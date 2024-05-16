<?php

namespace App\Http\Controllers\Investissement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Investissement\SecteurDepense;

class SecteurDepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $secteur_depenses = SecteurDepense::all();
            return view('investissement.secteur_depense', compact('secteur_depenses'));
        }
        return redirect('/')->with('danger', "Session expirée");
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
            'secteur_depense' => 'required',
        ]);
        /**
         * donnee a ajouté dans la table
         */
        if (Auth::check()) {
            $data = $request->all();
            //dd($data);
            /**
             * insertion des données dans la table user
             */
            SecteurDepense::create([
                'secteur_depense' => $data['secteur_depense'],
            ]);
            return redirect('/secteur_depense')->with('success', "operation ajouté avec succès");
        }
        return redirect('/')->with('danger', "Session expirée");
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Auth::check()) {
            $id = decrypt($id);
            $secteur_depense = SecteurDepense::find($id);
            return view('investissement.secteur_depense_edit', compact('secteur_depense'));
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Auth::check()) {
            $id = decrypt($id);
            $request->validate([
                'secteur_depense' => 'required',
            ]);
            $data = $request->all();
            $secteur_depense = SecteurDepense::find($id);

            $secteur_depense->update([
                'secteur_depense' => $data['secteur_depense'],
            ]);
            return redirect('/secteur_depense')->with('success', "Secteur modifié avec succès");
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
