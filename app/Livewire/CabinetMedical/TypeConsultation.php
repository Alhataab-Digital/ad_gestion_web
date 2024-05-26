<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\TypeConsultation as CabinetMedicalTypeConsultation;
use Livewire\Component;

class TypeConsultation extends Component
{
    public $type_consultations=[];

    public function mount()
    {
        $this->type_consultations=CabinetMedicalTypeConsultation::all();
    }
    public function render()
    {
        return view('livewire.cabinet-medical.type-consultation');
    }
}
