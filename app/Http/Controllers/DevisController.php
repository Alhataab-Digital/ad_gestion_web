<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Caisse;
use App\Models\Societe;
use App\Models\Devise;
use App\Models\TypeReglement;
use App\Models\Client;
use App\Models\Produit;
use App\Models\Devis;
use App\Models\DetailDevis;
use App\Models\StockProduit;
use App\Models\StockProduitActivite;
use App\Models\ActiviteInvestissement;

class DevisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $agence_id=Auth::user()->agence_id;
        $deviss=Devis::where('agence_id',$agence_id)->orderBy('id','DESC')->get();
        $deviss_cs=Devis::where('etat','en cours')->where('agence_id',$agence_id)->orderBy('id','DESC')->get();
        $deviss_lv=Devis::where('etat','livrer')->where('agence_id',$agence_id)->orderBy('id','DESC')->get();
        $deviss_an=Devis::where('etat','annuler')->where('agence_id',$agence_id)->orderBy('id','DESC')->get();
        return view('e-commerce.devis',compact('deviss','deviss_cs','deviss_lv','deviss_an'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
         //
         if(Auth::check()){
            $id=Auth::user()->id;
            $agence_id=Auth::user()->agence_id;
            Devis::create([
                'user_id'=>$id,
                'agence_id'=>$agence_id,
            ]);
        $devis=Devis::where('user_id',$id)->where('agence_id',$agence_id)->latest('id')->first();

        return redirect('devis/'.encrypt($devis->id).'/edit');

        }
        return redirect('/auth')->with('danger',"Session expirée");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->montant_ht && $request->nom_client && $request->adresse){
            $client=Client::find($request->client_id);
            // dd($client);
            $devis=Devis::find($request->devis_id);

                    $devis->update([
                        'client_id' =>$request->client_id,
                        'montant_total' =>$request->montant_ht,
                        'etat' =>'en cours',
                    ]);

            $client->update([
                'nom_client' =>$request->nom_client,
                'adresse' =>$request->adresse,
            ]);
            return redirect('detail_devis/'.encrypt($devis->id).'/show');
        }
        return back();
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
        $id=decrypt($id);
        $devis=Devis::find($id);
        $agence_id=Auth::user()->agence_id;
        $activite_investissements=ActiviteInvestissement::where("agence_id",$agence_id)->where('etat_activite','valider')->get();
        $produit_stocks=StockProduitActivite::where('agence_id',$agence_id)->where('activite_id',$devis->activite_id)->where('quantite_en_stock','>','0')->get();
        // $produits=Produit::where('agence_id',$agence_id)->get();
        $clients=Client::all();
        $detail_deviss=DetailDevis::where('devis_id',$devis->id)->get();
        $total_ht=DetailDevis::where('devis_id',$devis->id)->selectRaw('sum(quantite_demandee*prix_unitaire_demande) as total')->first('total');
        return view('e-commerce.nouveau_devis', compact(
            // 'produits',
            'clients','devis','produit_stocks','detail_deviss','total_ht','activite_investissements'));
    }

    public function activite_devis(Request $request ,$id)
    {
        // dd($request->activite);
        $id=decrypt($id);
        $devis=Devis::find($id);
        $agence_id=Auth::user()->agence_id;
        $devis->update([
            'activite_id' =>$request->activite,
        ]);

        return redirect('devis/'.encrypt($devis->id).'/edit');
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

    public function select_produit(Request $request){
        if(Auth::check()){
            $agence_id=Auth::user()->agence_id;

            $data['produits']=Produit::select('prix_unitaire_vente')
            ->where('id',$request->id)->get(['prix_unitaire_vente']);

            return response()->json($data);

        }
            return redirect('/auth')->with('success',"Vous n'êtes pas autorisé à accéder");


    }


}
