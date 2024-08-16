<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\TypeVaccin as CabinetMedicalTypeVaccin;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TypeVaccin extends Component
{
    public $type_vaccins=[];
    public $type_vaccin;

    public function mount()
    {
        $this->type_vaccins=CabinetMedicalTypeVaccin::all();
    }

    public function render()
    {
        return view('livewire.cabinet-medical.type-vaccin');
    }

    public function save()
    {

        $validated = $this->validate(
            [
                'type_vaccin' => 'required',
            ]
        );
        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;

        CabinetMedicalTypeVaccin::create([
            'type_vaccin' => $validated['type_vaccin'],
        ]);

        return redirect()->route('ad.sante.type.vaccin')->with('success', 'Type crée avec succès');

        $this->type_vaccin ='';
    }

    public function deleteConfirmation($id)
    {
        dd('err'.$id);
        return redirect()->route('ad.sante.index.patient')->with('danger', 'Impossible de supprimer ce patient');

    }
}
