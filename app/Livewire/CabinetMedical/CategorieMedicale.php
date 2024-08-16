<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\CategorieMedecin;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CategorieMedicale extends Component
{
    public $categories=[];
    public $categorie;

    public function mount()
    {
        $this->categories=CategorieMedecin::all();
    }

    public function render()
    {
        return view('livewire.cabinet-medical.categorie-medicale');
    }

    public function save()
    {

        $validated = $this->validate(
            [
                'categorie' => 'required',
            ]
        );
        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;

        CategorieMedecin::create([
            'categorie_medecin' => $validated['categorie'],
        ]);

        return redirect()->route('ad.sante.categorie.medicale')->with('success', 'Categorie crée avec succès');

        $this->categorie = '';
    }
}
