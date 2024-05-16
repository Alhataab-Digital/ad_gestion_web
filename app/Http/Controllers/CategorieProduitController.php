<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CategorieProduit;

class CategorieProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (Auth::check()) {
            $id = Auth::user()->societe_id;
            $agence_id = Auth::user()->agence_id;
            $categories = CategorieProduit::where('agence_id', $agence_id)->get();
            return view('categorie_produit.index', compact('categories'));
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
        //
        /**
         * validation des champs de saisie
         */
        $request->validate([
            'nom' => 'required',
            'commentaire' => 'required',
        ]);
        $agence_id = Auth::user()->agence_id;
        /**
         * donnee a ajouté dans la table
         */

        $data = $request->all();
        if (Auth::check()) {
            /**
             * insertion des données dans la table user
             */
            CategorieProduit::create([
                'nom_categorie_produit' => $data['nom'],
                'description_categorie_produit' => $data['commentaire'],
                'agence_id' => $agence_id,
            ]);
            return redirect('/categorie_produit')->with('success', 'categorie produit crée avec succès');
        }
        return redirect('/')->with('danger', "Session expirée");
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
        $id = decrypt($id);
        if (Auth::check()) {
            $categorie = CategorieProduit::find($id);
            return view('categorie_produit.edit', compact('categorie'));
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
            $categorie = CategorieProduit::find($id);
            /**
             * validation des champs de saisie
             */
            $data = $request->validate([
                'nom' => 'required',
                'description' => 'required',
            ]);
            /**
             * donnee a ajouté dans la table
             */


            /**
             * insertion des données dans la table user
             */
            $categorie->update([
                'nom_categorie_produit' => $data['nom'],
                'description_categorie_produit' => $data['description'],
            ]);
            return back()->with('success', 'Categorie Modifier avec succès');
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
