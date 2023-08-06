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
use App\Models\MouvementCaisse;
use Barryvdh\DomPDF\Facade\Pdf;

class EnvoiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id=Auth::user()->id;
        if(isset(Caisse::where('user_id',$id)->first(['id'])->id)){
            $date=date('Y-m-d');
            $caisse_id=Caisse::where('user_id',$id)->first(['id'])->id;
            $caisse=Caisse::find($caisse_id);
            $agence_id=Auth::user()->agence_id;
            $agence=Agence::find( $agence_id);
            $operations=OperationTransfert::where('envoi_user_id',$id)->where('date_envoi',$date)->get();
            return view('transfert.envoi', compact('caisse','agence','operations'));
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
        $code_envoi=mt_rand(1000000000, 9999999999);

    //     dd('id_client : '.$request->c_id.', Montant envoi :'.$request->montant.', Frai envoi :'.$request->frais.', type frais :'.$request->type_frais.'
    //    , montant ttc : '.$request->ttc.', devise agence : '.$request->devise_id.', destination : '.$request->region_id.',
    //     destinataire'.$request->nom_destinataire.' tel'.$request->telephone_destinataire.' code'.$code_envoi.' date'.date("Y-m-d"));


        $client=Client::find($request->c_id);

        $user_id=Auth::user()->id;
    if(Caisse::where('user_id',$user_id)->first(['id'])->id)
    {

        $caisse_id=Caisse::where('user_id',$user_id)->first(['id'])->id;
        $compte_caisse= Caisse::where('user_id',$user_id)->first(['compte'])->compte;
        $date_envoi=Caisse::where('user_id',$user_id)->first(['date_comptable'])->date_comptable;
        /**
         * mise a jour du client
         */
        $client->update([
            'nom_client'=>$request->nom_client,
            'telephone'=>$request->telephone,
            'adresse'=>$request->adresse,
        ]);
        /**
         * enregistrement de l'operation
         */
        OperationTransfert::create([
            'client_id'=>$request->c_id,
            'montant'=>$request->montant,
            'type_envoi'=>$request->type_frais,
            'frais_envoi'=>$request->frais,
            'montant_ttc'=>$request->ttc,
            'agence_id'=>$request->agence_id,
            'envoi_user_id'=>$user_id,
            'code_envoi'=>'GMC'.$code_envoi,
            'taux_echange'=>$request->taux,
            'devise_id'=>$request->devise_id,
            'date_envoi'=>$date_envoi,

            'region_id'=>$request->region_id,
            'nom_destinataire'=>$request->nom_destinataire,
            'telephone_destinataire'=>$request->telephone_destinataire,

        ]);

        /**
         * mise a jour de la caisse
         */

         $compte=$compte_caisse + $request->ttc;

        $caisse=Caisse::find($caisse_id);

        /**
         * mise a jour dU mouvement caisse
         */
        $user_id=Auth::user()->id;
        MouvementCaisse::create([
            'caisse_id'=>$caisse->id,
            'user_id'=>$user_id,
            'description'=>'Envoi change',
            'entree'=> $request->ttc,
            'solde'=>$compte,
            'date_comptable'=>$date_envoi,

        ]);

        $caisse->update([
            'compte'=>$compte,
        ]);
        $id=Auth::user()->id;
        $operation=OperationTransfert::where('envoi_user_id',$id)->latest('id')->first();
        return redirect()->route('envoi.show',$operation)->with('success','operation effectuee avec succès');



    }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $operation= OperationTransfert::find($id);
        $agence_id=Auth::user()->agence_id;
        $agence=Agence::find( $agence_id);
        $agence_destination =Agence::where('region_id',$operation->region_id)->first();

        return view('transfert.show_envoi', compact('operation','agence','agence_destination'));
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

    public function numero_client(Request $request){



        $data = $request->validate([
            'telephone'=>'required',
        ]);
        $data=$request->all();

        $tel = $data['telephone'];
        /**
         * si le telephone existe afficher le client
         */
        if(isset(Client::where('telephone' ,$tel)->first(['id'])->id)){

            $agence_id=Auth::user()->agence_id;
            $agence=Agence::find($agence_id);
            $client_id=Client::where('telephone' ,$tel)->first(['id'])->id;
            $client=Client::find($client_id);
            $devise_agences=DeviseAgence::where('agence_id',$agence_id)->get();
            $reglements= TypeReglement::all();
            $regions=Region::all();
            return view('transfert.detail_envoi', compact('client','devise_agences','agence','regions','reglements'));
        /**
         * si non enregistre le client et affiche le formulaire
         */
        }else{

            client::create([
                'telephone'=>$data['telephone'],
            ]);
            /**
             * si le telephone existe afficher le client
             */
            $agence_id=Auth::user()->agence_id;
            $agence=Agence::find($agence_id);
            $client_id=Client::where('telephone' ,$tel)->first(['id'])->id;
            $client=Client::find($client_id);
            $devise_agences=DeviseAgence::where('agence_id',$agence_id)->get();
            $reglements= TypeReglement::all();
            $regions=Region::all();
            return view('transfert.detail_envoi', compact('client','devise_agences','regions','agence','reglements'));
            //return redirect('/achat_devise')->with('success','client ajouté avsec succès');
        }


    }

    public function info_destination(Request $request)
    {
                if(Auth::check()){

                    $agence_id=Auth::user()->agence_id;
                    $agence = Agence::where('region_id',$request->id)->first(['id','devise_id']);

                    $data['devise']=DeviseAgence::select('taux','devise_id')
                    ->where('agence_id',$agence_id)
                    ->where('devise_id',$agence->devise_id)
                    ->get(['taux','devise_id']);

                    return response()->json($data);
                }
                    return redirect('/auth')->with('success',"Vous n'êtes pas autorisé à accéder");


    }

    public function print( $id)
    {
        $operation= OperationTransfert::find($id);
        $agence_id=Auth::user()->agence_id;
        $agence=Agence::find( $agence_id);
        $agence_destination =Agence::where('region_id',$operation->region_id)->first();

        // return view('transfert.show_envoi', compact('operation','agence','agence_destination'));

        $pdf=PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
        ->loadView('print.recu_envoi',compact('operation','agence','agence_destination'));

        return $pdf->download('recu_envoi_change.pdf');
    }
}
