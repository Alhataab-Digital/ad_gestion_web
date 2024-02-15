<?php

namespace App\Http\Controllers\Investissement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Caisse;
use App\Models\Societe;
use App\Models\Devise;
use App\Models\TypeReglement;
use App\Models\Investisseur;
use App\Models\OperationInvestisseur;
use App\Models\MouvementCaisse;
use Barryvdh\DomPDF\Facade\Pdf;

class VersementInvestisseurController extends Controller
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
                $operations = OperationInvestisseur::where('user_id', $id)->where('sens_operation', 'entree')->orderBy('id', 'DESC')->get();

                return view('investissement.versement', compact('operations', 'caisse'));
            }
            return view('investissement.message');
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
    public function store(Request $request, $id)
    {
        if (Auth::check()) {
            $id = decrypt($id);

            $investisseur = Investisseur::find($id);

            if (empty($request->montant)) {
                return redirect()->route('i_versement')->with('danger', "Veillez remplir le montant de l'operation");
            } else {
                if ($request->reglement == 0) {
                    return redirect()->route('i_versement')->with('danger', "Veillez remplir le mode reglement de l'operation");
                } else {


                    $user_id = Auth::user()->id;
                    if (Caisse::where('user_id', $user_id)->first(['id'])->id) {

                        $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
                        $compte_caisse = Caisse::where('user_id', $user_id)->first(['compte'])->compte;
                        $date_comptable = Caisse::where('user_id', $user_id)->first(['date_comptable'])->date_comptable;
                        $compte_investisseur = $investisseur->compte_investisseur;
                        $compte_investis = $investisseur->montant_investis;
                        $montant_versement = $request->montant;


                        $montant_investisseur = $compte_investisseur + $montant_versement;
                        $montant_investis = $compte_investis + $montant_versement;
                        $montant_caisse = $compte_caisse + $montant_versement;

                        // dd($montant_investisseur);
                        /**
                         * mise a jour du client
                         */
                        $investisseur->update([
                            'nom' => $request->nom,
                            'prenom' => $request->prenom,
                            'telephone' => $request->telephone,
                            'email' => $request->email,
                            'heritier' => $request->heritier,
                            'montant_investis' => $montant_investis,
                            'compte_investisseur' => $montant_investisseur,
                        ]);
                        /**
                         * enregistrement de l'operation
                         */
                        OperationInvestisseur::create([
                            'montant_operation' => $request->montant,
                            'solde' => $montant_investisseur,
                            'sens_operation' => 'entree',
                            'reglement_id' => $request->reglement,
                            'caisse_id' => $caisse_id,
                            'investisseur_id' => $id,
                            'user_id' => $user_id,
                            'date_comptable' => $date_comptable,
                            'valider' => 'oui',

                        ]);

                        /**
                         * mise a jour de la caisse
                         */

                        $compte = $compte_caisse + $request->montant;

                        $caisse = Caisse::find($caisse_id);

                        $user_id = Auth::user()->id;

                        MouvementCaisse::create([
                            'caisse_id' => $caisse->id,
                            'user_id' => $user_id,
                            'description' => 'Versement investisseur =>' . $request->nom . '/' . $request->telephone,
                            'entree' => $montant_versement,
                            'solde' => $compte,
                            'date_comptable' => $date_comptable

                        ]);

                        $caisse->update([
                            'compte' => $montant_caisse,
                        ]);
                        $id = Auth::user()->id;

                        $operation = OperationInvestisseur::where('user_id', $id)->latest('id')->first();
                        return redirect()->route('i_versement.show', encrypt($operation->id))->with('success', 'operation effectuee avec succès');
                    }
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
            $operation = OperationInvestisseur::find($id);
            return view('investissement.operation_versement_detail', compact('operation'));
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
        //
    }

    public function versement(Request $request)
    {
        /**
         * validation des champs de saisie
         */
        $data = $request->validate([
            'code' => 'required',
        ]);
        $id = $request->code;
        if (Auth::check()) {
            $investisseur = Investisseur::where('code', $id)->first();
            if ($investisseur == NULL) {
                return back()->with('danger', 'Code inexistant');
            } else {
                $code = $data['code'];

                if (Investisseur::where('code', $code)->first(['etat'])->etat == 0) {
                    return redirect('/i_versement')->with('danger', "votre compte n'est pas activer");
                } else {

                    $investisseur_id = Investisseur::where('code', $code)->first(['id'])->id;
                    $investisseur = Investisseur::find($investisseur_id);
                    $reglements = TypeReglement::all();
                    return view('investissement.operation_versement', compact('investisseur', 'reglements'));
                }
            }
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function print($id)
    {
        if (Auth::check()) {
            $id = decrypt($id);
            $operation = OperationInvestisseur::find($id);
            // return view('investissement.operation_versement_detail',compact('operation'));

            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('print.investissement.recu_versement_investisseur', compact('operation'));

            return $pdf->download('recu_versement.pdf');
        }
        return redirect('/')->with('danger', "Session expirée");
    }
}
