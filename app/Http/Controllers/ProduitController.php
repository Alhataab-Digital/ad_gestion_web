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
            $agence_id=Auth::user()->agence_id;
            $produits=Produit::where('agence_id',$agence_id)->get();
            $categories=CategorieProduit::where('agence_id',$agence_id)->get();
            return view('produit.index', compact('produits','categories'));

        }
        return redirect('/auth')->with('danger',"Session expirée");
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
        //  $agence_id=Auth::user()->agence_id;
        // dd($request->categorie,$request->nom,$request->prix_a,$request->prix_r,$request->prix_v,$request->stock_min,
        // $request->description,$agence_id);
        /**
             * validation des champs de saisie
             */
            $request->validate([
                'categorie'=>'required',
                'nom'=>'required',
                'prix_a'=>'required',
                'prix_r'=>'required',
                'prix_v'=>'required',
                'stock_min'=>'required',
                'description'=>'required',
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
                'categorie_produit_id'=>$data['categorie'],
                'nom_produit'=>$data['nom'],
                'prix_unitaire_achat'=>$data['prix_a'],
                'prix_unitaire_revient'=>$data['prix_r'],
                'prix_unitaire_vente'=>$data['prix_v'],
                'stock_min'=>$data['stock_min'],
                'description_produit'=>$data['description'],
                'agence_id'=>$agence_id,
            ]);
            return redirect('/produit')->with('success','Produit crée avec succès');
        }
        return redirect('/auth')->with('danger',"Session expirée");
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
        $id=decrypt($id);
        if(Auth::check()){
            $produit= Produit::find($id);
            $categorie_produits= CategorieProduit::where('id','!=',$produit->categorie_produit_id);
            return view('produit.edit',compact('categorie_produits','produit'));
        }
        return redirect('/auth')->with('danger',"Session expirée");

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id=decrypt($id);
        $produit=Produit::find($id);
        /**
             * validation des champs de saisie
             */
            $data=$request->validate([
                'categorie'=>'required',
                'nom'=>'required',
                'prix_a'=>'required',
                'prix_r'=>'required',
                'prix_v'=>'required',
                'stock_min'=>'required',
                'description'=>'required',
            ]);
            /**
             * donnee a ajouté dans la table
             */


            /**
             * insertion des données dans la table user
             */
            $produit->update([
                'categorie_produit_id'=>$data['categorie'],
                'nom_produit'=>$data['nom'],
                'prix_unitaire_achat'=>$data['prix_a'],
                'prix_unitaire_revient'=>$data['prix_r'],
                'prix_unitaire_vente'=>$data['prix_v'],
                'stock_min'=>$data['stock_min'],
                'description_produit'=>$data['description'],
            ]);
            return back()->with('success','Produit modifier avec succès');



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
