<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\TypePrestation as CabinetMedicalTypePrestation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TypePrestation extends Component
{

    public $type_prestations=[];
    public $type_prestation;
    public $tarif_prestation;

    public function mount()
    {
        $this->type_prestations=CabinetMedicalTypeprestation::all();
    }

    public function render()
    {
        return view('livewire.cabinet-medical.type-prestation');
    }

    public function save()
    {

        $validated = $this->validate(
            [
                'type_prestation' => 'required',
                'tarif_prestation' => 'required |numeric'
            ]
        );
        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;

       CabinetMedicalTypePrestation::create([
            'type_prestation' => $validated['type_prestation'],
            'tarif_prestation' => $validated['tarif_prestation'],
        ]);

        return redirect()->route('ad.sante.type.prestation')->with('success', 'Type crée avec succès');

        $this->type_prestation ='';
        $this->tarif_prestation = '';
    }

    public function deleteConfirmation($id)
    {
        dd('err'.$id);
        return redirect()->route('ad.sante.index.patient')->with('danger', 'Impossible de supprimer ce patient');

    }
}
