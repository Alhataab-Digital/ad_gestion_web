<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Caisse;
use App\Models\Societe;
use App\Models\Devise;
use App\Models\TypeReglement;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\Commande;
use App\Models\DetailCommande;
use App\Models\Livrer;
use App\Models\DetailLivrer;
use App\Models\EntrepotStock;
use App\Models\StockProduit;
use App\Models\StockProduitActivite;
use App\Models\Investisseur;
use App\Models\TypeActiviteInvestissement;
use App\Models\MouvementCaisse;
use App\Models\ActiviteInvestissement;
use App\Models\SecteurDepense;
use App\Models\DetailActiviteInvestissement;
use App\Models\BeneficeActivite;
use App\Models\RepartitionDividende;
use App\Models\OperationInvestisseur;
use App\Models\OperationDepenseActivite;

class DetailLivrerController extends Controller
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
        if (Auth::check()) {
            //  dd($request->activite);
            $livraison = Livrer::find($request->livraison_id);
            $user_id = Auth::user()->id;
            $id = Auth::user()->id;
            $agence_id = Auth::user()->agence_id;
            $societe_id = Auth::user()->societe_id;
            $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;

            if ($livraison->etat == 'valider') {
                return back()->with('danger', 'La commande deja valider');
            } else {
                if (Caisse::where('user_id', $user_id)->first(['id'])->id) {
                    $compte_caisse = Caisse::where('user_id', $user_id)->first(['compte'])->compte;
                    $compte_dividende_societe = Societe::where('id', $societe_id)->first(['compte_societe'])->compte_societe;
                    $compte_securite_societe = Societe::where('id', $societe_id)->first(['compte_securite'])->compte_securite;
                    $date_comptable = Caisse::where('user_id', $user_id)->first(['date_comptable'])->date_comptable;

                    // if($compte_caisse < $request->montant_ht)
                    // {
                    //     return back()->with('danger','La montant caisse est insuffisant D4aaa');
                    // }
                    // else
                    // {

                    /**
                     * mise à jour du stock produit
                     */

                    if (isset(StockProduit::where('produit_id', $request->produit_id)->where('entrepot_id', $request->entrepot)->where('agence_id', $agence_id)->first(['produit_id'])->produit_id)) {
                        for ($i = 0; $i < count($request->produit_id); $i++) {
                            $stocks = StockProduit::where('produit_id', $request->produit_id[$i])->where('entrepot_id', $request->entrepot)->where('agence_id', $agence_id)->get();

                            foreach ($stocks as  $stock) {

                                $data = [
                                    'quantite_en_stock'     => $request->qte[$i] + $stock->quantite_en_stock,
                                ];
                                StockProduit::where('produit_id', $request->produit_id[$i])->where('entrepot_id', $request->entrepot)->where('agence_id', $agence_id)->update($data);
                            }
                        }
                    } else {
                        for ($i = 0; $i < count($request->produit_id); $i++) {
                            $data = [
                                'produit_id'            => $request->produit_id[$i],
                                'entrepot_id'           => $request->entrepot,
                                'agence_id'             => $agence_id,
                                'quantite_en_stock'     => $request->qte[$i],
                            ];
                            StockProduit::create($data);
                        }
                    }

                    /**
                     * mise à jour du stock produit activite
                     */
                    if (isset(StockProduitActivite::where('produit_id', $request->produit_id)->where('activite_id', $request->activite)->where('agence_id', $agence_id)->first(['produit_id'])->produit_id)) {
                        for ($i = 0; $i < count($request->produit_id); $i++) {
                            $stocks = StockProduitActivite::where('produit_id', $request->produit_id[$i])->where('activite_id', $request->activite)->where('agence_id', $agence_id)->get();

                            foreach ($stocks as  $stock) {

                                $data = [
                                    'quantite_en_stock'     => $request->qte[$i] + $stock->quantite_en_stock,
                                ];
                                StockProduitActivite::where('produit_id', $request->produit_id[$i])->where('activite_id', $request->activite)->where('agence_id', $agence_id)->update($data);
                            }
                        }
                    } else {
                        for ($i = 0; $i < count($request->produit_id); $i++) {
                            $data = [
                                'produit_id'            => $request->produit_id[$i],
                                'activite_id'           => $request->activite,
                                'agence_id'             => $agence_id,
                                'quantite_en_stock'     => $request->qte[$i],
                            ];
                            StockProduitActivite::create($data);
                        }
                    }

                    for ($i = 0; $i < count($request->produit_id); $i++) {
                        /**
                         * ajout des produit livrer
                         */
                        $data_livraison = [
                            'livrer_id'             => $request->livraison_id,
                            'produit_id'            => $request->produit_id[$i],
                            'quantite_livree'       => $request->qte[$i],
                            'prix_unitaire_livre'   => $request->prix[$i],
                        ];

                        DetailLivrer::create($data_livraison);
                    }
                    /**
                     * mise a jour Livraison
                     */
                    $livraison = Livrer::find($request->livraison_id);
                    $livraison->update([
                        'entrepot_id' => $request->entrepot,
                        'activite_id' => $request->activite,
                        'montant_total' => $request->montant_ht,
                        'etat' => 'valider',
                    ]);

                    /**
                     * mise a jour commande
                     */
                    $commande = Commande::find($request->commande_id);
                    $commande->update([
                        'etat' => 'livrer',
                    ]);
                    return redirect('livrer/' . encrypt($request->livraison_id) . '/show');
                    // }

                }
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
}
