<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\TarifPrestation as CabinetMedicalTarifPrestation;
use App\Models\CabinetMedical\TypePrestation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TarifPrestation extends Component
{

   
    public function render()
    {
        return view('livewire.cabinet-medical.tarif-prestation');
    }

    
}
