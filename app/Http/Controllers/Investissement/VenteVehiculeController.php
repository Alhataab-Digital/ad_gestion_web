<?php

namespace App\Http\Controllers\Investissement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Client;
use App\Models\Caisse;
use App\Models\Devise;
use App\Models\Investisseur;
use App\Models\TypeReglement;
use App\Models\Stock;
use App\Models\Operation;
use App\Models\OperationDevise;
use App\Models\OperationVehiculeVendu;
use App\Models\OperationVehiculeAchete;
use App\Models\Agence;
use App\Models\DeviseAgence;
use App\Models\MouvementCaisse;
use App\Models\ActiviteVehicule;
use Barryvdh\DomPDF\Facade\Pdf;

class VenteVehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            if (isset(Caisse::where('user_id', $id)->first(['id'])->id)) {
                $caisse_id = Caisse::where('user_id', $id)->first(['id'])->id;
                $caisse = Caisse::find($caisse_id);
                $agence_id = Auth::user()->agence_id;
                $agence = Agence::find($agence_id);
                $operations = OperationVehiculeVendu::where('user_id', $id)->where('client_id', '!=', Null)->where('etat', NULL)->where('sens_operation', 'entree')->orderBy('id', 'DESC')->get();
                return view('investissement.vente_vehicule', compact('caisse', 'operations', 'agence'));
            }
            return view('devise.message');
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function client(Request $request)
    {
        if (Auth::check()) {
            $data = $request->validate([
                'telephone' => 'required',
            ]);
            $data = $request->all();

            $tel = $data['telephone'];
            $agence_id = Auth::user()->agence_id;
            // if (isset(ActiviteVehicule::where('agence_id', $agence_id)->where('etat_activite', 'ouverte')->first(['id'])->id)) {
            /**
             * si le telephone existe afficher le client
             */
            if (isset(client::where('telephone', $tel)->first(['id'])->id)) {

                $agence_id = Auth::user()->agence_id;
                $societe_id = Auth::user()->societe_id;
                $client_id = client::where('telephone', $tel)->where('societe_id', $societe_id)->first(['id'])->id;
                $client = Client::find($client_id);
                $devise_agences = DeviseAgence::where('agence_id', $agence_id)->get();
                // $activite_ouverte = ActiviteVehicule::where('agence_id', $agence_id)->where('etat_activite', 'ouverte')->first();
                // $reglements = TypeReglement::all();
                return view('investissement.detail_vente_vehicule', compact(
                    'client',
                    'devise_agences',
                    // 'reglements',
                    //  'activite_ouverte'
                ));
                /**
                 * si non enregistre le client et affiche le formulaire
                 */
            } else {
                $societe_id = Auth::user()->societe_id;
                Client::create([
                    'telephone' => $data['telephone'],
                    'societe_id' => $societe_id,
                ]);
                /**
                 * si le telephone existe afficher le client
                 */
                $agence_id = Auth::user()->agence_id;
                $societe_id = Auth::user()->societe_id;
                $devise_agences = DeviseAgence::where('agence_id', $agence_id)->get();
                $client_id = client::where('telephone', $tel)->where('societe_id', $societe_id)->first(['id'])->id;
                $client = Client::find($client_id);
                // $devises = Devise::all();
                // $activite_ouverte = ActiviteVehicule::where('agence_id', $agence_id)->where('etat_activite', 'ouverte')->first();
                // $reglements = TypeReglement::all();
                return view('investissement.detail_vente_vehicule', compact(
                    'client',
                    'devise_agences',
                    // 'reglements',
                    // 'activite_ouverte'
                ));
                //return redirect('/vente_devise')->with('success','client ajouté avsec succès');
            }
            // } else {
            //     return redirect('/vente_vehicule')->with('danger', 'Vous n\'avez pas ouvert l\'activite');
            // }
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

        if (Auth::check()) {
            //   dd($activite_ouvert->taux_devise, $taux->taux, $prix_vente, $marge,$request->prix_revient);
            $operation_achat_id = OperationVehiculeAchete::where('chassis', $request->chassis)->first(['id'])->id;
            $operation_achat = OperationVehiculeAchete::find($operation_achat_id);
            $activite = ActiviteVehicule::where('agence_id', $operation_achat->caisse->agence_id)->where('etat_activite', 'ouverte')->first();

            if ($activite) {
                $activite_ouvert = ActiviteVehicule::find($activite->id);
                $agence_id = Auth::user()->agence_id;
                $taux = DeviseAgence::where('devise_id', $activite_ouvert->agence->devise_id)->where('agence_id', $agence_id)->first();
                $client = Client::find($request->c_id);

                $prix_vente = $request->prix_vente / $taux->taux;

                // dd($operation_achat->caisse->agence_id, $activite_ouvert->id);

                if ($request->prix_vente) {

                    if ($request->prix_vente > $request->prix_revient) {

                        $agence_id = Auth::user()->agence_id;
                        $id = Auth::user()->id;
                        $request->c_id;
                        $request->telephone;
                        $request->nom_client;
                        $request->id_vente;
                        $request->annee;
                        $request->marque;
                        $request->model;
                        $request->chassis;
                        $request->prix_achat;
                        $request->charge_usa;
                        $request->prix_revient;
                        $request->prix_vente;
                        $marge =  $prix_vente - $request->prix_revient;
                        // $request->activite_id;


                        $client = Client::find($request->c_id);



                        if (Caisse::where('user_id', $id)->first(['id'])->id) {

                            $caisse_id = Caisse::where('user_id', $id)->first(['id'])->id;
                            $caisse = Caisse::find($caisse_id);
                            $agence_id = Auth::user()->agence_id;
                            $agence = Agence::find($agence_id);

                            $compte_caisse = Caisse::where('user_id', $id)->first(['compte'])->compte;
                            $date_comptable = Caisse::where('user_id', $id)->first(['date_comptable'])->date_comptable;
                            $montant_operation =  $prix_vente;


                            if ($operation_achat->etat == NULL) {

                                $client->update([
                                    'nom_client' => $request->nom_client,
                                    'telephone' => $request->telephone,
                                    'adresse' => $request->adresse,
                                ]);

                                /**
                                 * enregistrement de l'operation
                                 */
                                $operation_achat->update([
                                    'etat' => 'vendu',
                                ]);


                                OperationVehiculeVendu::create([
                                    'prix_vente' => $request->prix_vente,
                                    'marge' => $marge,
                                    'taux_devise' => $taux->taux,
                                    'sens_operation' => 'entree',
                                    'client_id' => $request->c_id,
                                    'activite_id' => $activite_ouvert->id,
                                    'date_comptable' => $date_comptable,
                                    'operation_vehicule_achete_id' => $operation_achat_id,
                                    'caisse_id' => $caisse_id,
                                    'user_id' => $id,
                                ]);


                                return redirect('/vente_vehicule');
                            } else {
                                return redirect("/detail_activite_investissement/repartition")->with('danger', 'Activité déjà términée ');;
                            }
                        }
                    } else {

                        return redirect('/vente_vehicule')->with('danger', "Le montant de la vente est inferieur au montant de revient");
                    }
                } else {

                    return redirect('/vente_vehicule')->with('danger', "vous n'avez pas saisie le montant de la vente");
                }
            }
            // return redirect('/vente_vehicule')->with('danger', "Ce vehicule est achater à l'agence ". $operation_achat->caisse->agence->nom ." qui actuellement n'a pas d'activité ouvert");
            return redirect('/vente_vehicule')->with('danger', "Pas d'activité en cours. Veillez ouvrir une activité dans l'agence ". $operation_achat->caisse->agence->nom ." ");
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

    public function valider($id)
    {
        if (Auth::check()) {
            $id = decrypt($id);
            $user_id = Auth::user()->id;
            $operation_vente = OperationVehiculeVendu::find($id);
            $activite_ouvert = ActiviteVehicule::find($operation_vente->activite_id);
            $operation_achat = OperationVehiculeAchete::find($operation_vente->operation_vehicule_achete_id);

            $marge = $operation_vente->marge;
            $prix_vente = round($operation_vente->prix_vente / $operation_vente->taux_devise);
            if (Caisse::where('user_id', $user_id)->first(['id'])->id) {

                $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
                $caisse = Caisse::find($caisse_id);
                $agence_id = Auth::user()->agence_id;
                $agence = Agence::find($agence_id);

                $compte_caisse = Caisse::where('user_id', $user_id)->first(['compte'])->compte;
                $date_comptable = Caisse::where('user_id', $user_id)->first(['date_comptable'])->date_comptable;
                $montant_operation = $operation_vente->prix_vente;

                // dd($marge,$montant_operation,$prix_vente, $operation_vente->prix_vente,$operation_achat->prix_revient);
                if ($operation_vente->etat == NULL) {

                    $activites = ActiviteVehicule::where('id', $operation_vente->activite_id)->get();

                    foreach ($activites as $activite) {

                        $vente = $activite->montant_vente + $prix_vente;
                        $depense = $activite->total_depense + $operation_achat->prix_revient;
                        $benefice = $activite->montant_benefice + $marge;

                        $activite_ouvert->update([
                            'montant_vente' => $vente,
                            'total_depense' => $depense,
                            'montant_benefice' => $benefice,
                        ]);
                    }


                    /**
                     * enregistrement de l'operation
                     */
                    $operation_vente->update([
                        'etat' => 'paye',
                    ]);



                    /**
                     * mise a jour de la caisse
                     */

                    $compte = ($compte_caisse) + ($montant_operation);

                    $caisse = Caisse::find($caisse_id);

                    $user_id = Auth::user()->id;

                    MouvementCaisse::create([
                        'caisse_id' => $caisse->id,
                        'user_id' => $id,
                        'description' => 'Vente vehicule ' . $operation_achat->chassis,
                        'entree' => $montant_operation,
                        'solde' => $compte,
                        'date_comptable' => $date_comptable,

                    ]);

                    $caisse->update([
                        'compte' => $compte,
                    ]);

                    return redirect('/vente_vehicule');
                } else {
                    return redirect("/detail_activite_investissement/repartition")->with('danger', 'Activité déjà términée ');;
                }
            }
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function annuler($id)
    {
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        if (Auth::check()) {
            $id = decrypt($id);
            $operation = OperationVehiculeVendu::find($id);
            return view('investissement.vente_vehicule_edit', compact('operation'));
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
            $operation_vente = OperationVehiculeVendu::find($id);
            $operation_achat = OperationVehiculeAchete::Where('id', $operation_vente->operation_vehicule_achete_id)->first();

            $marge = ($request->prix_vente / $operation_vente->taux_devise) - $operation_achat->prix_revient;
            //     dd( $marge

            //     , $request->prix_vente
            // );
            $operation_vente->update(
                [
                    'marge' => $marge,
                    'prix_vente' => $request->prix_vente,
                ]
            );
            return redirect('/vente_vehicule');
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function chassis(Request $request)
    {
        if (Auth::check()) {
            $societe_id = Auth::user()->societe_id;
            $agence_id = Auth::user()->agence_id;

            $data['chassis'] = OperationVehiculeAchete::where('chassis', $request->chassis)->where('etat', null)->get();
            return response()->json($data);
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
}
