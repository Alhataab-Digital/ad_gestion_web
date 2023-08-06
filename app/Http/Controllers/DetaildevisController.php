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
use App\Models\client;
use App\Models\Produit;
use App\Models\Devis;
use App\Models\DetailDevis;

class DetaildevisController extends Controller
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
        //
        if(Auth::check()){

            //
    // dd($request->devis_id,$request->produit,
    // $request->qte,
    // $request->prix,$request->total,
    // $request->montant_ht,
    // $request->client);


        for($i=0;$i<count($request->produit); $i++)
        {

            $data=[
                'devis_id'              =>$request->devis_id,
                'produit_id'               =>$request->produit[$i],
                'quantite_demandee'       =>$request->qte[$i],
                'prix_unitaire_demande'  =>$request->prix[$i],
            ];
            Detaildevis::create($data);

        }

        $devis=Devis::find($request->devis_id);

        $devis->update([
            'client_id' =>$request->client,
            'montant_total' =>$request->montant_ht,
            'etat' =>'en cours',
        ]);
        return redirect('detail_devis/'.$devis->id.'/show');

    }
    return redirect('/auth')->with('danger',"Session expirée");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
         $devis=Devis::find($id);
         $detail_deviss=Detaildevis::where('devis_id',$devis->id)->get();
         $total_ht=Detaildevis::where('devis_id',$devis->id)->selectRaw('sum(quantite_demandee*prix_unitaire_demande) as total')->first('total');
         return view('e-commerce.devis_encours', compact('devis','detail_deviss','total_ht'));
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
