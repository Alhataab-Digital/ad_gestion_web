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
       $societe_id=Auth::user()->societe_id;
            $type_activites=TypeActiviteInvestissement::where('societe_id',$societe_id)->get();
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
       $societe_id=Auth::user()->societe_id;
       //dd($data);
       /**
        * insertion des données dans la table user
        */
        TypeActiviteInvestissement::create([
            'type_activite'=>$data['type_activite'],
            'societe_id'=>$societe_id,
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
            $type_activite=TypeActiviteInvestissement::find($id);
        return view('investissement.type_activite_edit',compact('type_activite'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'type_activite'=>'required',
        ]);
        $data=$request->all();
        $type_activite=TypeActiviteInvestissement::find($id);
        $type_activite->update([
            'type_activite'=>$data['type_activite'],
       ]);
       return redirect('/type_activite_investissement')->with('success',"Type d'investissement modifier avec succès");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
