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
use App\Models\ActiviteInvestissement;

class DetailDevisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        if(Auth::check()){

            //
    // dd($request->devis_id,$request->produit,
    // $request->qte,
    // $request->prix,);
    if(isset(DetailDevis::where('devis_id',$request->devis_id)->where('produit_id',$request->produit)->first(['id'])->id))
    {
        return back()->with('danger',"Produit deja enregistrer");
    }else{
        
       
        $data=[
            'devis_id'              =>$request->devis_id,
            'produit_id'               =>$request->produit,
            'quantite_demandee'       =>$request->qte,
            'prix_unitaire_demande'  =>$request->prix,
        ];
        DetailDevis::create($data);
        return back();
    }
    
        

        // $devis=devis::find($request->devis_id);

        // $devis->update([
        //     'fournisseur_id' =>$request->fournisseur,
        //     'montant_total' =>$request->montant_ht,
        //     'etat' =>'en cours',
        // ]);
        // return back();
        // return redirect('detail_devis/'.$devis->id.'/show');

    }
    return redirect('/auth')->with('danger',"Session expirée");

            //
            // if(Auth::check()){

            //
            // dd($request->devis_id,$request->produit,
            // $request->qte,
            // $request->prix,$request->total,
            // $request->montant_ht,
            // $request->client);


            //     for($i=0;$i<count($request->produit); $i++)
            //     {

            //         $data=[
            //             'devis_id'              =>$request->devis_id,
            //             'produit_id'               =>$request->produit[$i],
            //             'quantite_demandee'       =>$request->qte[$i],
            //             'prix_unitaire_demande'  =>$request->prix[$i],
            //         ];
            //         Detaildevis::create($data);

            //     }

            //     $devis=Devis::find($request->devis_id);

            //     $devis->update([
            //         'client_id' =>$request->client,
            //         'montant_total' =>$request->montant_ht,
            //         'etat' =>'en cours',
            //     ]);
            //     return redirect('detail_devis/'.$devis->id.'/show');

            // }
            // return redirect('/auth')->with('danger',"Session expirée");

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $id=decrypt($id);
         $devis=Devis::find($id);
         $agence_id=Auth::user()->agence_id;
         $detail_deviss=DetailDevis::where('devis_id',$devis->id)->get();
         $activite_investissements=ActiviteInvestissement::where("agence_id",$agence_id)->where('etat_activite','valider')->get();
         $total_ht=DetailDevis::where('devis_id',$devis->id)->selectRaw('sum(quantite_demandee*prix_unitaire_demande) as total')->first('total');
         return view('e-commerce.devis_encours', compact('devis','detail_deviss','total_ht','activite_investissements'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id=decrypt($id);
        $devis=Devis::find($id);
        $agence_id=Auth::user()->agence_id;
        $produits=Produit::where('agence_id',$agence_id)->get();
        $clients=Client::all();
        $detail_deviss=DetailDevis::where('devis_id',$devis->id)->get();
        $total_ht=DetailDevis::where('devis_id',$devis->id)->selectRaw('sum(quantite_demandee*prix_unitaire_demande) as total')->first('total');
        return view('e-commerce.edit_devis', compact('produits','clients','devis','detail_deviss','total_ht'));

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
        $id=decrypt($id);
        
        $produit=DetailDevis::find($id);

        $produit->delete();

        return back();
    }

    public function client_devis(Request $request)
    {
        
        $societe_id=Auth::user()->societe_id;
        $tel=$request->id;
       
        if(isset(Client::where('telephone' ,$tel)->where('societe_id',$societe_id)->first(['id'])->id)){

            $agence_id=Auth::user()->agence_id;

            $id=Client::where('telephone' ,$tel)->first(['id'])->id;
           
            $data['client']=Client::where('id',$id)->get();
            return response()->json($data);

        }else{

            Client::create([
                'telephone'=>$tel,
                'societe_id'=>$societe_id,
            ]);
            /**
             * si le telephone existe afficher le client
             */
            $id=Client::where('telephone' ,$tel)->where('societe_id',$societe_id)->first(['id'])->id;
            $data['client']=Client::where('id',$id)->get();
            return response()->json($data);

        }
    }
}
