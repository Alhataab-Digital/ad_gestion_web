<?php

namespace App\Livewire\CabinetMedical;

use Livewire\Component;

class FacturationPrestation extends Component
{
    public $numero_patient='';


    public function render()
    {
        return view('livewire.cabinet-medical.facturation-prestation');
    }

    public function save()
    {
        $validated = $this->validate(
            [
                'numero_patient'=> 'required | min:8|max:12',
            ]
        );
    }
}
