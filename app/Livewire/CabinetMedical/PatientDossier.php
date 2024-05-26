<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\Consultation;
use App\Models\CabinetMedical\Facturation;
use App\Models\CabinetMedical\Patient;
use App\Models\Civilite;
use App\Models\SituationMatrimoniale;
use Livewire\Component;

class PatientDossier extends Component
{


    public $numero_patient;
    public $patients;
    public $civilite ;
    public $nom ;
    public $prenom ;
    public $situation;
    public $profession;
    public $date_naissance;
    public $lieu_naissance;
    public $telephone;
    public $adresse;
    public $complement_adresse;
    public $taille;
    public $poid;
    public $temperature;
    public $groupe_sanguin;
    public $mail ;
    public $personne_contact ;
    public $icm ;
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

        $civilite = Civilite::where('id', $patients->civilite_id)->first();
        $situation = SituationMatrimoniale::where('id', $patients->situation_matrimoniale_id)->first();

        $this->numero_patient = $patients->numero_patient;
        $this->patients = $patients->id;
        if(isset( $civilite->civilite)){
            $this->civilite =     $civilite->civilite;
        }else{
            $this->civilite = '';
        }

        $this->nom = $patients->nom;
        $this->prenom = $patients->prenom;
        if(isset($situation->situation_matrimoniale))
        {
            $this->situation =  $situation->situation_matrimoniale;
        }else{
            $this->situation ='';
        }

        $this->profession = $patients->profession;
        $this->date_naissance = $patients->date_naissance;
        $this->lieu_naissance = $patients->lieu_naissance;
        $this->telephone = $patients->telephone;
        $this->adresse = $patients->adresse;
        $this->complement_adresse = $patients->complement_adresse;
        $this->taille = $patients->taille;
        $this->temperature = $patients->temperature;
        $this->poid = $patients->poid;
        $this->mail = $patients->mail;
        $this->groupe_sanguin = $patients->groupe_sanguin;
        $this->personne_contact = $patients->personne_contact;
        if(isset($patients->taille)&& isset($patients->poid)){
            $icm=round( $patients->poid/($patients->taille*$patients->taille));
            if($icm<16.5){
                $this->icm=$icm.' (Maigreur extrême – dénutrition)';
            }
            if(16.5<$icm && $icm<18.5){
                $this->icm=$icm.' (Maigreur)';
            }
            if(18.5<$icm && $icm<25){
                $this->icm=$icm.' (Corpulence normale)';
            }
            if(25<$icm && $icm<30){
                $this->icm=$icm.' (Surpoids ou pré-obésité)';
            }
            if(30<$icm && $icm<35){
                $this->icm=$icm.' (Obésité modérée (classe I))';
            }
            if(35<$icm && $icm<40){
                $this->icm=$icm.' (Obésité sévère (classe II))';
            }
            if(40<$icm){
                $this->icm=$icm.' (Obésité morbide (classe III))';
            }
        }

    }

    public function render()
    {
        $patient = Patient::where('id',  $this->patients)->first();
        return view('livewire.cabinet-medical.patient-dossier',compact('patient'));
    }
}
