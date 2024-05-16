<?php

namespace App\Livewire\CabinetAssurance;

use App\Models\CabinetAssurance\Energie as CabinetAssuranceEnergie;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Energie extends Component
{
    public $energies = [];
    public $libelle_energie = '';

    public function mount()
    {
            $societe_id = Auth::user()->societe_id;
            $this->energies = CabinetAssuranceenergie::where('societe_id', $societe_id)->get();

    }
    public function render()
    {
        return view('livewire.cabinet-assurance.energie');
    }

    public function save()
    {

        $validated = $this->validate(
            [
                'libelle_energie' => 'required',
            ]
        );
        $user_id = Auth::user()->id;
        $societe_id = Auth::user()->societe_id;

        CabinetAssuranceEnergie::create([
            'libelle_energie' => $validated['libelle_energie'],
            'user_id' => $user_id,
            'societe_id' => $societe_id,
        ]);

        return redirect()->route('index.energie')->with('success', 'energie crée avec succès');

    }
}
