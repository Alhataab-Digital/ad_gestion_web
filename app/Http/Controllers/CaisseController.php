<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Caisse;
use App\Models\Societe;
use App\Models\Agence;
use App\Models\Stock;
use App\Models\Operation;
use App\Models\OperationTransfert;
use App\Models\OperationInvestisseur;
use App\Models\ActiviteInvestissement;
use App\Models\MouvementCaisse;


class CaisseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){

            $societe_id=Auth::user()->societe_id;
            $agences=Agence::where('societe_id',$societe_id)->get();
            $caisses=Caisse::all();

        return view('caisse.index', compact('caisses','agences'));
        }
        return redirect('/')->with('danger',"Session expirée");
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
             * validation des champs de saisie
             */
            $request->validate([
                'libelle'=>'required',
                'montant_min'=>'required',
                'montant_max'=>'required',
                'compte'=>'required',
                'agence_id'=>'required',
            ]);
            /**
             * donnee a ajouté dans la table
             */

            $data=$request->all();
            if(Auth::check()){
            /**
             * insertion des données dans la table user
             */
            Caisse::create([
                'libelle'=>$data['libelle'],
                'montant_min'=>$data['montant_min'],
                'montant_max'=>$data['montant_max'],
                'compte'=>$data['compte'],
                'agence_id'=>$data['agence_id'],
            ]);
            return redirect('/caisse')->with('success','caisse crée avec succès');
        }
        return redirect('/')->with('danger',"Session expirée");

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function attribution()
    {
            $user_id=Auth::user()->id;
            $agence_id=Auth::user()->agence_id;

            $caisse_destinations=Caisse::where('user_id','!=',$user_id)->where('agence_id',$agence_id)->get();
        return view('caisse.attribution', compact('caisse_destinations',));
    }

    public function attribution_valider()
    {
        return view('caisse.attribution');
    }

    public function operation()
    {
        if(Auth::check()){
            $id=Auth::user()->id;
            $caisses=Caisse::where('user_id',$id)->get();
            $user_id=Auth::user()->id;
            $agence_id=Auth::user()->agence_id;
            $agence=Agence::find($agence_id);
            if(isset(Caisse::where('user_id',$user_id)->first(['id'])->id)){

                $caisse_id=Caisse::where('user_id',$user_id)->first(['id'])->id;
                $stocks=Stock::Where('caisse_id',$caisse_id)->get();
                return view('caisse.operation', compact('caisses','stocks','agence'));
            }
            return view('caisse.message');
        }
        return redirect('/')->with('danger',"Session expirée");
    }
    public function ouverture(Request $request, $id)
    {
        $jour=date("Y-m-d");
        if($request->date==$jour){

                    $caisse = Caisse::find($id);
                    $user_id=Auth::user()->id;
                    MouvementCaisse::create([
                    'caisse_id'=>$caisse->id,
                    'user_id'=>$user_id,
                    'description'=>'Ouverture caisse',
                    'entree'=>$caisse->compte,
                    'solde'=>$caisse->compte,
                    'date_comptable'=>$request->date,
                    ]);

                // dd($caisse);
                    $caisse->update([
                        'etat'=>1,
                        'date_comptable'=>$request->date,
                    ]);
                    return redirect('caisse/operation')->with('success',"Caisse ouverte");
        }else{
            return redirect('caisse/operation')->with('danger',"La date n'est pas à jours ");
        }

    }
    public function fermeture(Request $request,$id)
    {
        $caisse = Caisse::find($id);
        $user_id=Auth::user()->id;

        MouvementCaisse::create([
            'caisse_id'=>$caisse->id,
            'user_id'=>$user_id,
            'description'=>'Fermeture caisse',
            'entree'=>$caisse->compte,
            'solde'=>$caisse->compte,
            'date_comptable'=>$request->date,
        ]);
        // dd($caisse);
         $caisse->update([
             'etat'=>0,
         ]);
         return redirect('caisse/operation')->with('danger',"Caisse fermée");
    }

    public function rapport_caisse()
    {
        $id=Auth::user()->id;
        if(Caisse::where('user_id',$id)->first()){

            $caisse=Caisse::where('user_id',$id)->first();

            $agence_id=Auth::user()->agence_id;
            $agence=Agence::find($agence_id);
            $mouvement_caisses=MouvementCaisse::where('caisse_id',$caisse->id)->get();
        /**
         * rapport caisse gestion investissement
         */
        $entree=OperationInvestisseur::where('caisse_id',$caisse->id)->where('sens_operation','entree')->sum('montant_operation');
        $sortie=OperationInvestisseur::where('caisse_id',$caisse->id)->where('sens_operation','sortie')->sum('montant_operation');
        $decaissement=ActiviteInvestissement::where('caisse_id',$caisse->id)->sum('montant_decaisse');
        $entree_count=OperationInvestisseur::where('caisse_id',$caisse->id)->where('sens_operation','entree')->count();
        $sortie_count=OperationInvestisseur::where('caisse_id',$caisse->id)->where('sens_operation','sortie')->count();
        $activite_count=ActiviteInvestissement::where('caisse_id',$caisse->id)->count();
        /**
         * rapport caisse gestion change
         */
        $envoi_change=OperationTransfert::where('envoi_user_id',$id)->sum('montant_ttc');
        if(OperationTransfert::where('type_envoi',1)){

            $retrait_change=OperationTransfert::where('retrait_user_id',$id)->sum(DB::raw('montant_ttc/taux_echange') );
        }
        if(OperationTransfert::where('type_envoi',0)){

        $retrait_change=OperationTransfert::where('retrait_user_id',$id)->sum(DB::raw('montant/taux_echange') );
        }
        $envoi_change_count=OperationTransfert::where('envoi_user_id',$id)->count();
        $retrait_change_count=OperationTransfert::where('retrait_user_id',$id)->count();

        $achat_change=Operation::where('user_id',$id)->where('sens_operation','sortie')->sum('montant_operation');
        $vente_change=Operation::where('user_id',$id)->where('sens_operation','entree')->sum('montant_operation');
        $achat_change_count=Operation::where('user_id',$id)->where('sens_operation','sortie')->count();
        $vente_change_count=Operation::where('user_id',$id)->where('sens_operation','entree')->count();

        return view('caisse.rapport_caisse',compact('caisse','entree','sortie',
        'entree_count','sortie_count',
        'envoi_change','retrait_change',
        'envoi_change_count','retrait_change_count',
        'mouvement_caisses','agence',
        'achat_change_count','vente_change_count',
        'achat_change','vente_change',
        'activite_count','decaissement'));

        }

        return view('erreur.message');
    }
}
