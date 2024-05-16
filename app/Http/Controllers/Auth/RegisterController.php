<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\TypeGestion;
use App\Models\Users\Utilisateur;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gestions = TypeGestion::orderBy('gestion')->get();
        return view('auth.registre', compact('gestions'));
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
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:utilisateurs',
            'adresse' => 'required',
            'password' => 'required|min:4',
            'terms' => 'required',
            'gestion' => 'required',
        ]);
        /**
         * donnee a ajouté dans la table
         */
        $data = $request->all();
        /**
         * insertion des données dans la table user
         */
        Utilisateur::create([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'adresse' => $data['adresse'],
            'password' => Hash::make($data['password']),
            'terms' => $data['terms'],
            'gestion_id' => $data['gestion'],
        ]);
        return redirect('/registre')->with('success', 'Utilisateur ajouté avec succès connectez vous avec votre mail et votre mot de passe');
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
