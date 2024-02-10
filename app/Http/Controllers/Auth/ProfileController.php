<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Agence;
use App\Models\Devise;
use App\Models\Region;
use App\Models\UserEnLigne;
use App\Models\Utilisateur;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
        return view('auth.profile');
        }
        return redirect('/')->with('danger',"Session expirée");
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
        $request->validate([
            'password'=>'required|confirmed|min:4',
        ]);
        /**
         * donnee a ajouté dans la table
         */
        $data=$request->all();

        $utilisateur= Utilisateur::find(Auth::user()->id);
        if(isset($utilisateur)){
            if(isset(UserEnLigne::where('utilisateur_id',$utilisateur->id)->first()->id))
            {
            $deconnexion=UserEnLigne::where('utilisateur_id',$utilisateur->id)->first();
            $deconnexion->delete('utilisateur_id',$utilisateur->id);
            $utilisateur->update([
                'password'=>Hash::make($data['password']),
            ]);
            Session::flush();
            Auth::logout();
            return redirect('/auth')->with('success',"Mot de passe modifier avec succès reconnectez vous");
            }
            return redirect('/auth');
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
