<?php

namespace App\Livewire\CabinetAssurance;

use App\Models\CabinetAssurance\Categorie as CabinetAssuranceCategorie;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Categorie extends Component
{
    public $categories = [];
    public $libelle_categorie = '',$code_categorie = '';

    public function mount()
    {
            $societe_id = Auth::user()->societe_id;
            $this->categories = CabinetAssuranceCategorie::where('societe_id', $societe_id)->get();

    }
    public function render()
    {
        return view('livewire.cabinet-assurance.categorie');
    }

    public function save()
    {

        $validated = $this->validate(
            [
                'libelle_categorie' => 'required',
                'code_categorie' => 'required'
            ]
        );
        $user_id = Auth::user()->id;
        $societe_id = Auth::user()->societe_id;

        CabinetAssuranceCategorie::create([
            'code_categorie' => $validated['code_categorie'],
            'libelle_categorie' => $validated['libelle_categorie'],
            'user_id' => $user_id,
            'societe_id' => $societe_id,
        ]);

        return redirect()->route('index.categorie')->with('success', 'categorie crée avec succès');

    }
}
