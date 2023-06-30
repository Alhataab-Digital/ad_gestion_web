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
use App\Models\OperationInterCaisse;
use App\Models\NatureOperationCharge;

class AutresOperationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id=Auth::user()->id;
        if(isset(Caisse::where('user_id',$user_id)->first(['id'])->id)){
            $nature_operations=NatureOperationCharge::all();
            return view('operation.index', compact('nature_operations'));
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
        //
        // dd($request->nature_operation_id,
        // $request->montant_operation,
        // $request->commentaire,);

        $user_id=Auth::user()->id;
        if(Caisse::where('user_id',$user_id)->first(['id'])->id)
        {

             /**
            * validation des champs de saisie
            */
            $request->validate([
                'nature_operation_id'=>'required',
                'montant_operation'=>'required',
                'commentaire'=>'required',
            ]);

            $data=$request->all();

            $caisse_id=Caisse::where('user_id',$user_id)->first(['id'])->id;
            $compte_caisse= Caisse::where('user_id',$user_id)->first(['compte'])->compte;
            $date_comptable= Caisse::where('user_id',$user_id)->first(['date_comptable'])->date_comptable;
            $montant_operation=$data['montant_operation'];

            if($compte_caisse < $montant_operation){
                return redirect()->route('operation')->with('danger',"Le montant caisse est insuffisant");
            }else{

                    /**
                     * insertion des données dans la table user
                     */
                    Operation::create([
                        'montant_operation'=>$data['montant_operation'],
                        'commentaire'=>$data['commentaire'],
                        'sens_operation'=>'sortie',
                        'nature_operation_charge_id'=>$data['nature_operation_id'],
                        'caisse_id'=>$caisse_id,
                        'user_id'=>$user_id,
                        'date_comptable'=>$date_comptable,
                    ]);

                    /**
                     * mise a jour de la caisse
                    */
                    $compte=$compte_caisse-$montant_operation;

                    $caisse=Caisse::find($caisse_id);
                    $nature_operation=NatureOperationCharge::find($data['nature_operation_id']);

                    $user_id=Auth::user()->id;

                    MouvementCaisse::create([
                        'caisse_id'=>$caisse->id,
                        'user_id'=>$user_id,
                        'description'=> $nature_operation->nature_operation_charge,
                        'sortie'=>$montant_operation,
                        'solde'=>$compte,
                        'date_comptable'=>$date_comptable,

                    ]);

                    $caisse->update([
                        'compte'=>$compte,
                    ]);


                    return redirect()->route('operation')->with('success',"Operation effectuée avec succès");

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
