<?php

namespace App\Http\Controllers\Caisse;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Users\Utilisateur;
use App\Models\Agences\Agence;
use App\Models\Caisse\Caisse;

class CaisseUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $societe_id = Auth::user()->societe_id;
            $role = Auth::user()->role->id;

            if ($role == 1 || $role == 0) {
                $users = Utilisateur::where('societe_id', $societe_id)->get();
                $agences = Agence::where('societe_id', $societe_id)->get();
                $caisses = Caisse::where('user_id', '!=', 0)->get();
                return view('caisse_user.index', compact('caisses', 'users', 'agences'));
            }
            $users = Utilisateur::where('societe_id', $societe_id)->where('role_id', '!=', 1)->Where('role_id', '!=', 0)->get();
            $agences = Agence::where('societe_id', $societe_id)->get();
            $caisses = Caisse::where('user_id', '!=', 0)->get();
            return view('caisse_user.index', compact('caisses', 'users', 'agences'));
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function utilisateur_agence(Request $request)
    {
        if (Auth::check()) {
            $societe_id = Auth::user()->societe_id;
            $role = Auth::user()->role->id;

            if ($role == 1 || $role == 0) {
                $data['users'] = Utilisateur::where('societe_id', $societe_id)
                    ->where('agence_id', '=', $request->id)
                    ->where('agence_id', '!=', 0)
                    ->get(['nom', 'prenom', 'id']);
                return response()->json($data);
            }
            $data['users'] = Utilisateur::where('societe_id', $societe_id)
                ->where('agence_id', $request->id)
                ->where('agence_id', '!=', 0)->where('role_id', '!=', 1)->Where('role_id', '!=', 0)
                ->get(['nom', 'prenom', 'id']);
            return response()->json($data);
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function utilisateur_caisse(Request $request)
    {
        if (Auth::check()) {
            $data['caisses'] = Caisse::select('libelle', 'id')
                ->where('agence_id', $request->id)
                ->where('user_id', '=', 0)->get();
            return response()->json($data);
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
            'user' => 'required',
            'caisse' => 'required',
        ]);
        /**
         * donnee a ajouté dans la table
         */

        $data = $request->all();

        $caisse = Caisse::find($data['caisse']);
        /**
         * insertion des données dans la table user
         */
        $caisse->update([
            'user_id' => $data['user'],
        ]);
        return redirect('/caisse_user')->with('success', 'Caisse associé avec succès');
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


    public function asso_caisse_annuler(Request $request, $id)
    {

        $id = decrypt($id);
        $caisse = Caisse::find($id);

        $caisse->update([
            'user_id' => 0,
        ]);
        return redirect('/caisse_user')->with('success', 'Association annuler avec succès');
    }
}
