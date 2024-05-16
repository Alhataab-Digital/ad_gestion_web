<?php

namespace App\Livewire\CabinetAssurance;

use App\Models\CabinetAssurance\Puissance as CabinetAssurancePuissance;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Puissance extends Component
{
    public $puissances = [];
    public $devise_puissance = '',$valeur_puissance = '';

    public function mount()
    {
            $societe_id = Auth::user()->societe_id;
            $this->puissances = CabinetAssurancePuissance::where('societe_id', $societe_id)->get();

    }

    public function render()
    {
        return view('livewire.cabinet-assurance.puissance');
    }

    public function save()
    {

        $validated = $this->validate(
            [
                'devise_puissance' => 'required',
                'valeur_puissance' => 'required'
            ]
        );
        $user_id = Auth::user()->id;
        $societe_id = Auth::user()->societe_id;

        CabinetAssurancePuissance::create([
            'valeur_puissance' => $validated['valeur_puissance'],
            'devise_puissance' => $validated['devise_puissance'],
            'user_id' => $user_id,
            'societe_id' => $societe_id,
        ]);

        return redirect()->route('index.puissance')->with('success', 'puissance crée avec succès');

    }

}
