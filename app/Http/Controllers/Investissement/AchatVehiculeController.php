<?php

namespace App\Http\Controllers\Investissement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\fournisseur;
use App\Models\Caisse;
use App\Models\Devise;
use App\Models\TypeReglement;
use App\Models\Stock;
use App\Models\Operation;
use App\Models\OperationDevise;
use App\Models\OperationVehiculeAchete;
use App\Models\Agence;
use App\Models\DeviseAgence;
use App\Models\MouvementCaisse;
use App\Models\ActiviteVehicule;
use Barryvdh\DomPDF\Facade\Pdf;

class AchatVehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id=Auth::user()->id;
        if(isset(Caisse::where('user_id',$id)->first(['id'])->id)){
            $caisse_id=Caisse::where('user_id',$id)->first(['id'])->id;
            $caisse=Caisse::find($caisse_id);
            $agence_id=Auth::user()->agence_id;
            $agence=Agence::find( $agence_id);
            $operations=OperationVehiculeAchete::where('user_id',$id)->where('fournisseur_id','!=', Null )->where('sens_operation', 'sortie' )->get();
            return view('investissement.achat_vehicule', compact('caisse','operations','agence'));
        }
        return view('devise.message');
    }

    public function fournisseur(Request $request){


        $data = $request->validate([
            'telephone'=>'required',
        ]);
        $data=$request->all();

        $tel = $data['telephone'];
        $agence_id=Auth::user()->agence_id;
        $societe_id=Auth::user()->societe_id;

        if(isset(ActiviteVehicule::where('agence_id',$agence_id)->where('etat_activite','ouverte')->first(['id'])->id))
        {

            /**
             * si le telephone existe afficher le fournisseur
             */
            if(isset(fournisseur::where('telephone' ,$tel)->where('societe_id',$societe_id)->first(['id'])->id)){

                $agence_id=Auth::user()->agence_id;
                $societe_id=Auth::user()->societe_id;
                $fournisseur_id=Fournisseur::where('telephone' ,$tel)->where('societe_id',$societe_id)->first(['id'])->id;
                $fournisseur=Fournisseur::find($fournisseur_id);
                $devise_agences=DeviseAgence::where('agence_id',$agence_id)->get();
                $activite_ouverte=ActiviteVehicule::where('agence_id',$agence_id)->where('etat_activite','ouverte')->first();
                $reglements= TypeReglement::all();
                return view('investissement.detail_achat_vehicule', compact('fournisseur','devise_agences','reglements','activite_ouverte'));
            /**
             * si non enregistre le fournisseur et affiche le formulaire
             */
            }else{
                
                $societe_id=Auth::user()->societe_id;
                fournisseur::create([
                    'telephone'=>$data['telephone'],
                    'societe_id'=>$societe_id,
                ]);
                /**
                 * si le telephone existe afficher le fournisseur
                 */
                $agence_id=Auth::user()->agence_id;
                $societe_id=Auth::user()->societe_id;
                $devise_agences=DeviseAgence::where('agence_id',$agence_id)->get();
                $fournisseur_id=Fournisseur::where('telephone' ,$tel)->where('societe_id',$societe_id)->first(['id'])->id;
                $fournisseur=Fournisseur::find($fournisseur_id);
                $devises= Devise::all();
                $activite_ouverte=ActiviteVehicule::where('agence_id',$agence_id)->where('etat_activite','ouverte')->first();
                $reglements= TypeReglement::all();
                return view('investissement.detail_achat_vehicule', compact('fournisseur','devise_agences','reglements','activite_ouverte'));
            //return redirect('/achat_devise')->with('success','fournisseur ajouté avsec succès');
            }
        }else{
           return redirect('/achat_vehicule')->with('danger','Vous n\'avez pas ouvert l\'activite'); 
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         /**
         * selection du fournisseur
        *$request->adresse &&
        *$request->f_id &&
        *$request->telephone &&
        *$request->nom_fournisseur &&
         */

         $fournisseur=Fournisseur::find($request->f_id);
if(
$request->annee &&
$request->marque &&
$request->model &&
$request->chassis &&
$request->charge_usa &&
$request->prix_achat &&
$request->activite_id 

){

    
    // dd($operation_vehicule);
    if(!isset(OperationVehiculeAchete::where('chassis',$request->chassis)->first(['id'])->id)){
        $user_id=Auth::user()->id;
    if(Caisse::where('user_id',$user_id)->first(['id'])->id)
    {

        $caisse_id=Caisse::where('user_id',$user_id)->first(['id'])->id;
        // $montant_operation=$request->prix_revient;
        $montant_operation=$request->charge_usa + $request->prix_achat;
        if(Caisse::where('user_id',$user_id)->first(['compte'])->compte < $montant_operation)
        {
            $compte_caisse= Caisse::where('user_id',$user_id)->first(['compte'])->compte;

            return redirect('/achat_vehicule')->with('danger','Le montant de votre caisse est insuffisant ');
        }
        else
        {
            $compte_caisse= Caisse::where('user_id',$user_id)->first(['compte'])->compte;
            $date_comptable= Caisse::where('user_id',$user_id)->first(['date_comptable'])->date_comptable;
        /**
         * mise a jour du fournisseur
         */
        $fournisseur->update([
            'nom_fournisseur'=>$request->nom_fournisseur,
            'telephone'=>$request->telephone,
            'adresse'=>$request->adresse,
        ]);
        /**
         * enregistrement de l'operation
         */
        OperationVehiculeAchete::create([
            'prix_achat'=>$request->prix_achat,
            'charge_usa'=>$request->charge_usa,
            'prix_revient'=>$montant_operation,
            'sens_operation'=>'sortie',
            'fournisseur_id'=>$request->f_id,
            'annee'=>$request->annee,
            'marque'=>$request->marque,
            'model'=>$request->model,
            'chassis'=>$request->chassis,
            'date_comptable'=>$date_comptable,
            'activite_id'=>$request->activite_id,
            'caisse_id'=>$caisse_id,
            'user_id'=>$user_id,
        ]);



         $compte=$compte_caisse-$montant_operation;

        $caisse=Caisse::find($caisse_id);

        /**
         * mise a jour du moouvement caisse
         */
        $user_id=Auth::user()->id;
        MouvementCaisse::create([
            'caisse_id'=>$caisse->id,
            'user_id'=>$user_id,
            'description'=>'Achat vehicule '.$request->chassis,
            'sortie'=>$montant_operation,
            'solde'=>$compte,
            'date_comptable'=>$date_comptable,

        ]);
        /**
         * mise a jour de la caisse
         */
        $caisse->update([
            'compte'=>$compte,
        ]);
        

        $id=Auth::user()->id;
        $operation=OperationVehiculeAchete::where('user_id',$id)->latest('id')->first();
        return redirect()->route('achat_vehicule.show',$operation)->with('success','operation effectuee avec succès');

        }

    }
    }else{
        return redirect('/achat_vehicule')->with('danger', "le chassis existe déjà");
    }
}else{
    return redirect('/achat_vehicule')->with('danger', "vous n'avez pas remplis tous les champs");
}
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $agence_id=Auth::user()->agence_id;
        $operation= OperationVehiculeAchete::find($id);
        $agence=Agence::find( $agence_id);
        return view('investissement.show_achat_vehicule', compact('operation','agence'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
