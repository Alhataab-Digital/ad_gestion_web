<?php

namespace App\Http\Controllers\Cash;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Devise;
use App\Models\DeviseAgence;

class DeviseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id=Auth::user()->societe_id;
        // $devises=Devise::where('societe_id',$id)->get();
        $devises=Devise::all();
        return view('devise.index' , compact('devises'));
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
                'monnaie'=>'required',
                'devise'=>'required',
                'unite'=>'required|unique:devises',
                // 'taux'=>'required',
                'societe_id'=>'required',
            ]);
            /**
             * donnee a ajouté dans la table
             */

            $data=$request->all();
            //dd($data);
            /**
             * insertion des données dans la table user
             */
            Devise::create([
                'monnaie'=>$data['monnaie'],
                'devise'=>$data['devise'],
                'unite'=>$data['unite'],
                // 'taux'=>$data['taux'],
                'societe_id'=>$data['societe_id'],
            ]);
            return redirect('/devise')->with('success','Devise ajouté avec succès');
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
        if(Auth::check()){
            $devise= Devise::find($id);
            return view('devise.edit',compact('devise'));
        }
        return redirect('/auth')->with('success',"Session expirée");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $devise=Devise::find($id);
        /**
             * validation des champs de saisie
             */
            $data=$request->validate([
                'monnaie'=>'required',
                'devise'=>'required',
                'unite'=>'required',
                // 'taux'=>'required',
            ]);
            /**
             * donnee a ajouté dans la table
             */


            /**
             * insertion des données dans la table user
             */
            $devise->update([
                'monnaie'=>$data['monnaie'],
                'devise'=>$data['devise'],
                'unite'=>$data['unite'],
                // 'taux'=>$data['taux'],
            ]);
            return redirect('/devise')->with('success','Devise modifier avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // public function taux(){
    //     $devises=Devise::all();
    //     $devise_agences=DeviseAgence::all();
    //     return view('devise.taux', compact('devises','devise_agences'));
    // }

    // public function agence (Requete $request )
    // {

    // }
}
