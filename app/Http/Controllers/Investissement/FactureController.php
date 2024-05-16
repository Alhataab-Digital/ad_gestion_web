<?php

namespace App\Http\Controllers\Investissement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Investissement\Devis;
use App\Models\Investissement\DetailDevis;
use App\Models\Investissement\Facture;
use App\Models\Investissement\DetailFacture;
use App\Models\Investissement\EntrepotStock;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $agence_id = Auth::user()->agence_id;
            $factures = Facture::orderBy('updated_at', 'DESC')->where('agence_id', $agence_id)->get();
            $factures_nvs = Facture::where('etat', NULL)->where('agence_id', $agence_id)->orderBy('id', 'DESC')->get();
            $factures_imps = Facture::where('etat', 'valider')->where('agence_id', $agence_id)->orderBy('id', 'DESC')->get();
            $factures_ech = Facture::where('etat', 'echeance')->where('agence_id', $agence_id)->orderBy('id', 'DESC')->get();
            $factures_pays = Facture::where('etat', 'terminer')->where('agence_id', $agence_id)->orderBy('id', 'DESC')->get();
            $factures_anns = Facture::where('etat', 'annuler')->where('agence_id', $agence_id)->orderBy('id', 'DESC')->get();
            return view('investissement.facture', compact('factures', 'factures_nvs', 'factures_imps', 'factures_ech', 'factures_pays', 'factures_anns'));
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

            $facture = Facture::where('devis_id', $request->devis_id)->first();
            if (isset($facture)) {

                $facture = Facture::where('devis_id', $request->devis_id)->latest('id')->first();

                $devis = Devis::find($request->devis_id);

                $devis->update([
                    'activite_id' => $request->activite,
                    'etat' => 'valider',
                ]);

                return redirect('facture/' . encrypt($facture->id) . '/edit');
            } else {
                $devis = Devis::find($request->devis_id);
                $id = Auth::user()->id;
                $agence_id = Auth::user()->agence_id;

                Facture::create([
                    'devis_id'  => $request->devis_id,
                    'activite_id'  => $request->activite,
                    'client_id'  => $request->client_id,
                    'montant_total' => $devis->montant_total,
                    'user_id'      => $id,
                    'agence_id'    => $agence_id,
                ]);

                $devis = Devis::find($request->devis_id);

                $devis->update([
                    'activite_id' => $request->activite,
                    'etat' => 'valider',
                ]);

                $facture = Facture::where('user_id', $id)->where('agence_id', $agence_id)->latest('id')->first();

                return redirect('facture/' . encrypt($facture->id) . '/edit');
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
        if (Auth::check()) {
            $id = decrypt($id);
            $facture = Facture::find($id);
            if ($facture->entrepot_id == NULL) {
                $entrepots = EntrepotStock::where("agence_id", $facture->agence_id)->get();
                $devis = Devis::where('id', $facture->devis_id)->first();
                $detail_deviss = DetailDevis::where('devis_id', $facture->devis_id)->get();
                $detail_factures = DetailFacture::where('facture_id', $facture->id)->get();
                $total_ht = DetailFacture::where('facture_id', $facture->id)->selectRaw('sum(quantite_vendue*prix_unitaire_vendu) as total')->first('total');
                return view('investissement.facture_encours', compact('devis', 'detail_deviss', 'total_ht', 'facture', 'entrepots', 'detail_factures'));
            }

            $devis = Devis::where('id', $facture->devis_id)->first();
            $detail_deviss = DetailDevis::where('devis_id', $facture->devis_id)->get();
            $detail_factures = DetailFacture::where('facture_id', $facture->id)->get();
            $entrepots = EntrepotStock::where('id', '!=', $facture->entrepot_id)->where("agence_id", $facture->agence_id)->get();
            $total_ht = DetailFacture::where('facture_id', $facture->id)->selectRaw('sum(quantite_vendue*prix_unitaire_vendu) as total')->first('total');
            return view('investissement.facture_encours', compact('devis', 'detail_deviss', 'total_ht', 'facture', 'entrepots', 'detail_factures'));
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Auth::check()) {
            // dd($request->client_id);
            $id = decrypt($id);
            $facture = Facture::find($id);
            // dd($facture,$request->montant_ht);
            if ($request->montant_ht == NULL) {
                return back();
            }
            $facture->update([
                'montant_total' => $request->montant_ht,
                'client_id' => $request->client_id,
                'etat' => 'valider',
            ]);

            $devis = devis::find($facture->devis_id);
            $devis->update([
                'etat' => 'Facture',
            ]);

            return redirect('detail_facture/' . encrypt($id) . '/show');
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

    public function select_produit(Request $request)
    {
        if (Auth::check()) {
            $agence_id = Auth::user()->agence_id;

            $data['produits'] = DetailDevis::where('devis_id', $request->devis_id)->where('produit_id', $request->id)->get();

            return response()->json($data);
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function print()
    {
    }
}
