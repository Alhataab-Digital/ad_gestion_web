<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\Consultation;
use App\Models\CabinetMedical\Facturation;
use App\Models\CabinetMedical\PaiementRecu;
use App\Models\CabinetMedical\Patient;
use App\Models\CabinetMedical\Rdv;
use App\Models\Users\Utilisateur;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RendezVousConsultation extends Component
{

    public $rendez_vouss=[];
    public $facturations=[];
    public $paiements=[];
    public $contrat_assurances=[];
    public $rendez_vous;
    public $maison_assurance;
    public $contrat_assurance;
    public $utilisateur=[];
    public $telephone='';

public function mount()
{

        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;
        $this->utilisateur=Utilisateur::where('id',$user_id)->first();
        $this->telephone=$this->utilisateur->agence->region->indicatif;
        $this->rendez_vouss=Rdv::where('societe_id',$societe_id)->get();
        $this->facturations=Facturation::where('societe_id',$societe_id)->where('etat',0)->get();
        $this->paiements=PaiementRecu::where('societe_id',$societe_id)->get();

}
    public function render()
    {
        return view('livewire.cabinet-medical.rendez-vous-consultation');
    }

    public function valider(){

        $validated = $this->validate(
            [
                'telephone'=> 'required | min:8|max:12',
            ]
        );

        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;
        $validated['telephone'];
        $patient=Patient::where('telephone',$validated['telephone'])->first();
        $numero_patient = 'PAT/'.mt_rand(1000, 9999).'/'.date('dmY');

        if(isset($patient->telephone)){

            return redirect()->route('ad.sante.dossier.rendez-vous.consultation',encrypt($patient->id));

        }else{

            Patient::create([
                'telephone'=> $validated['telephone'],
                'numero_patient'=> $numero_patient,
                'user_id'=> $user_id,
                'societe_id' => $societe_id,
            ]);

            $patient=Patient::where('telephone',$validated['telephone'])->first();

            return redirect()->route('ad.sante.dossier.rendez-vous.consultation',encrypt($patient->id));

        }


    }

    public function facturerRendezVous($id)
    {

        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;
        $rendez_vous=Rdv::find($id);

        if(isset($rendez_vous->etat) != 0){
        $montant_assurer=round(($rendez_vous->taux_couverture/100)*$rendez_vous->montant);
        $montant_patient=round($rendez_vous->montant-(($rendez_vous->taux_couverture/100)*$rendez_vous->montant));
       
        Facturation::create([
            'rdv_id'=>$rendez_vous->id,
            'patient_id'=>$rendez_vous->patient_id,
            'medecin_id'=>$rendez_vous->medecin_id,
            'tarif_consultation_id'=>$rendez_vous->planification->tarif_consultation_id,
            'taux_assurer'=>$rendez_vous->taux_couverture,
            'montant'=>$rendez_vous->montant,
            'montant_assurer'=> $montant_assurer,
            'montant_patient'=>$montant_patient,
            'reste_a_payer'=>$montant_patient,
            'user_id'=>$user_id,
            'societe_id'=>$societe_id,
        ]);

        $rendez_vous->update([
            'etat'=> "1",
        ]);

        return redirect()->route('ad.sante.rendez-vous.consultation');
        }else{
            dd('facturer deja');
        }


    }
    public function IntroduireSalleAttente($id)
    {
        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;
        $rendez_vous=Rdv::find($id);

        if(isset($rendez_vous->etat) ==2){

        Consultation::create([
            'rdv_id'=>$rendez_vous->id,
            'patient_id'=>$rendez_vous->patient_id,
            'medecin_id'=>$rendez_vous->medecin_id,
            'tarif_consultation_id'=>$rendez_vous->planification->tarif_consultation_id,
            'user_id'=>$user_id,
            'societe_id'=>$societe_id,
        ]);

        $rendez_vous->update([
            'etat'=>3,
        ]);

        return redirect()->route('ad.sante.rendez-vous.consultation');
    }
    }
}
