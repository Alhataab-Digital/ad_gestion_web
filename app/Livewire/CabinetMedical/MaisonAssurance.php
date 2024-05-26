<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\MaisonAssurance as CabinetMedicalMaisonAssurance;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MaisonAssurance extends Component
{
    public $maison_assurances=[];
    public $maison_assurance;
    public $telephone;
    public $adresse;
    public $mail;


    public function mount()
    {
        $this->maison_assurances=CabinetMedicalMaisonAssurance::all();
    }

    public function render()
    {
        return view('livewire.cabinet-medical.maison-assurance');
    }

    public function save()
    {
        $validated = $this->validate(
            [
                'maison_assurance'=>'required',
                'telephone'=> 'required',
                'adresse'=> 'required',
                'mail'=> 'required',

            ]
        );

        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;

        CabinetMedicalMaisonAssurance::create([
            'maison_assurance'=> $validated['maison_assurance'],
            'adresse'=> $validated['adresse'],
            'telephone'=> $validated['telephone'],
            'mail'=>$validated['mail'],
            'user_id'=> $user_id,
            'societe_id' => $societe_id,
    ]);

    return redirect()->route('ad.sante.maison.assurance.medicale')->with('success', 'maison assurance crée avec succès');
    }
}
