<?php

namespace App\Http\Controllers\Investissement;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Caisse\Caisse;
use App\Models\Societe;
use App\Models\Investissement\Commande;
use App\Models\Investissement\DetailCommande;
use App\Models\Investissement\Livrer;
use App\Models\Investissement\DetailLivrer;
use App\Models\Investissement\EntrepotStock;
use App\Models\Caisse\MouvementCaisse;
use App\Models\Investissement\ActiviteInvestissement;
use Barryvdh\DomPDF\Facade\Pdf;

class LivrerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $agence_id = Auth::user()->agence_id;
            $livraisons = Livrer::where('agence_id', $agence_id)->orderBy('id', 'DESC')->get();
            $livraisons_cs = Livrer::where('agence_id', $agence_id)->where('agence_id', $agence_id)->where('etat', Null)->orderBy('id', 'DESC')->get();
            $livraisons_lv = Livrer::where('agence_id', $agence_id)->where('etat', 'valider')->orderBy('id', 'DESC')->get();
            $livraisons_an = Livrer::where('agence_id', $agence_id)->where('etat', 'annuler')->orderBy('id', 'DESC')->get();
            return view('investissement.livraison', compact('livraisons', 'livraisons_cs', 'livraisons_lv', 'livraisons_an'));
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
        //
        // dd(
        // $request->activite,
        // $request->commande_id,
        // $request->produit,
        // $request->qte,
        // $request->prix ,
        // $request->total,
        // $request->montant_ht,
        // $request->fournisseur_id

        // );
        if (Auth::check()) {
            $commande = Commande::find($request->commande_id);
            // dd($commande);
            if (isset(Livrer::where('commande_id', $request->commande_id)->first(['id'])->id)) {

                return redirect('detail_commande/' . encrypt($request->commande_id) . '/show');
            } else {

                $user_id = Auth::user()->id;
                $id = Auth::user()->id;
                $agence_id = Auth::user()->agence_id;
                $societe_id = Auth::user()->societe_id;


                if ($commande->etat == 'valider') {
                    return back()->with('danger', 'La commande deja valider');
                } else {
                    if (isset(Caisse::where('user_id', $user_id)->first(['id'])->id)) {
                        $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
                        $compte_caisse = Caisse::where('user_id', $user_id)->first(['compte'])->compte;
                        $compte_dividende_societe = Societe::where('id', $societe_id)->first(['compte_societe'])->compte_societe;
                        $compte_securite_societe = Societe::where('id', $societe_id)->first(['compte_securite'])->compte_securite;
                        $date_comptable = Caisse::where('user_id', $user_id)->first(['date_comptable'])->date_comptable;

                        if ($compte_caisse < $request->montant_ht) {
                            return back()->with('danger', 'La montant caisse est insuffisant');
                        } else {

                            $activite_investissement = ActiviteInvestissement::find($request->activite);

                            if ($activite_investissement->compte_activite < $request->montant_ht) {
                                return back()->with('danger', "La montant de l'activite est insuffisant");
                            } else {
                                $activite_investissement->update([
                                    'compte_activite' => $activite_investissement->compte_activite - $request->montant_ht,
                                    'total_depense' => $activite_investissement->total_depense + $request->montant_ht,
                                ]);
                                /**
                                 * mise a jour de la caisse
                                 */
                                $montant_operation = $request->montant_ht;

                                $compte = $compte_caisse - $montant_operation;

                                $caisse = Caisse::find($caisse_id);

                                MouvementCaisse::create([
                                    'caisse_id' => $caisse->id,
                                    'user_id' => $user_id,
                                    'description' => 'Commende N° ' . $request->commande_id . ' Valider',
                                    'sortie' => $montant_operation,
                                    'solde' => $compte,
                                    'date_comptable' => $date_comptable,
                                ]);

                                $caisse->update([
                                    'compte' => $compte,
                                ]);


                                $id = Auth::user()->id;
                                $agence_id = Auth::user()->agence_id;
                                $request->commande_id;
                                $request->fournisseur_id;
                                Livrer::create([
                                    'commande_id'  => $request->commande_id,
                                    'fournisseur_id'  => $request->fournisseur_id,
                                    'user_id'      => $id,
                                    'agence_id'    => $agence_id,
                                ]);

                                $commande = Commande::find($request->commande_id);

                                $commande->update([
                                    'activite_id' => $request->activite,
                                    'etat' => 'Valider',
                                ]);

                                return redirect('detail_commande/' . encrypt($request->commande_id) . '/show');
                            }
                        }
                    }
                    return back()->with('danger', "Verifier votre caisse si c'est operationnel");
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
        if (Auth::check()) {
            $id = decrypt($id);
            $livraison = Livrer::find($id);
            $detail_livraisons = DetailLivrer::where('livrer_id', $id)->get();
            $total_ht = DetailLivrer::where('livrer_id', $id)->selectRaw('sum(quantite_livree*prix_unitaire_livre) as total')->first('total');

            return view('investissement.livraison_show', compact('livraison', 'detail_livraisons', 'total_ht'));
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

            $agence_id = Auth::user()->agence_id;
            if (isset(EntrepotStock::where("agence_id", $agence_id)->first(['id'])->id)) {
                // if(isset(ActiviteInvestissement::where("agence_id",$agence_id)->where('etat_activite','valider')->first(['id'])->id))
                // {
                $livraison = Livrer::find($id);
                $entrepots = EntrepotStock::where("agence_id", $agence_id)->get();
                // $activite_investissements=ActiviteInvestissement::where("agence_id",$agence_id)->where('etat_activite','valider')->get();
                $commande = Commande::where('id', $livraison->commande_id)->first();
                $detail_commandes = DetailCommande::where('commande_id', $livraison->commande_id)->get();
                $total_ht = DetailCommande::where('commande_id', $livraison->commande_id)->selectRaw('sum(quantite_commandee*prix_unitaire_commande) as total')->first('total');
                return view('investissement.livraison_encours', compact(
                    'commande',
                    'detail_commandes',
                    'total_ht',
                    'livraison',
                    'entrepots',
                    // 'activite_investissements'
                ));

                // }
                // return back()->with('danger',"Vous n'avez pas d'activité en cours");
            }
            return back()->with('danger', "Vous n'avez pas d'entrepot");
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

    public function print($id)
    {
        // dd('commande livrer');
        if (Auth::check()) {
            $id = decrypt($id);
            $commande = Commande::find($id);


            $agence_id = Auth::user()->agence_id;
            $livraison = Livrer::find($id);
            $detail_livraisons = DetailLivrer::where('livrer_id', $id)->get();
            $total_ht = DetailLivrer::where('livrer_id', $id)->selectRaw('sum(quantite_livree*prix_unitaire_livre) as total')->first('total');

            $societe=Societe::find(Auth::user()->societe_id);
            $path=public_path('images/logo/'.Auth::user()->societe->logo);

            $type=pathinfo($path,PATHINFO_EXTENSION);
            $data=file_get_contents($path);
            $logo='data:image/'.$type.';base64,'.base64_encode($data);

            $pdf = Pdf::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('print.investissement.reception_produit', compact('livraison', 'detail_livraisons', 'total_ht','societe','logo'));

            return $pdf->download('recu_reception_produit.pdf');
        }
        return redirect('/')->with('danger', "Session expirée");
    }
}
