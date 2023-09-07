<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Utilisateur;
use App\Models\Agence;
use App\Models\Caisse;
use App\Models\CaisseUser;
use App\Models\DeviseAgence;
use App\Models\EntrepotStock;
use App\Models\StockProduit;

class InventaireStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $agence_id=Auth::user()->agence_id;
        $entrepots=EntrepotStock::where('agence_id',$agence_id)->get();
        $inventaire_stocks=StockProduit::where('entrepot_id',Null)->where('agence_id',$agence_id)->get();

        return view('e-commerce.inventaire_stock',compact('entrepots','inventaire_stocks'));
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
        $agence_id=Auth::user()->agence_id;
        $entrepots=EntrepotStock::where('agence_id',$agence_id)->get();
        $inventaire_stocks=StockProduit::where('entrepot_id',$request->entrepot)->where('agence_id',$agence_id)->get();
        return view('e-commerce.inventaire_stock',compact('entrepots','inventaire_stocks'));


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
