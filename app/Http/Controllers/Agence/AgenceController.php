<?php

namespace App\Http\Controllers\Agence;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Agences\Agence;
use App\Models\MoneyChange\Devise;
use App\Models\Region;
use App\Models\Agences\DeviseAgence;

class AgenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $societe_id = Auth::user()->societe_id;
            $devises = Devise::all();
            $regions = Region::orderBy('nom')->get();
            $agences = Agence::Where('societe_id', $societe_id)->get();
            return view('agence.index', compact('agences', 'devises', 'regions'));
        }
        return redirect('/')->with('danger', "Session expirée");
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
            'adresse' => 'required',
            'telephone' => 'required | min:8',
            'email' => 'required',
            'societe' => 'required',
            'devise_id' => 'required',
            'region_id' => 'required',
        ]);
        /**
         * donnee a ajouté dans la table
         */

        $data = $request->all();
        if (Auth::check()) {
            /**
             * insertion des données dans la table user
             */
            Agence::create([
                'nom' => $data['nom'],
                'adresse' => $data['adresse'],
                'telephone' => $data['telephone'],
                'email' => $data['email'],
                'societe_id' => $data['societe'],
                'region_id' => $data['region_id'],
                'devise_id' => $data['devise_id'],
            ]);
            return redirect('/agence')->with('success', 'Agence crée avec succès');
        }
        return redirect('/')->with('danger', "Session expirée");
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
        if (Auth::check()) {
            $id = decrypt($id);
            $agence = Agence::find($id);
            $devises = Devise::all();
            $regions = Region::where('id', '!=', $agence->region_id)->orderBy('nom', 'asc')->get();
            // $regions=Region::all();
            $devise_agences = DeviseAgence::where('agence_id', $id)->get();
            return view('agence.edit', compact('agence', 'regions', 'devises', 'devise_agences'));
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Auth::check()) {
            $id = decrypt($id);
            $request->validate([
                'nom' => 'required',
                'adresse' => 'required',
                'telephone' => 'required',
                'email' => 'required',
                'region_id' => 'required',
            ]);
            /**
             * donnee a ajouté dans la table
             */
            $data = $request->all();

            $agence = Agence::find($id);
            $agence->update([
                'nom' => $data['nom'],
                'devise_id' => $data['devise_id'],
                'adresse' => $data['adresse'],
                'telephone' => $data['telephone'],
                'region_id' => $data['region_id'],
                'email' => $data['email'],
            ]);
            return back()->with('success', 'Agence modifié avec succès');
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function devise(Request $request)
    {
        if (Auth::check()) {
            // dd(' IdDevise'.$request->devise_id.' Taux'.$request->taux.' IdAgence'.$request->agence_id);
            $request->validate([
                'devise_id' => 'required',
                'agence_id' => 'required',
                'taux' => 'required',
            ]);

            $data = $request->all();
            $agence_id = $data['agence_id'];
            $devise_id = $data['devise_id'];
            if (isset(DeviseAgence::where('devise_id', $devise_id)->where('agence_id', $agence_id)->first(['agence_id'])->agence_id)) {
                return back()->with('danger', 'devise existe ');
            } else {

                DeviseAgence::create([
                    'agence_id' => $data['agence_id'],
                    'devise_id' => $data['devise_id'],
                    'taux' => $data['taux'],
                ]);
                return back()->with('success', 'Devise ajouté avec succès');
            }
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function region_code(Request $request)
    {

        if (Auth::check()) {
            $data['code'] = Region::where('id', $request->id)->get();
            return response()->json($data);
        }
        return redirect('/')->with('danger', "Session expirée");
    }
}
