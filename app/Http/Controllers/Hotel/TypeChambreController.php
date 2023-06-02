<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Devise;
use App\Models\DeviseAgence;
use App\Models\TypeChambre;


class TypeChambreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $type_chambres=TypeChambre::all();
        return view('hotel.type_chambre',compact('type_chambres'));
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
         /**
             * validation des champs de saisie
             */
            $request->validate([
                'nom_type_chambre'=>'required',
                'prix'=>'required',
                'capacite'=>'required',
                'societe'=>'required',
            ]);
            /**
             * donnee a ajouté dans la table
             */

            $data=$request->all();
            //dd($data);
            /**
             * insertion des données dans la table user
             */
            TypeChambre::create([
                'nom_type_chambre'=>$data['nom_type_chambre'],
                'prix'=>$data['prix'],
                'capacite'=>$data['capacite'],
                'societe_id'=>$data['societe'],
            ]);
            return redirect('/type_chambre')->with('success','Type de chambre ajouté avec succès');
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
