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
    public $facturations_non_paye=[];
    public $paiements=[];
    public $utilisateur=[];
    public $telephone='';

    public function mount()
    {
            $societe_id = Auth::user()->societe_id;
            $user_id = Auth::user()->id;
            $this->utilisateur=Utilisateur::where('id',$user_id)->first();
            $this->telephone=$this->utilisateur->agence->region->indicatif;
            $this->facturations_non_paye=Facturation::where('societe_id',$societe_id)->where('etat',0)->orderBy('id',"DESC")->get();
            $this->facturations=Facturation::where('societe_id',$societe_id)->where('etat','!=',0)->orderBy('id',"DESC")->get();
            $this->paiements=PaiementRecu::where('societe_id',$societe_id)->orderBy('id',"DESC")->get();

    }
    public function render()
    {
        return view('livewire.cabinet-medical.facturation-consultation');
    }
}
