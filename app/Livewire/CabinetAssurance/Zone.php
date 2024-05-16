<?php

namespace App\Livewire\CabinetAssurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\CabinetAssurance\Zone as CabinetAssuranceZone;
use Livewire\Component;

class Zone extends Component
{
    public $zones = [];
    public $libelle_zone = '',$code_zone = '';

    public function mount()
    {
            $societe_id = Auth::user()->societe_id;
            $this->zones = CabinetAssuranceZone::where('societe_id', $societe_id)->get();

    }
    public function render()
    {
        return view('livewire.cabinet-assurance.zone');
    }

    public function save()
    {

        $validated = $this->validate(
            [
                'libelle_zone' => 'required',
                'code_zone' => 'required'
            ]
        );
        $user_id = Auth::user()->id;
        $societe_id = Auth::user()->societe_id;

        CabinetAssuranceZone::create([
            'code_zone' => $validated['code_zone'],
            'libelle_zone' => $validated['libelle_zone'],
            'user_id' => $user_id,
            'societe_id' => $societe_id,
        ]);

        return redirect()->route('index.zone')->with('success', 'Zone crée avec succès');

    }
}
