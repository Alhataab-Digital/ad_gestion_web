<?php

namespace App\Livewire\CabinetMedical;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Civilite;
use App\Models\CabinetMedical\Rdv;
use Illuminate\Support\Facades\Auth;
use App\Models\SituationMatrimoniale;
use App\Models\CabinetMedical\Patient;
use App\Models\CabinetMedical\PriseEnCharge;
use App\Models\CabinetMedical\ContratAssurance;
use App\Models\CabinetMedical\MotifConsultation;
use App\Models\CabinetMedical\TarifConsultation;

use App\Models\CabinetMedical\PlanificationMedecin;
use App\Models\CabinetMedical\TypeConsultation;

class DossierRendezVousConsultation extends Component
{
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

    public $tarif_montants = [];
    public $tarif_montant = null;
    public $date_rdvs = [];
    public $heure_rdvs;
    public $heure_rdv;
    public $motif;


    public $civilites = [];
    public $motifs = [];
    public $situations = [];
    public $planification_dates = [];
    public $planification_date = null;
    public $planification_medecins = [];
    public $planification_medecin = null;
    public $type_consultations = [];
    public $type_consultation = null;


    public function mount(Rdv $rendez_vous, $id)
    {
        $id = decrypt($id);

        $patients = Patient::where('id', $id)->first();

        $this->civilites = Civilite::all();
        $this->motifs = MotifConsultation::all();
        $this->situations = SituationMatrimoniale::all();
        $this->type_consultations = TypeConsultation::all();
        $this->patients = $patients->id;
        $this->civilite = $patients->civilite_id;
        $this->nom      = $patients->nom;
        $this->prenom = $patients->prenom;
        $this->profession = $patients->profession;
        $this->situation = $patients->situation_matrimoniale_id;
        $this->date_naissance = $patients->date_naissance;
        $this->lieu_naissance = $patients->lieu_naissance;
        $this->telephone = $patients->telephone;
        $this->adresse = $patients->adresse;
    }
    public function updatedTypeConsultation($TypeConsultationId)
    {

        $societe_id = Auth::user()->societe_id;
            $this->planification_dates = PlanificationMedecin::where('type_consultation_id', $TypeConsultationId)
            ->where('jour_semaine','>=',date('Y-m-d'))
            ->orderBy('jour_semaine',"ASC")
            ->where('societe_id', $societe_id)
                ->get();
            $this->planification_date = null;


    }
    public function updatedPlanificationDate($PlanificationDateId)
    {
        $societe_id = Auth::user()->societe_id;

        $this->planification_medecins = PlanificationMedecin::where('id', $PlanificationDateId)
            ->where('societe_id', $societe_id)
            ->get();
        $this->planification_medecin = null;
    }
    public function updatedPlanificationMedecin($PlanificationMedecinId)
    {
        $societe_id = Auth::user()->societe_id;

        $this->tarif_montants = PlanificationMedecin::find($PlanificationMedecinId);
        $this->tarif_montant = $this->tarif_montants->type_consultation->tarif_consultation;
    }
    // public function updatedPlanification($heureId)
    // {
    //     // dd($heureId);
    //     $this->heure_rdvs = PlanificationMedecin::where('id', $heureId)
    //     ->first();

    //     $this->heure_rdv=($this->heure_rdvs->heure_debut);

    // }


    public function render()
    {
        return view('livewire.cabinet-medical.dossier-rendez-vous-consultation');
    }

    public function enregistrer()
    {

        // dd('ok');
        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;

        $validated = $this->validate(
            [
                'tarif_montant' => 'required',
                'planification_date' => 'required',
                'planification_medecin' => 'required',
                'type_consultation' => 'required',
                'motif' => 'required',
                'civilite' => 'required',
                'nom' => 'required',
                'prenom' => 'required',
                'situation' => 'required',
                'profession' => 'required',
                'date_naissance' => 'required',
                'lieu_naissance' => 'required',
                'telephone' => 'required',
                'adresse' => 'required',
            ]
        );
        $planning = PlanificationMedecin::find($validated['planification_medecin']);
        $patients = Patient::where('id', $this->patients)->first();

                    Rdv::create([
                        'motif' => $validated['motif'],
                        'patient_id' => $this->patients,
                        'medecin_id' => $planning->medecin_id,
                        'date_rdv' => $planning->jour_semaine,
                        'heure_rdv' => $planning->heure_debut,
                        'planification_id' => $planning->id,
                        'user_id' => $user_id,
                        'societe_id' => $societe_id,
                    ]);

                    $patients->update([
                        'civilite_id' => $validated['civilite'],
                        'nom' => $validated['nom'],
                        'prenom' => $validated['prenom'],
                        'situation_matrimoniale_id' => $validated['situation'],
                        'profession' => $validated['profession'],
                        'date_naissance' => $validated['date_naissance'],
                        'lieu_naissance' => $validated['lieu_naissance'],
                        'telephone' => $validated['telephone'],
                        'adresse' => $validated['adresse'],
                    ]);

                    return redirect()->route('ad.sante.rendez-vous.consultation')->with('success', " Rendez-vous enregistrer avec succès");
    }
}
