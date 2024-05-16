<?php

namespace App\Http\Controllers\Agence;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Users\Utilisateur;
use App\Models\Agences\Agence;
use App\Models\Caisse\Caisse;
use App\Models\Agences\DeviseAgence;

class AgenceUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            if (isset(Auth::user()->role->id)) {
                $societe_id = Auth::user()->societe_id;
                $role = Auth::user()->role->id;
                $agences = Agence::where('societe_id', $societe_id)->get();

                if ($role == 1 || $role == 0) {
                    $users = Utilisateur::where('societe_id', $societe_id)->Where('agence_id', '!=', '0')->get();
                    $caisses = Caisse::all();
                    return view('agence_user.index', compact('caisses', 'users', 'agences'));
                }
                $users = Utilisateur::where('societe_id', $societe_id)->Where('agence_id', '!=', '0')->where('role_id', '!=', 1)->Where('role_id', '!=', 0)->get();
                $caisses = Caisse::all();
                return view('agence_user.index', compact('caisses', 'users', 'agences'));
            }
            return redirect('/home')->with('danger', "l'utilisateur n'as pas de role");
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
            'user_id' => 'required',
            'agence_id' => 'required',
        ]);

        /**
         * donnee a ajouté dans la table
         */

        $data = $request->all();
        if (Auth::check()) {
            $utilisateur = Utilisateur::find($data['user_id']);
            /**
             * insertion des données dans la table user
             */
            //dd($utilisateur);
            $utilisateur->update([
                'agence_id' => $data['agence_id'],
            ]);
            return redirect('/agence_user')->with('success', 'Agence associé avec succès');
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function listUser(Request $request)
    {

        if (Auth::check()) {
            $societe_id = Auth::user()->societe_id;

            $data['users'] = Utilisateur::where('societe_id', '=', $societe_id)
                ->where('agence_id', '!=', $request->id)
                ->where('agence_id', '=', 0)
                ->get(['nom', 'prenom', 'id']);
            return response()->json($data);
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
    public function asso_agence_annuler(Request $request, $id)
    {
        if (Auth::check()) {
            $user = Utilisateur::find($id);
            if (isset(Caisse::where('user_id', $id)->first()->id)) {
                $caisse = Caisse::where('user_id', $id)->first();
                return redirect('/agence_user')->with('danger', "Veillez deconnecter ce utilisateur a la caisse $caisse->libelle ");
            }

            $user->update([
                'agence_id' => 0,
            ]);
            return redirect('/agence_user')->with('success', 'Association annuler avec succès');
        }
        return redirect('/')->with('danger', "Session expirée");
    }


    public function edit_devise(Request $request)
    {
        if (Auth::check()) {
            $devise = DeviseAgence::find($request->id);
            if (isset($devise)) {

                $taux = $request->taux;

                // La fonction pour remplacer la virgule en un point
                $taux =  str_replace(',', '.', $taux);
                // dd($taux);
                if ((float)$taux == $taux) {
                    $devise->update([
                        'taux' => $taux,
                    ]);
                    return back()->with('success', 'taux modifier');
                }
                return back();
            }
            return back();
        }
        return redirect('/')->with('danger', "Session expirée");
    }
}
