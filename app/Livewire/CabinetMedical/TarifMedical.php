<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\TarifMedical as CabinetMedicalTarifMedical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Livewire;

class TarifMedical extends Component
{

    public $tarifs = [];
    public function mount()
    {

            $societe_id = Auth::user()->societe_id;
            $this->tarifs = CabinetMedicalTarifMedical::where('societe_id', $societe_id)->get();

    }

    public $libelle_tarif = '';
    public $prix = '';
    public $libelle_edit_id;

    public function render()
    {

        return view('livewire.cabinet-medical.tarif-medical');
    }

    public function save()
    {

        $validated = $this->validate(
            [
                'libelle_tarif' => 'required',
                'prix' => 'required'
            ]
        );
        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;

        CabinetMedicalTarifMedical::create([
            'libelle_tarif' => $validated['libelle_tarif'],
            'prix' => $validated['prix'],
            'user_id' => $user_id,
            'societe_id' => $societe_id,
        ]);

        return redirect()->route('ad.sante.index.tarif_medical')->with('success', 'Tarif crée avec succès');

        $this->libelle_edit_id ='';
        $this->prix = '';
    }
    public function editTarif($id)
    {
        $tarif=CabinetMedicalTarifMedical::where('id',$id)->first();
        if($tarif){
            $this->libelle_edit_id = $tarif->id;
            $this->libelle_tarif = $tarif->libelle_tarif;
            $this->prix = $tarif->prix;
        }
        else{
            return redirect()->route('ad.sante.index.tarif_medical');
        }



    }

    public function deleteConfirmation($id)
    {
        $tarif = CabinetMedicalTarifMedical::where('id', $id)->first();
        $tarif->delete();
        return redirect()->route('ad.sante.index.tarif_medical')->with('danger', 'Opération supprimer avec succès');
    }
}
