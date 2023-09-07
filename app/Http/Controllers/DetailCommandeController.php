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
        // $request->prix,);
        if(isset(DetailCommande::where('commande_id',$request->commande_id)->where('produit_id',$request->produit)->first(['id'])->id))
        {
            return back()->with('danger',"Produit deja enregistrer");
        }else{
            
           
            $data=[
                'commande_id'              =>$request->commande_id,
                'produit_id'               =>$request->produit,
                'quantite_commandee'       =>$request->qte,
                'prix_unitaire_commande'  =>$request->prix,
            ];
            DetailCommande::create($data);
            return back();
        }
        
            

            // $commande=Commande::find($request->commande_id);

            // $commande->update([
            //     'fournisseur_id' =>$request->fournisseur,
            //     'montant_total' =>$request->montant_ht,
            //     'etat' =>'en cours',
            // ]);
            // return back();
            // return redirect('detail_commande/'.$commande->id.'/show');

        }
        return redirect('/auth')->with('danger',"Session expirée");




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
        $produit=DetailCommande::find($id);

        $produit->delete();

        return back();
    }

    public function fournisseur_commande(Request $request)
    {
        
        $societe_id=Auth::user()->societe_id;
        $tel=$request->id;
       
        if(isset(Fournisseur::where('telephone' ,$tel)->where('societe_id',$societe_id)->first(['id'])->id)){

            $agence_id=Auth::user()->agence_id;

            $id=Fournisseur::where('telephone' ,$tel)->first(['id'])->id;
           
            $data['fournisseur']=Fournisseur::where('id',$id)->get();
            return response()->json($data);

        }else{

            Fournisseur::create([
                'telephone'=>$tel,
                'societe_id'=>$societe_id,
            ]);
            /**
             * si le telephone existe afficher le client
             */
            $id=Fournisseur::where('telephone' ,$tel)->where('societe_id',$societe_id)->first(['id'])->id;
            $data['fournisseur']=Fournisseur::where('id',$id)->get();
            return response()->json($data);

        }
    }
}
