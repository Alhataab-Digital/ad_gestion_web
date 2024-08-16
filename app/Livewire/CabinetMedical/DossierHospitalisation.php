<?php

namespace App\Livewire\CabinetMedical;

use App\Models\Civilite;
use App\Models\CabinetMedical\Rdv;
use Illuminate\Support\Facades\Auth;
use App\Models\SituationMatrimoniale;
use App\Models\CabinetMedical\Patient;
use App\Models\CabinetMedical\PriseEnCharge;
use App\Models\CabinetMedical\ContratAssurance;
use App\Models\CabinetMedical\MotifConsultation;
use App\Models\CabinetMedical\TarifConsultation;
use Livewire\Component;

class DossierHospitalisation extends Component
{
    public $patients;
    public $civilite;
    public $nom;
    public $prenom;
    public $situation;
    public $profession;
    public $date_naissance;
    public $lieu_naissance;
    public $telephone;
    public $adresse;

    public $tarif_montants = [];
    public $tarif_montant = null;
    public $date_rdvs = [];
    public $heure_rdvs;
    public $heure_rdv;
    public $motif;


    public $civilites = [];
    public $motifs = [];
    public $situations = [];
    public $planification_dates = [];
    public $planification_date = null;
    public $planification_medecins = [];
    public $planification_medecin = null;
    public $tarif_consultations = [];
    public $tarif_consultation = null;


    public function mount( $id)
    {
        $id = decrypt($id);

        $patients = Patient::where('id', $id)->first();

        $this->civilites = Civilite::all();
        $this->motifs = MotifConsultation::all();
        $this->situations = SituationMatrimoniale::all();
        $this->tarif_consultations = TarifConsultation::all();
        $this->patients = $patients->id;
        $this->civilite = $patients->civilite_id;
        $this->nom      = $patients->nom;
        $this->prenom = $patients->prenom;
        $this->profession = $patients->profession;
        $this->situation = $patients->situation_matrimoniale_id;
        $this->date_naissance = $patients->date_naissance;
        $this->lieu_naissance = $patients->lieu_naissance;
        $this->telephone = $patients->telephone;
        $this->adresse = $patients->adresse;
    }
    public function render()
    {
        return view('livewire.cabinet-medical.dossier-hospitalisation');
    }
}
