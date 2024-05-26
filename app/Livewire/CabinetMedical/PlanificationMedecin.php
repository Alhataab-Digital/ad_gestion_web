<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\Medecin;
use App\Models\CabinetMedical\PlanificationMedecin as CabinetMedicalPlanificationMedecin;
use App\Models\CabinetMedical\SpecialiteMedecin;
use App\Models\CabinetMedical\TarifConsultation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PlanificationMedecin extends Component
{
    public $medecins;
    public $tarif_consultations;
    public $tarif_consultation;
    public $planifications;
    public $medecin=null, $intervention, $debut, $fin, $date;

    public $specialites=[];
    public $specialite = null;


    public function mount()
    {
        $this->medecins = Medecin::all();
        $this->specialites = SpecialiteMedecin::all();
        $this->tarif_consultations = TarifConsultation::all();
        $this->planifications=CabinetMedicalPlanificationMedecin::where('jour_semaine', date('Y-m-d'))->get();
    }

    public function updatedSpecialite($specialiteId)
    {
        $this->medecins = Medecin::where('specialite_id',$specialiteId)->get();
    }

    public function render()
    {
        return view('livewire.cabinet-medical.planification-medecin');
    }


    public function save()
    {

        $validated = $this->validate(
            [
                'specialite' => 'required',
                'medecin' => 'required',
                'tarif_consultation' => 'required',
                'date' => 'required',
                'debut' => 'required',
                'fin' => 'required',

            ]
        );

        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;
        if (isset(CabinetMedicalPlanificationMedecin::where('societe_id', $societe_id)
            ->where('specialite_id', $validated['specialite'])
            ->where('medecin_id', $validated['medecin'])
            ->where('jour_semaine', $validated['date'])
            ->where('heure_debut', $validated['debut'])->latest()->first()->id))
        {
            return redirect()->route('ad.sante.index.planification.medecin')->with('danger', 'Medecin deja planifier pour cette date');

        } else {
            CabinetMedicalPlanificationMedecin::create([
                'specialite_id' => $validated['specialite'],
                'medecin_id' => $validated['medecin'],
                'tarif_consultation_id' => $validated['tarif_consultation'],
                'jour_semaine' => $validated['date'],
                'heure_debut' => $validated['debut'],
                'heure_fin' => $validated['fin'],
                'user_id' => $user_id,
                'societe_id' => $societe_id,
            ]);

            return redirect()->route('ad.sante.index.planification.medecin')->with('success', 'planification crée avec succès');
        }
    }
}
