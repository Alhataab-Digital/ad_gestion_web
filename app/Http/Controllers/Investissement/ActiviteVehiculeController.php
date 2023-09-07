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
use App\Models\OperationVehiculeVendu;
use App\Models\Agence;
use App\Models\Societe;
use App\Models\DeviseAgence;
use App\Models\MouvementCaisse;
use App\Models\Investisseur;
use App\Models\ActiviteVehicule;
use Barryvdh\DomPDF\Facade\Pdf;

class ActiviteVehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $id=Auth::user()->id;
        if(isset(Caisse::where('user_id',$id)->first(['id'])->id)){
            $caisse_id=Caisse::where('user_id',$id)->first(['id'])->id;
                $caisse=Caisse::find($caisse_id);
                $agence_id=Auth::user()->agence_id;
                $agence=Agence::find( $agence_id);
        $activites=ActiviteVehicule::where('etat_activite','en cours')->where('agence_id',$agence_id)->get();
        return view('investissement.activite_vehicule',compact('activites','caisse'));
        }
        return view('investissement.message');
    }

    public function fermeture()
    {
        //
        $id=Auth::user()->id;
        if(isset(Caisse::where('user_id',$id)->first(['id'])->id)){
            $caisse_id=Caisse::where('user_id',$id)->first(['id'])->id;
                $caisse=Caisse::find($caisse_id);
                $agence_id=Auth::user()->agence_id;
                $agence=Agence::find( $agence_id);
        $activite_ouvertes=ActiviteVehicule::where('etat_activite','ouverte')->where('agence_id',$agence_id)->get();
        return view('investissement.fermer_activite_vehicule',compact('activite_ouvertes','caisse'));
        }
        return view('investissement.message');
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
        $request->validate([
            'intitule'=>'required',
            'montant_ouverture'=>'required',
            'detail'=>'required',
        ]);
    
        /**
         * donnee a ajouté dans la table
         */
    
        $data=$request->all();
        // dd($data);
        $id=Auth::user()->id;
    
            if(isset(Caisse::where('user_id',$id)->first(['id'])->id))
            {
                    $caisse_id=Caisse::where('user_id',$id)->first(['id'])->id;
                    $caisse=Caisse::find($caisse_id);
                    $societe_id=Auth::user()->societe_id;
                    $agence_id=Auth::user()->agence_id;
                    $agence=Agence::find( $agence_id);
    
                    $compte_caisse= Caisse::where('user_id',$id)->first(['compte'])->compte;
                    $investisseurs=Investisseur::where('compte_investisseur','>','0')->where('etat','1')->where('societe_id',$societe_id)->get();
                    foreach($investisseurs as $investisseur)
                    {
                        
                            $taux=DeviseAgence::where('devise_id',$investisseur->agence->devise_id)->where('agence_id',$agence_id)->get();
                            foreach($taux as $tx)
                            {
                                $capital_investisseurs=Investisseur::where('etat','1')->where('societe_id',$societe_id)->selectRaw('sum(compte_investisseur) as total')->get();
                                // $somme_total=0;
                                foreach($capital_investisseurs as $capital_investisseur)
                                {
                                    
                                        // $mult = pow(10, abs($places)); 
                                        // return $places < 0 ?
                                        // ceil($value / $mult) * $mult :
                                        //     ceil($value * $mult) / $mult;
                                    
                                    //    dd($capital_investisseur->total,$tx->taux);
                                        $somme_total=ceil($capital_investisseur->total/$tx->taux);
                                        // dd($somme_total);
                                        $date_comptable= Caisse::where('user_id',$id)->first(['date_comptable'])->date_comptable;
                        
                                    if(isset(ActiviteVehicule::where('etat_activite','ouverte')->where('agence_id',$agence_id)->first(['id'])->id))
                                    {
                                        return redirect('/activite_vehicule',)->with('danger','L\'activite est déjà ouverte ');
                                    }else{
                                        if( $somme_total < $data['montant_ouverture'])  {
                        
                                            return redirect('/activite_vehicule',)->with('danger','Le montant de l\'activité est supperieur au capital investis ');
                        
                                        } else{
                
                                            if( $compte_caisse < $data['montant_ouverture'])  {
                        
                                                return redirect('/activite_vehicule',)->with('danger','Le montant caisse insuffisant ');
                        
                                            } else{
                                                /**
                                                 * insertion des données dans la table user
                                                 */
                                                ActiviteVehicule::create([
                                                    'intitule'=>$data['intitule'],
                                                    'capital_activite'=>$somme_total,
                                                    'montant_ouverture'=>$data['montant_ouverture'],
                                                    'taux_devise'=>$tx->taux,
                                                    'detail'=>$data['detail'],
                                                    'user_id'=>$id,
                                                    'caisse_id'=>$caisse_id,
                                                    'agence_id'=>$agence_id,
                                                    'date_comptable'=>$date_comptable,
                                                ]);
                            
                                                $activite_id=ActiviteVehicule::where('user_id',$id)->latest('id')->first();
                            
                                                return redirect('/'.$activite_id->id.'/activite_vehicule/repartition');
                                            }
                                        }
                                    }
                                }
                            }
                        
                    }
            }
        return view('devise.message');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $activite_vehicule=ActiviteVehicule::find($id);

        $detail_activite_vehicules=DetailActiviteVehicule::where('activite_vehicule_id',$activite_vehicule->id)->get();
        $operation_depenses=OperationDepenseActivite::where('activite_vehicule_id',$activite_vehicule->id)->get();

            return view('investissement.activite_vehicule_show', compact(
                'detail_activite_vehicules',
                'activite_vehicule',
                'operation_depenses'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user_id=Auth::user()->id;
        $caisse_id=Caisse::where('user_id',$user_id)->first(['id'])->id;
            $caisse=Caisse::find($caisse_id);
            $agence_id=Auth::user()->agence_id;
            $agence=Agence::find( $agence_id);
        $activite=ActiviteVehicule::find($id);

        return view('investissement.benefice_investissement', compact('activite','caisse'));
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

    public function repartition($id)
    {

        $activite_vehicule=ActiviteVehicule::find($id);

        $agence_id=Auth::user()->agence_id;
        $societe_id=Auth::user()->societe_id;

        $investisseurs=Investisseur::where('compte_investisseur','>','0')->where('etat','1')->where('societe_id',$societe_id)->get();

        return view('investissement.activite_vehicule_repartition', compact(

            'investisseurs',
            'activite_vehicule',
            
        ));

    }

    public function valider()
    {

        $id=Auth::user()->id;
        if(isset(Caisse::where('user_id',$id)->first(['id'])->id)){
        $caisse_id=Caisse::where('user_id',$id)->first(['id'])->id;
                $caisse=Caisse::find($caisse_id);
                $agence_id=Auth::user()->agence_id;
                $agence=Agence::find( $agence_id);
        $activites=ActiviteVehicule::where('etat_activite','ouverte')->where('agence_id',$agence_id)->get();
        return redirect('/activite_vehicule',)->with('success','Activite ouverte ');
    
        }
        return view('investissement.message');
    }

    public function repartie(Request $request)
    {
        $id=Auth::user()->id;
        $agence_id=Auth::user()->agence_id;

        $caisse_id=Caisse::where('user_id',$id)->first(['id'])->id;

            $compte_caisse= Caisse::where('user_id',$id)->first(['compte'])->compte;
            $compte_dividende_societe= Agence::where('id',$agence_id)->first(['compte_societe'])->compte_societe;
            $date_comptable= Caisse::where('user_id',$id)->first(['date_comptable'])->date_comptable;
            $vehicule_vendus=OperationVehiculeVendu::where('activite_id',$request->activite_id)->get();
            $activite_vehicule=ActiviteVehicule::find($request->activite_id);

        if($activite_vehicule->etat_activite=='ouverte'){
            $taux_devise=$activite_vehicule->taux_devise;
            $dividende_entreprise=ceil($request->montant_benefice/2);
            $benefice_investisseur=ceil($request->montant_benefice/2);
            $benefice_securite=ceil($benefice_investisseur*0.1);
            $dividende_investisseur=$benefice_investisseur-$benefice_securite;
            $total_depense=$request->total_depense;
            
            // dd(
            //     $taux_devise,
            //     $dividende_entreprise,
            //     $benefice_investisseur,
            //     $benefice_securite,
            //     $dividende_investisseur,
            //     $total_depense
            // );


            for($i=0;$i<count($request->investisseur_id); $i++)
            {

                $investisseurs=Investisseur::where('id',$request->investisseur_id[$i])->get();

                foreach( $investisseurs as  $investisseur){
                    $caisse=Caisse::find($caisse_id);
                    
                    $investisseur_id   =$request->investisseur_id[$i];
                    $montant_investis  = (ceil(($request->montant_investis[$i])*$taux_devise))+$investisseur->compte_investisseur;
                    $dividende_gagner  =(($request->taux[$i])*(ceil($dividende_investisseur*$taux_devise)))+$investisseur->compte_dividende;
                // dd(
                // $investisseur_id,
                // $montant_investis,
                // $dividende_investisseur,
                // $dividende_gagner,
                // $request->taux,
                // );
                        $data=[
                            'compte_dividende'   =>$dividende_gagner,
                            'compte_investisseur'  =>$montant_investis,
                        ];

                        Investisseur::where('id', $investisseur_id)->update($data);

                }
                foreach($vehicule_vendus as $vehicule_vendu){

                    $vehicule_vendu->update([
                        'etat'=>'fermer',
                    ]);
                }
            }

            // for($k=0;$k<count($request->secteur_id); $k++)
            // {

            //     $data=[
            //         'activite_vehicule_id'   =>$activite_vehicule->id,
            //         'secteur_depense_id'               =>$request->secteur_id[$k],
            //         'montant_depense'       =>$request->montant_depense[$k],
            //     ];
            //     OperationDepenseActivite::create($data);

            // }

            $activite_vehicule->update([
                'etat_activite'=>'fermer',
            ]);
             /**
                 * mise a jour de la caisse
                */
                $montant_operation=$request->montant_benefice+$request->montant_activite;

                $compte=$compte_caisse+$montant_operation;

                $compte_dividende_entreprise=ceil($compte_dividende_societe+$dividende_entreprise*$taux_devise);

                $caisse=Caisse::find($caisse_id);

                $user_id=Auth::user()->id;

                // MouvementCaisse::create([
                //     'caisse_id'=>$caisse->id,
                //     'user_id'=>$user_id,
                //     'description'=>'Fermeture de l\'activite N° '. $activite_vehicule->id,
                //     'entree'=>$montant_operation,
                //     'solde'=>$compte,
                //     'date_comptable'=>$date_comptable,

                // ]);

                $societe_id=Auth::user()->societe_id;
                $societe=Societe::find($societe_id);
                $societe->update([
                    'compte_societe'=>$compte_dividende_entreprise,
                    'compte_securite'=>ceil($benefice_securite*$taux_devise),
                ]);

            return redirect('/activite_vehicule')->with('success','Activité fermée');
         } else{
            return redirect("/$activite_vehicule->id/activite_vehicule/repartition")->with('danger','Activité déjà términée ');;
        }
    }
}
