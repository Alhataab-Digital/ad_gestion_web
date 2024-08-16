<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\TypeAddiction as CabinetMedicalTypeAddiction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TypeAddiction extends Component
{
    public $type_addictions=[];
    public $type_addiction;


    public function mount()
    {
        $this->type_addictions=CabinetMedicalTypeAddiction::all();
    }

    public function render()
    {
        return view('livewire.cabinet-medical.type-addiction');
    }
    
    public function save()
    {

        $validated = $this->validate(
            [
                'type_addiction' => 'required',
            ]
        );
        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;

        CabinetMedicalTypeAddiction::create([
            'type_addiction' => $validated['type_addiction'],
        ]);

        return redirect()->route('ad.sante.type.addiction')->with('success', 'Type crée avec succès');

        $this->type_addiction ='';
    }

    public function deleteConfirmation($id)
    {
        dd('err'.$id);
        return redirect()->route('ad.sante.index.patient')->with('danger', 'Impossible de supprimer ce patient');

    }
}
