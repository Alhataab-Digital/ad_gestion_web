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
use App\Models\client;
use App\Models\Produit;
use App\Models\Devis;
use App\Models\DetailDevis;
use App\Models\Facture;
use App\Models\DetailFacture;
use App\Models\EntrepotStock;
use App\Models\StockProduit;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $factures=Facture::all();
        $factures_cs=Facture::where('etat',NULL)->get();
        $factures_lv=Facture::where('etat','valider')->get();
        $factures_an=Facture::where('etat','annuler')->get();
        return view('e-commerce.facture',compact('factures','factures_cs','factures_lv','factures_an'));
    
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

        // dd(

        // $request->devis_id,
        // $request->produit,
        // $request->qte,
        // $request->prix ,
        // $request->total,
        // $request->montant_ht,
        // $request->client

        // );
        $facture=Facture::where('devis_id',$request->devis_id)->first();

            if(isset($facture)){

                $facture=Facture::where('devis_id',$request->devis_id)->latest('id')->first();

                return redirect('facture/'.$facture->id.'/edit');
            }else{
                $id=Auth::user()->id;
                $agence_id=Auth::user()->agence_id;

                Facture::create([
                    'devis_id'  => $request->devis_id,
                    'client_id'  => $request->client,
                    'user_id'      => $id,
                    'agence_id'    => $agence_id,
                ]);

                // $devis=devis::find($request->devis_id);

                //     $devis->update([
                //         'etat' =>'Facture',
                //     ]);

                $facture=Facture::where('user_id',$id)->where('agence_id',$agence_id)->latest('id')->first();

                return redirect('facture/'.$facture->id.'/edit');
            }
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
        //
            $facture=Facture::find($id);
            if($facture->entrepot_id==NULL)
            {
                $entrepots=EntrepotStock::where("agence_id",$facture->agence_id)->get();
                $devis=Devis::where('id',$facture->devis_id)->first();
                $detail_deviss=DetailDevis::where('devis_id',$facture->devis_id)->get();
                $detail_factures=DetailFacture::where('facture_id',$facture->id)->get();
                $total_ht=DetailFacture::where('facture_id',$facture->id)->selectRaw('sum(quantite_vendue*prix_unitaire_vendu) as total')->first('total');
                return view('e-commerce.facture_encours', compact('devis','detail_deviss','total_ht','facture','entrepots','detail_factures'));

            }
           
            $devis=Devis::where('id',$facture->devis_id)->first();
            $detail_deviss=DetailDevis::where('devis_id',$facture->devis_id)->get();
            $detail_factures=DetailFacture::where('facture_id',$facture->id)->get();
            $entrepots=EntrepotStock::where('id','!=',$facture->entrepot_id)->where("agence_id",$facture->agence_id)->get();
            $total_ht=DetailFacture::where('facture_id',$facture->id)->selectRaw('sum(quantite_vendue*prix_unitaire_vendu) as total')->first('total');
            return view('e-commerce.facture_encours', compact('devis','detail_deviss','total_ht','facture','entrepots','detail_factures'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $facture=Facture::find($id);
// dd($facture,$request->montant_ht);

                    $facture->update([
                        'montant_total' =>$request->montant_ht,
                        'etat' =>'Valider',
                    ]);

        $devis=devis::find($facture->devis_id);
                    $devis->update([
                        'etat' =>'Facture',
                    ]);

        return redirect('detail_facture/'.$id.'/show');
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

            $data['produits']=DetailDevis::where('devis_id',$request->devis_id)->where('produit_id',$request->id)->get();

            return response()->json($data);

        }
            return redirect('/auth')->with('success',"Vous n'êtes pas autorisé à accéder");


    }

    public function print()
    {

    }
}
