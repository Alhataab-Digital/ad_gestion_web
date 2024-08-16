<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\TarifConsultation as CabinetMedicalTarifConsultation;
use App\Models\CabinetMedical\TypeConsultation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TarifConsultation extends Component
{
    public $tarif_consultations = [];
    public $type_consultations=[];
    public $type_consultation= '';
    public $montant = '';

    public function mount()
    {

            $societe_id = Auth::user()->societe_id;
            $this->type_consultations = TypeConsultation::all();
            $this->tarif_consultations = CabinetMedicalTarifConsultation::where('societe_id', $societe_id)->get();

    }

    public function render()
    {
        return view('livewire.cabinet-medical.tarif-consultation');
    }

    public function save()
    {

        $validated = $this->validate(
            [
                'type_consultation' => 'required',
                'montant' => 'required'
            ]
        );
        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;

        CabinetMedicalTarifConsultation::create([
            'type_consultation_id' => $validated['type_consultation'],
            'montant' => $validated['montant'],
            'user_id' => $user_id,
            'societe_id' => $societe_id,
        ]);

        return redirect()->route('ad.sante.tarif.consultation')->with('success', 'Tarif crée avec succès');

        $this->type_consultation ='';
        $this->montant = '';
    }

    public function deleteConfirmation($id)
    {
        dd('err'.$id);
        return redirect()->route('ad.sante.index.patient')->with('danger', 'Impossible de supprimer ce patient');

    }
}
