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
use App\Models\NatureOperationCharge;
use App\Models\SecteurDepense;

class SecteurDepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
            $secteur_depenses=SecteurDepense::all();
        return view('investissement.secteur_depense',compact('secteur_depenses'));

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
           'secteur_depense'=>'required',
       ]);
       /**
        * donnee a ajouté dans la table
        */

       $data=$request->all();
       //dd($data);
       /**
        * insertion des données dans la table user
        */
        SecteurDepense::create([
           'secteur_depense'=>$data['secteur_depense'],
       ]);
       return redirect('/secteur_depense')->with('success',"operation ajouté avec succès");
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $secteur_depense=SecteurDepense::find($id);
        return view('investissement.secteur_depense_edit',compact('secteur_depense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'secteur_depense'=>'required',
        ]);
        $data=$request->all();
        $secteur_depense=SecteurDepense::find($id);

        $secteur_depense->update([
            'secteur_depense'=>$data['secteur_depense'],
       ]);
       return redirect('/secteur_depense')->with('success',"Secteur modifié avec succès");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
