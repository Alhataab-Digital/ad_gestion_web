<?php

namespace App\Http\Controllers\Investissement;

use App\Http\Controllers\Controller;
use App\Models\Investisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\TypeReglement;
use App\Models\OperationInvestisseur;
use App\Models\OperationDividende;
use App\Models\MouvementCaisse;
use App\Models\DeviseAgence;
use App\Models\Agence;
use App\Models\Caisse;

class PortailInvestisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('investissement.portail.portail');
    }

    public function inscrire()
    {
        //
        return view('investissement.portail.inscrire');
    }

    public function profile_investisseur($id)
    {
        $id = decrypt($id);
        $investisseur = Investisseur::find($id);
        $agence = Agence::find($investisseur->agence_id);
        $operation_div = OperationDividende::where('investisseur_id', $id)->where('valider', 'oui')->orderBy('id', 'DESC')->get();
        $operation_inv = OperationInvestisseur::where('investisseur_id', $id)->where('valider', 'oui')->orderBy('id', 'DESC')->get();
        $operation_div_invalid = OperationDividende::where('investisseur_id', $id)->where('valider', 'non')->orderBy('id', 'DESC')->get();
        $operation_inv_invalid = OperationInvestisseur::where('investisseur_id', $id)->where('valider', 'non')->orderBy('id', 'DESC')->get();

        return view('investissement.portail.profile_investisseur', compact('investisseur', 'operation_div', 'operation_inv', 'operation_div_invalid', 'operation_inv_invalid', 'agence'));
    }

    public function connect(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $investisseurs = Investisseur::where('email', $request->email)->first();
        $connection = $request->only('email', 'password');

        if (isset($investisseurs->email) == $connection['email'] && isset($investisseurs->password) == Hash::make($connection['password'])) {

            $investisseurs = Investisseur::where('email', $request->email)->get();
            foreach ($investisseurs as $investisseur) {
                if ($investisseur->etat != 0) {
                    return redirect('profile/' . encrypt($investisseur->id) . '/investisseur');
                }
                return redirect('/portail')->with('danger', 'Compte inactif');
            }
        }
        return redirect('/portail')->with('danger', 'Login ou mots de passe invalide');
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
        $code = $request->code;

        $request->validate([
            // 'email'=>'required|email|unique:investisseurs',
            'password' => 'required|min:4',
        ]);

        /**
         * donnee a ajouté dans la table
         */
        $data = $request->all();
        if (isset(Investisseur::where('code', $code)->where('password', Null)->first(['id'])->id)) {
            $investisseur = Investisseur::where('code', $code)->first();
            /**
             * insertion des données dans la table user
             */
            $investisseur->update([
                'password' => Hash::make($data['password']),
            ]);

            return redirect('/portail');
        } else {
            return redirect('/inscrire')->with('danger', 'Vous avez déjà un compte');;
        }
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

    public function recuperation(Request $request)
    {

        if (isset(Investisseur::where('code', $request->code)->first(['id'])->id)) {

            $data['inscription'] = Investisseur::where('code', $request->code)->get();
            return response()->json($data);
        }

        if (isset(Investisseur::where('code', '!=', $request->code)->first(['id'])->id)) {

            $data['erreur'] = ("Vous n'est pas investisseur ");
            return response()->json($data);
        }
    }

    public function valider_operation_div($id)
    {

        $id = decrypt($id);
        $operation = OperationDividende::find($id);
        $investisseur = Investisseur::find($operation->investisseur_id);
        $user_id = $operation->user_id;

        $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
        $compte_caisse = Caisse::where('user_id', $user_id)->first(['compte'])->compte;
        $date_comptable = Caisse::where('user_id', $user_id)->first(['date_comptable'])->date_comptable;
        $compte_dividende = $investisseur->compte_dividende;
        $montant_retrait = $operation->montant_operation;

        $montant_investisseur = $compte_dividende - $montant_retrait;
        $montant_caisse = $compte_caisse - $montant_retrait;

        // dd($montant_investisseur);
        /**
         * mise a jour du client
         */
        $investisseur->update([
            'compte_dividende' => $montant_investisseur,
        ]);
        /**
         * enregistrement de l'operation
         */
        $operation->update([
            'valider' => 'oui',
            'solde' => $montant_investisseur,
        ]);

        /**
         * mise a jour de la caisse
         */

        $compte = $compte_caisse - $operation->montant_operation;

        $caisse = Caisse::find($caisse_id);

        $user_id = $operation->user_id;

        MouvementCaisse::create([
            'caisse_id' => $caisse->id,
            'user_id' => $user_id,
            'description' => 'retrait dividende investisseur =>' . $investisseur->nom . '/' . $investisseur->telephone,
            'sortie' => $montant_retrait,
            'solde' => $compte,
            'date_comptable' => $date_comptable,

        ]);

        $caisse->update([
            'compte' => $montant_caisse,
        ]);

        return redirect('profile/' . encrypt($investisseur->id) . '/investisseur');
    }

    public function valider_operation_inv($id)
    {

        $id = decrypt($id);
        $operation = OperationInvestisseur::find($id);
        $investisseur = Investisseur::find($operation->investisseur_id);
        $user_id = $operation->user_id;

        $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
        $compte_caisse = Caisse::where('user_id', $user_id)->first(['compte'])->compte;
        $date_comptable = Caisse::where('user_id', $user_id)->first(['date_comptable'])->date_comptable;
        $compte_investisseur = $investisseur->compte_investisseur;
        $compte_investis = $investisseur->montant_investis;
        $montant_retrait = $operation->montant_operation;

        $montant_investis = $compte_investis - $montant_retrait;
        $montant_caisse = $compte_caisse - $montant_retrait;

        // dd($montant_investisseur);
        /**
         * mise a jour du client
         */
        if ($montant_investis == 0) {

            $montant_investisseur = 0;
            $investisseur->update([
                'montant_investis' => $montant_investis,
                'compte_investisseur' => $montant_investisseur,
            ]);


            /**
             * enregistrement de l'operation
             */
            $operation->update([
                'valider' => 'oui',
                'solde' => $montant_investis,
            ]);

            /**
             * mise a jour de la caisse
             */

            $compte = $compte_caisse - $operation->montant_operation;

            $caisse = Caisse::find($caisse_id);

            MouvementCaisse::create([
                'caisse_id' => $caisse->id,
                'user_id' => $user_id,
                'description' => 'retrait dans compte investissement =>' . $investisseur->nom . '/' . $investisseur->telephone,
                'sortie' => $montant_retrait,
                'solde' => $compte,
                'date_comptable' => $date_comptable,

            ]);

            $caisse->update([
                'compte' => $montant_caisse,
            ]);

            return redirect('profile/' . encrypt($investisseur->id) . '/investisseur');
        } else {

            $montant_investisseur = $compte_investisseur - $montant_retrait;

            $investisseur->update([
                'montant_investis' => $montant_investis,
                'compte_investisseur' => $montant_investisseur,
            ]);


            /**
             * enregistrement de l'operation
             */
            $operation->update([
                'valider' => 'oui',
                'solde' => $montant_investis,
            ]);

            /**
             * mise a jour de la caisse
             */

            $compte = $compte_caisse - $operation->montant_operation;

            $caisse = Caisse::find($caisse_id);

            MouvementCaisse::create([
                'caisse_id' => $caisse->id,
                'user_id' => $user_id,
                'description' => 'retrait dans compte investissement =>' . $investisseur->nom . '/' . $investisseur->telephone,
                'sortie' => $montant_retrait,
                'solde' => $compte,
                'date_comptable' => $date_comptable,

            ]);

            $caisse->update([
                'compte' => $montant_caisse,
            ]);

            return redirect('profile/' . encrypt($investisseur->id) . '/investisseur');
        }
    }
}
