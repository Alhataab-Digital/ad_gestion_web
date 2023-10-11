<?php

namespace App\Http\Controllers\Investissement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Caisse;
use App\Models\MouvementCaisse;
use App\Models\Societe;
use App\Models\Devise;
use App\Models\Agence;
use App\Models\Investisseur;
use App\Models\TypeActiviteInvestissement;
use App\Models\ActiviteInvestissement;
use App\Models\ActiviteVehicule;
use App\Models\DetailActiviteInvestissement;
use App\Models\DetailActiviteVehicule;
use App\Models\BeneficeActivite;
use App\Models\RepartitionDividende;
use App\Models\OperationInvestisseur;
use App\Models\SecteurDepense;

class DetailActiviteVehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        
        // $request->taux_devise;
        //
        // dd($request->montant);
        // dd($request->benefice);
        // dd($request->dividende_e);
        // dd($request->dividende_i);
        // dd(
    //     // $request->investisseur,
        // $request->montant_investis,
        // $request->montant_restant,
        // $request->taux_devise,
    //     // $request->montant_restant*$request->taux_devise,
    //     // $request->compte,
    //     // $request->investisseur_id
    // );

        $id=Auth::user()->id;

        if(Caisse::where('user_id',$id)->first(['id'])->id){

                $caisse_id=Caisse::where('user_id',$id)->first(['id'])->id;
                $caisse=Caisse::find($caisse_id);
                $agence_id=Auth::user()->agence_id;
                $agence=Agence::find( $agence_id);



                $compte_caisse= Caisse::where('user_id',$id)->first(['compte'])->compte;
                $date_comptable= Caisse::where('user_id',$id)->first(['date_comptable'])->date_comptable;
                $montant_operation=$request->montant_ouverture;
            if( $compte_caisse < $montant_operation){
                return redirect('activite_vehicule/create',)->with('danger','Le montant prevus pour l\'activite est superieur au montant capital !');
            }else{

                $activite_vehicule=ActiviteVehicule::find($request->activite_id);

                if($activite_vehicule->etat_activite==Null){

                    $investisseur_id   =$request->investisseur_id;
                    $activite       =$request->activite_id;
                    $montant_investis  = $request->montant_investis;
                    $taux  = $request->taux;
                    $taux_devise=$request->taux_devise;
                    $montant_restant  =$request->montant_restant;
                    // dd($activite ,$montant_investis,$montant_restant,$taux_devise);

                    for($i=0;$i<count($investisseur_id); $i++)
                    {

                        $data=[

                            'activite_vehicule_id'   =>$activite,
                            'investisseur_id'              =>$investisseur_id[$i],
                            'montant_investis'             =>$montant_investis[$i],
                            'taux'                         =>$taux[$i],
                        ];

                        DetailActiviteVehicule::create($data);

                    }

                    $activite_vehicule->update([
                        'etat_activite'=>'ouverte',
                    ]);

                    foreach($request->investisseur_id as $key=>$items ){

                        $investisseur['id']=$request->investisseur_id[$key];
                        $investisseur['compte_investisseur']=round($taux_devise*$request->montant_restant[$key]);

                        Investisseur::where('id',$request->investisseur_id[$key])->update($investisseur);

                    }

                //     /**
                //  * mise a jour de la caisse
                // */

                //     $compte=($compte_caisse)-($montant_operation);

                //     $caisse=Caisse::find($caisse_id);

                //     $user_id=Auth::user()->id;

                //     MouvementCaisse::create([
                //         'caisse_id'=>$caisse->id,
                //         'user_id'=>$user_id,
                //         'description'=>'Budget decaisser pour investissement',
                //         'sortie'=>$montant_operation,
                //         'solde'=>$compte,
                //         'date_comptable'=>$date_comptable,

                //     ]);

                //     $caisse->update([
                //         'compte'=>$compte,
                //     ]);


                    return redirect('/activite_vehicule/valider');
                } else{
                    return redirect("/detail_activite_vehicule/repartition")->with('danger','Activité déjà términée ');;
                }
            }
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
        $user_id=Auth::user()->id;
        $caisse_id=Caisse::where('user_id',$user_id)->first(['id'])->id;
            $caisse=Caisse::find($caisse_id);
            $agence_id=Auth::user()->agence_id;
            $agence=Agence::find( $agence_id);

        $activite_vehicule=ActiviteVehicule::find($id);

         $detail_activite_vehicules=DetailActiviteVehicule::where('activite_vehicule_id',$id)->get();

        return view('investissement.detail_activite_vehicule', compact('activite_vehicule',
        'caisse','detail_activite_vehicules'
    ));
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
