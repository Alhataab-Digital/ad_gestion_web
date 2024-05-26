<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\CategorieMedecin;
use Livewire\Component;

class CategorieMedicale extends Component
{
    public $categories=[];

    public function mount()
    {
        $this->categories=CategorieMedecin::all();
    }
    
    public function render()
    {
        return view('livewire.cabinet-medical.categorie-medicale');
    }
}
