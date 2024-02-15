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
use App\Models\Operation;
use App\Models\OperationDevise;
use App\Models\Agence;
use App\Models\DeviseAgence;
use App\Models\MouvementCaisse;
use Barryvdh\DomPDF\Facade\Pdf;

class AchatDeviseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
        if (isset(Caisse::where('user_id', $id)->first(['id'])->id)) {
            $caisse_id = Caisse::where('user_id', $id)->first(['id'])->id;
            $caisse = Caisse::find($caisse_id);
            $agence_id = Auth::user()->agence_id;
            $agence = Agence::find($agence_id);
            $operations = OperationDevise::where('user_id', $id)->where('client_id', '!=', Null)->where('sens_operation', 'sortie')->get();
            return view('devise.achat_devise', compact('caisse', 'operations', 'agence'));
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

        /**
         * selection du client
         */

        $client = Client::find($request->f_id);

        $user_id = Auth::user()->id;
        if (Caisse::where('user_id', $user_id)->first(['id'])->id) {

            $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
            $montant_operation = $request->montant * $request->taux;
            if (Caisse::where('user_id', $user_id)->first(['compte'])->compte < $montant_operation) {
                $compte_caisse = Caisse::where('user_id', $user_id)->first(['compte'])->compte;

                return redirect('/achat_devise')->with('danger', 'Le montant de votre caisse est insuffisant ');
            } else {
                $compte_caisse = Caisse::where('user_id', $user_id)->first(['compte'])->compte;
                $date_comptable = Caisse::where('user_id', $user_id)->first(['date_comptable'])->date_comptable;
                /**
                 * mise a jour du client
                 */
                $client->update([
                    'nom_client' => $request->nom_client,
                    'telephone' => $request->telephone,
                    'adresse' => $request->adresse,
                ]);
                /**
                 * enregistrement de l'operation
                 */
                OperationDevise::create([
                    'montant_operation' => $montant_operation,
                    'sens_operation' => 'sortie',
                    'client_id' => $request->f_id,
                    'devise_id' => $request->devise,
                    'taux' => $request->taux,
                    'reglement_id' => $request->reglement,
                    'date_comptable' => $date_comptable,
                    'caisse_id' => $caisse_id,
                    'user_id' => $user_id,
                ]);



                $compte = $compte_caisse - $montant_operation;

                $caisse = Caisse::find($caisse_id);

                /**
                 * mise a jour du moouvement caisse
                 */
                $user_id = Auth::user()->id;
                MouvementCaisse::create([
                    'caisse_id' => $caisse->id,
                    'user_id' => $user_id,
                    'description' => 'Achat change',
                    'sortie' => $montant_operation,
                    'solde' => $compte,
                    'date_comptable' => $date_comptable,

                ]);
                /**
                 * mise a jour de la caisse
                 */
                $caisse->update([
                    'compte' => $compte,
                ]);
                /**
                 * verification de la devise
                 */

                if (isset(Stock::where('caisse_id', $caisse_id)->where('devise_id', $request->devise)->first(['id'])->id)) {

                    $stock = Stock::where('caisse_id', $caisse_id)->where('devise_id', $request->devise)->first(['id', 'montant']);
                    /**
                     * montant du stock
                     */
                    $montant_stock = $stock->montant;
                    /**
                     * montant saisie
                     */
                    $montant = $request->montant;
                    /**
                     * montant total
                     */
                    $montant_total = $montant_stock + $montant;

                    /**
                     * mise a jour du stock
                     */
                    $stock->update([
                        'montant' => $montant_total,
                        'devise_id' => $request->devise,
                        'caisse_id' => $caisse_id,
                    ]);

                    $id = Auth::user()->id;
                    $operation = OperationDevise::where('user_id', $id)->latest('id')->first();
                    return redirect()->route('achat_devise.show', $operation)->with('success', 'operation effectuee avec succès');
                } else {

                    /**
                     * enregistrement de l'operation
                     */
                    Stock::create([
                        'montant' => $request->montant,
                        'devise_id' => $request->devise,
                        'caisse_id' => $caisse_id,
                    ]);
                    $id = Auth::user()->id;
                    $operation = OperationDevise::where('user_id', $id)->latest('id')->first();
                    return redirect()->route('achat_devise.show', $operation)->with('success', 'operation effectuee avec succès');
                }
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $agence_id = Auth::user()->agence_id;
        $operation = OperationDevise::find($id);
        $agence = Agence::find($agence_id);
        return view('devise.show_achat_devise', compact('operation', 'agence'));
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

    public function client(Request $request)
    {

        $data = $request->validate([
            'telephone' => 'required',
        ]);
        $data = $request->all();

        $tel = $data['telephone'];
        /**
         * si le telephone existe afficher le client
         */
        if (isset(Client::where('telephone', $tel)->first(['id'])->id)) {

            $agence_id = Auth::user()->agence_id;
            $client_id = Client::where('telephone', $tel)->first(['id'])->id;
            $client = client::find($client_id);
            $devise_agences = DeviseAgence::where('agence_id', $agence_id)->get();
            $reglements = TypeReglement::all();
            return view('devise.detail_achat_devise', compact('client', 'devise_agences', 'reglements'));
            /**
             * si non enregistre le client et affiche le formulaire
             */
        } else {

            client::create([
                'telephone' => $data['telephone'],
            ]);
            /**
             * si le telephone existe afficher le client
             */
            $agence_id = Auth::user()->agence_id;
            $devise_agences = DeviseAgence::where('agence_id', $agence_id)->get();
            $client_id = Client::where('telephone', $tel)->first(['id'])->id;
            $client = client::find($client_id);
            $devises = Devise::all();
            $reglements = TypeReglement::all();
            return view('devise.detail_achat_devise', compact('client', 'devise_agences', 'reglements'));
            //return redirect('/achat_devise')->with('success','client ajouté avsec succès');
        }
    }
    public function taux_devise(Request $request)
    {
        if (Auth::check()) {
            $societe_id = Auth::user()->societe_id;
            $agence_id = Auth::user()->agence_id;

            $data['devises'] = DeviseAgence::select('devise_id', 'taux')
                ->where('devise_id', $request->id)->where('agence_id', $agence_id)->get(['devise_id', 'taux']);
            return response()->json($data);
        }
        return redirect('/auth')->with('success', "Vous n'êtes pas autorisé à accéder");
    }

    public function stock_devise(Request $request)
    {
        if (Auth::check()) {
            $societe_id = Auth::user()->societe_id;
            $user_id = Auth::user()->id;
            $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;

            $data['stocks'] = Stock::select('montant', 'id')
                ->where('devise_id', $request->id)->where('caisse_id', $caisse_id)->get(['montant', 'id']);
            return response()->json($data);
        }
        return redirect('/auth')->with('success', "Vous n'êtes pas autorisé à accéder");
    }

    public function print($id)
    {
        $agence_id = Auth::user()->agence_id;
        $operation = OperationDevise::find($id);
        $agence = Agence::find($agence_id);
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            ->loadView('print.recu_achat_devise', compact('operation', 'agence'));

        return $pdf->download('recu_achat.pdf');
    }
}
