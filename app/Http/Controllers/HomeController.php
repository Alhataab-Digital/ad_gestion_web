<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Societe;
use App\Models\Utilisateur;
use App\Models\Devise;
use App\Models\Investisseur;
use App\Models\ActiviteInvestissement;
use App\Models\Caisse;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if(Auth::check()){
        $id=Auth::user()->id;

        $societe=Societe::where('admin_id',$id)->first();

        $societe_id=Auth::user()->societe_id;
        $agence_id=Auth::user()->agence_id;
        $devises=Devise::where('societe_id',$societe_id)->get();
        $count_investisseur=Investisseur::where('agence_id',$agence_id)->count();
        $count_user=Utilisateur::where('societe_id',$societe_id)->count();
        $count_activite=ActiviteInvestissement::where('agence_id',$agence_id)->count();
        return view('home', compact('societe','devises','count_investisseur','count_user','count_activite'));
      }
        return redirect('/auth')->with('danger',"Session expirée");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( $id)
    {
        $utilisateur=Utilisateur::findOrFail($id);

        $societe=Societe::where('admin_id',$id)->first();

        $utilisateur->update([
            'societe_id'=>$societe->id,
        ]);
        return redirect('/home')->with('success','Activer');
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
