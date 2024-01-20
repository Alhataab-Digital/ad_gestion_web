<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Societe;
use App\Models\Utilisateur;
use App\Models\Devise;
use App\Models\Investisseur;
use App\Models\ActiviteInvestissement;
use App\Models\ActiviteVehicule;
use App\Models\Operation;
use App\Models\Caisse;
use App\Models\Banque;
use App\Models\Facture;
use App\Models\Agence;
use App\Models\Devis;

use App\Models\OperationVehiculeAchete;
use App\Models\OperationVehiculeVendu;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if(Auth::check()){
        $id=Auth::user()->id;

        $societe=Societe::where('admin_id',$id)->first();
        $societe_id=Auth::user()->societe_id;
        $agence_id=Auth::user()->agence_id;
        $agence=Agence::find( $agence_id);
        $devises=Devise::where('societe_id',$societe_id)->get();
        // if(isset(Auth::user()->role_id)){
        //     $role=Auth::user()->role_id;
        //     if($role==1 || $role==0){

        //         $facture_non_valider=Devis::where('agence_id',$agence_id)->where('etat','en cours')->count();
        //         $total_non_valider=Devis::where('agence_id',$agence_id)->where('etat','en cours')->selectRaw('sum(montant_total) as total')->first('total');

        //         $facture_impayer=Facture::where('agence_id',$agence_id)->where('etat','valider')->orWhere('etat','echeance')->count();
        //         $total_impayer=Facture::where('agence_id',$agence_id)->where('etat','valider')->orWhere('etat','echeance')->selectRaw('sum(montant_total-montant_regle) as total')->first('total');

        //         $facture_payer=Facture::where('agence_id',$agence_id)->where('etat','terminer')->count();
        //         $total_payer=Facture::where('agence_id',$agence_id)->where('etat','terminer')->selectRaw('sum(montant_total) as total')->first('total');


        //         $count_user=Utilisateur::where('societe_id',$societe_id)->count();
        //         $count_caisse_agence=Caisse::where('agence_id',$agence_id)->count();
        //         $montant_total_caisse_agence=Caisse::where('agence_id',$agence_id)->selectRaw('sum(compte)as total')->first('total');


        //         $count_investisseur=Investisseur::where('agence_id',$agence_id)->count();

        //         $activite_non_valider=ActiviteInvestissement::where('agence_id',$agence_id)->where('etat_activite','en cours')->count();
        //         $montant_activite_non_valider=ActiviteInvestissement::where('agence_id',$agence_id)->where('etat_activite','en cours')->selectRaw('sum(montant_decaisse) as total')->first('total');

        //         $activite_encours=ActiviteInvestissement::where('agence_id',$agence_id)->where('etat_activite','valider')->count();
        //         $montant_activite_encours=ActiviteInvestissement::where('agence_id',$agence_id)->where('etat_activite','valider')->selectRaw('sum(montant_decaisse) as total')->first('total');

        //         $activite_terminer=ActiviteInvestissement::where('agence_id',$agence_id)->where('etat_activite','terminer')->count();
        //         $montant_activite_terminer=ActiviteInvestissement::where('agence_id',$agence_id)->where('etat_activite','terminer')->selectRaw('sum(montant_decaisse) as total')->first('total');

        //         $count_activite_vehicule=ActiviteVehicule::where('agence_id',$agence_id)->where('etat_activite','!=','annuler')->count();
        //         return view('home', compact('societe','devises','count_investisseur','count_user','count_activite_vehicule',
        //         'activite_non_valider','activite_encours','activite_terminer','montant_total_caisse_agence',
        //         'facture_non_valider','facture_impayer','facture_payer','total_payer','total_impayer','total_non_valider','agence','count_caisse_agence',
        //         'montant_activite_non_valider','montant_activite_encours','montant_activite_terminer'));
        //     }
        // }
                $facture_non_valider=Facture::where('agence_id',$agence_id)->where('etat',NULL)->count();
                $total_non_valider=Facture::where('agence_id',$agence_id)->where('etat',NULL)->selectRaw('sum(montant_total) as total')->first('total');

                $facture_valider=Facture::where('agence_id',$agence_id)->where('etat','valider')->count();
                $total_valider=Facture::where('agence_id',$agence_id)->where('etat','valider')->selectRaw('sum(montant_total-montant_regle) as total')->first('total');

                $facture_echeance=Facture::where('agence_id',$agence_id)->where('etat','echeance')->count();
                $total_echeance=Facture::where('agence_id',$agence_id)->where('etat','echeance')->selectRaw('sum(montant_total-montant_regle) as total')->first('total');

                $facture_payer=Facture::where('agence_id',$agence_id)->where('etat','terminer')->count();
                $total_payer=Facture::where('agence_id',$agence_id)->where('etat','terminer')->selectRaw('sum(montant_total) as total')->first('total');



        // $count_user=Utilisateur::where('societe_id',$societe_id)->where('role_id','!=',1)->Where('role_id','!=',0)->count();
        $count_user=Utilisateur::where('societe_id',$societe_id)->count();
        $count_caisse_agence=Caisse::where('agence_id',$agence_id)->count();
        $montant_total_caisse_agence=Caisse::where('agence_id',$agence_id)->selectRaw('sum(compte)as total')->first('total');

        $count_caisse=Caisse::where('agence_id',$agence_id)->where('user_id',$id)->count();
        $montant_total_caisse=Caisse::where('agence_id',$agence_id)->where('user_id',$id)->selectRaw('sum(compte)as total')->first('total');

        $count_banque_agence=Banque::where('agence_id',$agence_id)->count();
        $montant_total_banque_agence=Banque::where('agence_id',$agence_id)->selectRaw('sum(compte)as total')->first('total');

        $count_charge=Operation::where('user_id',$id)->count();
        $montant_total_charge=Operation::where('user_id',$id)->selectRaw('sum(montant_operation)as total')->first('total');
        $count_charge_agence=Operation::where('agence_id',$agence_id)->count();
        $montant_total_charge_agence=Operation::where('agence_id',$agence_id)->selectRaw('sum(montant_operation)as total')->first('total');

        $count_investisseur=Investisseur::where('societe_id',$societe_id)->count();
        $montant_total_investisseur=Investisseur::where('societe_id',$societe_id)->selectRaw('sum(compte_investisseur)as total')->first('total');

        $activite_non_valider=ActiviteInvestissement::where('agence_id',$agence_id)->where('etat_activite','en cours')->count();
        $montant_activite_non_valider=ActiviteInvestissement::where('agence_id',$agence_id)->where('etat_activite','en cours')->selectRaw('sum(montant_decaisse) as total')->first('total');

        $activite_encours=ActiviteInvestissement::where('agence_id',$agence_id)->where('etat_activite','valider')->count();
        $montant_activite_encours=ActiviteInvestissement::where('agence_id',$agence_id)->where('etat_activite','valider')->selectRaw('sum(montant_decaisse) as total')->first('total');

        $activite_terminer=ActiviteInvestissement::where('agence_id',$agence_id)->where('etat_activite','terminer')->count();
        $montant_activite_terminer=ActiviteInvestissement::where('agence_id',$agence_id)->where('etat_activite','terminer')->selectRaw('sum(montant_decaisse) as total')->first('total');

        $count_activite_vehicule=ActiviteVehicule::where('agence_id',$agence_id)->count();
        $total_activite_vehicule=ActiviteVehicule::where('agence_id',$agence_id)->selectRaw('sum(montant_ouverture) as total')->first('total');

        $count_vehicule_vendu=OperationVehiculeVendu::where('etat','paye')->where('user_id',$id)->count();
        $total_vehicule_vendu=OperationVehiculeVendu::where('etat','paye')->where('user_id',$id)->selectRaw('sum(prix_vente) as total')->first('total');

        $count_vehicule_achete=OperationVehiculeAchete::where('etat',NULL)->where('user_id',$id)->count();
        $total_vehicule_achete=OperationVehiculeAchete::where('etat',NULL)->where('user_id',$id)->selectRaw('sum(prix_revient) as total')->first('total');


        $activite_vehicule=ActiviteVehicule::where('agence_id',$agence_id)->where('etat_activite','!=','annuler')->count();

        return view('home', compact('societe','devises',
        'count_investisseur',
        'montant_total_investisseur','count_user',
        'activite_non_valider','activite_encours','activite_terminer','montant_total_caisse_agence','montant_total_caisse','montant_total_banque_agence',
        'facture_non_valider','facture_valider','facture_echeance','facture_payer',
        'total_payer','total_valider','total_echeance',
        'total_non_valider','agence','count_caisse_agence','count_caisse','count_banque_agence',
        'montant_activite_non_valider','montant_activite_encours','montant_activite_terminer',
        'count_charge','montant_total_charge','count_charge_agence','montant_total_charge_agence',
        'count_vehicule_achete','total_vehicule_achete','count_vehicule_vendu','total_vehicule_vendu','count_activite_vehicule','total_activite_vehicule',)

        );
    }
        return redirect('/auth')->with('danger',"Session expirée");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( $id)
    {

        $utilisateur=Utilisateur::findOrFail($id);

        $societe=Societe::where('admin_id',$id)->first();

        $utilisateur->update([
            'societe_id'=>$societe->id,
        ]);
        return redirect('/home')->with('success','Activer');
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
