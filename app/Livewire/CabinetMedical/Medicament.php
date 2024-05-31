<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\Medicament as CabinetMedicalMedicament;
use Livewire\Component;

class Medicament extends Component
{
    public $medicaments=[];

    public function mount()
    {
        $this->medicaments=CabinetMedicalMedicament::all();
    }
    public function render()
    {
        return view('livewire.cabinet-medical.medicament');
    }
}
