<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\Consultation;
use App\Models\CabinetMedical\Facturation;
use App\Models\CabinetMedical\Patient;
use Livewire\Component;

class PatientDossier extends Component
{

    public $patients;
    public $civilite ;
    public $nom ;
    public $prenom ;
    public $situation;
    public $age;
    public $telephone;
    public $adresse;
    public $taille;
    public $poid;
    public $mail ;
    public $password;
    public $consultations=[];
    public $facturations=[];
    public $consutlation_traiters=[];

    public function mount(Patient $patients, $id)
    {
        $id = decrypt($id);

        $patients = Patient::where('id', $id)->first();

        $this->consultations = Consultation::where('patient_id', $id)->where('etat', '0')->get();
        $this->facturations = Facturation::where('patient_id', $id)->get();
        $this->consutlation_traiters = Consultation::where('patient_id', $id)->where('etat', '1')->get();

        $this->patients = $patients->id;
        $this->civilite = $patients->civilite;
        $this->nom = $patients->nom;
        $this->prenom = $patients->prenom;
        $this->situation = $patients->situation;
        $this->age = $patients->age;
        $this->telephone = $patients->telephone;
        $this->adresse = $patients->adresse;
        $this->taille = $patients->taille;
        $this->poid = $patients->poid;
        $this->mail = $patients->mail;
        $this->password = $patients->password;
    }

    public function render()
    {
        $patient = Patient::where('id',  $this->patients)->first();
        return view('livewire.cabinet-medical.patient-dossier',compact('patient'));
    }
}
