<?php

namespace App\Http\Controllers\Detenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Detenu\DetenuModel;

class DetenuController extends Controller
{
    public function index()
    {

        $detenus = DetenuModel::Where('date_liberation', NULL)->get();
        return view('detention.detenu.index', compact('detenus'));
    }

    public function create()
    {

        return view('detention.detenu.create');
    }

    public function store(Request $request)
    {

        /**
         * validation des champs de saisie
         */
        $request->validate([
            'nom_prenom' => 'required',
            'sexe' => 'required',
            'date_naissance' => 'required',
            'lieu_naissance' => 'required',
            'nom_mere' => 'required',
            'examen_medical' => 'required',
            'date_detention' => 'required',
            'motif_detention' => 'required',
            'mineur' => 'required',
        ]);
        /**
         * donnee a ajouté dans la table
         */

        $data = $request->all();
        // dd($data);

        if (Auth::check()) {
            /**
             * insertion des données dans la table user
             */
            DetenuModel::create([
                'nom_prenom' => $data['nom_prenom'],
                'sexe' => $data['sexe'],
                'nom_mere' => $data['nom_mere'],
                'date_naissance' => $data['date_naissance'],
                'lieu_naissance' => $data['lieu_naissance'],
                'examen_medical' => $data['examen_medical'],
                'date_detention' => $data['date_detention'],
                'motif_detention' => $data['motif_detention'],
                'mineur' => $data['mineur'],
                'utilisateur_id' => Auth::user()->id,
            ]);
            return back()->with('success', 'detenu enregistré avec succès');
        }
        return redirect('/auth')->with('danger', "Session expirée");
    }

    public function edit(string $id)
    {
    }
}
