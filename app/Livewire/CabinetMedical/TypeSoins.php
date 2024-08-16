<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\TypeSoins as CabinetMedicalTypeSoins;
use Livewire\Component;

class TypeSoins extends Component
{

    public $type_soinss=[];
    public $type_soins;
    public $tarif_soins;

    public function mount()
    {
        $this->type_soinss=CabinetMedicalTypeSoins::all();
    }
    
    public function render()
    {
        return view('livewire.cabinet-medical.type-soins');
    }
}
