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
use App\Models\Client;
use App\Models\Produit;
use App\Models\Devis;
use App\Models\Detaildevis;
use App\Models\StockProduit;

class DevisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $deviss=Devis::all();
        $deviss_cs=Devis::where('etat','en cours')->get();
        $deviss_lv=Devis::where('etat','livrer')->get();
        $deviss_an=Devis::where('etat','annuler')->get();
        return view('e-commerce.devis',compact('deviss','deviss_cs','deviss_lv','deviss_an'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
         //
         if(Auth::check()){
            $id=Auth::user()->id;
            $agence_id=Auth::user()->agence_id;
            Devis::create([
                'user_id'=>$id,
                'agence_id'=>$agence_id,
            ]);
        $devis=Devis::where('user_id',$id)->where('agence_id',$agence_id)->latest('id')->first();

        return redirect('devis/'.$devis->id.'/edit');

        }
        return redirect('/auth')->with('danger',"Session expirée");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

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
        //
        $devis=Devis::find($id);
        $agence_id=Auth::user()->agence_id;
        $produit_stocks=StockProduit::where('agence_id',$agence_id)->get();
        $produits=Produit::where('agence_id',$agence_id)->get();
        $clients=Client::all();
        return view('e-commerce.nouveau_devis', compact('produits','clients','devis','produit_stocks'));
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
