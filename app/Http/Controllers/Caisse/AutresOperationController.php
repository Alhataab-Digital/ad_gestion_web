<?php

namespace App\Http\Controllers\Caisse;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Caisse\Caisse;
use App\Models\Societe;
use App\Models\Operation;
use App\Models\Caisse\MouvementCaisse;
use App\Models\Investissement\NatureOperationCharge;

class AutresOperationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            if (isset(Caisse::where('user_id', $user_id)->first(['id'])->id)) {
                $caisse = Caisse::where('user_id', $user_id)->first();
                $nature_operations = NatureOperationCharge::all();
                $operations = Operation::where('user_id', $user_id)->orderBy('id', 'DESC')->get();
                return view('operation.index', compact('nature_operations', 'operations', 'caisse'));
            }
            return view('investissement.message');
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
        //
        // dd($request->nature_operation_id,
        // $request->montant_operation,
        // $request->commentaire,);
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $agence_id = Auth::user()->agence_id;
            $societe_id = Auth::user()->societe_id;

            if (Caisse::where('user_id', $user_id)->first(['id'])->id) {

                /**
                 * validation des champs de saisie
                 */
                $request->validate([
                    'nature_operation_id' => 'required',
                    'montant_operation' => 'required',
                    'commentaire' => 'required',
                ]);

                $data = $request->all();

                $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
                $compte_societe = Societe::where('id', $societe_id)->first(['compte_societe'])->compte_societe;
                $compte_caisse = Caisse::where('user_id', $user_id)->first(['compte'])->compte;
                $date_comptable = Caisse::where('user_id', $user_id)->first(['date_comptable'])->date_comptable;
                $montant_operation = $data['montant_operation'];

                if ($compte_societe < $montant_operation) {
                    return redirect()->route('operation')->with('danger', "Le montant compte agence est insuffisant");
                } else {
                    if ($compte_caisse < $montant_operation) {
                        return redirect()->route('operation')->with('danger', "Le montant caisse est insuffisant");
                    } else {

                        /**
                         * insertion des données dans la table user
                         */
                        Operation::create([
                            'montant_operation' => $data['montant_operation'],
                            'commentaire' => $data['commentaire'],
                            'sens_operation' => 'sortie',
                            'nature_operation_charge_id' => $data['nature_operation_id'],
                            'caisse_id' => $caisse_id,
                            'agence_id' => $agence_id,
                            'user_id' => $user_id,
                            'date_comptable' => $date_comptable,
                        ]);

                        /**
                         * mise a jour de la caisse
                         */
                        $compte = $compte_caisse - $montant_operation;
                        $compte_societe = $compte_societe - $montant_operation;

                        $societe = Societe::find($societe_id);
                        $caisse = Caisse::find($caisse_id);
                        $nature_operation = NatureOperationCharge::find($data['nature_operation_id']);

                        $user_id = Auth::user()->id;

                        MouvementCaisse::create([
                            'caisse_id' => $caisse->id,
                            'user_id' => $user_id,
                            'description' => $nature_operation->nature_operation_charge,
                            'sortie' => $montant_operation,
                            'solde' => $compte,
                            'date_comptable' => $date_comptable,

                        ]);

                        $caisse->update([
                            'compte' => $compte,
                        ]);
                        $societe->update([
                            'compte_societe' => $compte_societe,
                        ]);

                        return redirect()->route('operation')->with('success', "Operation effectuée avec succès");
                    }
                }
            }
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Auth::check()) {
            $id = decrypt($id);
            $operation = Operation::find($id);
            return view('operation.show', compact('operation'));
        }
        return redirect('/')->with('danger', "Session expirée");
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
        if (Auth::check()) {
            $id = decrypt($id);
            $agence_id = Auth::user()->agence_id;
            $societe_id = Auth::user()->societe_id;
            $operation = Operation::find($id);
            $user_id = $operation->user_id;

            if (Caisse::where('user_id', $user_id)->first(['id'])->id) {

                $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
                $compte_societe = Societe::where('id', $societe_id)->first(['compte_societe'])->compte_societe;
                $compte_caisse = Caisse::where('user_id', $user_id)->first(['compte'])->compte;
                $date_comptable = Caisse::where('user_id', $user_id)->first(['date_comptable'])->date_comptable;
                $montant_operation = $operation->montant_operation;

                /**
                 * mise a jour de la caisse
                 */
                $compte = $compte_caisse + $montant_operation;
                $compte_societe = $compte_societe + $montant_operation;

                $societe = Societe::find($societe_id);
                $caisse = Caisse::find($caisse_id);
                $nature_operation = NatureOperationCharge::find($operation->nature_operation_charge_id);

                MouvementCaisse::create([
                    'caisse_id' => $caisse->id,
                    'user_id' => $user_id,
                    'description' => 'Supprimer ' . $nature_operation->nature_operation_charge,
                    'entree' => $montant_operation,
                    'solde' => $compte,
                    'date_comptable' => $date_comptable,

                ]);

                $caisse->update([
                    'compte' => $compte,
                ]);
                $societe->update([
                    'compte_societe' => $compte_societe,
                ]);

                $operation->delete();
                return redirect()->route('operation')->with('success', "Operation effectuée avec succès");
            }
        }
        return redirect('/')->with('danger', "Session expirée");
    }
}
