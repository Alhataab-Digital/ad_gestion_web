<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\Consultation;
use App\Models\CabinetMedical\Examen;
use App\Models\CabinetMedical\Medicament;
use App\Models\CabinetMedical\Patient;
use App\Models\CabinetMedical\Prescription;
use App\Models\CabinetMedical\SigneVitaux;
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
    public $imc;
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
    public $temperature_corporelle;
    public $frequence_cardiaque;
    public $frequence_respiratoire;
    public $pression_arterielle;
    public $saturation_oxygene;
    public $douleur;
    public $signe_vitaux;


    public function mount(Patient $patients, $id)
    {
        $id=decrypt($id);

        $this->medicaments =Medicament::all();
        $this->type_examens =TypeExamen::all();
        $this->type_soins =TypeSoins::all();
        $this->consultation =Consultation::where('id', $id)->first();
        $traitement =Traitement::where('consultation_id', $id)->first();
        $signe_vitaux =SigneVitaux::where('consultation_id', $id)->first();
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
        // $this->taille = $patients->taille;
        // $this->poid = $patients->poid;

        if(isset($traitement)){
            $this->traitement=$traitement;
            $this->diagnostique = $traitement->diagnostique;
            $this->conclusion =$traitement->conclusion;
        }
        if(isset($signe_vitaux)){

            $this->signe_vitaux=$signe_vitaux;
            $this->taille = $signe_vitaux->taille;
            $this->poid = $signe_vitaux->poid;
            $this->temperature_corporelle=$signe_vitaux->temperature_corporelle;
            $this->frequence_cardiaque=$signe_vitaux->frequence_cardiaque;
            $this->frequence_respiratoire=$signe_vitaux->frequence_respiratoire;
            $this->pression_arterielle=$signe_vitaux->pression_arterielle;
            $this->saturation_oxygene=$signe_vitaux->saturation_oxygene;
            $this->douleur=$signe_vitaux->douleur;
            if($signe_vitaux->taille!=null && $signe_vitaux->poid!=null){
                $imc=round( ($signe_vitaux->poid)/($signe_vitaux->taille*$signe_vitaux->taille));

                if($imc<16.5){
                    $this->imc=$imc.' (Maigreur extrême – dénutrition)';
                }else
                if(16.5<$imc && $imc<18.5){
                    $this->imc=$imc.' (Maigreur)';
                }else
                if(18.5<$imc && $imc<25){
                    $this->imc=$imc.' (Corpulence normale)';
                }else
                if(25<$imc && $imc<30){
                    $this->imc=$imc.' (Surpoids ou pré-obésité)';
                }else
                if(30<$imc && $imc<35){
                    $this->imc=$imc.' (Obésité modérée (classe I))';
                }else
                if(35<$imc && $imc<40){
                    $this->imc=$imc.' (Obésité sévère (classe II))';
                }else
                if(40<$imc){
                    $this->imc=$imc.' (Obésité morbide (classe III))';
                }
            }
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

        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;
        $consultation=Consultation::where('id',$this->consultation->id)->first();


        $validated = $this->validate(
            [
                'poid' => 'required',
                'taille' => 'required',
                'temperature_corporelle' => '',
                'frequence_cardiaque' => '',
                'frequence_respiratoire' => '',
                'pression_arterielle' => '',
                'saturation_oxygene' => '',
                'douleur' => '',
            ]);
            $signe_vitaux =SigneVitaux::where('consultation_id', $this->consultation->id)->first();
            $patients = Patient::where('id',$this->consultation->patient_id)->first();
            if(isset($signe_vitaux)){
                $patients ->update([
                    'poid'=> $validated['poid'],
                    'taille'=> $validated['taille'],
                ]);
                $signe_vitaux->update([
                    'poid'=> $validated['poid'],
                    'taille'=> $validated['taille'],
                    'temperature_corporelle'=> $validated['temperature_corporelle'],
                    'frequence_cardiaque'=> $validated['frequence_cardiaque'],
                    'frequence_respiratoire'=> $validated['frequence_respiratoire'],
                    'pression_arterielle'=> $validated['pression_arterielle'],
                    'saturation_oxygene'=> $validated['saturation_oxygene'],
                    'douleur'=> $validated['douleur'],
                ]);
                return redirect()->route('ad.sante.traitement.consultation',encrypt($consultation->id))->with('succes');

            }else{
                $patients ->update([
                    'poid'=> $validated['poid'],
                    'taille'=> $validated['taille'],
                ]);
            SigneVitaux::create([
                'poid'=> $validated['poid'],
                'taille'=> $validated['taille'],
                'temperature_corporelle'=> $validated['temperature_corporelle'],
                'frequence_cardiaque'=> $validated['frequence_cardiaque'],
                'frequence_respiratoire'=> $validated['frequence_respiratoire'],
                'pression_arterielle'=> $validated['pression_arterielle'],
                'saturation_oxygene'=> $validated['saturation_oxygene'],
                'douleur'=> $validated['douleur'],
                'consultation_id'=> $consultation->id,
                'patient_id'=>$consultation->patient_id,
                'medecin_id'=>$consultation->medecin_id,
                'user_id'=> $user_id,
                'societe_id'=> $societe_id,
            ]);
            return redirect()->route('ad.sante.traitement.consultation',encrypt($consultation->id))->with('succes');
        }
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
