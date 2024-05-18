<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\Consultation;
use App\Models\CabinetMedical\Patient;
use Livewire\Component;

class TraitementConsultation extends Component
{
    public $patients;
    public $motif;
    public $examen_clinique;
    public $examen_biologique;
    public $examen_radiologique;
    public $diagnostique;
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


    public function mount(Patient $patients, $id)
    {
        $id=decrypt($id);
        $this->consultation =Consultation::where('id', $id)->first();
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

    }
    public function render()
    {
        return view('livewire.cabinet-medical.traitement-consultation');
    }

    public function save()
    {
        // dd($this->consultation->id);
        $validated = $this->validate(
            [
                'motif' => 'required',
                'examen_biologique' => 'required',
                'examen_radiologique' => 'required',
                'examen_clinique' => 'required',
                'diagnostique' => 'required',
                'traitement' => 'required',
            ]);
            $traitement=Consultation::where('id',$this->consultation->id)->first();

            $traitement->update([
                'motif'=> $validated['motif'],
                'examen_biologique'=> $validated['examen_biologique'],
                'examen_radiologique'=>$validated['examen_radiologique'],
                'examen_clinique'=> $validated['examen_clinique'],
                'diagnostique'=> $validated['diagnostique'],
                'traitement'=> $validated['traitement'],
                'etat'=> 1,
            ]);

            //
            return redirect()->route('ad.sante.dossier.medecin',encrypt($this->consultation->medecin_id))->with('succes');
           

    }
}
