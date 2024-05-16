<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\Consultation;
use App\Models\CabinetMedical\Facturation;
use App\Models\CabinetMedical\Patient;
use App\Models\CabinetMedical\PlanificationMedecin;
use App\Models\CabinetMedical\TarifMedical;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class DossierConsultation extends Component
{
    public $patients;
    public $civilite ;
    public $nom ;
    public $prenom ;
    public $situation;
    public $age;
    public $telephone;
    public $adresse;
    public $tarifs;
    public $planifications = [];
    public $consultation = null;
    public $planification = null;


    public function mount(Patient $patients, $id)
    {
        $id = decrypt($id);

        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;
        $this->tarifs = TarifMedical::where('societe_id', $societe_id)->get();
        $patients = Patient::where('id', $id)->first();

        $this->patients = $patients->id;
        $this->civilite = $patients->civilite;
        $this->nom = $patients->nom;
        $this->prenom = $patients->prenom;
        $this->situation = $patients->situation;
        $this->age = $patients->age;
        $this->telephone = $patients->telephone;
        $this->adresse = $patients->adresse;

    }
    public function updatedConsultation($tarifId)
    {

        $this->planifications = PlanificationMedecin::where('tarif_medical_id', $tarifId)
        ->where('jour_semaine',date('Y-m-d'))
        ->get();
        $this->planification = null;
    }

    public function render()
    {
        return view('livewire.cabinet-medical.dossier-consultation');
    }


    public function enregistrer()
    {
        $patients = Patient::where('id', $this->patients)->first();
        $validated = $this->validate(
            [
                'civilite'=>'required',
                'nom'=> 'required',
                'prenom'=> 'required',
                'situation'=> 'required',
                'age'=> 'required',
                'adresse'=> 'required',
                'consultation'=> 'required',
                'planification'=> 'required',
            ]
        );
        // dd($validated['consultation']);
        $this->tarifs=TarifMedical::where("id",$validated['consultation'])->first();
        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;

        $patients->update([
            'civilite'=> $validated['civilite'],
            'nom'=> $validated['nom'],
            'prenom'=>$validated['prenom'],
            'situation'=> $validated['situation'],
            'age'=> $validated['age'],
            'adresse'=> $validated['adresse'],
        ]);
if(isset(Facturation::where('patient_id',$this->patients)->where('etat','instance')->latest()->first()->id)){

    return redirect()->route('ad.sante.index.consultation')->with('danger', "Ce patient à une consultation en instance");

}else{

    Consultation::create([
        'patient_id' => $this->patients,
        'planification_id' => $validated['planification'],
        'tarif_medical_id' => $this->tarifs->id,
        'user_id' => $user_id,
        'societe_id' => $societe_id,
    ]);

    Facturation::create([
        'etat' => 'instance',
        'montant' => $this->tarifs->prix,
        'patient_id' => $this->patients,
        'planification_id' => $validated['planification'],
        'tarif_id' => $this->tarifs->id,
        'user_id' => $user_id,
        'societe_id' => $societe_id,
    ]);
    $recu=Facturation::where('user_id',$user_id)->latest('id')->first();
    return redirect()->route('ad.sante.recu.consultation',encrypt($recu->id))->with('succes');
}


    }
}
