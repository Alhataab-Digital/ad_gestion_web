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

class DevisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $agence_id = Auth::user()->agence_id;
            $id = Auth::user()->id;
            $deviss = Devis::where('agence_id', $agence_id)->where('user_id', $id)->orderBy('id', 'DESC')->get();
            $deviss_nv = Devis::where('etat', NULL)->where('agence_id', $agence_id)->orderBy('id', 'DESC')->get();
            $deviss_cs = Devis::where('etat', 'en cours')->where('agence_id', $agence_id)->where('user_id', $id)->orderBy('id', 'DESC')->get();
            $deviss_vd = Devis::where('etat', 'valider')->where('agence_id', $agence_id)->where('user_id', $id)->orderBy('id', 'DESC')->get();
            $deviss_lv = Devis::where('etat', 'Facture')->where('agence_id', $agence_id)->orderBy('id', 'DESC')->get();
            $deviss_an = Devis::where('etat', 'annuler')->where('agence_id', $agence_id)->orderBy('id', 'DESC')->get();
            return view('investissement.devis', compact('deviss', 'deviss_nv', 'deviss_cs', 'deviss_vd', 'deviss_lv', 'deviss_an'));
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        if (Auth::check()) {
            $id = Auth::user()->id;
            $agence_id = Auth::user()->agence_id;
            Devis::create([
                'user_id' => $id,
                'agence_id' => $agence_id,
            ]);
            $devis = Devis::where('user_id', $id)->where('agence_id', $agence_id)->latest('id')->first();

            return redirect('devis/' . encrypt($devis->id) . '/edit');
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            if ($request->montant_ht && $request->nom_client && $request->adresse) {
                $client = Client::find($request->client_id);
                // dd($client);
                $devis = Devis::find($request->devis_id);

                $devis->update([
                    'client_id' => $request->client_id,
                    'montant_total' => $request->montant_ht,
                    'etat' => 'en cours',
                ]);

                $client->update([
                    'nom_client' => $request->nom_client,
                    'adresse' => $request->adresse,
                ]);
                return redirect('detail_devis/' . encrypt($devis->id) . '/show');
            }
            return back();
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
        if (Auth::check()) {
            $id = decrypt($id);
            $devis = Devis::find($id);
            $agence_id = Auth::user()->agence_id;
            $activite_investissements = ActiviteInvestissement::where("agence_id", $agence_id)->where('etat_activite', 'valider')->get();
            $produit_stocks = StockProduitActivite::where('agence_id', $agence_id)->where('activite_id', $devis->activite_id)->where('quantite_en_stock', '>', '0')->get();
            // $produits=Produit::where('agence_id',$agence_id)->get();
            $clients = Client::all();
            $detail_deviss = DetailDevis::where('devis_id', $devis->id)->get();
            $total_ht = DetailDevis::where('devis_id', $devis->id)->selectRaw('sum(quantite_demandee*prix_unitaire_demande) as total')->first('total');
            return view('investissement.nouveau_devis', compact(
                // 'produits',
                'clients',
                'devis',
                'produit_stocks',
                'detail_deviss',
                'total_ht',
                'activite_investissements'
            ));
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function activite_devis(Request $request, $id)
    {
        if (Auth::check()) {
            // dd($request->activite);
            $id = decrypt($id);
            $devis = Devis::find($id);
            $agence_id = Auth::user()->agence_id;
            $devis->update([
                'activite_id' => $request->activite,
            ]);

            return redirect('devis/' . encrypt($devis->id) . '/edit');
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
        //
    }

    public function select_produit(Request $request)
    {
        if (Auth::check()) {
            $agence_id = Auth::user()->agence_id;

            $data['produits'] = Produit::select('prix_unitaire_vente')
                ->where('id', $request->id)->get(['prix_unitaire_vente']);

            return response()->json($data);
        }
        return redirect('/')->with('danger', "Session expirée");
    }
}
