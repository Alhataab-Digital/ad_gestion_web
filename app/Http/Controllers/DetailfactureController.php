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
use App\Models\Facture;
use App\Models\DetailFacture;
use App\Models\Devis;
use App\Models\EntrepotStock;
use App\Models\StockProduit;

class DetailfactureController extends Controller
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
        // dd(
        // $request->commande_id,
        // $request->livraison_id,
        // $request->entrepot,
        // $request->produit_id,
        // $request->qte,
        // $request->prix,$request->total,
        // $request->montant_ht,
        // $request->fournisseur,
        // count($request->produit));



        $id=Auth::user()->id;
        $agence_id=Auth::user()->agence_id;

        /**
         * mise à jour du stock produit
         */


                            $stocks=StockProduit::where('produit_id',$request->produit_id)->where('entrepot_id',$request->entrepot)->where('agence_id',$agence_id)->get();

                            foreach( $stocks as  $stock)
                            {
                                for( $i=0; $i<count($request->produit_id) ; $i++)
                                {
                                    // dd($stock->produit_id,$request->qte[$i],array($stock->quantite_en_stock));

                                    if($request->produit_id[$i]==$stock->produit_id && $request->qte[$i] <= $stock->quantite_en_stock){
                                        // dd('ok');
                                        for( $i=0; $i<count($request->produit_id) ; $i++)
                                        {
                                        $data=[
                                            'quantite_en_stock'     =>$stock->quantite_en_stock-$request->qte[$i],
                                        ];
                                        StockProduit::where('produit_id',$request->produit_id[$i])->where('entrepot_id',$request->entrepot)->where('agence_id',$agence_id)->update($data);

                                        }

                                        for( $i=0; $i<count($request->produit_id) ; $i++)
                                        {
                                            /**
                                             * ajout des produit facturer
                                             */

                                            $data_facture=[
                                                'facture_id'            =>$request->facture_id,
                                                'produit_id'            =>$request->produit_id[$i],
                                                'quantite_vendue'       =>$request->qte[$i],
                                                'prix_unitaire_vendu'   =>$request->prix[$i],
                                            ];
                                            DetailFacture::create($data_facture);
                                        }
                                            /**
                                             * mise a jour Livraison
                                             */
                                            $facture=Facture::find($request->facture_id);
                                            $facture->update([
                                                'entrepot_id'=>$request->entrepot,
                                                'montant_total'=>$request->montant_ht,
                                                'etat' =>'valider',
                                            ]);

                                            /**
                                             * mise a jour commande
                                             */
                                            $devis=Devis::find($request->devis_id);
                                            $devis->update([
                                                'etat' =>'facturer',
                                            ]);
                                        return redirect('facture/'.$request->facture_id.'/show');
                                    }else{
                                        dd('erreur');
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
