<?php

namespace App\Livewire\CabinetAssurance;

use App\Http\Controllers\CabinetAssurance\ClasseController;
use App\Models\CabinetAssurance\Classe as CabinetAssuranceClasse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Classe extends Component
{

    public $classes = [];
    public $libelle_classe = '',$code_classe = '';

    public function mount()
    {
            $societe_id = Auth::user()->societe_id;
            $this->classes = CabinetAssuranceClasse::where('societe_id', $societe_id)->get();

    }
    public function render()
    {
        return view('livewire.cabinet-assurance.classe');
    }

    public function save()
    {

        $validated = $this->validate(
            [
                'libelle_classe' => 'required',
                'code_classe' => 'required'
            ]
        );
        $user_id = Auth::user()->id;
        $societe_id = Auth::user()->societe_id;

        CabinetAssuranceClasse::create([
            'code_classe' => $validated['code_classe'],
            'libelle_classe' => $validated['libelle_classe'],
            'user_id' => $user_id,
            'societe_id' => $societe_id,
        ]);

        return redirect()->route('index.classe')->with('success', 'classe crée avec succès');

    }
}
