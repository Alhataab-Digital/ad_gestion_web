<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequeste;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Users\Utilisateur;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $id = Auth::user()->societe_id;
            $utilisateurs = Utilisateur::where('societe_id', $id)->get();
            return response(
                [
                    'user' =>  $utilisateurs,
                ],
                200
            );
        }
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
    public function store(UserRequeste $request)
    {
        $request->validated();

        $data = $request->all();
        // $societe_id=Auth::user()->societe_id;
        // $gestion_id=Auth::user()->gestion_id;
        /**
         * insertion des données dans la table user
         */
        Utilisateur::create([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'adresse' => $data['adresse'],
            'password' => Hash::make($data['password']),
            'terms' => 1,
            'gestion_id' => 1,
            'societe_id' => 1,
        ]);

        return response(
            [
                'message' =>  'success',
            ],
            201
        );
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
