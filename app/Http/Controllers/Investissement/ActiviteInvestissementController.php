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
        'montant_decaisser'=>'required',
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
                $capital_investisseur=Investisseur::where('etat','1')->selectRaw('sum(compte_investisseur) as total')->first('total');
                $date_comptable= Caisse::where('user_id',$id)->first(['date_comptable'])->date_comptable;

                if($capital_investisseur->total < $data['montant_decaisser'])  {

                    return redirect('/activite_investissement/create',)->with('danger','Le montant capital inferieur au montant investis ');

                } else{

                    if($data['montant_decaisser'] > $compte_caisse)  {

                        return redirect('/activite_investissement/create',)->with('danger','Le montant caisse insuffisant ');

                    } else{
                    /**
                     * insertion des données dans la table user
                     */
                    ActiviteInvestissement::create([
                        'type_activite_id'=>$data['type_activite'],
                        'capital_activite'=>$capital_investisseur->total,
                        'montant_decaisse'=>$data['montant_decaisser'],
                        'commentaire'=>$data['commentaire'],
                        'user_id'=>$id,
                        'caisse_id'=>$caisse_id,
                        'agence_id'=>$agence_id,
                        'date_comptable'=>$date_comptable,
                    ]);

                    $activite_id=ActiviteInvestissement::where('user_id',$id)->latest('id')->first();

                    return redirect('/'.$activite_id->id.'/activite_investissement/repartition');
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
        $activite_investissement=ActiviteInvestissement::find($id);

        $activite_investissement->delete();

        return redirect('/activite_investissement/create',)->with('danger','Le activité supprimer ');

    }


    public function repartition($id)
    {

        $activite_investissement=ActiviteInvestissement::find($id);

        $investisseurs=Investisseur::where('compte_investisseur','>','0')->where('etat','1')->get();

        return view('investissement.activite_investissement_repartition', compact(
        'investisseurs',
        'activite_investissement',
    ));



    }

    public function repartie(Request $request)
    {
        $id=Auth::user()->id;
        $caisse_id=Caisse::where('user_id',$id)->first(['id'])->id;

            $compte_caisse= Caisse::where('user_id',$id)->first(['compte'])->compte;
            $compte_dividende_societe= Caisse::where('user_id',$id)->first(['compte_dividende_societe'])->compte_dividende_societe;
            $date_comptable= Caisse::where('user_id',$id)->first(['date_comptable'])->date_comptable;

        $activite_investissement=ActiviteInvestissement::find($request->activite_id);

        if($activite_investissement->etat_activite=='valider'){

            $dividende_entreprise=($request->montant_benefice/2);
            $dividende_investisseur=($request->montant_benefice/2);

            for($i=0;$i<count($request->investisseur_id); $i++)
            {

                 $investisseurs=Investisseur::where('id',$request->investisseur_id[$i])->get();

                foreach( $investisseurs as  $investisseur){

                    $investisseur_id   =$request->investisseur_id[$i];
                    $montant_investis  = $request->montant_investis[$i]+$investisseur->compte_investisseur;
                    $dividende_gagner  =(($request->taux[$i])*$dividende_investisseur)+$investisseur->compte_dividende;

                //     dd(
                // $investisseur_id,
                // $montant_investis,
                // $dividende_investisseur,
                // $dividende_gagner,
                // $request->taux,);

                        $data=[
                            'compte_dividende'   =>$dividende_gagner,
                            'compte_investisseur'  =>$montant_investis,
                        ];

                        Investisseur::where('id',$request->investisseur_id[$i])->update($data);

                }
            }

            $activite_investissement->update([
                'etat_activite'=>'terminer',
            ]);
             /**
                 * mise a jour de la caisse
                */
                $montant_operation=$request->dividende_entreprise+$request->montant_activite;

                $compte=$compte_caisse+$request->montant_activite;

                $compte_dividende_entreprise=$compte_dividende_societe+$dividende_entreprise;

                $caisse=Caisse::find($caisse_id);

                $user_id=Auth::user()->id;

                MouvementCaisse::create([
                    'caisse_id'=>$caisse->id,
                    'user_id'=>$user_id,
                    'description'=>'Cloture de l\'activite N° '. $activite_investissement->id,
                    'entree'=>$montant_operation,
                    'solde'=>$compte,
                    'date_comptable'=>$date_comptable,

                ]);

                $caisse->update([
                    'compte'=>$compte,
                    'compte_dividende_societe'=>$compte_dividende_entreprise,
                ]);

            return redirect('/activite_investissement/valider');
         } else{
            return redirect("/$activite_investissement->id/activite_investissement/repartition")->with('danger','Activité déjà términée ');;
        }
    }


}
