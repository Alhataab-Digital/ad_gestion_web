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
use App\Models\ActiviteVehicule;
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
        if(isset(Auth::user()->role_id)){
            $role=Auth::user()->role_id;
            if($role==1 || $role==0){
                
                $count_user=Utilisateur::where('societe_id',$societe_id)->count();
                $count_investisseur=Investisseur::where('agence_id',$agence_id)->count();
                $count_activite=ActiviteInvestissement::where('agence_id',$agence_id)->where('etat_activite','!=','annuler')->count();
                $count_activite_vehicule=ActiviteVehicule::where('agence_id',$agence_id)->where('etat_activite','!=','annuler')->count();
                return view('home', compact('societe','devises','count_investisseur','count_user','count_activite','count_activite_vehicule'));
            }
        }
        
        $count_user=Utilisateur::where('societe_id',$societe_id)->where('role_id','!=',1)->Where('role_id','!=',0)->count();
        $count_investisseur=Investisseur::where('agence_id',$agence_id)->count();
        $count_activite=ActiviteInvestissement::where('agence_id',$agence_id)->where('etat_activite','!=','annuler')->count();
        $count_activite_vehicule=ActiviteVehicule::where('agence_id',$agence_id)->where('etat_activite','!=','annuler')->count();
        return view('home', compact('societe','devises','count_investisseur','count_user','count_activite','count_activite_vehicule'));
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
