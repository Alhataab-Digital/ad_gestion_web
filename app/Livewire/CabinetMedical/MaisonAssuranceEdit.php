<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\ContratAssurance;
use App\Models\CabinetMedical\MaisonAssurance;
use App\Models\CabinetMedical\TarifConsultation;
use App\Models\CabinetMedical\TypeConsultation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MaisonAssuranceEdit extends Component
{
    public $maison_assurance, $maison_assurance_id;
    public $tarif_consultations=[];
    public $contrat_assurances=[];
    public $numero_contrat;
    public $date_debut;
    public $date_fin;
    public $taux_couverture;
    public $telephone;
    public $adresse;
    public $mail;


    public function mount($id)
    {
        $id=decrypt($id);

        $assureur=MaisonAssurance::find($id);
        $this->tarif_consultations=TarifConsultation::all();
        $this->contrat_assurances=ContratAssurance::where('maison_assurance_id',$id)->get();
        $this->maison_assurance_id=$assureur->id;
        $this->maison_assurance=$assureur->maison_assurance;
        $this->telephone=$assureur->telephone;
        $this->adresse=$assureur->adresse;
        $this->mail=$assureur->mail;

        // dd($id);
    }
    public function render()
    {
        return view('livewire.cabinet-medical.maison-assurance-edit');
    }

    public function update()
    {
        $maison_assurance = MaisonAssurance::where('id', $this->maison_assurance_id)->first();
// dd($maison_assurance);
        $validated = $this->validate(
            [
                'maison_assurance'=>'required',
                'telephone'=> 'required',
                'adresse'=> 'required',
                'mail'=> 'required',

            ]
        );

        $maison_assurance->update([
            'maison_assurance'=> $validated['maison_assurance'],
            'telephone'=> $validated['telephone'],
            'adresse'=>$validated['adresse'],
            'mail'=> $validated['mail'],
        ]);

        return redirect()->route('ad.sante.maison.assurance.edit',encrypt($maison_assurance->id))->with('success', 'Opération modifié avec succès');
    }

    public function saveContrat()
    {
        $maison_assurance = MaisonAssurance::where('id', $this->maison_assurance_id)->first();
        // dd($maison_assurance);


        $validated =  $this->validate(
            [
                'numero_contrat'=>'required',
                'date_debut'=> 'required',
                'date_fin'=> 'required',
                'taux_couverture'=> 'required',

            ]
        );

        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;
        // dd($validated['tarif_consultation'],
        // $validated['date_debut'],
        // $validated['date_fin'],
        // $validated['taux_couverture'],
        // $maison_assurance->id
        // );
        ContratAssurance::create([

            'maison_assurance_id'=>$maison_assurance->id,
            'numero_contrat'=> $validated['numero_contrat'],
            'date_debut'=> $validated['date_debut'],
            'date_fin'=>$validated['date_fin'],
            'taux_couverture'=> $validated['taux_couverture'],
            'user_id'=> $user_id,
            'societe_id' => $societe_id,
    ]);

    return redirect()->route('ad.sante.maison.assurance.edit',encrypt($maison_assurance->id))->with('success', 'Contrat enregisté avec succès');
    }
}
