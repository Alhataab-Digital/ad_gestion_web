<?php

namespace App\Http\Controllers\Investissement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Client;
use App\Models\Caisse;
use App\Models\Devise;
use App\Models\Investisseur;
use App\Models\TypeReglement;
use App\Models\Stock;
use App\Models\Operation;
use App\Models\OperationDevise;
use App\Models\OperationVehiculeVendu;
use App\Models\OperationVehiculeAchete;
use App\Models\Agence;
use App\Models\DeviseAgence;
use App\Models\MouvementCaisse;
use App\Models\ActiviteVehicule;
use Barryvdh\DomPDF\Facade\Pdf;

class VenteVehiculeController extends Controller
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
            $operations=OperationVehiculeVendu::where('user_id',$id)->where('client_id','!=', Null )->where('etat',NULL)->where('sens_operation', 'entree' )->get();
            return view('investissement.vente_vehicule', compact('caisse','operations','agence'));
        }
        return view('devise.message');
    }

    public function client(Request $request)
    {

        $data = $request->validate([
            'telephone'=>'required',
        ]);
        $data=$request->all();

        $tel = $data['telephone'];
        $agence_id=Auth::user()->agence_id;
        if(isset(ActiviteVehicule::where('agence_id',$agence_id)->where('etat_activite','ouverte')->first(['id'])->id))
        {
        /**
         * si le telephone existe afficher le client
         */
            if(isset(client::where('telephone' ,$tel)->first(['id'])->id)){

                $agence_id=Auth::user()->agence_id;
                $societe_id=Auth::user()->societe_id;
                $client_id=client::where('telephone' ,$tel)->where('societe_id',$societe_id)->first(['id'])->id;
                $client=Client::find($client_id);
                $devise_agences=DeviseAgence::where('agence_id',$agence_id)->get();
                $activite_ouverte=ActiviteVehicule::where('agence_id',$agence_id)->where('etat_activite','ouverte')->first();
                $reglements= TypeReglement::all();
                return view('investissement.detail_vente_vehicule', compact('client','devise_agences','reglements','activite_ouverte'));
            /**
             * si non enregistre le client et affiche le formulaire
             */
            }else{
                $societe_id=Auth::user()->societe_id;
                Client::create([
                    'telephone'=>$data['telephone'],
                    'societe_id'=>$societe_id,
                ]);
                /**
                 * si le telephone existe afficher le client
                 */
                $agence_id=Auth::user()->agence_id;
                $societe_id=Auth::user()->societe_id;
                $devise_agences=DeviseAgence::where('agence_id',$agence_id)->get();
                $client_id=client::where('telephone' ,$tel)->where('societe_id',$societe_id)->first(['id'])->id;
                $client=Client::find($client_id);
                $devises= Devise::all();
                $activite_ouverte=ActiviteVehicule::where('agence_id',$agence_id)->where('etat_activite','ouverte')->first();
                $reglements= TypeReglement::all();
                return view('investissement.detail_vente_vehicule', compact('client','devise_agences','reglements','activite_ouverte'));
                //return redirect('/vente_devise')->with('success','client ajouté avsec succès');
            }
        }else{
            return redirect('/vente_vehicule')->with('danger','Vous n\'avez pas ouvert l\'activite'); 
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
        $client=Client::find($request->c_id);

        if($request->prix_vente ){

            if($request->prix_vente > $request->prix_revient){

                $agence_id=Auth::user()->agence_id;
                $id=Auth::user()->id;
                $request->c_id;
                $request->telephone;
                $request->nom_client;
                $request->id_vente;
                $request->annee;
                $request->marque;
                $request->model;
                $request->chassis;
                $request->prix_achat;
                $request->charge_usa;
                $request->prix_revient;
                $request->prix_vente;
                $marge= $request->prix_vente - $request->prix_revient;
                $request->activite_id;
                $activite_ouvert=ActiviteVehicule::find($request->activite_id);
                $operation_achat_id=OperationVehiculeAchete::where('chassis',$request->chassis)->first(['id'])->id;
                $operation_achat=OperationVehiculeAchete::find($operation_achat_id);
                $client=Client::find($request->c_id);
            // dd($operation_achat);

                if(Caisse::where('user_id',$id)->first(['id'])->id){
        
                        $caisse_id=Caisse::where('user_id',$id)->first(['id'])->id;
                        $caisse=Caisse::find($caisse_id);
                        $agence_id=Auth::user()->agence_id;
                        $agence=Agence::find( $agence_id);
        
                        $compte_caisse= Caisse::where('user_id',$id)->first(['compte'])->compte;
                        $date_comptable= Caisse::where('user_id',$id)->first(['date_comptable'])->date_comptable;
                        $montant_operation=$request->prix_vente;
                        
        
                        if($operation_achat->etat==NULL){

                            $activites=ActiviteVehicule::where('id',$request->activite_id)->get();

                            // dd($activites);

                            // $capital_investisseur=Investisseur::where('etat','1')->where('agence_id',$agence_id)->selectRaw('sum(compte_investisseur) as total')->first('total');
                            // $investisseurs= Investisseur::where('agence_id',$agence_id)->get();

                                // $dividende_entreprise=($marge/2);
                                // $dividende_investisseur=($marge/2);
                               
                                // foreach($investisseurs as $investisseur){
                                //         $taux=round(($investisseur->compte_investisseur/$capital_investisseur->total)*100);
                                //         $montant_repartis=round(($dividende_investisseur*$taux)/100);
                                //         $investisseur_id   =$investisseur->id;
                                //         $dividende_gagner  =$investisseur->compte_dividende+$montant_repartis;

                                //     // dd(
                                //     // $taux,
                                //     // $montant_repartis,
                                //     // $investisseur_id,
                                //     // $dividende_gagner,
                                //     //  );

                                //             $data=[
                                //                 'compte_dividende'   =>$dividende_gagner,
                                //             ];

                                //             Investisseur::where('id', $investisseur_id)->update($data);

                                // }
                                foreach($activites as $activite){

                                    $vente=$activite->montant_vente+$request->prix_vente;
                                    $depense=$activite->total_depense+$request->prix_revient;
                                    $benefice=$activite->montant_benefice+$marge;

                                    $activite_ouvert->update([
                                        'montant_vente'=> $vente,
                                        'total_depense'=> $depense,
                                        'montant_benefice'=>$benefice,
                                    ]);
                                }
                        
                                $client->update([
                                    'nom_client'=>$request->nom_client,
                                    'telephone'=>$request->telephone,
                                    'adresse'=>$request->adresse,
                                ]);

                                /**
                                 * enregistrement de l'operation
                                 */
                                $operation_achat->update([
                                    'etat'=>'vendu',
                                ]);


                                OperationVehiculeVendu::create([
                                    'prix_vente'=>$request->prix_vente,
                                    'marge'=>$marge,
                                    'sens_operation'=>'entree',
                                    'client_id'=>$request->c_id,
                                    'activite_id'=>$request->activite_id,
                                    'date_comptable'=>$date_comptable,
                                    'operation_vehicule_achete_id'=>$operation_achat_id,
                                    'activite_id'=>$request->activite_id,
                                    'caisse_id'=>$caisse_id,
                                    'user_id'=>$id,
                                ]);

                               
                                /**
                                 * mise a jour de la caisse
                                */
        
                            $compte=($compte_caisse)+($montant_operation);
        
                            $caisse=Caisse::find($caisse_id);
        
                            $user_id=Auth::user()->id;
        
                            MouvementCaisse::create([
                                'caisse_id'=>$caisse->id,
                                'user_id'=>$id,
                                'description'=>'Vente vehicule '.$request->chassis,
                                'entree'=>$montant_operation,
                                'solde'=>$compte,
                                'date_comptable'=>$date_comptable,
        
                            ]);
        
                            $caisse->update([
                                'compte'=>$compte,
                            ]);
        
                            return redirect('/vente_vehicule');
                        } else{
                            return redirect("/detail_activite_investissement/repartition")->with('danger','Activité déjà términée ');;
                        }
                }


            }else{

                return redirect('/vente_vehicule')->with('danger', "Le montant de la vente est inferieur au montant de revient");

            }

        }else{

            return redirect('/vente_vehicule')->with('danger', "vous n'avez pas saisie le montant de la vente");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

    public function chassis(Request $request){
        if(Auth::check()){
            $societe_id=Auth::user()->societe_id;
            $agence_id=Auth::user()->agence_id;

            $data['chassis']=OperationVehiculeAchete::where('chassis',$request->chassis)->where('etat',null)->get();
            return response()->json($data);
        }
            return redirect('/auth')->with('success',"Vous n'êtes pas autorisé à accéder");

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
