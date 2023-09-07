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
use App\Models\Livrer;
use App\Models\DetailLivrer;
use App\Models\EntrepotStock;

class LivrerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agence_id=Auth::user()->agence_id;
        $livraisons=Livrer::where('agence_id',$agence_id)->get();
        $livraisons_cs=Livrer::where('agence_id',$agence_id)->where('agence_id',$agence_id)->where('etat',Null)->get();
        $livraisons_lv=Livrer::where('agence_id',$agence_id)->where('etat','valider')->get();
        $livraisons_an=Livrer::where('agence_id',$agence_id)->where('etat','annuler')->get();
        return view('e-commerce.livraison',compact('livraisons','livraisons_cs','livraisons_lv','livraisons_an'));
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
        // dd(

        // $request->commande_id,
        // $request->produit,
        // $request->qte,
        // $request->prix ,
        // $request->total,
        // $request->montant_ht,
        // $request->fournisseur_id

        // );
        
    if(isset(Livrer::where('commande_id',$request->commande_id)->first(['id'])->id)){

        $livraison=Livrer::where('commande_id',$request->commande_id)->latest('id')->first();
       
        return redirect('livrer/'.$livraison->id.'/edit');
    }else{
        $id=Auth::user()->id;
        $agence_id=Auth::user()->agence_id;
        $request->commande_id;
        $request->fournisseur_id;
        Livrer::create([
            'commande_id'  => $request->commande_id,
            'fournisseur_id'  =>$request->fournisseur_id,
            'user_id'      => $id,
            'agence_id'    => $agence_id,
        ]);

        // $commande=Commande::find($request->commande_id);

        //     $commande->update([
        //         'etat' =>'livrer',
        //     ]);

        $livraison=Livrer::where('user_id',$id)->where('agence_id',$agence_id)->latest('id')->first();

        return redirect('livrer/'.$livraison->id.'/edit');
    }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $livraison=Livrer::find($id);
        $detail_livraisons=DetailLivrer::where('livrer_id',$id)->get();
        $total_ht=DetailLivrer::where('livrer_id',$id)->selectRaw('sum(quantite_livree*prix_unitaire_livre) as total')->first('total');

        return view('e-commerce.livraison_show',compact('livraison','detail_livraisons','total_ht'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        
        $agence_id=Auth::user()->agence_id;
        if(isset(EntrepotStock::where("agence_id",$agence_id)->first(['id'])->id))
        {
            $livraison=Livrer::find($id);
            $entrepots=EntrepotStock::where("agence_id",$agence_id)->get();
            $commande=Commande::where('id',$livraison->commande_id)->first();
            $detail_commandes=DetailCommande::where('commande_id',$livraison->commande_id)->get();
            $total_ht=DetailCommande::where('commande_id',$livraison->commande_id)->selectRaw('sum(quantite_commandee*prix_unitaire_commande) as total')->first('total');
            return view('e-commerce.livraison_encours', compact('commande','detail_commandes','total_ht','livraison','entrepots'));
       
        }
        return back()->with('danger',"Vous n'avez pas d'entrepot");
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

    public function print()
    {
        
    }
}
