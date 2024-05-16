<?php

namespace App\Livewire\CabinetAssurance;

use App\Models\CabinetAssurance\Classe;
use App\Models\CabinetAssurance\Energie;
use App\Models\CabinetAssurance\Groupe;
use App\Models\CabinetAssurance\PrimeNet as CabinetAssurancePrimeNet;
use App\Models\CabinetAssurance\Puissance;
use App\Models\CabinetAssurance\Usage;
use App\Models\CabinetAssurance\Zone;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PrimeNet extends Component
{

    public $prime_nets = [];
    public $usages = [];
    public $puissances = [];
    public $energies = [];
    public $zones = [];
    public $groupes = [];
    public $classes = [];

    public $usage='',$puissance='',$energie='',$zone='',$groupe='',$classe='',$montant='';

    public function mount()
    {
            $societe_id = Auth::user()->societe_id;
            $this->prime_nets = CabinetAssurancePrimeNet::where('societe_id', $societe_id)->get();
            $this->usages = Usage::where('societe_id', $societe_id)->get();
            $this->puissances = Puissance::where('societe_id', $societe_id)->get();
            $this->energies = Energie::where('societe_id', $societe_id)->get();
            $this->zones = Zone::where('societe_id', $societe_id)->get();
            $this->groupes = Groupe::where('societe_id', $societe_id)->get();
            $this->classes = Classe::where('societe_id', $societe_id)->get();
    }

    public function render()
    {
        return view('livewire.cabinet-assurance.prime-net');
    }

    public function save()
    {

        $validated = $this->validate(
            [
                'usage' => 'required',
                'puissance' => 'required',
                'energie' => 'required',
                'zone' => 'required',
                'groupe' => 'required',
                'classe' => 'required',
                'montant' => 'required',
            ]
        );
        $user_id = Auth::user()->id;
        $societe_id = Auth::user()->societe_id;

        CabinetAssurancePrimeNet::create([
            'usage_id' => $validated['usage'],
            'puissance_id' => $validated['puissance'],
            'energie_id' => $validated['energie'],
            'zone_id' => $validated['zone'],
            'groupe_id' => $validated['groupe'],
            'classe_id' => $validated['classe'],
            'montant' => $validated['montant'],
            'user_id' => $user_id,
            'societe_id' => $societe_id,
        ]);

        return redirect()->route('index.prime_net')->with('success', 'prime net crée avec succès');

    }
}
