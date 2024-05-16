<?php

namespace App\Livewire\CabinetMedical;

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
    public $consutlations;

    public function mount(Patient $patients, $id)
    {
        $id = decrypt($id);

        $patients = Patient::where('id', $id)->first();

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
        $consultations = Facturation::where('patient_id', $this->patients)->get();
        return view('livewire.cabinet-medical.patient-dossier',compact('patient','consultations'));
    }
}
