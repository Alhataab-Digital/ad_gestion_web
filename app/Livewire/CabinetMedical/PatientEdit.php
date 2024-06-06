<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\ContratAssurance;
use App\Models\CabinetMedical\MaisonAssurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\CabinetMedical\Patient;
use App\Models\CabinetMedical\PriseEnCharge;
use App\Models\Civilite;
use App\Models\SituationMatrimoniale;
use Livewire\Component;

class PatientEdit extends Component
{

    public $civilites = [];
    public $situations = [];

    public $numero_patient;
    public $patients;
    public $civilite;
    public $nom;
    public $prenom;
    public $situation;
    public $profession;
    public $date_naissance;
    public $lieu_naissance;
    public $telephone;
    public $adresse;
    public $complement_adresse;
    public $taille;
    public $poid;
    public $temperature;
    public $groupe_sanguin;
    public $mail;
    public $icm;
    public $personne_contact;
    public $prise_en_charges=[];
    public $maison_assurances = [];
    public $contrat_assurances = [];
    public $maison_assurance;
    public $confirm_assurer;
    public $numero_assurer;
    public $nom_assurer;

    public function mount(Patient $patients, $id)
    {
        $id = decrypt($id);
        $patients = Patient::where('id', $id)->first();

        $this->civilites = Civilite::all();
        $this->situations = SituationMatrimoniale::all();
        $this->maison_assurances = MaisonAssurance::all();
        $prise_en_charge = PriseEnCharge::where('patient_id', $id)->first();
        if( isset($prise_en_charge)){
        $this->maison_assurance = MaisonAssurance::find($prise_en_charge->maison_assurance_id);
        $this->contrat_assurances=ContratAssurance::where('maison_assurance_id', $this->maison_assurance->id)->get();
        }
        $this->numero_patient = $patients->numero_patient;
        $this->patients = $patients->id;
        $this->civilite = $patients->civilite_id;
        $this->nom = $patients->nom;
        $this->prenom = $patients->prenom;
        $this->situation = $patients->situation_matrimoniale_id;
        $this->profession = $patients->profession;
        $this->date_naissance = $patients->date_naissance;
        $this->lieu_naissance = $patients->lieu_naissance;
        $this->telephone = $patients->telephone;
        $this->adresse = $patients->adresse;
        $this->complement_adresse = $patients->complement_adresse;
        $this->taille = $patients->taille;
        $this->temperature = $patients->temperature;
        $this->poid = $patients->poid;
        $this->mail = $patients->mail;
        $this->groupe_sanguin = $patients->groupe_sanguin;
        $this->personne_contact = $patients->personne_contact;
        if (isset($patients->taille) && isset($patients->poid)) {
            $icm = round($patients->poid / ($patients->taille * $patients->taille));
            if ($icm < 16.5) {
                $this->icm = $icm . ' (Maigreur extrême – dénutrition)';
            }
            if (16.5 < $icm && $icm < 18.5) {
                $this->icm = $icm . ' (Maigreur)';
            }
            if (18.5 < $icm && $icm < 25) {
                $this->icm = $icm . ' (Corpulence normale)';
            }
            if (25 < $icm && $icm < 30) {
                $this->icm = $icm . ' (Surpoids ou pré-obésité)';
            }
            if (30 < $icm && $icm < 35) {
                $this->icm = $icm . ' (Obésité modérée (classe I))';
            }
            if (35 < $icm && $icm < 40) {
                $this->icm = $icm . ' (Obésité sévère (classe II))';
            }
            if (40 < $icm) {
                $this->icm = $icm . ' (Obésité morbide (classe III))';
            }
        }
    }

    public function render()
    {
        $patient = Patient::where('id',  $this->patients)->first();
        return view('livewire.cabinet-medical.patient-edit', compact('patient'));
    }

    public function update()
    {
        $patients = Patient::where('id', $this->patients)->first();

        $validated = $this->validate(
            [
                'civilite' => 'required',
                'nom' => 'required',
                'prenom' => 'required',
                'situation' => 'required',
                'profession' => 'required',
                'date_naissance' => 'required',
                'lieu_naissance' => 'required',

            ]
        );

        $patients->update([
            'civilite_id' => $validated['civilite'],
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'situation_matrimoniale_id' => $validated['situation'],
            'profession' => $validated['profession'],
            'date_naissance' => $validated['date_naissance'],
            'lieu_naissance' => $validated['lieu_naissance'],
        ]);

        return redirect()->route('ad.sante.edit.patient', encrypt($patients->id))->with('success', 'Opération modifié avec succès');
    }

    public function updateCoordonnees()
    {
        $patients = Patient::where('id', $this->patients)->first();

        $validated = $this->validate(
            [
                'telephone' => 'required',
                'adresse' => 'required',
                'complement_adresse' => '',
                'mail' => '',
                'personne_contact' => '',

            ]
        );

        $patients->update([
            'telephone' => $validated['telephone'],
            'adresse' => $validated['adresse'],
            'complement_adresse' => $validated['complement_adresse'],
            'mail' => $validated['mail'],
            'personne_contact' => $validated['personne_contact'],
        ]);

        return redirect()->route('ad.sante.edit.patient', encrypt($patients->id))->with('success', 'Opération modifié avec succès');

    }

    public function updateInfoMedicale()
    {
        $patients = Patient::where('id', $this->patients)->first();

        $validated = $this->validate(
            [
                'taille' => '',
                'poid' => '',
                'temperature' => '',
                'groupe_sanguin' => '',

            ]
        );

        $patients->update([
            'taille' => $validated['taille'],
            'poid' => $validated['poid'],
            'temperature' => $validated['temperature'],
            'groupe_sanguin' => $validated['groupe_sanguin'],
        ]);

        return redirect()->route('ad.sante.edit.patient', encrypt($patients->id))->with('success', 'Opération modifié avec succès');
    }

    public function savePriseEnCharge()
    {

        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;
        $patients = Patient::where('id', $this->patients)->first();
        $validated = $this->validate(
            [
                'maison_assurance' => 'required',
                'nom_assurer' => 'required',
                'confirm_assurer' => 'required',
                'numero_assurer' => 'required',

            ]
        );
        $contrat = ContratAssurance::where('maison_assurance_id', $validated['maison_assurance'],)->latest()->first();
        if (isset(PriseEnCharge::where('contrat_assurance_id', $contrat->id)->first()->id)) {
            return redirect()->route('ad.sante.edit.patient', encrypt($patients->id))->with('danger', 'Contrat prise en charge existe déjà ');
        } else {
            PriseEnCharge::create([
                'contrat_assurance_id' => $contrat->id,
                'maison_assurance_id' => $validated['maison_assurance'],
                'nom_assurer' => $validated['nom_assurer'],
                'confirm_assurer' => $validated['confirm_assurer'],
                'numero_assurer' => $validated['numero_assurer'],
                'patient_id' => $patients->id,
                'user_id' => $user_id,
                'societe_id' => $societe_id,
            ]);
            return redirect()->route('ad.sante.edit.patient', encrypt($patients->id))->with('success', 'Prise en charge enregistrée avec succès');
        }
    }
}
