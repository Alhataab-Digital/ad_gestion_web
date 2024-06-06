<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\Consultation;
use App\Models\CabinetMedical\ContratAssurance;
use App\Models\CabinetMedical\Examen;
use App\Models\CabinetMedical\Facturation;
use App\Models\CabinetMedical\MaisonAssurance;
use App\Models\CabinetMedical\Patient;
use App\Models\CabinetMedical\Prescription;
use App\Models\CabinetMedical\PriseEnCharge;
use App\Models\CabinetMedical\Rdv;
use App\Models\CabinetMedical\Soins;
use App\Models\Civilite;
use App\Models\SituationMatrimoniale;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class PatientDossier extends Component
{


    public $numero_patient;
    public $patients;
    public $civilite ,$nom ,$prenom ,$situation,$date_naissance,$profession,$lieu_naissance,$telephone,$adresse,$complement_adresse;
    public $taille,$poid,$temperature,$groupe_sanguin;
    public $mail ,$personne_contact,$icm ;
    public $nbr_rdv;
    public $consultations=[];
    public $prescriptions=[];
    public $facturations=[];
    public $consutlation_traitement=[];
    public $nbr_consutlation_encours=[];
    public $prise_en_charges=[];
    public $maison_assurance;
    public $contrat_assurances = [];
    public $examens=[];
    public $soins=[];

    public $rendez_vouss=[];

    public function mount(Patient $patients, $id)
    {
        $id = decrypt($id);

        $patient = Patient::find($id);
        $prise_en_charge = PriseEnCharge::where('patient_id', $id)->first();

        $this->examens =Examen::where('patient_id', $id)->get();
        $this->soins =Soins::where('patient_id', $id)->get();
        if( isset($prise_en_charge)){
        $this->maison_assurance = MaisonAssurance::find($prise_en_charge->maison_assurance_id);
        $this->contrat_assurances=ContratAssurance::where('maison_assurance_id', $this->maison_assurance->id)->get();
        }
        $this->rendez_vouss=Rdv::where('patient_id', $id)->orderBy('id',"DESC")->get();
        $this->consultations = Consultation::where('patient_id', $id)->where('etat',1)->orderBy('id',"DESC")->get();
        $this->prescriptions =Prescription::where('patient_id', $id)->orderBy('id',"DESC")->get();
        $this->facturations = Facturation::where('patient_id', $id)->orderBy('id',"DESC")->get();
        $this->nbr_consutlation_encours = Consultation::where('patient_id', $id)->where('etat',1)->orderBy('id',"DESC")->count();
        $this->consutlation_traitement = Consultation::where('patient_id', $id)->where('etat','!=',0)->orderBy('id',"DESC")->get();
        $this->prise_en_charges = PriseEnCharge::where('patient_id', $id)->orderBy('id',"DESC")->get();
        $civilite = Civilite::where('id', $patients->civilite_id)->first();
        $situation = SituationMatrimoniale::where('id', $patients->situation_matrimoniale_id)->first();



        $this->numero_patient = $patient->numero_patient;
        $this->patients = $patient->id;
        $this->civilite = $patient->civilite->civilite;
        $this->nom = $patient->nom;
        $this->prenom = $patient->prenom;
        $this->situation =  $patient->situation->situation_matrimoniale;
        $this->profession = $patient->profession;
        $this->date_naissance = $patient->date_naissance;
        $this->lieu_naissance = $patient->lieu_naissance;
        $this->telephone = $patient->telephone;
        $this->adresse = $patient->adresse;
        $this->complement_adresse = $patient->complement_adresse;
        $this->taille = $patient->taille;
        $this->temperature = $patient->temperature;
        $this->poid = $patient->poid;
        $this->mail = $patient->mail;
        $this->groupe_sanguin = $patient->groupe_sanguin;
        $this->personne_contact = $patient->personne_contact;
        if($patient->taille!=null && $patient->poid!=null){
            $icm=round( ($patient->poid)/($patient->taille*$patient->taille));

            if($icm<16.5){
                $this->icm=$icm.' (Maigreur extrême – dénutrition)';
            }else
            if(16.5<$icm && $icm<18.5){
                $this->icm=$icm.' (Maigreur)';
            }else
            if(18.5<$icm && $icm<25){
                $this->icm=$icm.' (Corpulence normale)';
            }else
            if(25<$icm && $icm<30){
                $this->icm=$icm.' (Surpoids ou pré-obésité)';
            }else
            if(30<$icm && $icm<35){
                $this->icm=$icm.' (Obésité modérée (classe I))';
            }else
            if(35<$icm && $icm<40){
                $this->icm=$icm.' (Obésité sévère (classe II))';
            }else
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

    public function recuPrint($id)
    {
            ini_set('max_execution_time',3600);
        $consultation = Consultation::find($id);
        $prescriptions =Prescription::where('consultation_id', $id)->get();

            $path=public_path('images/logo/'.$consultation->societe->logo);

            $type=pathinfo($path,PATHINFO_EXTENSION);
            $data=file_get_contents($path);
            $logo='data:image/'.$type.';base64,'.base64_encode($data);
        $data = [
            'prescriptions' =>$prescriptions,
            'logo'=>$logo,
            'consultation'=>$consultation,
        ];

        $pdf = Pdf::loadView('print.cabinet_medical.ordonnance-consultation', $data);
        return response()->streamDownload(
            function() use($pdf){
                echo $pdf->stream();
            },
            'ordonnance-consultations.pdf'
        );

    }

}
