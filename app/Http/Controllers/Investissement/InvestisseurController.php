<?php

namespace App\Http\Controllers\Investissement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Investissement\Investisseur;

class InvestisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (Auth::check()) {
            $agence_id = Auth::user()->agence_id;
            $societe_id = Auth::user()->societe_id;
            $investisseurs = Investisseur::where('societe_id', $societe_id)->get();
            return view('investissement.index', compact('investisseurs'));
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check()) {
            return view('investissement.create');
        }
        return redirect('/')->with('danger', "Session expirée");
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
            'email' => 'required|unique:investisseurs',
            'telephone' => 'required',
            'heritier' => 'required',
        ]);
        /**
         * donnee a ajouté dans la table
         */
        $code = mt_rand(10000, 99999);
        $date_creation = date("Y-m-d");
        $agence_id = Auth::user()->agence_id;
        $societe_id = Auth::user()->societe_id;
        $data = $request->all();
        if (Auth::check()) {
            if ($agence_id == 0 || $agence_id == null) {
                return redirect('/investisseur')->with('danger', "Votre compte utilisateur n'est pas associé à une agence");
            } else {
                //dd($data);
                /**
                 * insertion des données dans la table user
                 */
                Investisseur::create([
                    'code' => $code,
                    'nom' => $data['nom'],
                    'prenom' => $data['prenom'],
                    'email' => $data['email'],
                    'telephone' => $data['telephone'],
                    'heritier' => $data['heritier'],
                    'agence_id' => $agence_id,
                    'societe_id' => $societe_id,
                    'date_creation' => $date_creation,
                ]);
                return redirect('/investisseur')->with('success', 'investisseur ajouté avec succès');
            }
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
            $investisseur = Investisseur::find($id);
            return view('investissement.edit', compact('investisseur'));
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
            $investisseur = Investisseur::find($id);

            $investisseur->update([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'heritier' => $request->heritier,
            ]);
            return back()->with('success', 'investisseur modifier avec succès');
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function password(Request $request, $id)
    {
        if (Auth::check()) {
            $id = decrypt($id);
            $investisseur = Investisseur::find($id);

            $investisseur->update([
                'password' => encrypt($request->password),
            ]);
            return back()->with('success', 'mot de passe investisseur modifier avec succès');
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

    public function code()
    {
        if (Auth::check()) {
            return view('investissement.code');
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function activer_desactiver(Request $request)
    {
        $data = $request->validate([
            'code' => 'required',
        ]);

        $id = $request->code;
        if (Auth::check()) {
            $investisseur = Investisseur::where('code', $id)->first();
            if ($investisseur == NULL) {
                return back()->with('danger', 'Code inexistant');
            } else {
                $request->validate([
                    'code' => 'required',
                ]);
                // dd($investisseur);
                /**
                 * insertion des données dans la table user
                 */
                if ($investisseur->etat == 0) {

                    $investisseur->update([
                        'etat' => 1,
                    ]);
                    return back()->with('success', 'Compte activé avec succès');
                }
                if ($investisseur->etat == 1) {

                    $investisseur->update([
                        'etat' => 0,
                    ]);
                    return back()->with('danger', 'Compte desactivé avec succès');
                }
            }
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function consultation()
    {
        if (Auth::check()) {
            return view('investissement.consultation');
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function consulter(Request $request)
    {
        /**
         * validation des champs de saisie
         */
        $data = $request->validate([
            'code' => 'required',
        ]);
        $id = $request->code;
        if (Auth::check()) {
            $investisseur = Investisseur::where('code', $id)->first();
            if ($investisseur == NULL) {
                return back()->with('danger', 'Code inexistant');
            } else {
                $code = $data['code'];
                $investisseur_id = Investisseur::where('code', $code)->first(['id'])->id;
                $investisseur = Investisseur::find($investisseur_id);

                return view('investissement.consulter', compact('investisseur'));
            }
        }
        return redirect('/')->with('danger', "Session expirée");
    }
}
