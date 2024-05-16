<?php

namespace App\Livewire\CabinetMedical;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\CabinetMedical\TarifMedical;

class TarifMedicalEdit extends Component
{

    public $tarif;
    public $libelle_tarif;
    public $prix;

    public function mount(TarifMedical $tarif, $id)
    {
        $id = decrypt($id);
        $tarif = TarifMedical::where('id', $id)->first();

        $this->tarif = $tarif->id;
        $this->libelle_tarif = $tarif->libelle_tarif;
        $this->prix = $tarif->prix;
    }

    public function render()
    {
        return view('livewire.cabinet-medical.tarif-medical-edit');

    }


    public function update()
    {
        $tarif = TarifMedical::where('id', $this->tarif)->first();

        $validated = $this->validate(
            [
                'libelle_tarif' => 'required',
                'prix' => 'required'
            ]
        );

        $tarif->update([
            'libelle_tarif' => $validated['libelle_tarif'],
            'prix' => $validated['prix'],
        ]);

        return redirect()->route('ad.sante.index.tarif_medical')->with('success', 'Opération modifié avec succès');
    }
}
