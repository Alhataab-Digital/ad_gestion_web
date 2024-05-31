<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Investissement\EntrepotStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntrepotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (Auth::check()) {
            $agence_id = Auth::user()->agence_id;

            $entrepots = EntrepotStock::Where('agence_id', $agence_id)->get();
            return view('investissement.entrepot', compact('entrepots'));
        }
        return redirect('/auth')->with('success', "Session expirée");
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
        if (Auth::check()) {
            if ((Auth::user()->agence_id) != 0) {
                /**
                 * validation des champs de saisie
                 */
                $request->validate([
                    'nom' => 'required',
                    'adresse' => '',
                    'capacite' => '',
                ]);
                /**
                 * donnee a ajouté dans la table
                 */
                $agence_id = Auth::user()->agence_id;
                $data = $request->all();
                /**
                 * insertion des données dans la table user
                 */
                EntrepotStock::create([
                    'nom_entrepot' => $data['nom'],
                    'adresse_entrepot' => $data['adresse'],
                    'capacite_entrepot' => $data['capacite'],
                    'agence_id' => $agence_id,
                ]);
                return redirect('/entrepot')->with('success', 'Entrepot crée avec succès');
            } else {
                return redirect('/entrepot')->with('success', 'Vous n\'etes par lier à une agence');
            }
        }
        return redirect('/auth')->with('danger', "Session expirée");
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
            $agence_id = Auth::user()->agence_id;

            $entrepot = EntrepotStock::find($id);
            return view('e-commerce.editer_entrepot', compact('entrepot'));
        }
        return redirect('/auth')->with('success', "Session expirée");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id = decrypt($id);

        $entrepot = EntrepotStock::find($id);

        if (Auth::check()) {
            if ((Auth::user()->agence_id) != 0) {
                /**
                 * validation des champs de saisie
                 */
                $request->validate([
                    'nom' => 'required',
                    'adresse' => '',
                    'capacite' => '',
                ]);
                /**
                 * donnee a ajouté dans la table
                 */
                $agence_id = Auth::user()->agence_id;
                $data = $request->all();
                /**
                 * insertion des données dans la table user
                 */
                $entrepot->update([
                    'nom_entrepot' => $data['nom'],
                    'adresse_entrepot' => $data['adresse'],
                    'capacite_entrepot' => $data['capacite'],
                    'agence_id' => $agence_id,
                ]);
                return redirect('/entrepot')->with('success', 'Entrepot modifier avec succès');
            } else {
                return redirect('/entrepot')->with('success', 'Vous n\'etes par lier à une agence');
            }
        }
        return redirect('/auth')->with('danger', "Session expirée");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
