<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\Consultation;
use App\Models\CabinetMedical\Examen;
use App\Models\CabinetMedical\Patient;
use App\Models\CabinetMedical\Prescription;
use App\Models\CabinetMedical\SigneVitaux;
use App\Models\CabinetMedical\Traitement;
use App\Models\CabinetMedical\TypeSoins;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class ResultatConsultation extends Component
{
    public $patients;
    public $motif;
    public $examen_clinique;
    public $examen_biologique;
    public $examen_radiologique;
    public $diagnostique;
    public $conclusion;
    public $traitement;
    public $civilite ;
    public $nom ;
    public $prenom ;
    public $situation;
    public $age;
    public $telephone;
    public $adresse;
    public $taille;
    public $poid;
    public $consultation;
    public $medicaments=[];
    public $type_examens=[];
    public $type_soins=[];
    public $medicament;
    public $quantite;
    public $posologie;
    public $duree;
    public $prescriptions=[];
    public $examens=[];
    public $signe_vitaux=[];

    public function mount($id)
    {
        $id=decrypt($id);

        $this->consultation =Consultation::find($id);
        $traitement =Traitement::where('consultation_id', $id)->first();
        $this->prescriptions =Prescription::where('consultation_id', $id)->get();
        $this->examens =Examen::where('consultation_id', $id)->get();
        $this->signe_vitaux =SigneVitaux::where('consultation_id', $id)->get();
        $this->civilite = $this->consultation->patient->civilite;
        $this->nom = $this->consultation->patient->nom;
        $this->prenom = $this->consultation->patient->prenom;
        $this->situation = $this->consultation->patient->situation;
        $this->age = $this->consultation->patient->age;
        $this->telephone = $this->consultation->patient->telephone;
        $this->adresse = $this->consultation->patient->adresse;
        $this->taille = $this->consultation->patient->taille;
        $this->poid = $this->consultation->patient->poid;

        if(isset($traitement)){
            $this->traitement=$traitement;
            $this->diagnostique = $traitement->diagnostique;
            $this->conclusion =$traitement->conclusion;
        }


    }


    public function render()
    {
        return view('livewire.cabinet-medical.resultat-consultation');

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
    public function ExamenPrint($id)
    {
            ini_set('max_execution_time',3600);
        $consultation = Consultation::find($id);
        $examens =Examen::where('consultation_id', $id)->get();

            $path=public_path('images/logo/'.$consultation->societe->logo);

            $type=pathinfo($path,PATHINFO_EXTENSION);
            $data=file_get_contents($path);
            $logo='data:image/'.$type.';base64,'.base64_encode($data);
        $data = [
            'examens' =>$examens,
            'logo'=>$logo,
            'consultation'=>$consultation,
        ];

        $pdf = Pdf::loadView('print.cabinet_medical.examen-consultation', $data);
        return response()->streamDownload(
            function() use($pdf){
                echo $pdf->stream();
            },
            'examen-consultations.pdf'
        );

    }
}
