<?php

namespace App\Http\Controllers\Investissement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Caisse\Caisse;
use App\Models\TypeReglement;
use App\Models\Investissement\Investisseur;
use App\Models\Investissement\OperationDividende;
use Barryvdh\DomPDF\Facade\Pdf;

class RetraitDividendeController extends Controller
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
                $operations = OperationDividende::where('user_id', $id)->where('sens_operation', 'sortie')->where('valider', 'oui')->orderBy('id', 'DESC')->get();

                return view('investissement.retrait_dividende', compact('operations', 'caisse'));
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
                return redirect()->route('d_retrait')->with('danger', "Veillez remplir le montant de l'operation");
            } else {
                if ($request->reglement == 0) {
                    return redirect()->route('d_retrait')->with('danger', "Veillez remplir le mode reglement de l'operation");
                } else {


                    $user_id = Auth::user()->id;
                    if (Caisse::where('user_id', $user_id)->first(['id'])->id) {

                        $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
                        $compte_caisse = Caisse::where('user_id', $user_id)->first(['compte'])->compte;
                        $date_comptable = Caisse::where('user_id', $user_id)->first(['date_comptable'])->date_comptable;
                        $compte_dividende = $investisseur->compte_dividende;
                        $montant_retrait = $request->montant;

                        if ($compte_caisse < $montant_retrait) {
                            return redirect()->route('d_retrait')->with('danger', "Le montant caisse est insuffisant");
                        } else {

                            if ($compte_dividende < $montant_retrait) {
                                return redirect()->route('d_retrait')->with('danger', "Le montant investisseur est insuffisant");
                            } else {

                                $montant_investisseur = $compte_dividende - $montant_retrait;
                                $montant_caisse = $compte_caisse - $montant_retrait;

                                // dd($montant_investisseur);
                                /**
                                 * mise a jour du client
                                 */
                                // $investisseur->update([
                                //     'nom'=>$request->nom,
                                //     'prenom'=>$request->prenom,
                                //     'telephone'=>$request->telephone,
                                //     'email'=>$request->email,
                                //     'heritier'=>$request->heritier,
                                //     'compte_dividende'=>$montant_investisseur,
                                // ]);
                                /**
                                 * enregistrement de l'operation
                                 */
                                OperationDividende::create([
                                    'montant_operation' => $request->montant,
                                    'sens_operation' => 'sortie',
                                    'reglement_id' => $request->reglement,
                                    'caisse_id' => $caisse_id,
                                    'investisseur_id' => $id,
                                    'user_id' => $user_id,
                                    'date_comptable' => $date_comptable,

                                ]);

                                /**
                                 * mise a jour de la caisse
                                 */

                                // $compte=$compte_caisse - $request->montant;

                                // $caisse=Caisse::find($caisse_id);

                                // $user_id=Auth::user()->id;

                                // MouvementCaisse::create([
                                //     'caisse_id'=>$caisse->id,
                                //     'user_id'=>$user_id,
                                //     'description'=>'retrait dividende investisseur =>'.$request->nom.'/'.$request->telephone,
                                //     'sortie'=>$montant_retrait,
                                //     'solde'=>$compte,
                                //     'date_comptable'=>$date_comptable,

                                // ]);



                                // $caisse->update([
                                //     'compte'=>$montant_caisse,
                                // ]);
                                $user_id = Auth::user()->id;

                                $operation = OperationDividende::where('user_id', $user_id)->latest('id')->first();
                                return redirect()->route('d_retrait.show', encrypt($operation->id))->with('success', 'operation effectuee avec succès');
                            }
                        }
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
            $operation = OperationDividende::find($id);
            return view('investissement.operation_dividende_detail', compact('operation'));
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

    public function retrait(Request $request)
    {
        /**
         * validation des champs de saisie
         */
        $data = $request->validate([
            'code' => 'required',
        ]);

        $code = $data['code'];
        if (Auth::check()) {
            $investisseur = Investisseur::where('code', $code)->first();
            if ($investisseur == NULL) {
                return back()->with('danger', 'Code inexistant');
            } else {


                if (Investisseur::where('code', $code)->first(['etat'])->etat == 0) {
                    return redirect('/d_retrait')->with('danger', "votre compte n'est pas activer");
                } else {
                    $id = Auth::user()->id;
                    if (isset(Caisse::where('user_id', $id)->first(['id'])->id)) {
                        $caisse_id = Caisse::where('user_id', $id)->first(['id'])->id;
                        $caisse = Caisse::find($caisse_id);
                        $investisseur_id = Investisseur::where('code', $code)->first(['id'])->id;
                        $investisseur = Investisseur::find($investisseur_id);
                        $reglements = TypeReglement::all();

                        return view('investissement.operation_dividende', compact('investisseur', 'reglements', 'caisse'));
                    }
                    return view('investissement.message');
                }
            }
        }
        return redirect('/')->with('danger', "Session expirée");
    }

    public function print($id)
    {
        if (Auth::check()) {
            $id = decrypt($id);
            $operation = OperationDividende::find($id);
            // return view('investissement.operation_versement_detail',compact('operation'));

            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('print.investissement.recu_dividende', compact('operation'));

            return $pdf->download('recu_dividende.pdf');
        }
        return redirect('/')->with('danger', "Session expirée");
    }
}
