<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\SpecialiteMedecin;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SpecialiteMedicale extends Component
{
    public $specialites=[];
    public $specialite;

    public function mount()
    {
        $this->specialites=SpecialiteMedecin::all();
    }

    public function render()
    {
        return view('livewire.cabinet-medical.specialite-medicale');
    }

    public function save()
    {

        $validated = $this->validate(
            [
                'specialite' => 'required',
                'description' => ''
            ]
        );
        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;

        SpecialiteMedecin::create([
            'specialite_medecin' => $validated['specialite'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('ad.sante.specialite.medicale')->with('success', 'Spécialité crée avec succès');

        $this->specialite = '';
    }
}
