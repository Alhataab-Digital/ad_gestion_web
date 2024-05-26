<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\Facturation;
use App\Models\CabinetMedical\PaiementRecu;
use App\Models\Users\Utilisateur;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FacturationConsultation extends Component
{

    public $facturations=[];
    public $paiements=[];
    public $utilisateur=[];
    public $telephone='';

    public function mount()
    {
            $societe_id = Auth::user()->societe_id;
            $user_id = Auth::user()->id;
            $this->utilisateur=Utilisateur::where('id',$user_id)->first();
            $this->telephone=$this->utilisateur->agence->region->indicatif;
            $this->facturations=Facturation::where('societe_id',$societe_id)->get();
            $this->paiements=PaiementRecu::where('societe_id',$societe_id)->get();

    }
    public function render()
    {
        return view('livewire.cabinet-medical.facturation-consultation');
    }
}
