<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\TypeHospitalisation as CabinetMedicalTypeHospitalisation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TypeHospitalisation extends Component
{
    public $type_hospitalisations=[];
    public $type_hospitalisation;
    public $tarif_hospitalisation;

    public function mount()
    {
        $this->type_hospitalisations=CabinetMedicalTypeHospitalisation::all();
    }

    public function render()
    {
        return view('livewire.cabinet-medical.type-hospitalisation');
    }

    public function save()
    {

        $validated = $this->validate(
            [
                'type_hospitalisation' => 'required',
                'tarif_hospitalisation' => 'required |numeric'
            ]
        );
        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;

       CabinetMedicalTypehospitalisation::create([
            'type_hospitalisation' => $validated['type_hospitalisation'],
            'tarif_hospitalisation' => $validated['tarif_hospitalisation'],
        ]);

        return redirect()->route('ad.sante.type.hospitalisation')->with('success', 'Type crée avec succès');

        $this->type_hospitalisation ='';
        $this->tarif_hospitalisation = '';
    }

    public function deleteConfirmation($id)
    {
        dd('err'.$id);
        return redirect()->route('ad.sante.index.patient')->with('danger', 'Impossible de supprimer ce patient');

    }
}
