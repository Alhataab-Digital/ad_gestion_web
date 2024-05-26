<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\Consultation as CabinetMedicalConsultation;
use App\Models\CabinetMedical\Patient;
use App\Models\Users\Utilisateur;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Consultation extends Component
{
    public $utilisateur=[];
    public $consultations=[];
    public $telephone='';

public function mount()
{
        $user_id = Auth::user()->id;
        $this->utilisateur=Utilisateur::where('id',$user_id)->first();
        $this->telephone=$this->utilisateur->agence->region->indicatif;
        $this->consultations=CabinetMedicalConsultation::all();
}
    public function render()
    {
        return view('livewire.cabinet-medical.consultation');
    }

    // public function valider(){

    //     $validated = $this->validate(
    //         [
    //             'telephone'=> 'required | min:8|max:12',
    //         ]
    //     );

    //     $societe_id = Auth::user()->societe_id;
    //     $user_id = Auth::user()->id;
    //     $validated['telephone'];
    //     $patient=Patient::where('telephone',$validated['telephone'])->first();
    //     if(isset($patient->telephone)){

    //         return redirect()->route('ad.sante.dossier.consultation',encrypt($patient->id));

    //     }else{

    //         Patient::create([
    //             'telephone'=> $validated['telephone'],
    //             'user_id'=> $user_id,
    //             'societe_id' => $societe_id,
    //         ]);

    //         $patient=Patient::where('telephone',$validated['telephone'])->first();
    //         if(isset($patient->telephone)){
    //         return redirect()->route('ad.sante.dossier.consultation',encrypt($patient->id));
    //         }
    //         return redirect()->route('ad.sante.index.consultation')->with('success', "Le patient n'existe pas");;
    //     }


    // }
}
