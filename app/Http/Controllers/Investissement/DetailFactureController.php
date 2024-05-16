<?php

namespace App\Http\Controllers\Investissement;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Investissement\Facture;
use App\Models\Investissement\DetailFacture;
use App\Models\Investissement\EntrepotStock;
use App\Models\StockProduit;

class DetailFactureController extends Controller
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

        // dd($request->activite);
        if (Auth::check()) {
            $id = Auth::user()->id;
            $agence_id = Auth::user()->agence_id;
            $facture = Facture::where('devis_id', $request->devis_id)->first();

            if (isset(StockProduit::where('produit_id', $request->produit_id)->where('entrepot_id', $request->entrepot)->where('agence_id', $agence_id)->first()->id)) {
                $stock = StockProduit::where('produit_id', $request->produit_id)->where('entrepot_id', $request->entrepot)->where('agence_id', $agence_id)->first();
                if ($stock->quantite_en_stock >= $request->qte) {
                    if (isset(DetailFacture::where('facture_id', $request->facture_id)->where('produit_id', $request->produit_id)->first()->id)) {
                        return back()->with('danger', "produit déjà enregisté");
                    }

                    $data_facture = [
                        'facture_id'            => $request->facture_id,
                        'produit_id'            => $request->produit_id,
                        'quantite_vendue'       => $request->qte,
                        'prix_unitaire_vendu'   => $request->prix,
                    ];
                    DetailFacture::create($data_facture);

                    $stock->update([
                        'quantite_en_stock' => $stock->quantite_en_stock - $request->qte,
                    ]);

                    return back();
                }
                return back()->with('danger', "La quantité stock est insuffisante");
            }
            return back()->with('danger', "Vous n'avez pas de produit dans l'entrepot");;

            //  $facture=Facture::find($request->facture_id);
            //  $facture->update([
            //      'entrepot_id'=>$request->entrepot,
            //      'montant_total'=>$request->montant_ht,
            //      'etat' =>'valider',
            //  ]);
            /**
             * mise a jour Livraison
             */


            /**
             * mise a jour commande
             */
            //         $devis=Devis::find($request->devis_id);
            //         $devis->update([
            //             'etat' =>'facturer',
            //         ]);
            //     return redirect('facture/'.$request->facture_id.'/show');
            // }else{
            //     dd('erreur');
            // }
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Auth::check()) {
            $id = decrypt($id);
            $facture = Facture::find($id);
            $detail_factures = DetailFacture::where('facture_id', $facture->id)->get();
            $total_ht = DetailFacture::where('facture_id', $facture->id)->selectRaw('sum(quantite_vendue*prix_unitaire_vendu) as total')->first('total');
            return view('investissement.facture_show', compact('facture', 'detail_factures', 'total_ht'));
        }
        return redirect('/')->with('danger', "Session expirée");
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
        if (Auth::check()) {
            $id = decrypt($id);
            $produit = DetailFacture::find($id);
            // dd($produit);
            $stock = StockProduit::where('produit_id', $produit->produit_id)->first();

            // dd($produit, $stock);

            $stock->update([
                'quantite_en_stock' => $stock->quantite_en_stock + $produit->quantite_vendue,
            ]);


            $produit->delete();

            return back();
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function facture_entrepot(Request $request)
    {
        if (Auth::check()) {

            $agence_id = Auth::user()->agence_id;
            $facture_id = Facture::where('devis_id', $request->devis_id)->first();
            $facture = Facture::find($facture_id->id);
            $facture->update([
                'entrepot_id' => $request->id,
            ]);

            $data['entrepot'] = EntrepotStock::where('id', $request->id)->get();

            return response()->json($data);
        }
        return redirect('/')->with('danger', "Session expirée");
    }
}
