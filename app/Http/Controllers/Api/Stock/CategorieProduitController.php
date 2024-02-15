<?php

namespace App\Http\Controllers\Api\Stock;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategorieProduitRequeste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\CategorieProduit;

class CategorieProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = CategorieProduit::all();

        return response(
            [
                'categories' =>  $categories,
            ],
            200
        );
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
    public function store(CategorieProduitRequeste $request)
    {
        $request->validated();

        // $agence_id=Auth::user()->agence_id;
        /**
         * donnee a ajouté dans la table
         */
        $data = [
            'nom_categorie_produit' => $request->nom,
            'description_categorie_produit' => $request->description,
            'agence_id' => $request->agence_id,
        ];

        /**
         * insertion des données dans la table user
         */
        if ($request->agence_id == 0) {
            $message = " L'utilisateur n'est pas affecté à une agence";
            return response(
                [
                    'message' =>  $message,
                ],
                200
            );
        } else {
            $categorie = CategorieProduit::create($data);
            // $token = $user->createToken('ad_gestion')->plainTextToken;
            return response(
                [
                    'categorie' =>  $categorie,
                ],
                201
            );
        }
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
