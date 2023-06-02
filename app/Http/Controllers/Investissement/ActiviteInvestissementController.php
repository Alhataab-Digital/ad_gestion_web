<?php

namespace App\Http\Controllers\Investissement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Caisse;
use App\Models\Societe;
use App\Models\Devise;
use App\Models\Agence;
use App\Models\Investisseur;
use App\Models\TypeActiviteInvestissement;
use App\Models\MouvementCaisse;
use App\Models\ActiviteInvestissement;
use App\Models\BeneficeActivite;
use App\Models\RepartitionDividende;
use App\Models\OperationInvestisseur;

class ActiviteInvestissementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $id=Auth::user()->id;
        $caisse_id=Caisse::where('user_id',$id)->first(['id'])->id;
                $caisse=Caisse::find($caisse_id);
                $agence_id=Auth::user()->agence_id;
                $agence=Agence::find( $agence_id);
        $activites=ActiviteInvestissement::where('etat_activite','en cours')->get();
        return view('investissement.activite_investissement_liste',compact('activites','caisse'));

    }
    public function valider()
    {
        //
        $id=Auth::user()->id;
        $caisse_id=Caisse::where('user_id',$id)->first(['id'])->id;
                $caisse=Caisse::find($caisse_id);
                $agence_id=Auth::user()->agence_id;
                $agence=Agence::find( $agence_id);
        $activites=ActiviteInvestissement::where('etat_activite','valider')->get();
        return view('investissement.activite_investissement_valider',compact('activites','caisse'));

    }

    public function terminer()
    {
        //
        $id=Auth::user()->id;
        $caisse_id=Caisse::where('user_id',$id)->first(['id'])->id;
                $caisse=Caisse::find($caisse_id);
                $agence_id=Auth::user()->agence_id;
                $agence=Agence::find( $agence_id);
        $activites=ActiviteInvestissement::where('etat_activite','terminer')->get();
        return view('investissement.activite_investissement_terminer',compact('activites','caisse'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id=Auth::user()->id;

        if(isset(Caisse::where('user_id',$id)->first(['id'])->id)){
                $caisse_id=Caisse::where('user_id',$id)->first(['id'])->id;
                $caisse=Caisse::find($caisse_id);
                $agence_id=Auth::user()->agence_id;
                $agence=Agence::find( $agence_id);
            $type_activites=TypeActiviteInvestissement::all();
            return view('investissement.activite_investissement', compact('type_activites','caisse'));
        }
        return view('devise.message');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        /**
        * validation des champs de saisie
        */
       $request->validate([
        'type_activite'=>'required',
        // 'montant_decaisser'=>'required',
        'commentaire'=>'required',
    ]);
    /**
     * donnee a ajouté dans la table
     */

    $data=$request->all();
    // dd($data);
    $id=Auth::user()->id;

        if(isset(Caisse::where('user_id',$id)->first(['id'])->id)){
                $caisse_id=Caisse::where('user_id',$id)->first(['id'])->id;
                $caisse=Caisse::find($caisse_id);
                $agence_id=Auth::user()->agence_id;
                $agence=Agence::find( $agence_id);



            $compte_caisse= Caisse::where('user_id',$id)->first(['compte'])->compte;
            $date_comptable= Caisse::where('user_id',$id)->first(['date_comptable'])->date_comptable;

            /**
             * insertion des données dans la table user
             */
                    ActiviteInvestissement::create([
                        'type_activite_id'=>$data['type_activite'],
                        // 'capital_activite'=>$compte_caisse,
                        // 'montant_decaisse'=>$data['montant_decaisser'],
                        'commentaire'=>$data['commentaire'],
                        'user_id'=>$id,
                        'caisse_id'=>$caisse_id,
                        'agence_id'=>$agence_id,
                        'date_comptable'=>$date_comptable,
                    ]);
                // /**
                //  * mise a jour de la caisse
                //  */

                // $compte=$compte_caisse-$montant_operation;

                // $caisse=Caisse::find($caisse_id);

                // $user_id=Auth::user()->id;

                // MouvementCaisse::create([
                //     'caisse_id'=>$caisse->id,
                //     'user_id'=>$user_id,
                //     'description'=>'Budget decaisser pour investissement',
                //     'sortie'=>$montant_operation,
                //     'solde'=>$compte,
                //     'date_comptable'=>$date_comptable,

                // ]);


                // $caisse->update([
                //     'compte'=>$compte,
                // ]);
                $activite_id=ActiviteInvestissement::where('user_id',$id)->latest('id')->first();

                    return redirect('/'.$activite_id->id.'/activite_investissement/repartition');

        }
        return view('devise.message');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user_id=Auth::user()->id;
            $caisse_id=Caisse::where('user_id',$user_id)->first(['id'])->id;
                $caisse=Caisse::find($caisse_id);
                $agence_id=Auth::user()->agence_id;
                $agence=Agence::find( $agence_id);
            $activite_investissement=ActiviteInvestissement::find($id);
            $benefice_activite=BeneficeActivite::where('activite_id',$activite_investissement->id)->first();
            $dividendes=RepartitionDividende::where('activite_id',$activite_investissement->id)->get();
            return view('investissement.activite_investissement_show', compact('activite_investissement',
            'caisse','benefice_activite',
            'dividendes'
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
            $activite=ActiviteInvestissement::find($id);
            return view('investissement.benefice_investissement', compact('activite','caisse'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        /**
        * validation des champs de saisie
        */
       $request->validate([
        'montant_benefice'=>'required',
    ]);
    $data=$request->all();

    $activite_investissement=ActiviteInvestissement::find($id);

    $activite_investissement->update([
        'montant_benefice'=>$data['montant_benefice'],
        'etat_activite'=>'valider',
    ]);

    return redirect('/'.$id.'/activite_investissement/repartition',)->with('danger','Le benefice valider ');

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
        $activite_investissement=ActiviteInvestissement::find($id);



            /**
         * total benefice activite
         */
        $total_benefice_activite=$activite_investissement->montant_benefice;

        /**
         * partage dividende activite entre investisseur et entreprise
         */
        $dividende_entreprise=$dividende_investisseur=round($total_benefice_activite/2);
        $capital_activite_encours=ActiviteInvestissement::where('etat_activite','en cours')->where('date_comptable','<=',$activite_investissement->date_comptable)->sum('capital_activite');
        /**
         * total investissement
         */
        $vi_investisseur=OperationInvestisseur::where('sens_operation','entree')->where('date_comptable','<=',$activite_investissement->date_comptable)->sum('montant_operation');
        /**
         * liste investisseur
         */
        // $investisseurs= OperationInvestisseur::where('etat','1')->where('compte_investisseur','!=','0')->where('date_creation','<=',$activite_investissement->date_comptable)->get();
        $investisseurs=OperationInvestisseur::where('sens_operation','entree')->where('date_comptable','<=',$activite_investissement->date_comptable)->get();

        // foreach($investisseurs as $investisseur){

        //     $taux=(($investisseur->montant_operation));

        //     dd($taux);

        // }
        return view('investissement.activite_investissement_repartition', compact(
        'investisseurs',
        'vi_investisseur',
        'activite_investissement',
        'capital_activite_encours',
    ));



    }

    public function repartie(Request $request, string $id)
    {
        // dd($request->montant);
        // dd($request->benefice);
        // dd($request->dividende_e);
        // dd($request->dividende_i);
        // dd(
        // $request->investisseur,
        // $request->compte,
        // $request->dividende);
        // dd($request->compte);
        // dd($request->dividende);
        $activite_investissement=ActiviteInvestissement::find($id);

        if($activite_investissement->etat_activite=='valider'){

            $investisseur_id   =$request->investisseur;
            $activite       =$request->activite;
            $montant_investis  = $request->compte;
            $dividende_gagner  =$request->dividende;


            BeneficeActivite::create([
                'couts_activite'        =>$request->montant,
                'benefice_activite'     =>$request->benefice,
                'benefice_entreprise'   =>$request->dividende_e,
                'benefice_investisseur' =>$request->dividende_i,
                'activite_id'           =>$request->activite_id,
                'date_operation'        =>date("Y-m-d"),

            ]);
            for($i=0;$i<count($investisseur_id); $i++)
            {

                $data=[

                    'activite_id'       =>$activite[0],
                    'investisseur_id'   =>$investisseur_id[$i],
                    'montant_investis'  =>$montant_investis[$i],
                    'dividende_gagner'  =>$dividende_gagner[$i],
                ];
                RepartitionDividende::create($data);

            }

            $activite_investissement->update([
                'etat_activite'=>'terminer',
            ]);

            return redirect('/activite_investissement/valider');
         } else{
            return redirect("/$activite_investissement->id/activite_investissement/repartition")->with('danger','Activité déjà términée ');;
        }
    }


}
