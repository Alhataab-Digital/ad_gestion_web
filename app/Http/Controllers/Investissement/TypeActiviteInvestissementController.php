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

class TypeActiviteInvestissementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       $agence_id=Auth::user()->agence_id;
            $type_activites=TypeActiviteInvestissement::where('agence_id',$agence_id)->get();
        return view('investissement.type_activite',compact('type_activites'));

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
           'type_activite'=>'required',
       ]);
       /**
        * donnee a ajouté dans la table
        */

       $data=$request->all();
       $agence_id=Auth::user()->agence_id;
       //dd($data);
       /**
        * insertion des données dans la table user
        */
        TypeActiviteInvestissement::create([
            'type_activite'=>$data['type_activite'],
            'agence_id'=>$agence_id,
       ]);
       return redirect('/type_activite_investissement')->with('success',"Type d'investissement ajouté avec succès");
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
