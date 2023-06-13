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

            if(isset(StockProduit::where('produit_id',$request->produit_id)->where('entrepot_id',$request->entrepot)->where('agence_id',$agence_id)->first(['produit_id'])->produit_id))
            {
                for( $i=0; $i<count($request->produit_id) ; $i++)
                {
                    $stocks=StockProduit::where('produit_id',$request->produit_id[$i])->where('entrepot_id',$request->entrepot)->where('agence_id',$agence_id)->get();

                    foreach( $stocks as  $stock)
                    {
                        $data=[
                            'quantite_en_stock'     =>$request->qte[$i]+$stock->quantite_en_stock,
                        ];
                        StockProduit::where('produit_id',$request->produit_id[$i])->where('entrepot_id',$request->entrepot)->where('agence_id',$agence_id)->update($data);
                    }
                }
            }else{

                for( $i=0; $i<count($request->produit_id) ; $i++)
                {
                    $data=[
                        'produit_id'            =>$request->produit_id[$i],
                        'entrepot_id'           =>$request->entrepot,
                        'agence_id'             =>$agence_id,
                        'quantite_en_stock'     =>$request->qte[$i],
                    ];
                    StockProduit::where('produit_id',$request->produit_id[$i])->where('entrepot_id',$request->entrepot)->where('agence_id',$agence_id)->create($data);
                }
            }

            for( $i=0; $i<count($request->produit_id) ; $i++)
            {
            /**
             * ajout des produit livrer
             */

            $data_livraison=[
                'livrer_id'             =>$request->livraison_id,
                'produit_id'            =>$request->produit_id[$i],
                'quantite_livree'       =>$request->qte[$i],
                'prix_unitaire_livre'   =>$request->prix[$i],
            ];
            DetailLivrer::create($data_livraison);
            }
            /**
             * mise a jour Livraison
             */
            $livraison=Livrer::find($request->livraison_id);
            $livraison->update([
                'entrepot_id'=>$request->entrepot,
                'montant_total'=>$request->montant_ht,
                'etat' =>'valider',
            ]);

            /**
             * mise a jour commande
             */
            $commande=Commande::find($request->commande_id);
            $commande->update([
                'etat' =>'livrer',
            ]);
            return redirect('livrer/'.$request->livraison_id.'/show');

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
