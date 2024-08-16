<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\TypeExamen as CabinetMedicalTypeExamen;
use Livewire\Component;

class TypeExamen extends Component
{
    public $type_examens=[];
    public $type_examen;
    public $tarif_examen;

    public function mount()
    {
        $this->type_examens=CabinetMedicalTypeExamen::all();
    }
    public function render()
    {
        return view('livewire.cabinet-medical.type-examen');
    }
}
