<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Caisse;
use App\Models\Societe;
use App\Models\Devise;
use App\Models\TypeReglement;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\Commande;
use App\Models\DetailCommande;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $commandes=Commande::all();
        $commandes_cs=Commande::where('etat','en cours')->get();
        $commandes_lv=Commande::where('etat','livrer')->get();
        $commandes_an=Commande::where('etat','annuler')->get();
        return view('e-commerce.commande',compact('commandes','commandes_cs','commandes_lv','commandes_an'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        if(Auth::check()){
            $id=Auth::user()->id;
            $agence_id=Auth::user()->agence_id;
            Commande::create([
                'user_id'=>$id,
                'agence_id'=>$agence_id,
            ]);
        $commande=Commande::where('user_id',$id)->where('agence_id',$agence_id)->latest('id')->first();

        return redirect('commande/'.$commande->id.'/edit');

        }
        return redirect('/auth')->with('danger',"Session expirée");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $commande=Commande::find($id);
        $agence_id=Auth::user()->agence_id;
        $produits=Produit::where('agence_id',$agence_id)->get();
        $fournisseurs=Fournisseur::all();
        return view('e-commerce.nouvelle_commande', compact('produits','fournisseurs','commande'));
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
        $commande=Commande::find($id);

            $commande->update([
                'etat' =>'annuler',
            ]);
            return redirect('/commande');
    }

    public function select_produit(Request $request){
        if(Auth::check()){
            $agence_id=Auth::user()->agence_id;

            $data['produits']=Produit::select('prix_unitaire_achat')
            ->where('id',$request->id)->get(['prix_unitaire_achat']);

            return response()->json($data);

        }
            return redirect('/auth')->with('success',"Vous n'êtes pas autorisé à accéder");


    }
}
