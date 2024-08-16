<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\TypeConsultation as CabinetMedicalTypeConsultation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TypeConsultation extends Component
{
    public $type_consultations=[];
    public $type_consultation;
    public $tarif_consultation;

    public function mount()
    {
        $this->type_consultations=CabinetMedicalTypeConsultation::all();
    }
    public function render()
    {
        return view('livewire.cabinet-medical.type-consultation');
    }

    public function save()
    {

        $validated = $this->validate(
            [
                'type_consultation' => 'required',
                'tarif_consultation' => 'required |numeric'
            ]
        );
        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;

        CabinetMedicalTypeConsultation::create([
            'type_consultation' => $validated['type_consultation'],
            'tarif_consultation' => $validated['tarif_consultation'],
        ]);

        return redirect()->route('ad.sante.type.consultation')->with('success', 'Type crée avec succès');

        $this->type_consultation ='';
        $this->tarif_consultation = '';
    }

    public function deleteConfirmation($id)
    {
        dd('err'.$id);
        return redirect()->route('ad.sante.index.patient')->with('danger', 'Impossible de supprimer ce patient');

    }
}
