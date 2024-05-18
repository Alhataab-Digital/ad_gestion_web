<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\Consultation;
use App\Models\CabinetMedical\Medecin;
use App\Models\CabinetMedical\PlanificationMedecin;
use Livewire\Component;

class MedecinDossier extends Component
{
    public $medecins;
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
    public $planifications=[];
    public $consutlations=[];
    public $consutlation_traiters=[];

    public function mount(Medecin $medecins, $id)
    {
        $id = decrypt($id);

        $medecins = Medecin::where('id', $id)->first();

        $this->planifications = PlanificationMedecin::where('medecin_id',$id)->where('jour_semaine', date('Y-m-d'))->get();
        $this->consutlations = Consultation::where('medecin_id', $id)->where('etat', '0')->get();
        $this->consutlation_traiters = Consultation::where('medecin_id', $id)->where('etat', '1')->get();


        $this->medecins = $medecins->id;
        $this->civilite = $medecins->civilite;
        $this->nom = $medecins->nom;
        $this->prenom = $medecins->prenom;
        $this->situation = $medecins->situation;
        $this->age = $medecins->age;
        $this->telephone = $medecins->telephone;
        $this->adresse = $medecins->adresse;
        $this->taille = $medecins->taille;
        $this->poid = $medecins->poid;
        $this->mail = $medecins->mail;
        $this->password = $medecins->password;
    }

    public function render()
    {
        $medecin = Medecin::where('id',  $this->medecins)->first();
        return view('livewire.cabinet-medical.medecin-dossier',compact('medecin'));
    }
}
