<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Agence;
use App\Models\Devise;
use App\Models\Region;
use App\Models\DeviseAgence;
use App\Models\EntrepotStock;

class EntrepotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if(Auth::check()){
            $agence_id=Auth::user()->agence_id;
            $entrepots=EntrepotStock::Where('agence_id',$agence_id)->get();
            return view('e-commerce.entrepot', compact('entrepots'));
            }
            return redirect('/')->with('success',"Session expirée");
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
            if((Auth::user()->agence_id)!=0) {
        /**
        * validation des champs de saisie
        */
            $request->validate([
                'nom'=>'required',
                'adresse'=>'',
                'capacite'=>'',
            ]);
            /**
             * donnee a ajouté dans la table
             */
            $agence_id=Auth::user()->agence_id;
            $data=$request->all();
            /**
             * insertion des données dans la table user
             */
            EntrepotStock::create([
                'nom_entrepot'=>$data['nom'],
                'adresse_entrepot'=>$data['adresse'],
                'capacite_entrepot'=>$data['capacite'],
                'agence_id'=>$agence_id,
            ]);
            return redirect('/entrepot')->with('success','Entrepot crée avec succès');
                }else{
                    return redirect('/entrepot')->with('success','Vous n\'etes par lier à une agence');
                }
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
