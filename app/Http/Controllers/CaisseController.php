<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Caisse;
use App\Models\Societe;
use App\Models\Agence;
use App\Models\Stock;
use App\Models\Operation;
use App\Models\OperationTransfert;
use App\Models\OperationInvestisseur;
use App\Models\ActiviteInvestissement;
use App\Models\MouvementCaisse;
use App\Models\OperationInterCaisse;
use App\Models\DeviseAgence;


class CaisseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {

            $societe_id = Auth::user()->societe_id;
            $agence_id = Auth::user()->agence_id;
            $agences = Agence::where('societe_id', $societe_id)->get();
            $caisses = Caisse::where('agence_id', $agence_id)->get();

            return view('caisse.index', compact('caisses', 'agences'));
        }
        return redirect('/auth')->with('danger', "Session expirée");
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
            'libelle' => 'required',
            'montant_min' => 'required',
            'montant_max' => 'required',
            'compte' => 'required',
            'agence_id' => 'required',
        ]);
        /**
         * donnee a ajouté dans la table
         */

        $data = $request->all();
        $societe_id = Auth::user()->societe_id;
        if (Auth::check()) {
            /**
             * insertion des données dans la table user
             */
            Caisse::create([
                'libelle' => $data['libelle'],
                'montant_min' => $data['montant_min'],
                'montant_max' => $data['montant_max'],
                'compte' => $data['compte'],
                'agence_id' => $data['agence_id'],
                'societe_id' => $societe_id,
            ]);
            return redirect('/caisse')->with('success', 'caisse crée avec succès');
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

            $societe_id = Auth::user()->societe_id;
            $caisse = Caisse::find($id);
            $agences = Agence::where('societe_id', $societe_id)->where('id', '!=', $caisse->agence->id)->get();
            return view('caisse.edit', compact('caisse', 'agences'));
        }
        return redirect('/auth')->with('danger', "Session expirée");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id = decrypt($id);
        $request->validate([
            'agence_id' => 'required',
            'libelle' => 'required',
            'montant_min' => 'required',
            'montant_max' => 'required',
        ]);
        /**
         * donnee a ajouté dans la table
         */
        $data = $request->all();

        $caisse = Caisse::find($id);
        $caisse->update([
            'agence_id' => $data['agence_id'],
            'libelle' => $data['libelle'],
            'montant_min' => $data['montant_min'],
            'montant_max' => $data['montant_max'],
        ]);
        return back()->with('success', 'caisse modifier avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function attribution_externe()
    {
        $id = Auth::user()->id;
        if (isset(Caisse::where('user_id', $id)->first(['id'])->id)) {
            $user_id = Auth::user()->id;
            $caisse_id = Caisse::where('user_id', $id)->first(['id'])->id;
            $agence_id = Auth::user()->agence_id;
            $societe_id = Auth::user()->societe_id;
            $caisse = Caisse::find($caisse_id);
            $caisse_destinations = Caisse::where('user_id', '!=', $user_id)->where('agence_id', '!=', $agence_id)->where('societe_id', $societe_id)->get();
            $devise_agences = DeviseAgence::all();
            $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
            $operations = OperationInterCaisse::where('caisse_id', $caisse_id)->where('taux', '!=', 1)->where('etat', NULL)->get();

            return view('caisse.attribution_externe', compact('caisse_destinations', 'operations', 'caisse', 'devise_agences'));
        }
        return view('investissement.message');
    }
    public function attribution_externe_valider(Request $request)
    {
        $user_id = Auth::user()->id;
        $agence_id = Auth::user()->agence_id;
        $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
        $date_comptable = Caisse::where('user_id', $user_id)->first(['date_comptable'])->date_comptable;
        $montant_caisse = Caisse::where('user_id', $user_id)->first();

        /**
         * validation des champs de saisie
         */
        $request->validate([
            'montant_operation' => 'required',
            'caisse_destination' => 'required',
            'commentaire' => 'required',
        ]);
        /**
         * donnee a ajouté dans la table
         */

        $data = $request->all();

        $caisse = Caisse::where('user_id', $user_id)->first();
        $caisse_destination = Caisse::find($data['caisse_destination']);
        // dd($caisse_destination->agence->devise_id, $caisse_destination->agence_id, $devise_agence);
        if (isset(DeviseAgence::where('agence_id', $caisse->agence_id)->where('devise_id', $caisse_destination->agence->devise_id)->first()->taux)) {

            $taux = DeviseAgence::where('agence_id', $caisse->agence_id)->where('devise_id', $caisse_destination->agence->devise_id)->first()->taux;

            if ($montant_caisse->compte < $data['montant_operation']) {
                return redirect('/caisse/attribution_externe')->with('danger', 'montant caisse insuffisant pour effectuer cette operation');
            } else {

                if (!isset($taux) || $taux == 0) {
                    return redirect('/caisse/attribution_externe')->with('danger', "la devise de l'agence est null ");;
                } else {
                    /*
                 * insertion des données dans la table user
                 */
                    OperationInterCaisse::create([
                        'montant_operation' => $data['montant_operation'],
                        'commentaire' => $data['commentaire'],
                        'caisse_destination_id' => $data['caisse_destination'],
                        'taux' => $taux,
                        'caisse_id' => $caisse_id,
                        'user_id' => $user_id,
                        'date_comptable' => $date_comptable,
                    ]);
                    return redirect('/caisse/attribution_externe')->with('success', 'operation crée avec succès');
                }
            }
        } else {

            return redirect('/caisse/attribution_externe')->with('danger', 'Il faut definir le taux de la devise');
        }
    }

    public function attribution()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            if (isset(Caisse::where('user_id', $id)->first(['id'])->id)) {
                $user_id = Auth::user()->id;
                $caisse_id = Caisse::where('user_id', $id)->first(['id'])->id;
                $agence_id = Auth::user()->agence_id;
                $caisse = Caisse::find($caisse_id);
                $caisse_destinations = Caisse::where('user_id', '!=', $user_id)->where('agence_id', $agence_id)->get();
                $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
                $operations = OperationInterCaisse::where('caisse_id', $caisse_id)->where('taux', 1)->where('etat', NULL)->get();

                return view('caisse.attribution', compact('caisse_destinations', 'caisse', 'operations'));
            }
            return view('investissement.message');
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function attribution_valider(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $agence_id = Auth::user()->agence_id;
            $devise_id = Agence::where('id', $agence_id)->first()->devise_id;
            $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
            $date_comptable = Caisse::where('user_id', $user_id)->first(['date_comptable'])->date_comptable;
            $montant_caisse = Caisse::where('user_id', $user_id)->first();

            /**
             * validation des champs de saisie
             */
            $request->validate([
                'montant_operation' => 'required',
                'caisse_destination' => 'required',
                'commentaire' => 'required',
            ]);
            /**
             * donnee a ajouté dans la table
             */

            $data = $request->all();

            $caisse = Caisse::where('user_id', $user_id)->first();
            $caisse_destination = Caisse::find($data['caisse_destination']);
            // dd($caisse_destination->agence->devise_id, $caisse_destination->agence_id, $devise_agence);
            if (isset(DeviseAgence::where('agence_id', $caisse->agence_id)->where('devise_id', $caisse_destination->agence->devise_id)->first()->taux)) {

                $taux = DeviseAgence::where('agence_id', $caisse->agence_id)->where('devise_id', $caisse_destination->agence->devise_id)->first()->taux;

                if ($montant_caisse->compte < $data['montant_operation']) {
                    return redirect('/caisse/attribution')->with('danger', 'montant caisse insuffisant pour effectuer cette operation');
                } else {

                    if (!isset($taux) || $taux == 0) {
                        return redirect('/caisse/attribution')->with('danger', "la devise de l'agence est null ");
                    } else {
                        /**
                         * insertion des données dans la table user
                         */
                        OperationInterCaisse::create([
                            'montant_operation' => $data['montant_operation'],
                            'commentaire' => $data['commentaire'],
                            'caisse_destination_id' => $data['caisse_destination'],
                            'taux' => $taux,
                            'caisse_id' => $caisse_id,
                            'user_id' => $user_id,
                            'date_comptable' => $date_comptable,
                        ]);
                        return redirect('/caisse/attribution')->with('success', 'operation crée avec succès');
                    }
                }
            } else {

                return redirect('/caisse/attribution')->with('danger', 'Il faut definir le taux de la devise');
            }
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function encaissement()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            if (isset(Caisse::where('user_id', $user_id)->first(['id'])->id)) {
                $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
                $agence_id = Auth::user()->agence_id;
                $caisse = Caisse::find($caisse_id);
                $caisse_destination = Caisse::where('user_id', $user_id)->first();
                // $devise_agence=DeviseAgence::where('agence_id',$caisse_destination->agence_id)->first()->taux;

                $operations = OperationInterCaisse::where('caisse_destination_id', $caisse_id)->orderBy('id', 'DESC')->get();

                return view('caisse.encaissement', compact('operations', 'caisse'));
            }
            return view('investissement.message');
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function encaissement_valider($id)
    {
        if (Auth::check()) {
            $id = decrypt($id);

            $operation = OperationInterCaisse::find($id);

            if ($operation->etat == "valider") {
                return redirect('/caisse/encaissement')->with('danger', "Montant déjà encaissé");
            } else {
                $user_id = Auth::user()->id;
                $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
                $date_comptable = Caisse::where('user_id', $user_id)->first(['date_comptable'])->date_comptable;
                $caisse_destination = Caisse::where('user_id', $user_id)->first();
                // $devise_agence=DeviseAgence::where('agence_id',$caisse_destination->agence_id)->first()->taux;

                $montant_operation_recepteur = round($operation->montant_operation / $operation->taux);
                $montant_operation_emetteur = $operation->montant_operation;


                // dd($montant_operation);

                /**
                 * on verifie si la de emmetrice est ouverte
                 */

                if (isset(Caisse::where('id', $operation->caisse_id)->where('etat', 1)->first(['id'])->id)) {
                    /**
                     * on verifier si le montant de la caisse emttrice est suffissant
                     */

                    $compte_caisse_emettrice = Caisse::where('id', $operation->caisse_id)->first();

                    if ($compte_caisse_emettrice->compte >= $montant_operation_emetteur) {
                        /**
                         * on verifie si la caisse receptionniste est ouverte
                         */
                        if (isset(Caisse::where('id', $caisse_id)->where('etat', 1)->first(['id'])->id)) {
                            /**
                             * mise jour de l'operation
                             */
                            $operation->update([
                                'date_comptable_reception' => $date_comptable,
                                'user_destination_id' => $user_id,
                                'etat' => 'valider',
                            ]);

                            /**
                             * mise a jour de la caisse provenance
                             */
                            $compte_caisse_provenance = Caisse::where('id', $operation->caisse_id)->first(['compte'])->compte;
                            $compte = $compte_caisse_provenance - $operation->montant_operation;


                            $caisse = Caisse::find($operation->caisse_id);

                            $user_provenance = $operation->user_id;

                            MouvementCaisse::create([
                                'caisse_id' => $operation->caisse_id,
                                'user_id' => $user_provenance,
                                'description' => $operation->commentaire . ' ==> Destination ' . $caisse_destination->libelle,
                                'sortie' => $operation->montant_operation,
                                'solde' => $compte,
                                'date_comptable' => $date_comptable,

                            ]);

                            $caisse->update([
                                'compte' => $compte,
                            ]);

                            /**
                             * mise a jour de la caisse destination
                             */
                            $compte_caisse_destination = Caisse::where('id', $caisse_id)->first(['compte'])->compte;
                            $compte = $compte_caisse_destination + $montant_operation_recepteur;
                            $caisse_provenance = Caisse::where('id', $operation->caisse_id)->first();

                            $caisse = Caisse::find($caisse_id);

                            MouvementCaisse::create([
                                'caisse_id' => $caisse_id,
                                'user_id' => $user_id,
                                'description' => $operation->commentaire . ' ==> Provenance ' . $caisse_provenance->libelle,
                                'entree' => $montant_operation_recepteur,
                                'solde' => $compte,
                                'date_comptable' => $date_comptable,

                            ]);

                            $caisse->update([
                                'compte' => $compte,
                            ]);

                            return redirect('/caisse/encaissement')->with('success', "Operation effectuée avec succès ");
                        } else {
                            return redirect('/caisse/encaissement')->with('danger', "La caisse qui doit receptionner le montant n'est pas ouverte ");
                        }
                    } else {
                        return redirect('/caisse/encaissement')->with('danger', "Le montant de la caisse qui a attribuée est insuffisant ");
                    }
                } else {
                    return redirect('/caisse/encaissement')->with('danger', "La caisse qui a attribuée n'est pas ouverte ");
                }
            }
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function attribution_edit($id)
    {
        if (Auth::check()) {
            $id = decrypt($id);
            $user_id = Auth::user()->id;
            $agence_id = Auth::user()->agence_id;
            $operation = OperationInterCaisse::find($id);
            $caisse_destinations = Caisse::where('user_id', '!=', $user_id)->where('id', '!=', $operation->caisse_destination->id)->where('agence_id', $agence_id)->get();
            $devise_agences = DeviseAgence::all();
            return view('caisse.attribution_edit', compact('caisse_destinations', 'operation', 'devise_agences'));
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function attribution_modifier(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
            $date_comptable = Caisse::where('user_id', $user_id)->first(['date_comptable'])->date_comptable;
            $montant_caisse = Caisse::where('user_id', $user_id)->first();

            /**
             * validation des champs de saisie
             */
            $request->validate([
                'operation_id' => 'required',
                'montant_operation' => 'required',
                'caisse_destination' => 'required',
                'commentaire' => 'required',
            ]);
            /**
             * donnee a ajouté dans la table
             */

            $data = $request->all();

            $caisse = Caisse::where('user_id', $user_id)->first();
            $caisse_destination = Caisse::find($data['caisse_destination']);
            if (isset(DeviseAgence::where('agence_id', $caisse->agence_id)->where('devise_id', $caisse_destination->agence->devise_id)->first()->taux)) {
                $taux = DeviseAgence::where('agence_id', $caisse->agence_id)->where('devise_id', $caisse_destination->agence->devise_id)->first()->taux;

                if ($montant_caisse->compte < $data['montant_operation']) {
                    return redirect('/caisse/attribution')->with('danger', 'montant caisse insuffisant pour effectuer cette operation');
                } else {
                    /**
                     * insertion des données dans la table user
                     */
                    $operation = OperationInterCaisse::find($data['operation_id']);
                    if ($operation->etat == "valider") {
                        return redirect('/caisse/attribution')->with('success', 'attribution déjà valider');
                    } else {
                        $operation->update([
                            'montant_operation' => $data['montant_operation'],
                            'commentaire' => $data['commentaire'],
                            'caisse_destination_id' => $data['caisse_destination'],
                            'taux' => $taux,
                            'caisse_id' => $caisse_id,
                            'user_id' => $user_id,
                            'date_comptable' => $date_comptable,
                        ]);
                        return redirect('/caisse/attribution')->with('success', 'modification effectuée avec succès');
                    }
                }
            }
            return redirect('/caisse/attribution')->with('success', "Vous n'avez pas defini le taux de la devise");
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function attribution_externe_edit($id)
    {
        if (Auth::check()) {
            $id = decrypt($id);
            $user_id = Auth::user()->id;
            $agence_id = Auth::user()->agence_id;
            $operation = OperationInterCaisse::find($id);
            $caisse_destinations = Caisse::where('user_id', '!=', $user_id)->where('id', '!=', $operation->caisse_destination->id)->where('agence_id', '!=', $agence_id)->get();
            $devise_agences = DeviseAgence::all();
            return view('caisse.attribution_externe_edit', compact('caisse_destinations', 'operation', 'devise_agences'));
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function attribution_externe_modifier(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
            $date_comptable = Caisse::where('user_id', $user_id)->first(['date_comptable'])->date_comptable;
            $montant_caisse = Caisse::where('user_id', $user_id)->first();



            /**
             * validation des champs de saisie
             */
            $request->validate([
                'operation_id' => 'required',
                'montant_operation' => 'required',
                'caisse_destination' => 'required',
                'commentaire' => 'required',
            ]);
            /**
             * donnee a ajouté dans la table
             */

            $data = $request->all();

            $caisse = Caisse::where('user_id', $user_id)->first();
            $caisse_destination = Caisse::find($data['caisse_destination']);
            if (isset(DeviseAgence::where('agence_id', $caisse->agence_id)->where('devise_id', $caisse_destination->agence->devise_id)->first()->taux)) {
                $taux = DeviseAgence::where('agence_id', $caisse->agence_id)->where('devise_id', $caisse_destination->agence->devise_id)->first()->taux;

                if ($montant_caisse->compte < $data['montant_operation']) {
                    return redirect('/caisse/attribution_externe')->with('danger', 'montant caisse insuffisant pour effectuer cette operation');
                } else {
                    /**
                     * insertion des données dans la table user
                     */
                    $operation = OperationInterCaisse::find($data['operation_id']);
                    if ($operation->etat == "valider") {
                        return redirect('/caisse/attribution_externe')->with('success', 'attribution déjà valider');
                    } else {
                        $operation->update([
                            'montant_operation' => $data['montant_operation'],
                            'commentaire' => $data['commentaire'],
                            'caisse_destination_id' => $data['caisse_destination'],
                            'taux' => $taux,
                            'caisse_id' => $caisse_id,
                            'user_id' => $user_id,
                            'date_comptable' => $date_comptable,
                        ]);
                        return redirect('/caisse/attribution_externe')->with('success', 'modification effectuée avec succès');
                    }
                }
            }
            return redirect('/caisse/attribution_externe')->with('success', "Vous n'avez pas defini le taux de la devise");
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function attribution_supprimer($id)
    {
        if (Auth::check()) {
            $id = decrypt($id);
            $operation = OperationInterCaisse::find($id);
            $operation->delete();
            return back();
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function operation()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $caisses = Caisse::where('user_id', $id)->get();
            $user_id = Auth::user()->id;
            $agence_id = Auth::user()->agence_id;
            $agence = Agence::find($agence_id);
            if (isset(Caisse::where('user_id', $user_id)->first(['id'])->id)) {

                $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
                $stocks = Stock::Where('caisse_id', $caisse_id)->get();
                return view('caisse.operation', compact('caisses', 'stocks', 'agence'));
            }
            return view('caisse.message');
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function ouverture(Request $request, $id)
    {
        if (Auth::check()) {
            $id = decrypt($id);
            $jour = date("Y-m-d");
            if ($request->date == $jour) {

                $caisse = Caisse::find($id);
                $user_id = Auth::user()->id;
                MouvementCaisse::create([
                    'caisse_id' => $caisse->id,
                    'user_id' => $user_id,
                    'description' => 'Ouverture caisse',
                    'entree' => $caisse->compte,
                    'solde' => $caisse->compte,
                    'date_comptable' => $request->date,
                ]);

                // dd($caisse);
                $caisse->update([
                    'etat' => 1,
                    'date_comptable' => $request->date,
                ]);
                return redirect('caisse/operation')->with('success', "Caisse ouverte");
            } else {
                return redirect('caisse/operation')->with('danger', "La date n'est pas à jours ");
            }
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function fermeture(Request $request, $id)
    {
        if (Auth::check()) {
            $id = decrypt($id);
            $caisse = Caisse::find($id);
            $user_id = Auth::user()->id;

            MouvementCaisse::create([
                'caisse_id' => $caisse->id,
                'user_id' => $user_id,
                'description' => 'Fermeture caisse',
                'entree' => $caisse->compte,
                'solde' => $caisse->compte,
                'date_comptable' => $request->date,
            ]);
            // dd($caisse);
            $caisse->update([
                'etat' => 0,
            ]);
            return redirect('caisse/operation')->with('danger', "Caisse fermée");
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function rapport_caisse()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            if (Caisse::where('user_id', $id)->first()) {

                $caisse = Caisse::where('user_id', $id)->first();

                $agence_id = Auth::user()->agence_id;
                $agence = Agence::find($agence_id);
                $date_comptable = Caisse::where('user_id', $id)->first(['date_comptable'])->date_comptable;
                $mouvement_caisses = MouvementCaisse::where('caisse_id', $caisse->id)->where('date_comptable', $date_comptable)->orderBy('id', 'ASC')->get();
                /**
                 * rapport caisse gestion investissement
                 */
                $entree = OperationInvestisseur::where('caisse_id', $caisse->id)->where('sens_operation', 'entree')->sum('montant_operation');
                $sortie = OperationInvestisseur::where('caisse_id', $caisse->id)->where('sens_operation', 'sortie')->sum('montant_operation');
                $decaissement = ActiviteInvestissement::where('caisse_id', $caisse->id)->sum('montant_decaisse');
                $entree_count = OperationInvestisseur::where('caisse_id', $caisse->id)->where('sens_operation', 'entree')->count();
                $sortie_count = OperationInvestisseur::where('caisse_id', $caisse->id)->where('sens_operation', 'sortie')->count();
                $activite_count = ActiviteInvestissement::where('caisse_id', $caisse->id)->count();
                /**
                 * rapport caisse gestion change
                 */
                $envoi_change = OperationTransfert::where('envoi_user_id', $id)->sum('montant_ttc');
                if (OperationTransfert::where('type_envoi', 1)) {

                    $retrait_change = OperationTransfert::where('retrait_user_id', $id)->sum(DB::raw('montant_ttc/taux_echange'));
                }
                if (OperationTransfert::where('type_envoi', 0)) {

                    $retrait_change = OperationTransfert::where('retrait_user_id', $id)->sum(DB::raw('montant/taux_echange'));
                }
                $envoi_change_count = OperationTransfert::where('envoi_user_id', $id)->count();
                $retrait_change_count = OperationTransfert::where('retrait_user_id', $id)->count();

                $achat_change = Operation::where('user_id', $id)->where('sens_operation', 'sortie')->sum('montant_operation');
                $vente_change = Operation::where('user_id', $id)->where('sens_operation', 'entree')->sum('montant_operation');
                $achat_change_count = Operation::where('user_id', $id)->where('sens_operation', 'sortie')->count();
                $vente_change_count = Operation::where('user_id', $id)->where('sens_operation', 'entree')->count();

                return view('caisse.rapport_caisse', compact(
                    'caisse',
                    'entree',
                    'sortie',
                    'entree_count',
                    'sortie_count',
                    'envoi_change',
                    'retrait_change',
                    'envoi_change_count',
                    'retrait_change_count',
                    'mouvement_caisses',
                    'agence',
                    'achat_change_count',
                    'vente_change_count',
                    'achat_change',
                    'vente_change',
                    'activite_count',
                    'decaissement'
                ));
            }

            return view('erreur.message');
        }
        return redirect('/')->with('danger', "Session expirée");
    }
}
