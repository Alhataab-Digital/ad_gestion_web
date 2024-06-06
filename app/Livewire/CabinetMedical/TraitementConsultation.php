<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\Consultation;
use App\Models\CabinetMedical\Examen;
use App\Models\CabinetMedical\Medicament;
use App\Models\CabinetMedical\Patient;
use App\Models\CabinetMedical\Prescription;
use App\Models\CabinetMedical\Soins;
use App\Models\CabinetMedical\Traitement;
use App\Models\CabinetMedical\TypeExamen;
use App\Models\CabinetMedical\TypeSoins;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TraitementConsultation extends Component
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
    public $examens=[];
    public $type_soins=[];
    public $soins=[];
    public $medicament;
    public $quantite;
    public $posologie;
    public $duree;
    public $prescriptions=[];
    public $type_examen;
    public $libelle;
    public $observation;
    public $type_soin;



    public function mount(Patient $patients, $id)
    {
        $id=decrypt($id);

        $this->medicaments =Medicament::all();
        $this->type_examens =TypeExamen::all();
        $this->type_soins =TypeSoins::all();
        $this->consultation =Consultation::where('id', $id)->first();
        $traitement =Traitement::where('consultation_id', $id)->first();
        $this->prescriptions =Prescription::where('consultation_id', $id)->get();
        $this->examens =Examen::where('consultation_id', $id)->get();
        $this->soins =Soins::where('consultation_id', $id)->get();
        $patients = Patient::where('id',$this->consultation->patient_id)->first();
        $this->civilite = $patients->civilite;
        $this->nom = $patients->nom;
        $this->prenom = $patients->prenom;
        $this->situation = $patients->situation;
        $this->age = $patients->age;
        $this->telephone = $patients->telephone;
        $this->adresse = $patients->adresse;
        $this->taille = $patients->taille;
        $this->poid = $patients->poid;

        if(isset($traitement)){
            $this->traitement=$traitement;
            $this->diagnostique = $traitement->diagnostique;
            $this->conclusion =$traitement->conclusion;
        }


    }
    public function render()
    {
        return view('livewire.cabinet-medical.traitement-consultation');
    }

    public function save()
    {
        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;

        $validated = $this->validate(
            [
                'diagnostique' => 'required',
                'conclusion' => 'required',
            ]);
            $consultation=Consultation::where('id',$this->consultation->id)->first();
            $traitement =Traitement::where('consultation_id', $this->consultation->id)->first();
// dd($validated['conclusion'],$validated['diagnostique'],$consultation);
    if(isset($traitement)){
        $traitement->update([
            'diagnostique'=> $validated['diagnostique'],
            'conclusion'=> $validated['conclusion'],
        ]);
    }else{
        Traitement::create([
            'diagnostique'=> $validated['diagnostique'],
            'conclusion'=> $validated['conclusion'],
            'consultation_id'=> $consultation->id,
            'patient_id'=>$consultation->patient_id,
            'medecin_id'=>$consultation->medecin_id,
            'user_id'=> $user_id,
            'societe_id'=> $societe_id,
        ]);

        //
        return redirect()->route('ad.sante.traitement.consultation',encrypt($consultation->id))->with('succes');
    }



    }
    public function saveSigne()
    {

        dd('signe vitaux '.$this->consultation->id);
    }

    public function saveSoins()
    {

        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;
        $consultation=Consultation::where('id',$this->consultation->id)->first();

        $validated = $this->validate(
            [
                'type_soin' => 'required',
                'libelle' => 'required',
                'observation' => 'required',
            ]);

            Soins::create([
                'libelle'=> $validated['libelle'],
                'type_soins_id'=> $validated['type_soin'],
                'observation'=> $validated['observation'],
                'consultation_id'=> $consultation->id,
                'patient_id'=>$consultation->patient_id,
                'medecin_id'=>$consultation->medecin_id,
                'user_id'=> $user_id,
                'societe_id'=> $societe_id,
            ]);
            return redirect()->route('ad.sante.traitement.consultation',encrypt($consultation->id))->with('succes');
    }

    public function saveExamen()
    {
        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;
        $consultation=Consultation::where('id',$this->consultation->id)->first();

        $validated = $this->validate(
            [
                'type_examen' => 'required',
                'libelle' => 'required',
            ]);

            Examen::create([
                'libelle'=> $validated['libelle'],
                'type_examen_id'=> $validated['type_examen'],
                'consultation_id'=> $consultation->id,
                'patient_id'=>$consultation->patient_id,
                'medecin_id'=>$consultation->medecin_id,
                'user_id'=> $user_id,
                'societe_id'=> $societe_id,
            ]);
            return redirect()->route('ad.sante.traitement.consultation',encrypt($consultation->id))->with('succes');
    }

    public function saveMedicament()
    {
        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;
        $consultation=Consultation::where('id',$this->consultation->id)->first();

        $validated = $this->validate(
            [
                'medicament' => 'required',
                'quantite' => 'required',
                'posologie' => 'required',
                'duree' => 'required',
            ]);

            Prescription::create([
                'medicament_id'=> $validated['medicament'],
                'quantite'=> $validated['quantite'],
                'posologie'=> $validated['posologie'],
                'duree'=> $validated['duree'],
                'consultation_id'=> $consultation->id,
                'patient_id'=>$consultation->patient_id,
                'medecin_id'=>$consultation->medecin_id,
                'user_id'=> $user_id,
                'societe_id'=> $societe_id,
            ]);
            return redirect()->route('ad.sante.traitement.consultation',encrypt($consultation->id))->with('succes');
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
    public function terminerConsultation($id){

        $consultation = Consultation::find($id);
        $consultation->update([
            'etat'=>2,
        ]);
        return redirect()->route('ad.sante.dossier.patient',encrypt($consultation->patient->id));
    }
}
