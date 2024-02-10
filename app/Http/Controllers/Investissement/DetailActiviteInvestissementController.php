<?php

namespace App\Http\Controllers\Investissement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Caisse;
use App\Models\MouvementCaisse;
use App\Models\Societe;
use App\Models\Devise;
use App\Models\Agence;
use App\Models\Investisseur;
use App\Models\Commande;
use App\Models\TypeActiviteInvestissement;
use App\Models\ActiviteInvestissement;
use App\Models\DetailActiviteInvestissement;
use App\Models\BeneficeActivite;
use App\Models\RepartitionDividende;
use App\Models\OperationInvestisseur;
use App\Models\SecteurDepense;
use App\Models\OperationDepenseActivite;
use App\Models\Livrer;
use App\Models\OperationReglementFacture;
use App\Models\ReglementFacture;
use App\Models\Devis;
use App\Models\Facture;
use App\Models\StockProduitActivite;

class DetailActiviteInvestissementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // dd($request->montant);
        // dd($request->benefice);
        // dd($request->dividende_e);
        // dd($request->dividende_i);
        //     dd(
        //     $request->montant_activite,
        //     $request->montant_investis,
        //     $request->montant_restant,
        //     $request->montant
        // );
        // dd($request->compte);
        // dd($request->investisseur_id);
        $id = Auth::user()->id;

        if (Caisse::where('user_id', $id)->first(['id'])->id) {

            $caisse_id = Caisse::where('user_id', $id)->first(['id'])->id;
            $caisse = Caisse::find($caisse_id);
            $agence_id = Auth::user()->agence_id;
            $agence = Agence::find($agence_id);


            $activite_investissement = ActiviteInvestissement::find($request->activite_id);
            $compte_caisse = Caisse::where('user_id', $id)->first(['compte'])->compte;
            $date_comptable = Caisse::where('user_id', $id)->first(['date_comptable'])->date_comptable;
            $montant_operation = $request->montant_activite;
            if ($activite_investissement->capital_activite < $montant_operation) {
                return redirect('activite_investissement/create',)->with('danger', 'Le montant prevus pour l\'activite est superieur au montant capital !');
            } else {

                if ($activite_investissement->etat_activite == 'en cours') {

                    $investisseur_id   = $request->investisseur_id;
                    $activite       = $request->activite_id;
                    $montant_investis  = $request->montant_investis;
                    $taux  = $request->taux;
                    $taux_devise = $request->taux_devise;
                    $montant_restant  = $request->montant_restant;
                    // dd($activite );
                    for ($i = 0; $i < count($investisseur_id); $i++) {

                        $data = [

                            'activite_investissement_id'   => $activite,
                            'investisseur_id'              => $investisseur_id[$i],
                            'montant_investis'             => $montant_investis[$i],
                            'taux'                         => $taux[$i],
                        ];

                        DetailActiviteInvestissement::create($data);
                    }

                    $activite_investissement->update([
                        'etat_activite' => 'valider',
                        'compte_activite' => ($activite_investissement->montant_decaisse - $activite_investissement->total_depense) + ($activite_investissement->total_recette),
                    ]);

                    foreach ($request->investisseur_id as $key => $items) {

                        $investisseur['id'] = $request->investisseur_id[$key];
                        $investisseur['compte_investisseur'] = round($request->montant_restant[$key] / $taux_devise);

                        Investisseur::where('id', $request->investisseur_id[$key])->update($investisseur);
                    }

                    /**
                     * mise a jour de la caisse
                     */

                    // $compte=($compte_caisse)-($montant_operation);

                    // $caisse=Caisse::find($caisse_id);

                    // $user_id=Auth::user()->id;

                    // MouvementCaisse::create([
                    //     'caisse_id'=>$caisse->id,
                    //     'user_id'=>$user_id,
                    //     'description'=>'Budget decaisser pour investissement',
                    //     'sortie'=>$montant_operation,
                    //     'solde'=>$compte,
                    //     'date_comptable'=>$date_comptable,

                    // ]);

                    // $caisse->update([
                    //     'compte'=>$compte,
                    // ]);


                    return redirect('/activite_investissement/valider');
                } else {
                    return redirect("/detail_activite_investissement/repartition")->with('danger', 'Activité déjà términée ');;
                }
            }
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
        $id = decrypt($id);
        $user_id = Auth::user()->id;
        $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
        $caisse = Caisse::find($caisse_id);
        $agence_id = Auth::user()->agence_id;
        $activite_investissement = ActiviteInvestissement::find($id);
        $agence = Agence::find($activite_investissement->agence_id);
        $devise = Devise::where('id', $agence->devise_id)->first();
        $detail_activite_investissements = DetailActiviteInvestissement::where('activite_investissement_id', $id)->get();

        $secteur_depenses = SecteurDepense::all();



        $inventaire_stocks = StockProduitActivite::where('activite_id', $id)->where('quantite_en_stock', '!=', '0')->get();
        $produit_stock = StockProduitActivite::where('activite_id', $id)->selectRaw('sum(quantite_en_stock) as total')->first();
        // dd($produit_stock->total);
        if (isset(Devis::where('activite_id', $id)->where('etat', 'Facture')->orWhere('etat', 'annuler')->first()->id)) {
            $devis = Devis::where('activite_id', $id)->where('etat', 'Facture')->orWhere('etat', 'annuler')->first()->id;
            $factures = Facture::where('activite_id', $id)->where('client_id', '!=', NULL)->get();
            $facture_montant_total = Facture::where('activite_id', $id)->where('client_id', '!=', NULL)->selectRaw('sum(montant_total) as total')->get();
            $facture_montant_regler = Facture::where('activite_id', $id)->where('client_id', '!=', NULL)->selectRaw('sum(montant_regle) as total')->get();

            $operation_depenses = OperationDepenseActivite::where('activite_investissement_id', $activite_investissement->id)->get();
            $commandes = Commande::where('activite_id', $activite_investissement->id)->get();
            $reglements = OperationReglementFacture::where('activite_id', $activite_investissement->id)->get();

            return view('investissement.detail_activite_investissement', compact(
                'activite_investissement',
                'produit_stock',
                'caisse',
                'detail_activite_investissements',
                'secteur_depenses',
                'operation_depenses',
                'devise',
                'commandes',
                'reglements',
                'facture_montant_total',
                'facture_montant_regler',
                'factures',
                'inventaire_stocks',
                'devis',
            ));
        }
        // $devis=Devis::where('activite_id',$id)->where('etat','Facture')->orWhere('etat','annuler')->first()->id;
        $factures = Facture::where('activite_id', $id)->where('client_id', '!=', NULL)->get();
        $facture_montant_total = Facture::where('activite_id', $id)->where('client_id', '!=', NULL)->selectRaw('sum(montant_total) as total')->get();
        $facture_montant_regler = Facture::where('activite_id', $id)->where('client_id', '!=', NULL)->selectRaw('sum(montant_regle) as total')->get();

        $operation_depenses = OperationDepenseActivite::where('activite_investissement_id', $activite_investissement->id)->get();
        $commandes = Commande::where('activite_id', $activite_investissement->id)->get();
        $reglements = OperationReglementFacture::where('activite_id', $activite_investissement->id)->get();

        return view('investissement.detail_activite_investissement', compact(
            'activite_investissement',
            'produit_stock',
            'caisse',
            'detail_activite_investissements',
            'secteur_depenses',
            'operation_depenses',
            'devise',
            'commandes',
            'reglements',
            'facture_montant_total',
            'facture_montant_regler',
            'factures',
            'inventaire_stocks',
            // 'devis',
        ));
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

    public function supprimer_commande($id)
    {
        $id = decrypt($id);
        dd($id);
    }
    public function supprimer_reglement($id)
    {
        $id = decrypt($id);
        // dd($id);

        // $facture=Facture::find($request->facture_id);
        // $client=Client::find($facture->client_id);
        // $reglements= TypeReglement::all();
        $operation = OperationReglementFacture::find($id);
        // dd($operation);
        $facture = Facture::find($operation->facture_id);

        $reglement_facture = ReglementFacture::find($operation->reglement_facture_id);
        $user_id = Auth::user()->id;
        // dd($reglement_facture);
        if (Caisse::where('user_id', $user_id)->first(['id'])->id) {
            $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
            $compte_caisse = Caisse::where('user_id', $user_id)->first(['compte'])->compte;
            $date_comptable = Caisse::where('user_id', $user_id)->first(['date_comptable'])->date_comptable;

            // $reste_a_payer=$facture->montant_total-$operation->montant_operation;
            // dd('le reste à payer est supperieur au montant saisie');
            $montant_regle = $facture->montant_regle - $operation->montant_operation;

            $montant_operation = $operation->montant_operation;
            $montant_caisse = $compte_caisse - $montant_operation;
            if ($compte_caisse < $montant_operation) {
                return back()->with('danger', 'le montant caisse est insuffisant');
            }
            // dd($montant_regle,$montant_operation);
            if ($montant_regle == 0) {
                $facture->update([
                    'etat' => 'valider',
                    'montant_regle' => $montant_regle,
                ]);

                $reglement_facture->update([
                    'montant_regle' => $montant_regle,
                ]);
                /**
                 * mise a jour activite investissement
                 */
                $activite_investissement = ActiviteInvestissement::find($facture->activite_id);
                $activite_investissement->update([
                    'compte_activite' => $activite_investissement->compte_activite - $montant_operation,
                    'total_recette' => $activite_investissement->total_recette - $montant_operation
                ]);
                /**
                 * mise a jour de la caisse
                 */

                $compte = $compte_caisse - $montant_operation;

                $caisse = Caisse::find($caisse_id);

                $user_id = Auth::user()->id;

                MouvementCaisse::create([
                    'caisse_id' => $caisse->id,
                    'user_id' => $user_id,
                    'description' => 'suppression reglement N°  =>' . $operation->id,
                    'sortie' => $montant_operation,
                    'solde' => $compte,
                    'date_comptable' => $date_comptable
                ]);

                $caisse->update([
                    'compte' => $compte,
                ]);

                // $id=Auth::user()->id;
                // $reglement_facture->delete();
                $operation->delete();

                return back();
            } elseif ($montant_regle > 0) {

                $facture->update([
                    'etat' => 'echeance',
                    'montant_regle' => $montant_regle,
                ]);
                $reglement_facture->update([
                    'montant_regle' => $montant_regle,
                ]);
                $activite_investissement = ActiviteInvestissement::find($facture->activite_id);

                $activite_investissement->update([
                    'compte_activite' => $activite_investissement->compte_activite - $montant_operation,
                    'total_recette' => $activite_investissement->total_recette - $montant_operation
                ]);
                /**
                 * mise a jour de la caisse
                 */
                $compte = $compte_caisse - $montant_operation;
                $caisse = Caisse::find($caisse_id);

                $user_id = Auth::user()->id;

                MouvementCaisse::create([
                    'caisse_id' => $caisse->id,
                    'user_id' => $user_id,
                    'description' => 'suppression reglement N°  =>' . $operation->id,
                    'sortie' => $montant_operation,
                    'solde' => $compte,
                    'date_comptable' => $date_comptable
                ]);

                $caisse->update([
                    'compte' => $compte,
                ]);

                // $reglement_facture->delete();
                $operation->delete();
                // $id=Auth::user()->id;
                return back();
            }
            return back()->with('danger', 'Erreur du montant reglé');
        } //si non le reste à payer est inferieur ou egale au montant saisie
    }
}
