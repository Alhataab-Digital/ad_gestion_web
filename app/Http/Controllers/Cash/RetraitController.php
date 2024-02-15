<?php

namespace App\Http\Controllers\Cash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Client;
use App\Models\Caisse;
use App\Models\Devise;
use App\Models\TypeReglement;
use App\Models\Stock;
use App\Models\OperationTransfert;
use App\Models\Agence;
use App\Models\DeviseAgence;
use App\Models\Region;
use App\Models\TypePiece;
use App\Models\MouvementCaisse;
use Barryvdh\DomPDF\Facade\Pdf;

class RetraitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $id = Auth::user()->id;
        if (isset(Caisse::where('user_id', $id)->first(['id'])->id)) {
            $date = date('Y-m-d');
            $caisse_id = Caisse::where('user_id', $id)->first(['id'])->id;
            $caisse = Caisse::find($caisse_id);
            $agence_id = Auth::user()->agence_id;
            $agence = Agence::find($agence_id);
            $operations = OperationTransfert::where('retrait_user_id', $id)->where('etat', 1)->where('date_retrait', $date)->get();
            $pieces = TypePiece::all();
            return view('transfert.retrait', compact('caisse', 'agence', 'operations', 'pieces'));
        }
        return view('devise.message');
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $operation = OperationTransfert::find($id);
        $agence_id = Auth::user()->agence_id;
        $agence = Agence::find($agence_id);
        $devise = DeviseAgence::where('agence_id', $agence_id)
            ->where('devise_id', $operation->devise_id)
            ->first(['devise_id', 'taux']);
        $pieces = TypePiece::all();
        return view('transfert.show_retrait', compact('operation', 'agence', 'devise', 'pieces'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $operation = OperationTransfert::find($id);
        $agence_id = Auth::user()->agence_id;
        $agence = Agence::find($agence_id);
        $devise = DeviseAgence::where('agence_id', $agence_id)
            ->where('devise_id', $operation->devise_id)
            ->first(['devise_id', 'taux']);
        $pieces = TypePiece::all();
        return view('transfert.edit_retrait', compact('operation', 'agence', 'devise', 'pieces'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $operation = OperationTransfert::find($id);

        $data = $request->validate([
            'type_piece' => 'required',
            'numero_piece' => 'required',
        ]);
        $data = $request->all();
        $user_id = Auth::user()->id;
        $agence_id = Auth::user()->agence_id;
        $agence = Agence::find($agence_id);
        $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;

        /**
         * si le frais d'envoi et inclus
         */
        if (OperationTransfert::where('id', $id)->where('etat', 0)->first(['id'])) {
            $montant_operation = $request->montant;

            if (Caisse::where('user_id', $user_id)->first(['compte'])->compte < $montant_operation) {

                return redirect()->route('retrait.edit', $id)->with('danger', 'Le montant de votre caisse est insuffisant ');
            } else {
                $date_retrait = Caisse::where('user_id', $user_id)->first(['date_comptable'])->date_comptable;
                /**
                 * execution de la mise a jour operation
                 */
                $operation->update([
                    'type_piece_id' => $data['type_piece'],
                    'numero_piece' => $data['numero_piece'],
                    'taux_echange' => $request->taux,
                    'retrait_user_id' => $user_id,
                    'date_retrait' => $date_retrait,
                    'etat' => 1,
                ]);

                /**
                 * execution de la mise a jour caisse
                 */

                $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
                $compte_caisse = Caisse::where('user_id', $user_id)->first(['compte'])->compte;

                $compte = $compte_caisse - $montant_operation;

                $caisse = Caisse::find($caisse_id);
                /**
                 * mise a jour dU mouvement caisse
                 */
                $user_id = Auth::user()->id;
                MouvementCaisse::create([
                    'caisse_id' => $caisse->id,
                    'user_id' => $user_id,
                    'description' => 'Retrait change',
                    'sortie' => $montant_operation,
                    'solde' => $compte,
                    'date_comptable' => $date_retrait,

                ]);

                $caisse->update([
                    'compte' => $compte,
                ]);

                return redirect()->route('retrait.show', $id)->with('success', 'Opération effectuée avec succes ');
            }
        } else {
            return redirect()->route('retrait.show', $id)->with('success', 'Opération effectuée avec succes ');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function code_envoi(Request $request)
    {
        $data = $request->validate([
            'code_envoi' => 'required',
        ]);
        $data = $request->all();
        $id = Auth::user()->id;
        $agence_id = Auth::user()->agence_id;
        $agence = Agence::find($agence_id);



        $code_envoi = $data['code_envoi'];
        /**
         * si la code existe et l'etat est zero
         */
        if (isset(OperationTransfert::where('code_envoi', $code_envoi)->where('etat', 0)->first(['id'])->id)) {

            /**
             * si le retrait est effectuer par l'agent qui à envoyer
             */
            if (isset(OperationTransfert::where('code_envoi', $code_envoi)->where('envoi_user_id', $id)->where('etat', 0)->first(['id'])->id)) {
                return redirect('/retrait')->with('danger', ' vous ne pouvez pas retirer une opération effectuée par vous-même ');
            } else {

                /**
                 * si le retrait est effectuer dans la region de desination
                 */
                if (isset(OperationTransfert::where('code_envoi', $code_envoi)->where('region_id', $agence->region_id)->where('etat', 0)->first(['id'])->id)) {

                    $devise_operation = OperationTransfert::where('code_envoi', $code_envoi)->where('region_id', $agence->region_id)->where('etat', 0)->first(['id', 'devise_id', 'montant']);
                    /**
                     * si la devise d'echange exist  dans l'agence
                     */
                    if (DeviseAgence::where('agence_id', $agence_id)->where('devise_id', $devise_operation->devise_id)->first(['devise_id', 'taux'])) {

                        $devise = DeviseAgence::where('agence_id', $agence_id)->where('devise_id', $devise_operation->devise_id)->first(['devise_id', 'taux']);

                        $operation = OperationTransfert::where('code_envoi', $code_envoi)->where('region_id', $agence->region_id)->where('devise_id', $devise->devise_id)->where('etat', 0)->first(['id'])->id;
                        return redirect()->route('retrait.edit', $operation);
                    } else {

                        return redirect('/retrait')->with('danger', ' La devise est inexistante');
                    }
                } else {

                    return redirect('/retrait')->with('danger', ' Opération non destinée à votre région');
                }
            }
        } else {
            return redirect('/retrait')->with('danger', ' Aucune opération trouvée');
        }
    }

    public function print($id)
    {
        $operation = OperationTransfert::find($id);
        $agence_id = Auth::user()->agence_id;
        $agence = Agence::find($agence_id);
        $devise = DeviseAgence::where('agence_id', $agence_id)
            ->where('devise_id', $operation->devise_id)
            ->first(['devise_id', 'taux']);
        $pieces = TypePiece::all();
        // return view('transfert.show_retrait', compact('operation','agence','devise','pieces'));
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            ->loadView('print.recu_retrait', compact('operation', 'agence', 'devise', 'pieces'));

        return $pdf->download('recu_retrait_change.pdf');
    }
}
