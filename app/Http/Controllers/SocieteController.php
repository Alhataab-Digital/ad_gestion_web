<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Societe;
use App\Models\Utilisateur;
use Socket;

class SocieteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('gestion.societe');
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
                'raison_sociale'=>'required',
                'activite'=>'required',
                'forme_juridique'=>'required',
                'region'=>'required',
                'pays'=>'required',
                'telephone'=>'required',
                'email'=>'required|email|unique:societes',
            ]);
            /**
             * donnee a ajouté dans la table
             */

            $data=$request->all();


            /**
             * insertion des données dans la table user
             */
            Societe::create([
                'raison_sociale'=>$data['raison_sociale'],
                'activite'=>$data['activite'],
                'forme_juridique'=>$data['forme_juridique'],
                'region'=>$data['region'],
                'pays'=>$data['pays'],
                'telephone'=>$data['telephone'],
                'email'=>$data['email'],
                'code_postal'=>$data['code_postal'],
                'adresse'=>$data['adresse'],
                'complement'=>$data['complement'],
                'site_web'=>$data['site_web'],
                'admin_id'=>Auth::user()->id,
            ]);
            return redirect('/home')->with('success','societé enregistré avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $societe=Societe::findOrFail($id);
        return view('gestion.societe_show',compact('societe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $societe=Societe::findOrFail($id);
        return view('gestion.societe_edit',compact('societe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Societe $societe, $id)
    {

        $societe=Societe::find($id);


        /**
             * validation des champs de saisie
             */
            $data=$request->validate([
                'raison_sociale'=>'required',
                'activite'=>'required',
                'forme_juridique'=>'required',
                'region'=>'required',
                'pays'=>'required',
                'telephone'=>'required',
                'email'=>'required',
                'code_postal'=>'',
                'adresse'=>'',
                'complement'=>'',
                'site_web'=>'',
            ]);


           /**
             * insertion des données dans la table user
             */
            $societe->update([
                'raison_sociale'=>$data['raison_sociale'],
                'activite'=>$data['activite'],
                'forme_juridique'=>$data['forme_juridique'],
                'region'=>$data['region'],
                'pays'=>$data['pays'],
                'telephone'=>$data['telephone'],
                'email'=>$data['email'],
                'code_postal'=>$data['code_postal'],
                'adresse'=>$data['adresse'],
                'complement'=>$data['complement'],
                'site_web'=>$data['site_web'],
            ]);
            return back()->with('success','societé Modifier avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function update_logo(Request $request, Societe $societe, $id ){
        if(Auth::check()){
            $societe=Societe::findOrFail($id);
            /**
             * validation des champs de saisie
             */
            $request->validate([
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time().'.'.$request->logo->extension();

            $request->logo->move(public_path('images/logo'), $imageName);


            /**
             * insertion des données dans la table user
             */
            $societe->update([
                'logo'=>$imageName,
            ]);
            return back()->with('success','Logo mise à jour avec succès');
        }
            return redirect('/')->with('danger',"Session expirée");
    }
}
