<?php

namespace App\Http\Controllers\Banque;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Caisse\Caisse;
use App\Models\Agences\Agence;
use App\Models\Caisse\MouvementCaisse;
use App\Models\Banque;
use App\Models\OperationInterBanque;
use App\Models\OperationBanque;
use App\Models\MouvementBanque;

class BanqueController extends Controller
{

    public function index()
    {

        if (Auth::check()) {

            $societe_id = Auth::user()->societe_id;
            $agences = Agence::where('societe_id', $societe_id)->get();
            $banques = Banque::all();

            return view('banque.index', compact('banques', 'agences'));
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function store(Request $request)
    {
        /**
         * validation des champs de saisie
         */
        $request->validate([
            'libelle' => 'required',
            'numero' => 'required',
            'agence_id' => 'required',
        ]);
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $societe_id = Auth::user()->societe_id;
            /**
             * donnee a ajouté dans la table
             */

            $data = $request->all();
            /**
             * insertion des données dans la table user
             */
            Banque::create([
                'libelle' => $data['libelle'],
                'numero_compte_banque' => $data['numero'],
                'etat' => 'activer',
                'user_id' => $user_id,
                'agence_id' => $data['agence_id'],
                'societe_id' => $societe_id,
            ]);
            return redirect('/banque')->with('success', 'caisse crée avec succès');
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function edit(string $id)
    {
        if (Auth::check()) {

            $societe_id = Auth::user()->societe_id;
            $banque = Banque::find($id);
            $agences = Agence::where('societe_id', $societe_id)->where('id', '!=', $banque->agence->id)->get();
            return view('banque.edit', compact('banque', 'agences'));
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function update(Request $request, string $id)
    {

        $request->validate([
            'agence_id' => 'required',
            'libelle' => 'required',
            'numero' => 'required',
        ]);
        /**
         * donnee a ajouté dans la table
         */
        $data = $request->all();
        if (Auth::check()) {
            $banque = Banque::find($id);
            $banque->update([
                'agence_id' => $data['agence_id'],
                'libelle' => $data['libelle'],
                'numero_compte_banque' => $data['numero'],
            ]);
            return back()->with('success', 'banque modifier avec succès');
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function depot()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;

            if (isset(Caisse::where('user_id', $user_id)->first(['id'])->id)) {

                $agence_id = Auth::user()->agence_id;
                $societe_id = Auth::user()->societe_id;
                $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
                $caisse = Caisse::find($caisse_id);
                $agences = Agence::where('societe_id', $societe_id)->get();
                $banques = Banque::where('agence_id', $agence_id)->get();
                $operations = OperationBanque::where('user_id', $user_id)->where('sens_operation', 'entree')->orderBy('updated_at', 'DESC')->get();

                return view('banque.depot_banque', compact('banques', 'agences', 'operations', 'caisse'));
            }
            return view('investissement.message');
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function retrait(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;

            if (isset(Caisse::where('user_id', $user_id)->first(['id'])->id)) {

                $agence_id = Auth::user()->agence_id;
                $societe_id = Auth::user()->societe_id;
                $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
                $caisse = Caisse::find($caisse_id);
                $agences = Agence::where('societe_id', $societe_id)->get();
                $banques = Banque::where('agence_id', $agence_id)->get();
                $operations = OperationBanque::where('user_id', $user_id)->where('sens_operation', 'sortie')->orderBy('updated_at', 'DESC')->get();

                return view('banque.retrait_banque', compact('banques', 'agences', 'operations', 'caisse'));
            }
            return view('investissement.message');
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function virement(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->user_id;
            $agence_id = Auth::user()->agence_id;
            $societe_id = Auth::user()->societe_id;
            $agences = Agence::where('societe_id', $societe_id)->get();
            $banques_s = Banque::where('agence_id', $agence_id)->get();
            $banques_d = Banque::where('agence_id', '!=', $agence_id)->where('societe_id', $societe_id)->get();
            $operations = OperationInterBanque::where('user_id', $user_id)->get();

            return view('banque.virement_banque', compact('banques_s', 'banques_d', 'agences', 'operations'));
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function depot_create(Request $request)
    {
        if (Auth::check()) {
            if ($request->source == "caisse") {
                $user_id = Auth::user()->id;
                if (Caisse::where('user_id', $user_id)->first(['compte'])->compte >= $request->montant) {

                    $date_comptable = Caisse::where('user_id', $user_id)->first(['date_comptable'])->date_comptable;

                    $request->validate([
                        'source' => 'required',
                        'destination' => 'required',
                        'montant' => 'required',
                        'commentaire' => 'required',
                    ]);
                    /**
                     * donnee a ajouté dans la table
                     */

                    $data = $request->all();
                    // dd('operation effecteur');

                    $banque = Banque::find($request->destination);
                    $solde_banque = $banque->compte + $data['montant'];

                    $banque->update([
                        'compte' => $solde_banque,
                    ]);

                    OperationBanque::create([
                        'source' => $data['source'],
                        'banque_id' => $data['destination'],
                        'description' => $data['commentaire'],
                        'montant_operation' => $data['montant'],
                        'sens_operation' => 'entree',
                        'piece' => $data['piece'],
                        'user_id' => $user_id,
                        'date_comptable' => $date_comptable,
                    ]);

                    MouvementBanque::create([
                        'banque_id' => $data['destination'],
                        'user_id' => $user_id,
                        'description' => 'depot banque : '.$data['commentaire'],
                        'entree' => $data['montant'],
                        'solde' => $solde_banque,
                        'date_comptable' => $date_comptable,
                    ]);

                    $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
                    $caisse = Caisse::find($caisse_id);
                    $compte = $caisse->compte - $data['montant'];

                    MouvementCaisse::create([
                        'caisse_id' => $caisse_id,
                        'user_id' => $user_id,
                        'description' =>  'depot banque : '.$data['commentaire'],
                        'sortie' => $data['montant'],
                        'solde' => $compte,
                        'date_comptable' => $date_comptable,

                    ]);

                    $caisse->update([
                        'compte' => $compte,
                    ]);

                    return redirect('/banque/depot')->with('success', "Operation effectuée avec succès ");
                } else {
                    return redirect('/banque/depot')->with('danger', "montant caisse insufissant");
                }
            } else {
                $user_id = Auth::user()->id;
                $date_comptable = Caisse::where('user_id', $user_id)->first(['date_comptable'])->date_comptable;

                $request->validate([
                    'source' => 'required',
                    'destination' => 'required',
                    'montant' => 'required',
                    'commentaire' => 'required',
                ]);
                /**
                 * donnee a ajouté dans la table
                 */

                $data = $request->all();
                // dd('operation effecteur');

                $banque = Banque::find($request->destination);
                $solde_banque = $banque->compte + $data['montant'];

                $banque->update([
                    'compte' => $solde_banque,
                ]);

                OperationBanque::create([
                    'source' => $data['source'],
                    'banque_id' => $data['destination'],
                    'description' => $data['commentaire'],
                    'montant_operation' => $data['montant'],
                    'sens_operation' => 'entree',
                    'piece' => $data['piece'],
                    'user_id' => $user_id,
                    'date_comptable' => $date_comptable,
                ]);

                MouvementBanque::create([
                    'banque_id' => $data['destination'],
                    'user_id' => $user_id,
                    'description' =>  'depot banque : '.$data['commentaire'],
                    'entree' => $data['montant'],
                    'solde' => $solde_banque,
                    'date_comptable' => $date_comptable,
                ]);

                return redirect('/banque/depot')->with('success', "Operation effectuée avec succès ");
            }
        }
        return redirect('/')->with('danger', "Session expirée");
    }


    public function depot_supprimer($id)
    {
        if (Auth::check()) {
            $operation = OperationBanque::find($id);
            $banque = Banque::find($operation->banque_id);

            // dd($operation->montant_operation);

            if ($operation->source == "caisse") {
                $user_id = Auth::user()->id;

                if (Banque::where('id', $operation->banque_id)->first(['compte'])->compte >= $operation->montant_operation) {

                    $date_comptable = Caisse::where('user_id', $user_id)->first(['date_comptable'])->date_comptable;


                    $solde_banque = $banque->compte - $operation->montant_operation;

                    $banque->update([
                        'compte' => $solde_banque,
                    ]);

                    MouvementBanque::create([
                        'banque_id' => $operation->banque_id,
                        'user_id' => $user_id,
                        'description' => 'depot banque Annuler ',
                        'sortie' => $operation->montant_operation,
                        'solde' => $solde_banque,
                        'date_comptable' => $date_comptable,
                    ]);

                    $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
                    $caisse = Caisse::find($caisse_id);
                    $compte = $caisse->compte + $operation->montant_operation;

                    MouvementCaisse::create([
                        'caisse_id' => $caisse_id,
                        'user_id' => $user_id,
                        'description' => 'depot banque Annuler ',
                        'entree' => $operation->montant_operation,
                        'solde' => $compte,
                        'date_comptable' => $date_comptable,

                    ]);

                    $caisse->update([
                        'compte' => $compte,
                    ]);


                    $operation->delete();

                    return redirect('/banque/depot')->with('success', "Operation effectuée avec succès ");
                } else {

                   return redirect('/banque/depot')->with('danger', "montant banque insufissant");
                }
            } else {

                if (Banque::where('id', $operation->banque_id)->first(['compte'])->compte >= $operation->montant_operation) {

                    $user_id = Auth::user()->id;
                    $date_comptable = Caisse::where('user_id', $user_id)->first(['date_comptable'])->date_comptable;

                    $solde_banque = $banque->compte - $operation->montant_operation;

                    $banque->update([
                        'compte' => $solde_banque,
                    ]);

                    MouvementBanque::create([
                        'banque_id' => $operation->banque_id,
                        'user_id' => $user_id,
                        'description' => 'depot banque Annuler ',
                        'sortie' => $operation->montant_operation,
                        'solde' => $solde_banque,
                        'date_comptable' => $date_comptable,
                    ]);

                    $operation->delete();

                    return redirect('/banque/depot')->with('success', "Operation effectuée avec succès ");
                } else {

                    return redirect('/banque/depot')->with('danger', "montant banque insufissant");
                }
            }
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function retrait_create(Request $request)
    {
        if (Auth::check()) {
            if ($request->destination == "caisse") {

                // $banque=Banque::where('id',$request->source)->first(['compte'])->compte;
                // dd($request->destination,$request->montant,$request->source,$banque);
                $user_id = Auth::user()->id;
                if (Banque::where('id', $request->source)->first(['compte'])->compte >= $request->montant) {

                    $date_comptable = Caisse::where('user_id', $user_id)->first(['date_comptable'])->date_comptable;

                    $request->validate([
                        'source' => 'required',
                        'destination' => 'required',
                        'montant' => 'required',
                        'commentaire' => 'required',
                    ]);
                    /**
                     * donnee a ajouté dans la table
                     */

                    $data = $request->all();
                    // dd('operation effecteur');

                    $banque = Banque::find($request->source);
                    $solde_banque = $banque->compte - ($data['montant']);

                    $banque->update([
                        'compte' => $solde_banque,
                    ]);

                    OperationBanque::create([
                        'source' => $data['destination'],
                        'banque_id' => $data['source'],
                        'description' => $data['commentaire'],
                        'montant_operation' => $data['montant'],
                        'sens_operation' => 'sortie',
                        'piece' => $data['piece'],
                        'user_id' => $user_id,
                        'date_comptable' => $date_comptable,
                    ]);

                    MouvementBanque::create([
                        'banque_id' => $data['source'],
                        'user_id' => $user_id,
                        'description' => 'retrait banque : '.$data['commentaire'],
                        'sortie' => $data['montant'],
                        'solde' => $solde_banque,
                        'date_comptable' => $date_comptable,
                    ]);

                    $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
                    $caisse = Caisse::find($caisse_id);
                    $compte = $caisse->compte + $data['montant'];

                    MouvementCaisse::create([
                        'caisse_id' => $caisse_id,
                        'user_id' => $user_id,
                        'description' => 'retrait banque : '.$data['commentaire'],
                        'entree' => $data['montant'],
                        'solde' => $compte,
                        'date_comptable' => $date_comptable,

                    ]);

                    $caisse->update([
                        'compte' => $compte,
                    ]);

                    return redirect('/banque/retrait')->with('success', "Operation effectuée avec succès ");
                } else {

                    return redirect('/banque/depot')->with('danger', "montant banque insufissant");
                }
            } else {

                if (Banque::where('id', $request->source)->first(['compte'])->compte >= $request->montant) {

                    $user_id = Auth::user()->id;
                    $date_comptable = Caisse::where('user_id', $user_id)->first(['date_comptable'])->date_comptable;

                    $request->validate([
                        'source' => 'required',
                        'destination' => 'required',
                        'montant' => 'required',
                        'commentaire' => 'required',
                    ]);
                    /**
                     * donnee a ajouté dans la table
                     */

                    $data = $request->all();
                    // dd('operation effecteur');

                    $banque = Banque::find($request->source);
                    $solde_banque = $banque->compte - $data['montant'];

                    $banque->update([
                        'compte' => $solde_banque,
                    ]);

                    OperationBanque::create([
                        'source' => $data['destination'],
                        'banque_id' => $data['source'],
                        'description' => $data['commentaire'],
                        'montant_operation' => $data['montant'],
                        'sens_operation' => 'sortie',
                        'piece' => $data['piece'],
                        'user_id' => $user_id,
                        'date_comptable' => $date_comptable,
                    ]);

                    MouvementBanque::create([
                        'banque_id' => $data['source'],
                        'user_id' => $user_id,
                        'description' => 'retrait banque : '.$data['commentaire'],
                        'sortie' => $data['montant'],
                        'solde' => $solde_banque,
                        'date_comptable' => $date_comptable,
                    ]);

                    return redirect('/banque/retrait')->with('success', "Operation effectuée avec succès ");
                } else {

                    return redirect('/banque/depot')->with('danger', "montant caisse insufissant");
                }
            }
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function retrait_supprimer($id)
    {
        if (Auth::check()) {
            $operation = OperationBanque::find($id);
            $banque = Banque::find($operation->banque_id);

            // dd($operation->montant_operation);

            if ($operation->source == "caisse") {
                $user_id = Auth::user()->id;

                if (isset(Caisse::where('user_id', $user_id)->first(['compte'])->compte)) {

                    $date_comptable = Caisse::where('user_id', $user_id)->first(['date_comptable'])->date_comptable;


                    $solde_banque = $banque->compte + $operation->montant_operation;

                    $banque->update([
                        'compte' => $solde_banque,
                    ]);

                    MouvementBanque::create([
                        'banque_id' => $operation->banque_id,
                        'user_id' => $user_id,
                        'description' => 'depot banque Annuler ',
                        'entree' => $operation->montant_operation,
                        'solde' => $solde_banque,
                        'date_comptable' => $date_comptable,
                    ]);

                    $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
                    $caisse = Caisse::find($caisse_id);
                    $compte = $caisse->compte - $operation->montant_operation;

                    MouvementCaisse::create([
                        'caisse_id' => $caisse_id,
                        'user_id' => $user_id,
                        'description' => 'retrait banque Annuler ',
                        'sortie' => $operation->montant_operation,
                        'solde' => $compte,
                        'date_comptable' => $date_comptable,

                    ]);

                    $caisse->update([
                        'compte' => $compte,
                    ]);


                    $operation->delete();

                    return redirect('/banque/retrait')->with('success', "Operation effectuée avec succès ");
                } else {

                    return redirect('/banque/depot')->with('danger', "montant caisse insufissant");
                }
            } else {

                $user_id = Auth::user()->id;
                $date_comptable = Caisse::where('user_id', $user_id)->first(['date_comptable'])->date_comptable;

                $solde_banque = $banque->compte + $operation->montant_operation;

                $banque->update([
                    'compte' => $solde_banque,
                ]);

                MouvementBanque::create([
                    'banque_id' => $operation->banque_id,
                    'user_id' => $user_id,
                    'description' => 'retrait banque Annuler ',
                    'entree' => $operation->montant_operation,
                    'solde' => $solde_banque,
                    'date_comptable' => $date_comptable,
                ]);

                $operation->delete();

                return redirect('/banque/retrait')->with('success', "Operation effectuée avec succès ");
            }
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function rapprochement()
    {
        if (Auth::check()) {
            $agence_id = Auth::user()->agence_id;
            $agence = Agence::find($agence_id);
            $banques = Banque::where('agence_id', $agence_id)->get();
            $rapprochement_bancaires = MouvementBanque::where('banque_id', NULL)->orderBy('id', 'DESC')->get();
            return view('banque.rapport_banque', compact('banques', 'rapprochement_bancaires', 'agence'));
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function rapport_banque(Request $request)
    {
        if (Auth::check()) {
            $agence_id = Auth::user()->agence_id;
            $agence = Agence::find($agence_id);
            $banques = Banque::where('agence_id', $agence_id)->get();
            $rapprochement_bancaires = MouvementBanque::where('banque_id', $request->banque)->orderBy('id', 'DESC')->get();
            return view('banque.rapport_banque', compact('banques', 'rapprochement_bancaires', 'agence'));
        }
        return redirect('/')->with('danger', "Session expirée");
    }
}
