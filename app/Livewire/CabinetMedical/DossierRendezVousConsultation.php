<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\ContratAssurance;
use App\Models\CabinetMedical\Patient;
use App\Models\CabinetMedical\PlanificationMedecin;
use App\Models\CabinetMedical\PriseEnCharge;
use App\Models\CabinetMedical\Rdv;
use App\Models\CabinetMedical\type_consultationMedecin;
use App\Models\CabinetMedical\TarifConsultation;
use App\Models\CabinetMedical\TypeConsultation;
use App\Models\Civilite;
use App\Models\SituationMatrimoniale;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

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
    public $situations = [];
    public $planification_dates = [];
    public $planification_date = null;
    public $planification_medecins = [];
    public $planification_medecin = null;
    public $tarif_consultations = [];
    public $tarif_consultation = null;


    public function mount(Rdv $rendez_vous, $id)
    {
        $id = decrypt($id);

        $patients = Patient::where('id', $id)->first();

        $this->civilites = Civilite::all();
        $this->situations = SituationMatrimoniale::all();
        $this->tarif_consultations = TarifConsultation::all();
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
    public function updatedTarifConsultation($TarifConsultationId)
    {

        $societe_id = Auth::user()->societe_id;
            $this->planification_dates = PlanificationMedecin::where('tarif_consultation_id', $TarifConsultationId)
            ->where('jour_semaine','>=',date('Y-m-d'))
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
        $this->tarif_montant = $this->tarif_montants->tarif_consultation->montant;
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
        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;
        $validated = $this->validate(
            [
                'tarif_montant' => 'required',
                'planification_date' => 'required',
                'planification_medecin' => 'required',
                'tarif_consultation' => 'required',
                'motif' => 'required',
                'civilite' => 'required',
                'nom' => 'required',
                'prenom' => 'required',
                'situation' => 'required',
                'profession' => 'required',
                'date_naissance' => 'required',
                'lieu_naissance' => 'required',
                'telephone' => '',
                'adresse' => '',
            ]
        );


        $planning = PlanificationMedecin::find($validated['planification_medecin']);
        $patients = Patient::where('id', $this->patients)->first();
        //si le patient à une prise en charge existant
        if (isset(PriseEnCharge::where('patient_id', $this->patients)->first()->id)) {
            $prise_en_charge = PriseEnCharge::where('patient_id', $this->patients)->first();
            $contrat_assurance = ContratAssurance::where('maison_assurance_id', $prise_en_charge->maison_assurance_id)
            ->where('tarif_consultation_id', $planning->tarif_consultation_id)
            ->latest('date_fin')
            ->where('date_fin', '>=', Carbon::parse($planning->jour_semaine))
            ->first();
            // dd($contrat_assurance);
            //si la date de fin de validation de la prise en charge est superieur à la date de du planing
            if ( $contrat_assurance) {

                //si le patient à deja un rendez-vous en cours
                if (isset(Rdv::where('patient_id', $this->patients)
                    ->where('medecin_id', $planning->medecin_id)
                    ->where('date_rdv', $planning->jour_semaine,)
                    ->where('heure_rdv', $planning->heure_debut,)
                    ->where('planification_id', $planning->id)
                    ->where('etat', 0)->latest()->first()->id)) {

                    return redirect()->route('ad.sante.rendez-vous.consultation')->with('danger', "Ce patient à un rendez-vous en cours");
                } else {

                    $taux_assurer=$contrat_assurance->taux_couverture;
                    $contrat_id=$contrat_assurance->id;
                    Rdv::create([
                        'motif' => $validated['motif'],
                        'patient_id' => $this->patients,
                        'medecin_id' => $planning->medecin_id,
                        'contrat_id' => $contrat_id,
                        'taux_couverture' => $taux_assurer,
                        'montant' => $planning->tarif_consultation->montant,
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
            } else {
                // dd('si le le contrat de prise en charge est expire'.$planning->jour_semaine,$prise_en_charge->contrat_assurance->date_fin);
                //si le patient à deja un rendez-vous en cours
                if (isset(Rdv::where('patient_id', $this->patients)
                    ->where('medecin_id', $planning->medecin_id)
                    ->where('date_rdv', $planning->jour_semaine,)
                    ->where('heure_rdv', $planning->heure_debut,)
                    ->where('planification_id', $planning->id)
                    ->where('etat', 0)->latest()->first()->id)) {

                    return redirect()->route('ad.sante.rendez-vous.consultation')->with('danger', "Ce patient à un rendez-vous en cours");
                } else {
                   Rdv::create([
                        'motif' => $validated['motif'],
                        'patient_id' => $this->patients,
                        'medecin_id' => $planning->medecin_id,
                        'taux_couverture' => 0,
                        'montant' => $planning->tarif_consultation->montant,
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
        } else {

            // dd('ce patient ne dispose pas de prise ne charge');
            //si le patient à deja un rendez-vous en cours
            //si le patient à deja un rendez-vous en cours
            if (isset(Rdv::where('patient_id', $this->patients)
            ->where('medecin_id', $planning->medecin_id)
            ->where('date_rdv', $planning->jour_semaine,)
            ->where('heure_rdv', $planning->heure_debut,)
            ->where('planification_id', $planning->id)
            ->where('etat', 0)->latest()->first()->id)) {

            return redirect()->route('ad.sante.rendez-vous.consultation')->with('danger', "Ce patient à un rendez-vous en cours");
        } else {
           Rdv::create([
                'motif' => $validated['motif'],
                'patient_id' => $this->patients,
                'medecin_id' => $planning->medecin_id,
                'taux_couverture' => 0,
                'montant' => $planning->tarif_consultation->montant,
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
    }
}
