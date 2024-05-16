<?php

namespace App\Livewire\CabinetAssurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\CabinetAssurance\Groupe as CabinetAssuranceGroupe;
use Livewire\Component;

class Groupe extends Component
{
    public $groupes = [];
    public $libelle_groupe = '',$code_groupe = '';

    public function mount()
    {
            $societe_id = Auth::user()->societe_id;
            $this->groupes = CabinetAssuranceGroupe::where('societe_id', $societe_id)->get();

    }
    public function render()
    {
        return view('livewire.cabinet-assurance.groupe');
    }

    public function save()
    {

        $validated = $this->validate(
            [
                'libelle_groupe' => 'required',
                'code_groupe' => 'required'
            ]
        );
        $user_id = Auth::user()->id;
        $societe_id = Auth::user()->societe_id;

        CabinetAssurancegroupe::create([
            'code_groupe' => $validated['code_groupe'],
            'libelle_groupe' => $validated['libelle_groupe'],
            'user_id' => $user_id,
            'societe_id' => $societe_id,
        ]);

        return redirect()->route('index.groupe')->with('success', 'groupe crée avec succès');

    }
}
