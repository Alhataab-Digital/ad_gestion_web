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

class DetailCommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        if(Auth::check()){

                //
        // dd($request->commande_id,$request->produit,
        // $request->qte,
        // $request->prix,$request->total,
        // $request->montant_ht,
        // $request->fournisseur);


            for($i=0;$i<count($request->produit); $i++)
            {

                $data=[
                    'commande_id'              =>$request->commande_id,
                    'produit_id'               =>$request->produit[$i],
                    'quantite_commandee'       =>$request->qte[$i],
                    'prix_unitaire_commande'  =>$request->prix[$i],
                ];
                DetailCommande::create($data);

            }

            $commande=Commande::find($request->commande_id);

            $commande->update([
                'fournisseur_id' =>$request->fournisseur,
                'montant_total' =>$request->montant_ht,
                'etat' =>'en cours',
            ]);
            return redirect('detail_commande/'.$commande->id.'/show');

        }
        return redirect('/')->with('danger',"Session expirée");




    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $commande=Commande::find($id);
        $detail_commandes=DetailCommande::where('commande_id',$commande->id)->get();
        $total_ht=DetailCommande::where('commande_id',$commande->id)->selectRaw('sum(quantite_commandee*prix_unitaire_commande) as total')->first('total');
        return view('e-commerce.commande_encours', compact('commande','detail_commandes','total_ht'));
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
        $detail_commandes=DetailCommande::where('commande_id',$commande->id)->get();
        $total_ht=DetailCommande::where('commande_id',$commande->id)->selectRaw('sum(quantite_commandee*prix_unitaire_commande) as total')->first('total');
        return view('e-commerce.edit_commande', compact('produits','fournisseurs','commande','detail_commandes','total_ht'));

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
