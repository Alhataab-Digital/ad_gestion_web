<?php

namespace App\Livewire\CabinetAssurance;

use App\Models\CabinetAssurance\Usage as CabinetAssuranceUsage;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Usage extends Component
{
    public $usages = [];
    public $libelle_usage = '',$code_usage = '';

    public function mount()
    {
            $societe_id = Auth::user()->societe_id;
            $this->usages = CabinetAssuranceUsage::where('societe_id', $societe_id)->get();

    }
    public function render()
    {
        return view('livewire.cabinet-assurance.usage');
    }

    public function save()
    {

        $validated = $this->validate(
            [
                'libelle_usage' => 'required',
                'code_usage' => 'required'
            ]
        );
        $user_id = Auth::user()->id;
        $societe_id = Auth::user()->societe_id;

        CabinetAssuranceusage::create([
            'code_usage' => $validated['code_usage'],
            'libelle_usage' => $validated['libelle_usage'],
            'user_id' => $user_id,
            'societe_id' => $societe_id,
        ]);

        return redirect()->route('index.usage')->with('success', 'usage crée avec succès');

    }
}
