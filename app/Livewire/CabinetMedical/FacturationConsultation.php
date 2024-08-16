<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\ContratAssurance;
use App\Models\CabinetMedical\Facturation;
use App\Models\CabinetMedical\PaiementRecu;
use App\Models\CabinetMedical\PriseEnCharge;
use App\Models\CabinetMedical\Rdv;
use App\Models\Users\Utilisateur;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FacturationConsultation extends Component
{

    public $facturations=[];
    public $facturations_non_paye=[];
    public $paiements=[];
    public $utilisateur=[];
    public $telephone='';
    public $numero_ordre;
    public $numero_piece;

    public function mount()
    {
            $societe_id = Auth::user()->societe_id;
            $user_id = Auth::user()->id;
            $this->utilisateur=Utilisateur::where('id',$user_id)->first();
            $this->telephone=$this->utilisateur->agence->region->indicatif;
            $this->facturations_non_paye=Facturation::where('societe_id',$societe_id)->where('etat',0)->orderBy('id',"DESC")->get();
            $this->facturations=Facturation::where('societe_id',$societe_id)->where('etat','!=',0)->orderBy('id',"DESC")->get();
            $this->paiements=PaiementRecu::where('societe_id',$societe_id)->orderBy('id',"DESC")->get();

    }
    public function render()
    {
        return view('livewire.cabinet-medical.facturation-consultation');
    }

    public function facturerConsultation($id)
    {

        $consultation=Consultation::find($id);
        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;
        $rendez_vous=Rdv::find($consultation->rdv_id);

        $patient = Patient::find($consultation->patient_id);
        //si le patient à une prise en charge existant

       $date_consultation = Carbon::parse($consultation->created_at)->format('Y-m-d');
        if (isset(PriseEnCharge::where('patient_id', $patient->id)->first()->id)) {
            $prise_en_charge = PriseEnCharge::where('patient_id', $patient->id)->first();

            //si la date de fin de validation de la prise en charge est superieur à la date de la consultation
            if (ContratAssurance::where('id', $prise_en_charge->contrat_assurance_id)
                    ->latest('date_fin')
                    ->where('date_fin', '>=', $date_consultation )
                    ->first()->id)
            {
                    $contrat_assurance = ContratAssurance::where('id', $prise_en_charge->contrat_assurance_id)
                    ->latest('date_fin')
                    ->where('date_fin', '>=', $date_consultation )
                    ->first();
                //si la consultation est deja facturé
                if ($consultation->etat == 1) {
                    return redirect()->route('ad.sante.rendez-vous.consultation')->with('danger', "Consultation déjà facturé");
                } else {

                    $structure_assurer=$consultation->contrat_assurance->maison_assurance_id;
                    $taux_assurer=$consultation->contrat_assurance->taux_couverture;
                    $contrat_id=$consultation->contrat_assurance->id;
                    $latest = Facturation::latest('id')->first();
                    $newNumber = $latest ? intval($latest->id) + 1 : 1;
                    $this->numero_piece = str_pad($newNumber, 7, '0', STR_PAD_LEFT);

                    $montant_assurer=round(($consultation->contrat_assurance->taux_couverture/100)*$consultation->type_consultation->tarif_consultation);
                    $montant_patient=round($consultation->type_consultation->tarif_consultation-(($consultation->contrat_assurance->taux_couverture/100)*$consultation->type_consultation->tarif_consultation));

                    Facturation::create([
                        'numero_piece'=>'FAC'.$this->numero_piece,
                        'numero_ordre'=>$consultation->numero_ordre,
                        'patient_id'=>$consultation->rendez_vous->patient_id,
                        'medecin_id'=>$consultation->rendez_vous->medecin_id,
                        'contrat_id'=>$contrat_id,
                        'maison_assurance_id'=>$structure_assurer,
                        'taux_assurer'=>$taux_assurer,
                        'montant'=>$consultation->type_consultation->tarif_consultation,
                        'montant_assurer'=> $montant_assurer,
                        'montant_patient'=>$montant_patient,
                        'reste_a_payer'=>$montant_patient,
                        'user_id'=>$user_id,
                        'societe_id'=>$societe_id,
                    ]);

                    $consultation->update([
                        'etat'=> "1",
                    ]);
                    $rendez_vous->update([
                        'etat'=> "2",
                    ]);
                    return redirect()->route('ad.sante.rendez-vous.consultation')->with('success', " Rendez-vous enregistrer avec succès");
                }
            } else {
                // dd('si le le contrat de prise en charge est expire'.$planning->jour_semaine,$prise_en_charge->contrat_assurance->date_fin);
               //si la consultation est deja facturé
               if ($consultation->etat == 1) {
                    return redirect()->route('ad.sante.rendez-vous.consultation')->with('danger', "Consultation déjà facturé");
                } else {


                   $latest = Facturation::latest('id')->first();
                    $newNumber = $latest ? intval($latest->id) + 1 : 1;
                    $this->numero_piece = str_pad($newNumber, 7, '0', STR_PAD_LEFT);

                    $montant_assurer=0;
                    $montant_patient=$consultation->type_consultation->tarif_consultation;;

                    Facturation::create([
                        'numero_piece'=>'FAC'.$this->numero_piece,
                        'numero_ordre'=>$consultation->numero_ordre,
                        'patient_id'=>$consultation->rendez_vous->patient_id,
                        'medecin_id'=>$consultation->rendez_vous->medecin_id,
                        'contrat_id'=>0,
                        'taux_assurer'=>0,
                        'montant'=>$consultation->type_consultation->tarif_consultation,
                        'montant_assurer'=> $montant_assurer,
                        'montant_patient'=>$montant_patient,
                        'reste_a_payer'=>$montant_patient,
                        'user_id'=>$user_id,
                        'societe_id'=>$societe_id,
                    ]);

                    $consultation->update([
                        'etat'=> "1",
                    ]);
                    $rendez_vous->update([
                        'etat'=> "2",
                    ]);
                    return redirect()->route('ad.sante.rendez-vous.consultation')->with('success', " Rendez-vous enregistrer avec succès");
                }
            }
        } else {
            //si la consultation est déjà facturé
            if ($consultation->etat == 1) {
            return redirect()->route('ad.sante.rendez-vous.consultation')->with('danger', "Ce patient à un rendez-vous en cours");
        } else {

            $latest = Facturation::latest('id')->first();
            $newNumber = $latest ? intval($latest->id) + 1 : 1;
            $this->numero_piece = str_pad($newNumber, 7, '0', STR_PAD_LEFT);
            $montant_assurer=0;
            $montant_patient=$consultation->type_consultation->tarif_consultation;

            Facturation::create([
                'numero_piece'=>'FAC'.$this->numero_piece,
                'numero_ordre'=>$consultation->numero_ordre,
                'patient_id'=>$consultation->rendez_vous->patient_id,
                'medecin_id'=>$consultation->rendez_vous->medecin_id,
                'contrat_id'=>0,
                'taux_assurer'=>0,
                'montant'=>$consultation->type_consultation->tarif_consultation,
                'montant_assurer'=> $montant_assurer,
                'montant_patient'=>$montant_patient,
                'reste_a_payer'=>$montant_patient,
                'user_id'=>$user_id,
                'societe_id'=>$societe_id,
            ]);

                    $consultation->update([
                        'etat'=> "1",
                    ]);
                    $rendez_vous->update([
                        'etat'=> "2",
                    ]);
            return redirect()->route('ad.sante.rendez-vous.consultation')->with('success', "Rendez-vous enregistrer avec succès");
        }
        }

        // $societe_id = Auth::user()->societe_id;
        // $user_id = Auth::user()->id;
        // $consultation=CabinetMedicalConsultation::find($id);
        // $rendez_vous=Rdv::find($consultation->rdv_id);
        // if($consultation->etat == 0){
        //     $latest = Facturation::latest('id')->first();
        //     $newNumber = $latest ? intval($latest->id) + 1 : 1;
        //     $this->numero_ordre = str_pad($newNumber, 7, '0', STR_PAD_LEFT);

        //     $montant_assurer=round(($consultation->rendez_vous->taux_couverture/100)*$consultation->rendez_vous->montant);
        //     $montant_patient=round($consultation->rendez_vous->montant-(($consultation->rendez_vous->taux_couverture/100)*$rendez_vous->montant));

        //     Facturation::create([
        //         'numero_piece'=>'FAC'.$this->numero_piece,
        //         'numero_ordre'=>$consultation->numero_ordre,
        //         'patient_id'=>$consultation->rendez_vous->patient_id,
        //         'medecin_id'=>$consultation->rendez_vous->medecin_id,
        //         'maison_assurance_id'=>$consultation->rendez_vous->contrat_assurance->maison_assurance_id,
        //         'taux_assurer'=>$consultation->rendez_vous->taux_couverture,
        //         'montant'=>$consultation->rendez_vous->montant,
        //         'montant_assurer'=> $montant_assurer,
        //         'montant_patient'=>$montant_patient,
        //         'reste_a_payer'=>$montant_patient,
        //         'user_id'=>$user_id,
        //         'societe_id'=>$societe_id,
        //     ]);

        //     $rendez_vous->update([
        //         'etat'=> "1",
        //     ]);
        //     return redirect()->to(route('ad.sante.rendez-vous.consultation'));
        // }else{
        //     return redirect()->to(route('ad.sante.rendez-vous.consultation'))->with('danger', "Rendez-vous déjà facturé");
        // }


    }
}
