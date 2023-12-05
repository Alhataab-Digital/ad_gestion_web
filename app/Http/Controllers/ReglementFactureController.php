<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Caisse;
use App\Models\Societe;
use App\Models\Devise;
use App\Models\Client;
use App\Models\Facture;
use App\Models\DetailFacture;
use App\Models\TypeReglement;
use App\Models\Investisseur;
use App\Models\OperationInvestisseur;
use App\Models\MouvementCaisse;
use App\Models\OperationReglementFacture;
use App\Models\ActiviteInvestissement;
use App\Models\ReglementFacture;
use Barryvdh\DomPDF\Facade\Pdf;

class ReglementFactureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id=Auth::user()->id;
        if(isset(Caisse::where('user_id',$id)->first(['id'])->id)){
                $caisse_id=Caisse::where('user_id',$id)->first(['id'])->id;
                $caisse=Caisse::find($caisse_id);
                return view('e-commerce.reglement_facture',compact('caisse'));
        }
        return view('investissement.message');
    }
    /**
     * Display a listing of the resource.
     */
    public function comptoir()
    {
        //
    }

    public function numero_client(Request $request)
    {
        $societe_id=Auth::user()->societe_id;
        $client=Client::where('telephone',$request->numero)
                        ->where('societe_id',$societe_id)->first();
        if(isset($client)==NULL)
        {
            return back();
        }
        $factures=Facture::where('client_id',$client->id)->where('etat','!=','regler')->get();
        return view('e-commerce.facture_impayer',compact('factures','client'));

    }

    public function paiement_facture($id)
    {
        $id=decrypt($id);
        $facture=Facture::find($id);
        $societe_id=Auth::user()->societe_id;
        $agence_id=Auth::user()->agence_id;
        $client=Client::find($facture->client_id);
        $reglements= TypeReglement::all();

        if(!isset(ReglementFacture::where('facture_id',$facture->id)->first()->id)){
            ReglementFacture::create([
                'facture_id'=>$id,
            ]);
        }
        
        $reglement_facture=ReglementFacture::where('facture_id',$facture->id)->first();
        $operations=OperationReglementFacture::where('facture_id',$facture->id)->get();
        $activite_investissements=ActiviteInvestissement::where("agence_id",$agence_id)->where('etat_activite','valider')->get();
        $detail_factures=DetailFacture::where('facture_id',$facture->id)->get();
        $total_ht=DetailFacture::where('facture_id',$facture->id)->selectRaw('sum(quantite_vendue*prix_unitaire_vendu) as total')->first('total');
               
        return view('e-commerce.paiement_facture',compact('facture','reglement_facture','reglements','operations','client','activite_investissements','detail_factures','total_ht'));
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
        $facture=Facture::find($request->facture_id);
        $client=Client::find($facture->client_id);
        $reglements= TypeReglement::all();
        $reglement_facture=ReglementFacture::where('facture_id',$facture->id)->first();
        $operations=OperationReglementFacture::where('facture_id',$facture->id)->get();
        if($request->activite==0 ){
            return back()->with('danger',"Veillez selectionner l'activite investissement");
        }else{
            if(empty($request->montant)){
                return back()->with('danger',"Veillez remplir le montant de l'operation");
            }else{
                if($request->reglement==0 ){
                    return back()->with('danger',"Veillez remplir le mode reglement de l'operation");
                }else{
                  
                    if( $facture->montant_total==$reglement_facture->montant_regle)
                    {
                        return back()->with('danger',"Montant deja reglé");
                    }else{
                        
                            $user_id=Auth::user()->id;
                            if(Caisse::where('user_id',$user_id)->first(['id'])->id)
                            {
                
                                $caisse_id=Caisse::where('user_id',$user_id)->first(['id'])->id;
                                $compte_caisse= Caisse::where('user_id',$user_id)->first(['compte'])->compte;
                                $date_comptable= Caisse::where('user_id',$user_id)->first(['date_comptable'])->date_comptable;
                                
                            // Si le montant de la facture est inferieur ou egale au montant saisie
                                if($facture->montant_total<=$request->montant )
                                {
                                    $montant_regle=$facture->montant_total;
                                    $montant_operation=$montant_regle;

                                    // dd($montant_regle);
                                    // dd($montant_investisseur);
                                    /**
                                     * mise a jour du client
                                    */
                                    $reglement_facture->update([
                                        'montant_regle'=>$montant_regle,
                                    ]);
                                    /**
                                    * enregistrement de l'operation
                                    */
                                    OperationReglementFacture::create([
                                        'montant_operation'=>$montant_regle,
                                        'type_reglement_id'=>$request->reglement,
                                        'activite_id'=>$request->activite,
                                        'facture_id'=>$facture->id,
                                    ]);
                                    $facture->update([
                                        'etat'=>'terminer',
                                        'montant_regle'=>$montant_regle,
                                    ]);

                                    /**
                                     * mise a jour activite investissement
                                     */
                                    $activite_investissement=ActiviteInvestissement::find($request->activite);
                                    $activite_investissement->update([
                                        'compte_activite'=>$activite_investissement->compte_activite+$montant_operation, 
                                        'total_recette'=>$activite_investissement->total_recette+$montant_operation
                                    ]);
                                    /**
                                     * mise a jour de la caisse
                                    */
                    
                                    $compte=$compte_caisse + $montant_operation;
                    
                                        $caisse=Caisse::find($caisse_id);
                    
                                    $user_id=Auth::user()->id;
                    
                                    MouvementCaisse::create([
                                    'caisse_id'=>$caisse->id,
                                    'user_id'=>$user_id,
                                    'description'=>'reglement facture N° '.$request->facture_id,
                                    'entree'=>$montant_operation,
                                    'solde'=>$compte,
                                    'date_comptable'=>$date_comptable
                    
                                    ]);
                        
                                    $caisse->update([
                                        'compte'=>$compte,
                                    ]);

                                    // $id=Auth::user()->id;
                                    return back();
                                    //  $operation=OperationInvestisseur::where('user_id',$id)->latest('id')->first();
                                    //  return redirect()->route('i_versement.show',$operation)->with('success','operation effectuee avec succès');
                                

                                }
                                //si non si le montant à regle est superieur à Zero
                                elseif(($facture->montant_total-$reglement_facture->montant_regle) > 0){

                                   $reste_a_payer=$facture->montant_total-$reglement_facture->montant_regle;

                                    //si le reste à payer est supperieur au montant saisie
                                    if ( $reste_a_payer > $request->montant) {
                                        // dd('le reste à payer est supperieur au montant saisie');
                                        $montant_regle=$reglement_facture->montant_regle+$request->montant;
                                         $montant_operation=$request->montant;
                                         $montant_caisse=$compte_caisse+$montant_operation;
                                         // dd($montant_regle);
                                         // dd($montant_investisseur);
                                         /**
                                          * mise a jour du client
                                         */
                                         $reglement_facture->update([
                                             'montant_regle'=>$montant_regle,
                                         ]);
                                         /**
                                         * enregistrement de l'operation
                                         */
                                         OperationReglementFacture::create([
                                             'montant_operation'=>$montant_operation,
                                             'type_reglement_id'=>$request->reglement,
                                             'activite_id'=>$request->activite,
                                             'facture_id'=>$facture->id,
                                         ]);
     
                                             $facture->update([
                                                 'etat'=>'echeance',
                                                 'montant_regle'=>$montant_regle,
                                             ]);
                                         /**
                                          * mise a jour activite investissement
                                          */
                                         $activite_investissement=ActiviteInvestissement::find($request->activite);
     
                                         $activite_investissement->update([
                                             'compte_activite'=>$activite_investissement->compte_activite+$montant_operation,
                                             'total_recette'=>$activite_investissement->total_recette+$montant_operation
                                         ]);
                                         /**
                                          * mise a jour de la caisse
                                         */
                         
                                         $compte=$compte_caisse + $montant_operation;
                         
                                             $caisse=Caisse::find($caisse_id);
                         
                                         $user_id=Auth::user()->id;
                         
                                         MouvementCaisse::create([
                                         'caisse_id'=>$caisse->id,
                                         'user_id'=>$user_id,
                                         'description'=>'paiement facture =>'.$request->facture_id,
                                         'entree'=>$montant_operation,
                                         'solde'=>$compte,
                                         'date_comptable'=>$date_comptable
                         
                                         ]);
                             
                                         $caisse->update([
                                             'compte'=>$compte,
                                         ]);
     
                                         // $id=Auth::user()->id;
                                         return back();
                                    }
                                     //si non le reste à payer est inferieur ou egale au montant saisie 
                                    elseif ( $reste_a_payer <= $request->montant){
                                        // dd('le reste à payer est inferieur ou egale au montant saisie '.$reste_a_payer);

                                         $montant_regle=$reglement_facture->montant_regle+$reste_a_payer;
                                         $montant_operation=$reste_a_payer;
                                         $montant_caisse=$compte_caisse+$montant_operation;
                                        
                                         $reglement_facture->update([
                                            'montant_regle'=>$montant_regle,
                                        ]);
                                         /**
                                         * enregistrement de l'operation
                                         */
                                         OperationReglementFacture::create([
                                             'montant_operation'=>$montant_operation,
                                             'type_reglement_id'=>$request->reglement,
                                             'activite_id'=>$request->activite,
                                             'facture_id'=>$facture->id,
                                         ]);

                                          $facture->update([
                                                 'etat'=>'terminer',
                                                 'montant_regle'=>$montant_regle,
                                             ]);
     
                                         
                                         /**
                                          * mise a jour activite investissement
                                          */
                                         $activite_investissement=ActiviteInvestissement::find($request->activite);
     
                                         $activite_investissement->update([
                                             'compte_activite'=>$activite_investissement->compte_activite+$montant_operation,
                                             'total_recette'=>$activite_investissement->total_recette+$montant_operation
                                         ]);
                                         /**
                                          * mise a jour de la caisse
                                         */
                         
                                         $compte=$compte_caisse + $montant_operation;
                         
                                             $caisse=Caisse::find($caisse_id);
                         
                                         $user_id=Auth::user()->id;
                         
                                         MouvementCaisse::create([
                                         'caisse_id'=>$caisse->id,
                                         'user_id'=>$user_id,
                                         'description'=>'paiement facture =>'.$request->facture_id,
                                         'entree'=>$montant_operation,
                                         'solde'=>$compte,
                                         'date_comptable'=>$date_comptable
                         
                                         ]);
                             
                                         $caisse->update([
                                             'compte'=>$compte,
                                         ]);
     
                                        
                                         // $id=Auth::user()->id;
                                         return back();
                                    }

                                    }else
                                    // si non si le montant saisie est supperieur au montant à reglé
                                    {
                                        return back()->with('danger',"Erreur reglement");
                                    }
                                
                            }
                        
                    }
                    
                }
            }
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
}
