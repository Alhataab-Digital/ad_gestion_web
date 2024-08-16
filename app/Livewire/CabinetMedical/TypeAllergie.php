<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\TypeAllergie as CabinetMedicalTypeAllergie;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TypeAllergie extends Component
{
    public $type_allergies=[];
    public $type_allergie;

    public function mount()
    {
        $this->type_allergies=CabinetMedicalTypeAllergie::all();
    }

    public function render()
    {
        return view('livewire.cabinet-medical.type-allergie');
    }

    public function save()
    {

        $validated = $this->validate(
            [
                'type_allergie' => 'required',
            ]
        );
        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;

        CabinetMedicalTypeAllergie::create([
            'type_allergie' => $validated['type_allergie'],
        ]);

        return redirect()->route('ad.sante.type.allergie')->with('success', 'Type crée avec succès');

        $this->type_allergie ='';
    }

    public function deleteConfirmation($id)
    {
        dd('err'.$id);
        return redirect()->route('ad.sante.index.patient')->with('danger', 'Impossible de supprimer ce patient');

    }
}
