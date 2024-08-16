<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Users\Utilisateur;
use App\Models\Users\ConnexionUser;
use App\Models\Users\UserEnLigne;
use App\Models\Users\Role;
use App\Models\Users\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $id = Auth::user()->societe_id;
            if (isset(Auth::user()->role_id)) {
                $role = Auth::user()->role_id;
                if ($role == 1 || $role == 0) {
                    $utilisateurs = Utilisateur::where('societe_id', $id)->get();
                    return view('users.index', compact('utilisateurs'));
                }
            }

            $utilisateurs = Utilisateur::where('societe_id', $id)->where('role_id', '!=', 1)->Where('role_id', '!=', 0)->get();
            return view('users.index', compact('utilisateurs'));
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function online()
    {
        if (Auth::check()) {
            $id = Auth::user()->societe_id;
            $onlines = UserEnLigne::all();
            return view('users.online', compact('onlines'));
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function filelog()
    {
        if (Auth::check()) {
            $id = Auth::user()->societe_id;
            $utilisateurs = Utilisateur::all();
            $filelogs = ConnexionUser::orderBy('id', 'desc')->get();
            return view('users.filelog', compact('filelogs', ));
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
            'prenom' => 'required',
            'email' => 'required|email|unique:utilisateurs',
            'adresse' => 'required',
            'password' => 'required|min:4',
            'terms' => 'required',
            'gestion' => 'required',
            'societe' => 'required',
        ]);
        /**
         * donnee a ajouté dans la table
         */

        $data = $request->all();

        /**
         * insertion des données dans la table user
         */
        Utilisateur::create([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'adresse' => $data['adresse'],
            'password' => Hash::make($data['password']),
            'terms' => $data['terms'],
            'gestion_id' => $data['gestion'],
            'societe_id' => $data['societe'],
        ]);
        return redirect('/users/index')->with('success', 'Utilisateur ajouté avec succès');
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
        $id = decrypt($id);
        if (Auth::check()) {
            $utilisateur = Utilisateur::find($id);
            $roles = Role::all();
            $permissions = Permission::all();
            return view('users.edit', compact('utilisateur', 'roles'));
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Utilisateur $utilisateur, $id)
    {
        $id = decrypt($id);
        $utilisateur = Utilisateur::find($id);
        /**
         * validation des champs de saisie
         */
        $data = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required',
            'adresse' => 'required',
        ]);
        /**
         * donnee a ajouté dans la table
         */


        /**
         * insertion des données dans la table user
         */
        $utilisateur->update([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'adresse' => $data['adresse'],
        ]);
        return back()->with('success', 'Utilisateur Modifier avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function role(Request $request, $id)
    {

        $utilisateur = Utilisateur::find($id);

        $request->validate([
            'role' => 'required',
        ]);

        $data = $request->all();

        $utilisateur->update([
            'role_id' => $data['role'],
        ]);
        return back()->with('success', 'Role utilisateur mis à jour avec succès');
    }

    public function permission(Request $request)
    {
        $request->permission_id;
        $request->user_id;

        dd($request->permission_id . '  et ' . $request->user_id);
    }

    public function active($id)
    {
        $utilisateur = Utilisateur::find($id);
        $utilisateur->update([
            'etat' => 1,
        ]);
        return back()->with('success', 'Compte utilisateur activé avec succès');
    }

    public function inactive($id)
    {
        $utilisateur = Utilisateur::find($id);
        $utilisateur->update([
            'etat' => 0,
        ]);
        return back()->with('danger', 'Compte utilisateur desactivé avec succès');
    }

    public function password(Request $request, $id)
    {

        $utilisateur = Utilisateur::find($id);

        $request->validate([
            'password' => 'required|min:4',
        ]);

        $data = $request->all();

        $utilisateur->update([
            'password' => Hash::make($data['password']),
        ]);
        return back()->with('success', 'Mot de passe utilisateur initialisé avec succès');
    }
}
