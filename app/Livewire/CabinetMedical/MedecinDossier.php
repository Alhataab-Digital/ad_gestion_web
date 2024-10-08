<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\CategorieMedecin;
use App\Models\CabinetMedical\Consultation;
use App\Models\CabinetMedical\Medecin;
use App\Models\CabinetMedical\PlanificationMedecin;
use App\Models\CabinetMedical\Rdv;
use App\Models\CabinetMedical\Specialite;
use App\Models\CabinetMedical\SpecialiteMedecin;
use App\Models\Civilite;
use App\Models\SituationMatrimoniale;
use Livewire\Component;

class MedecinDossier extends Component
{
    public $medecins;
    public $civilite ;
    public $nom ;
    public $prenom ;
    public $situation ;
    public $date_naissance;
    public $lieu_naissance ;
    public $telephone ;
    public $titre ;
    public $specialite;
    public $categorie;
    public $adresse ;
    public $mail ;
    public $matricule;
    public $nbr_consultation_attente;
    public $nbr_rdv;
    public $rendez_vouss=[];
    public $planifications=[];
    public $consultations=[];
    public $consultation_traiters=[];
    public $consultation_en_cours=[];

    public function mount(Medecin $medecins, $id)
    {
        $id = decrypt($id);

        $medecins = Medecin::where('id', $id)->first();
        $civilite = Civilite::where('id', $medecins->civilite_id)->first();
        $situation = SituationMatrimoniale::where('id', $medecins->situation_matrimoniale_id)->first();
        $categorie = CategorieMedecin::where('id', $medecins->categorie_medicale_id)->first();
        $specialite = SpecialiteMedecin::where('id', $medecins->specialite_id)->first();
        $this->rendez_vouss=Rdv::where('medecin_id', $id)->where('etat',0)->orderBy('id',"DESC")->get();
        $this->nbr_rdv=Rdv::where('medecin_id', $id)->where('etat',0)->count();
        $this->planifications = PlanificationMedecin::where('medecin_id',$id)->where('jour_semaine','>=', date('Y-m-d'))->orderBy('id',"DESC")->get();
        $this->consultations = Consultation::where('medecin_id', $id)->where('etat',3)->orderBy('id',"DESC")->get();
        $this->consultation_en_cours = Consultation::where('medecin_id', $id)->where('etat',4)->orderBy('id',"DESC")->get();
        $this->nbr_consultation_attente=Consultation::where('medecin_id', $id)->where('etat',3)->count();

        $this->medecins = $medecins->id;
        $this->civilite =     $medecins->civilite->civilite;
        $this->nom = $medecins->nom;
        $this->prenom = $medecins->prenom;
        $this->situation =  $medecins->situation->situation_matrimoniale;
        $this->date_naissance = $medecins->date_naissance;
        $this->lieu_naissance = $medecins->lieu_naissance;
        $this->telephone = $medecins->telephone;
        $this->adresse = $medecins->adresse;
        $this->mail = $medecins->mail;
        $this->matricule = $medecins->matricule;
        $this->titre = $medecins->titre;
        $this->categorie =$medecins->categorie->categorie_medecin;
        $this->specialite =  $medecins->specialite->specialite_medecin;


    }

    public function render()
    {
        $medecin = Medecin::where('id',  $this->medecins)->first();
        return view('livewire.cabinet-medical.medecin-dossier',compact('medecin'));
    }

    public function AppelPatient($id)
    {
        $consultation=Consultation::find($id);

        $consultation->update([
            'etat'=>4
        ]);
        return redirect()->route('ad.sante.dossier.patient',encrypt($consultation->patient->id));
    }
}
