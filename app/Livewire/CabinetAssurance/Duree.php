<?php

namespace App\Livewire\CabinetAssurance;

use App\Models\CabinetAssurance\Duree as CabinetAssuranceDuree;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Duree extends Component
{
    public $durees = [];
    public $libelle_duree = '',$nbr_duree = '';

    public function mount()
    {
            $societe_id = Auth::user()->societe_id;
            $this->durees = CabinetAssuranceDuree::where('societe_id', $societe_id)->get();

    }
    public function render()
    {
        return view('livewire.cabinet-assurance.duree');
    }

    public function save()
    {

        $validated = $this->validate(
            [
                'libelle_duree' => 'required',
                'nbr_duree' => 'required'
            ]
        );
        $user_id = Auth::user()->id;
        $societe_id = Auth::user()->societe_id;

        CabinetAssuranceduree::create([
            'nbr_duree' => $validated['nbr_duree'],
            'libelle_duree' => $validated['libelle_duree'],
            'user_id' => $user_id,
            'societe_id' => $societe_id,
        ]);

        return redirect()->route('index.duree')->with('success', 'duree crée avec succès');

    }
}
