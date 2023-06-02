<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Produit;
use App\Models\CategorieProduit;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if(Auth::check()){
            $id=Auth::user()->societe_id;
            $produits=Produit::all();
            $categories=CategorieProduit::all();
            return view('produit.index', compact('produits','categories'));

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
        //
        /**
             * validation des champs de saisie
             */
            $request->validate([
                'categorie'=>'required',
                'nom'=>'required',
                'prix_a'=>'required',
                'prix_v'=>'required',
                'stock_min'=>'required',
                'stock_max'=>'required',
                'description',
            ]);
            $agence_id=Auth::user()->agence_id;
            /**
             * donnee a ajouté dans la table
             */

            $data=$request->all();
            // dd($data);
            if(Auth::check()){
            /**
             * insertion des données dans la table user
             */
            Produit::create([
                'nom_produit'=>$data['nom'],
                'description_produit'=>$data['description'],
                'prix_unitaire_achat'=>$data['prix_a'],
                'prix_unitaire_vente'=>$data['prix_v'],
                'stock_min'=>$data['stock_min'],
                'stock_max'=>$data['stock_max'],
                'categorie_produit_id'=>$data['categorie'],
                'agence_id'=>$agence_id,
            ]);
            return redirect('/produit')->with('success','Produit crée avec succès');
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
}
