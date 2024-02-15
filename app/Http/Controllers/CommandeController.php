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
        if (Auth::check()) {
            $id = Auth::user()->id;
            $agence_id = Auth::user()->agence_id;
            $commandes = Commande::where('agence_id', $agence_id)->where('user_id', $id)->orderBy('id', 'DESC')->get();
            $commandes_cs = Commande::where('agence_id', $agence_id)->where('user_id', $id)->where('etat', 'en cours')->orderBy('id', 'DESC')->get();
            $commandes_lv = Commande::where('agence_id', $agence_id)->where('etat', 'livrer')->orderBy('id', 'DESC')->get();
            $commandes_an = Commande::where('agence_id', $agence_id)->where('etat', 'annuler')->orderBy('id', 'DESC')->get();
            return view('e-commerce.commande', compact('commandes', 'commandes_cs', 'commandes_lv', 'commandes_an'));
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        if (Auth::check()) {
            $id = Auth::user()->id;
            $agence_id = Auth::user()->agence_id;
            Commande::create([
                'user_id' => $id,
                'agence_id' => $agence_id,
            ]);
            $commande = Commande::where('user_id', $id)->where('agence_id', $agence_id)->latest('id')->first();

            return redirect('commande/' . encrypt($commande->id) . '/edit');
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            // dd($request->commande_id,$request->fournisseur_id,
            // $request->nom_fournisseur,$request->adresse,$request->montant_ht);
            if ($request->montant_ht && $request->nom_fournisseur && $request->adresse) {
                $commande = Commande::find($request->commande_id);
                $fournisseur = Fournisseur::find($request->fournisseur_id);
                $commande->update([
                    'fournisseur_id' => $request->fournisseur_id,
                    'montant_total' => $request->montant_ht,
                    'etat' => 'en cours',
                ]);
                $fournisseur->update([
                    'nom_fournisseur' => $request->nom_fournisseur,
                    'adresse' => $request->adresse,
                ]);
                return redirect('detail_commande/' . encrypt($commande->id) . '/show');
            }
            return back();
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
        if (Auth::check()) {
            $id = decrypt($id);
            $commande = Commande::find($id);
            $detail_commandes = DetailCommande::where('commande_id', $commande->id)->get();
            $total_ht = DetailCommande::where('commande_id', $commande->id)->selectRaw('sum(quantite_commandee*prix_unitaire_commande) as total')->first('total');

            // $total_ht=DetailCommande::where('commande_id',$commande->id)->selectRaw('sum(quantite_commandee*prix_unitaire_commande) as total')->first('total');
            // return view('e-commerce.commande_encours', compact('commande','total_ht'));
            $agence_id = Auth::user()->agence_id;
            $produits = Produit::where('agence_id', $agence_id)->get();

            $fournisseurs = Fournisseur::all();
            return view('e-commerce.nouvelle_commande', compact('produits', 'fournisseurs', 'commande', 'detail_commandes', 'total_ht'));
        }
        return redirect('/')->with('danger', "Session expirée");
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
        if (Auth::check()) {
            $id = decrypt($id);
            $commande = Commande::find($id);

            $commande->update([
                'etat' => 'annuler',
            ]);
            return redirect('/commande');
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function select_produit(Request $request)
    {
        if (Auth::check()) {
            $agence_id = Auth::user()->agence_id;

            $data['produits'] = Produit::select(['prix_unitaire_achat', 'prix_unitaire_vente'])
                ->where('id', $request->id)->get(['prix_unitaire_achat', 'prix_unitaire_vente']);

            return response()->json($data);
        }
        return redirect('/')->with('danger', "Session expirée");
    }
}
