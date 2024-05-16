<?php

namespace App\Http\Controllers\Investissement;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\Produit;
use App\Models\Investissement\Devis;
use App\Models\Investissement\DetailDevis;
use App\Models\Investissement\StockProduitActivite;
use App\Models\Investissement\ActiviteInvestissement;

class DetailDevisController extends Controller
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
            $agence_id = Auth::user()->agence_id;

            // dd(
            // $request->devis_id,
            // $request->activite_id,
            // $request->produit,
            // $agence_id,
            // $request->qte,
            // $request->prix,);
            // dd(StockProduitActivite::where('produit_id',$request->produit)->where('activite_id',$request->activite_id)->where('agence_id',$agence_id)->first()->id);


            if (isset(StockProduitActivite::where('produit_id', $request->produit)->where('activite_id', $request->activite_id)->where('agence_id', $agence_id)->first()->id)) {
                $stock = StockProduitActivite::where('produit_id', $request->produit)->where('activite_id', $request->activite_id)->where('agence_id', $agence_id)->first();
                if ($stock->quantite_en_stock >= $request->qte) {
                    if (isset(DetailDevis::where('devis_id', $request->devis_id)->where('produit_id', $request->produit)->first(['id'])->id)) {
                        return back()->with('danger', "Produit deja enregistrer");
                    } else {
                        $data = [
                            'devis_id'              => $request->devis_id,
                            'produit_id'               => $request->produit,
                            'quantite_demandee'       => $request->qte,
                            'prix_unitaire_demande'  => $request->prix,
                        ];
                        DetailDevis::create($data);

                        $stock->update([
                            'quantite_en_stock' => $stock->quantite_en_stock - $request->qte,
                        ]);

                        return back();
                    }
                }
                return back()->with('danger', "La quantité stock est insuffisante");
            }
            return back()->with('danger', "Vous n'avez pas de produit dans l'entrepot");;





            // $devis=devis::find($request->devis_id);

            // $devis->update([
            //     'fournisseur_id' =>$request->fournisseur,
            //     'montant_total' =>$request->montant_ht,
            //     'etat' =>'en cours',
            // ]);
            // return back();
            // return redirect('detail_devis/'.$devis->id.'/show');



            //
            // dd($request->devis_id,$request->produit,
            // $request->qte,
            // $request->prix,$request->total,
            // $request->montant_ht,
            // $request->client);


            //     for($i=0;$i<count($request->produit); $i++)
            //     {

            //         $data=[
            //             'devis_id'              =>$request->devis_id,
            //             'produit_id'               =>$request->produit[$i],
            //             'quantite_demandee'       =>$request->qte[$i],
            //             'prix_unitaire_demande'  =>$request->prix[$i],
            //         ];
            //         Detaildevis::create($data);

            //     }

            //     $devis=Devis::find($request->devis_id);

            //     $devis->update([
            //         'client_id' =>$request->client,
            //         'montant_total' =>$request->montant_ht,
            //         'etat' =>'en cours',
            //     ]);
            //     return redirect('detail_devis/'.$devis->id.'/show');

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
            $devis = Devis::find($id);
            $agence_id = Auth::user()->agence_id;
            $detail_deviss = DetailDevis::where('devis_id', $devis->id)->get();
            $activite_investissements = ActiviteInvestissement::where("agence_id", $agence_id)->where('etat_activite', 'valider')->get();
            $activite_investissement = ActiviteInvestissement::find($devis->activite_id);
            $total_ht = DetailDevis::where('devis_id', $devis->id)->selectRaw('sum(quantite_demandee*prix_unitaire_demande) as total')->first('total');
            return view('investissement.devis_encours', compact('devis', 'detail_deviss', 'total_ht', 'activite_investissements', 'activite_investissement'));
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Auth::check()) {
            $id = decrypt($id);
            $devis = Devis::find($id);
            $agence_id = Auth::user()->agence_id;
            $produits = Produit::where('agence_id', $agence_id)->get();
            $clients = Client::all();
            $detail_deviss = DetailDevis::where('devis_id', $devis->id)->get();
            $total_ht = DetailDevis::where('devis_id', $devis->id)->selectRaw('sum(quantite_demandee*prix_unitaire_demande) as total')->first('total');
            return view('investissement.edit_devis', compact('produits', 'clients', 'devis', 'detail_deviss', 'total_ht'));
        }
        return redirect('/')->with('danger', "Session expirée");
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

            $produit = DetailDevis::find($id);
            $stock = StockProduitActivite::where('produit_id', $produit->produit_id)->first();

            // dd($produit, $stock);

            $stock->update([
                'quantite_en_stock' => $stock->quantite_en_stock + $produit->quantite_demandee,
            ]);

            $produit->delete();

            return back();
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function client_devis(Request $request)
    {
        if (Auth::check()) {
            $societe_id = Auth::user()->societe_id;
            $tel = $request->id;

            if (isset(Client::where('telephone', $tel)->where('societe_id', $societe_id)->first(['id'])->id)) {

                $agence_id = Auth::user()->agence_id;

                $id = Client::where('telephone', $tel)->where('societe_id', $societe_id)->first(['id'])->id;

                $data['client'] = Client::where('id', $id)->get();
                return response()->json($data);
            } else {

                Client::create([
                    'telephone' => $tel,
                    'societe_id' => $societe_id,
                ]);
                /**
                 * si le telephone existe afficher le client
                 */
                $id = Client::where('telephone', $tel)->where('societe_id', $societe_id)->first(['id'])->id;
                $data['client'] = Client::where('id', $id)->get();
                return response()->json($data);
            }
        }
        return redirect('/')->with('danger', "Session expirée");
    }
}
