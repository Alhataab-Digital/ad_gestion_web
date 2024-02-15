<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequeste;
use Illuminate\Support\Facades\Hash;
use App\Models\TypeGestion;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gestions = TypeGestion::all();
        return response()->json($gestions);
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
    public function store(RegisterRequeste $request)
    {
        $request->validated();

        $data = [
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'adresse' => $request->adresse,
            'password' => Hash::make($request->password),
            'terms' => 1,
            'gestion_id' => 1,
            'societe_id' => 1,
        ];
        /**
         * insertion des données dans la table user
         */
        $user = Utilisateur::create($data);
        $token = $user->createToken('ad_gestion')->plainTextToken;
        return response(
            [
                'user' =>  $user,
                'token' => $token,
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
