<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\Facturation;
use App\Models\CabinetMedical\PaiementRecu;
use App\Models\CabinetMedical\TarifMedical;
use App\Models\Caisse\Caisse;
use App\Models\Caisse\MouvementCaisse;
use App\Models\TypeReglement;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RecuConsultation extends Component
{

    public $recu_consultations;
    public $reglements;
    public $reglement;
    public $montant;
    public $recu;
    public $caisse;

    public function mount($id)
    {
        $id = decrypt($id);
        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;



        $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
        $this->caisse = Caisse::find($caisse_id);


        $this->recu_consultations = Facturation::where('id', $id)->where('societe_id', $societe_id)->first();
        $this->reglements = TypeReglement::all();
        $this->montant=$this->recu_consultations->montant;
        $this->recu=$this->recu_consultations->id;
    }


    public function render()
    {
        return view('livewire.cabinet-medical.recu-consultation');
    }

    public function paiement()
    {
        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;
        $caisse_id = Caisse::where('user_id', $user_id)->first(['id'])->id;
            $compte_caisse = Caisse::where('user_id', $user_id)->first(['compte'])->compte;
            $date_comptable = Caisse::where('user_id', $user_id)->first(['date_comptable'])->date_comptable;
            $caisse = Caisse::find($caisse_id);

        $validated = $this->validate(
            [
                'recu' => 'required',
                'reglement' => 'required',
                'montant' => 'required'
            ]);

        $recu=Facturation::where('id',$validated['recu'])->first();

        if (isset(Caisse::where('user_id', $user_id)->first(['id'])->id)) {
        if($recu->etat=="instance"){
            PaiementRecu::create([
                'montant' => $validated['montant'],
                'facturation_id' => $validated['recu'],
                'reglement_id' => $validated['reglement'],
                'user_id' => $user_id,
                'societe_id' => $societe_id,
            ]);


            $recu->update([
                'etat'=>'payé',
                'date_operation' =>$date_comptable,
            ]);

            /**
            * mise a jour de la caisse
            */


                         $compte = $compte_caisse + $validated['montant'];

                         MouvementCaisse::create([
                             'caisse_id' =>  $caisse_id,
                             'user_id' => $user_id,
                             'description' => 'Reglement consultation =>' .  $recu->tarif->libelle_tarif,
                             'entree' => $validated['montant'],
                             'solde' => $compte,
                             'date_comptable' => $date_comptable

                         ]);

                         $caisse->update([
                             'compte' => $compte,
                         ]);

         return redirect()->route('ad.sante.recu.consultation',encrypt($recu->id))->with('succes');

        }else{
            dd($validated['recu'],$validated['reglement'],$validated['montant'], $recu->etat);
        }




        }else{
            dd('caisse innexistante');
        }
    }
}
