<?php

namespace App\Http\Controllers\Investissement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Investissement\NatureOperationCharge;

class NatureOperationChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (Auth::check()) {
            $nature_operation_charges = NatureOperationCharge::all();
            return view('investissement.nature_operation_charge', compact('nature_operation_charges'));
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
            'nature_operation_charge' => 'required',
        ]);
        /**
         * donnee a ajouté dans la table
         */
        if (Auth::check()) {
            $data = $request->all();
            //dd($data);
            /**
             * insertion des données dans la table user
             */
            NatureOperationCharge::create([
                'nature_operation_charge' => $data['nature_operation_charge'],
            ]);
            return redirect('/nature_operation_charge')->with('success', "operation ajouté avec succès");
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
            $nature_operation_charge = NatureOperationCharge::find($id);
            return view('investissement.nature_operation_charge_edit', compact('nature_operation_charge'));
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
            /**
             * validation des champs de saisie
             */
            $request->validate([
                'nature_operation_charge' => 'required',
            ]);
            /**
             * donnee a ajouté dans la table
             */

            $data = $request->all();

            $nature_operation_charge = NatureOperationCharge::find($id);

            $nature_operation_charge->update([
                'nature_operation_charge' => $data['nature_operation_charge'],
            ]);
            return redirect('/nature_operation_charge')->with('success', "nature charge modifié avec succès");
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
}
