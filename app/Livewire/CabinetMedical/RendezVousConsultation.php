<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\Consultation;
use App\Models\CabinetMedical\ContratAssurance;
use App\Models\CabinetMedical\Facturation;
use App\Models\CabinetMedical\PaiementRecu;
use App\Models\CabinetMedical\Patient;
use App\Models\CabinetMedical\PriseEnCharge;
use App\Models\CabinetMedical\Rdv;
use App\Models\Users\Utilisateur;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RendezVousConsultation extends Component
{

    public $rendez_vouss=[];
    public $facturations=[];
    public $fac_en_cours;
    Public $cons_en_attentes=[];
    public $cons_en_cours;
    public $consultations=[];
    public $cons_en_attente;
    public $paiements=[];
    public $contrat_assurances=[];
    public $rendez_vous;
    public $maison_assurance;
    public $contrat_assurance;
    public $utilisateur=[];
    public $telephone='';
    public $numero_patient='';
    public $numero_ordre;
    public $numero_piece;

public function mount()
{

        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;
        $this->utilisateur=Utilisateur::where('id',$user_id)->first();
        $this->telephone=$this->utilisateur->agence->region->indicatif;
        $this->rendez_vouss=Rdv::where('societe_id',$societe_id)->where('etat','!=',3)->orderBy('id',"DESC")->get();
        $this->facturations=Facturation::where('societe_id',$societe_id)->where('etat',0)->orderBy('id',"DESC")->get();
        $this->fac_en_cours=Facturation::where('societe_id',$societe_id)->where('etat',0)->orderBy('id',"DESC")->count();
        $this->paiements=PaiementRecu::where('societe_id',$societe_id)->orderBy('id',"DESC")->get();
        $this->consultations=Consultation::where('user_id',$user_id)->where('societe_id',$societe_id)->where('etat',2)->orderBy('id',"DESC")->get();
        $this->cons_en_cours=Consultation::where('user_id',$user_id)->where('societe_id',$societe_id)->where('etat',2)->orderBy('id',"DESC")->count();
        $this->cons_en_attentes=Consultation::where('user_id',$user_id)->where('societe_id',$societe_id)->where('etat',3)->orderBy('id',"DESC")->get();
        $this->cons_en_attente=Consultation::where('user_id',$user_id)->where('societe_id',$societe_id)->where('etat',3)->count();

}
    public function render()
    {
        return view('livewire.cabinet-medical.rendez-vous-consultation');
    }

    public function validerNouveau(){

        $validated = $this->validate(
            [
                'telephone'=> 'required | min:8|max:12',
            ]
        );

        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;
        $validated['telephone'];
        $patient=Patient::where('telephone',$validated['telephone'])->first();
        $numero_patient = 'P'.mt_rand(100, 999).'-'.date('dmy');

        if(isset($patient->telephone)){

            return redirect()->to(route('ad.sante.dossier.rendez-vous.consultation',encrypt($patient->id)));

        }else{

            Patient::create([
                'telephone'=> $validated['telephone'],
                'numero_patient'=> $numero_patient,
                'user_id'=> $user_id,
                'societe_id' => $societe_id,
            ]);

            $patient=Patient::where('telephone',$validated['telephone'])->first();

            return redirect()->to(route('ad.sante.dossier.rendez-vous.consultation',encrypt($patient->id)));

        }


    }
    public function validerAncien(){

        $validated = $this->validate(
            [
                'numero_patient'=> 'required',
            ]
        );

        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;
        $patient=Patient::where('numero_patient',$validated['numero_patient'])->first();

        if(isset($patient->telephone)){

            return redirect()->to(route('ad.sante.dossier.rendez-vous.consultation',encrypt($patient->id)));

        }else{
            return redirect()->to(route('ad.sante.rendez-vous.consultation'))->with('danger', "Ce numero est introuvable");
        }


    }
    public function ConfirmerRendezVous($id)
    {
        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;
        $rendez_vous=Rdv::find($id);
        if(isset(PriseEnCharge::where('patient_id', $rendez_vous->patient_id)->first()->id))
        {
            $prise_en_charge = PriseEnCharge::where('patient_id', $rendez_vous->patient_id)->first();
            if(isset(ContratAssurance::where('id', $prise_en_charge->contrat_assurance_id)
            ->latest('date_fin')
            ->where('date_fin', '>=', now() )
            ->first()->id))
            {
                $contrat_assurance = ContratAssurance::where('id', $prise_en_charge->contrat_assurance_id)
                ->latest('date_fin')
                ->first();
                if(isset($rendez_vous->etat) ==2){
                    $latest = Consultation::latest('id')->first();
                    $newNumber = $latest ? intval($latest->id) + 1 : 1;
                    $this->numero_ordre = str_pad($newNumber, 8, '0', STR_PAD_LEFT);

                Consultation::create([
                    'numero_ordre'=>'CONS'.$this->numero_ordre,
                    'contrat_id'=>$contrat_assurance->id,
                    'rdv_id'=>$rendez_vous->id,
                    'patient_id'=>$rendez_vous->patient_id,
                    'medecin_id'=>$rendez_vous->medecin_id,
                    'type_consultation_id'=>$rendez_vous->planification->type_consultation_id,
                    'user_id'=>$user_id,
                    'societe_id'=>$societe_id,
                ]);
                $rendez_vous->update([
                    'etat'=> "1",
                ]);
                return redirect()->to(route('ad.sante.rendez-vous.consultation'));
                }else{
                    return redirect()->to(route('ad.sante.rendez-vous.consultation'))->with('danger', "Rendez-vous déjà facturé");
                }
            }else{
                if(isset($rendez_vous->etat) ==2){
                    $latest = Consultation::latest('id')->first();
                    $newNumber = $latest ? intval($latest->id) + 1 : 1;
                    $this->numero_ordre = str_pad($newNumber, 8, '0', STR_PAD_LEFT);

                Consultation::create([
                    'numero_ordre'=>'CONS'.$this->numero_ordre,
                    'contrat_id'=>0,
                    'rdv_id'=>$rendez_vous->id,
                    'patient_id'=>$rendez_vous->patient_id,
                    'medecin_id'=>$rendez_vous->medecin_id,
                    'type_consultation_id'=>$rendez_vous->planification->type_consultation_id,
                    'user_id'=>$user_id,
                    'societe_id'=>$societe_id,
                ]);
                $rendez_vous->update([
                    'etat'=> "1",
                ]);
                return redirect()->to(route('ad.sante.rendez-vous.consultation'));
                }else{
                    return redirect()->to(route('ad.sante.rendez-vous.consultation'))->with('danger', "Rendez-vous déjà facturé");
                }
            }

        }else
        {
            if(isset($rendez_vous->etat) ==2){
                $latest = Consultation::latest('id')->first();
                $newNumber = $latest ? intval($latest->id) + 1 : 1;
                $this->numero_ordre = str_pad($newNumber, 8, '0', STR_PAD_LEFT);

            Consultation::create([
                'numero_ordre'=>'CONS'.$this->numero_ordre,
                'contrat_id'=>0,
                'rdv_id'=>$rendez_vous->id,
                'patient_id'=>$rendez_vous->patient_id,
                'medecin_id'=>$rendez_vous->medecin_id,
                'type_consultation_id'=>$rendez_vous->planification->type_consultation_id,
                'user_id'=>$user_id,
                'societe_id'=>$societe_id,
            ]);
            $rendez_vous->update([
                'etat'=> "1",
            ]);
            return redirect()->to(route('ad.sante.rendez-vous.consultation'));
            }else{
                return redirect()->to(route('ad.sante.rendez-vous.consultation'))->with('danger', "Rendez-vous déjà facturé");
            }
        }
    }

    public function facturerConsultation($id)
    {

        $consultation=Consultation::find($id);
        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;
        $rendez_vous=Rdv::find($consultation->rdv_id);

        $patient = Patient::find($consultation->patient_id);
        //si le patient à une prise en charge existant

       $date_consultation = Carbon::parse($consultation->created_at)->format('Y-m-d');
        if (isset(PriseEnCharge::where('patient_id', $patient->id)->first()->id)) {
            $prise_en_charge = PriseEnCharge::where('patient_id', $patient->id)->first();

            //si la date de fin de validation de la prise en charge est superieur à la date de la consultation
            if (ContratAssurance::where('id', $prise_en_charge->contrat_assurance_id)
                    ->latest('date_fin')
                    ->where('date_fin', '>=', $date_consultation )
                    ->first()->id)
            {
                    $contrat_assurance = ContratAssurance::where('id', $prise_en_charge->contrat_assurance_id)
                    ->latest('date_fin')
                    ->where('date_fin', '>=', $date_consultation )
                    ->first();
                //si la consultation est deja facturé
                if ($consultation->etat == 1) {
                    return redirect()->route('ad.sante.rendez-vous.consultation')->with('danger', "Consultation déjà facturé");
                } else {

                    $structure_assurer=$consultation->contrat_assurance->maison_assurance_id;
                    $taux_assurer=$consultation->contrat_assurance->taux_couverture;
                    $contrat_id=$consultation->contrat_assurance->id;
                    $latest = Facturation::latest('id')->first();
                    $newNumber = $latest ? intval($latest->id) + 1 : 1;
                    $this->numero_piece = str_pad($newNumber, 7, '0', STR_PAD_LEFT);

                    $montant_assurer=round(($consultation->contrat_assurance->taux_couverture/100)*$consultation->type_consultation->tarif_consultation);
                    $montant_patient=round($consultation->type_consultation->tarif_consultation-(($consultation->contrat_assurance->taux_couverture/100)*$consultation->type_consultation->tarif_consultation));

                    Facturation::create([
                        'numero_piece'=>'FAC'.$this->numero_piece,
                        'numero_ordre'=>$consultation->numero_ordre,
                        'patient_id'=>$consultation->rendez_vous->patient_id,
                        'medecin_id'=>$consultation->rendez_vous->medecin_id,
                        'contrat_id'=>$contrat_id,
                        'maison_assurance_id'=>$structure_assurer,
                        'taux_assurer'=>$taux_assurer,
                        'montant'=>$consultation->type_consultation->tarif_consultation,
                        'montant_assurer'=> $montant_assurer,
                        'montant_patient'=>$montant_patient,
                        'reste_a_payer'=>$montant_patient,
                        'user_id'=>$user_id,
                        'societe_id'=>$societe_id,
                    ]);

                    $consultation->update([
                        'etat'=> "1",
                    ]);
                    $rendez_vous->update([
                        'etat'=> "2",
                    ]);
                    return redirect()->route('ad.sante.rendez-vous.consultation')->with('success', " Rendez-vous enregistrer avec succès");
                }
            } else {
                // dd('si le le contrat de prise en charge est expire'.$planning->jour_semaine,$prise_en_charge->contrat_assurance->date_fin);
               //si la consultation est deja facturé
               if ($consultation->etat == 1) {
                    return redirect()->route('ad.sante.rendez-vous.consultation')->with('danger', "Consultation déjà facturé");
                } else {


                   $latest = Facturation::latest('id')->first();
                    $newNumber = $latest ? intval($latest->id) + 1 : 1;
                    $this->numero_piece = str_pad($newNumber, 7, '0', STR_PAD_LEFT);

                    $montant_assurer=0;
                    $montant_patient=$consultation->type_consultation->tarif_consultation;;

                    Facturation::create([
                        'numero_piece'=>'FAC'.$this->numero_piece,
                        'numero_ordre'=>$consultation->numero_ordre,
                        'patient_id'=>$consultation->rendez_vous->patient_id,
                        'medecin_id'=>$consultation->rendez_vous->medecin_id,
                        'contrat_id'=>0,
                        'taux_assurer'=>0,
                        'montant'=>$consultation->type_consultation->tarif_consultation,
                        'montant_assurer'=> $montant_assurer,
                        'montant_patient'=>$montant_patient,
                        'reste_a_payer'=>$montant_patient,
                        'user_id'=>$user_id,
                        'societe_id'=>$societe_id,
                    ]);

                    $consultation->update([
                        'etat'=> "1",
                    ]);
                    $rendez_vous->update([
                        'etat'=> "2",
                    ]);
                    return redirect()->route('ad.sante.rendez-vous.consultation')->with('success', " Rendez-vous enregistrer avec succès");
                }
            }
        } else {
            //si la consultation est déjà facturé
            if ($consultation->etat == 1) {
            return redirect()->route('ad.sante.rendez-vous.consultation')->with('danger', "Ce patient à un rendez-vous en cours");
        } else {

            $latest = Facturation::latest('id')->first();
            $newNumber = $latest ? intval($latest->id) + 1 : 1;
            $this->numero_piece = str_pad($newNumber, 7, '0', STR_PAD_LEFT);
            $montant_assurer=0;
            $montant_patient=$consultation->type_consultation->tarif_consultation;

            Facturation::create([
                'numero_piece'=>'FAC'.$this->numero_piece,
                'numero_ordre'=>$consultation->numero_ordre,
                'patient_id'=>$consultation->rendez_vous->patient_id,
                'medecin_id'=>$consultation->rendez_vous->medecin_id,
                'contrat_id'=>0,
                'taux_assurer'=>0,
                'montant'=>$consultation->type_consultation->tarif_consultation,
                'montant_assurer'=> $montant_assurer,
                'montant_patient'=>$montant_patient,
                'reste_a_payer'=>$montant_patient,
                'user_id'=>$user_id,
                'societe_id'=>$societe_id,
            ]);

                    $consultation->update([
                        'etat'=> "1",
                    ]);
                    $rendez_vous->update([
                        'etat'=> "2",
                    ]);
            return redirect()->route('ad.sante.rendez-vous.consultation')->with('success', "Rendez-vous enregistrer avec succès");
        }
        }

        // $societe_id = Auth::user()->societe_id;
        // $user_id = Auth::user()->id;
        // $consultation=CabinetMedicalConsultation::find($id);
        // $rendez_vous=Rdv::find($consultation->rdv_id);
        // if($consultation->etat == 0){
        //     $latest = Facturation::latest('id')->first();
        //     $newNumber = $latest ? intval($latest->id) + 1 : 1;
        //     $this->numero_ordre = str_pad($newNumber, 7, '0', STR_PAD_LEFT);

        //     $montant_assurer=round(($consultation->rendez_vous->taux_couverture/100)*$consultation->rendez_vous->montant);
        //     $montant_patient=round($consultation->rendez_vous->montant-(($consultation->rendez_vous->taux_couverture/100)*$rendez_vous->montant));

        //     Facturation::create([
        //         'numero_piece'=>'FAC'.$this->numero_piece,
        //         'numero_ordre'=>$consultation->numero_ordre,
        //         'patient_id'=>$consultation->rendez_vous->patient_id,
        //         'medecin_id'=>$consultation->rendez_vous->medecin_id,
        //         'maison_assurance_id'=>$consultation->rendez_vous->contrat_assurance->maison_assurance_id,
        //         'taux_assurer'=>$consultation->rendez_vous->taux_couverture,
        //         'montant'=>$consultation->rendez_vous->montant,
        //         'montant_assurer'=> $montant_assurer,
        //         'montant_patient'=>$montant_patient,
        //         'reste_a_payer'=>$montant_patient,
        //         'user_id'=>$user_id,
        //         'societe_id'=>$societe_id,
        //     ]);

        //     $rendez_vous->update([
        //         'etat'=> "1",
        //     ]);
        //     return redirect()->to(route('ad.sante.rendez-vous.consultation'));
        // }else{
        //     return redirect()->to(route('ad.sante.rendez-vous.consultation'))->with('danger', "Rendez-vous déjà facturé");
        // }


    }
    public function IntroduireSalleAttente($id)
    {
        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;
        $rendez_vous=Rdv::find($id);

        if(isset($rendez_vous->etat) ==2){
            $latest = Consultation::latest('id')->first();
            $newNumber = $latest ? intval($latest->id) + 1 : 1;
            $this->numero_ordre = str_pad($newNumber, 8, '0', STR_PAD_LEFT);

            Consultation::create([
                'numero_ordre'=>'CONS'.$this->numero_ordre,
                'rdv_id'=>$rendez_vous->id,
                'patient_id'=>$rendez_vous->patient_id,
                'medecin_id'=>$rendez_vous->medecin_id,
                'type_consultation_id'=>$rendez_vous->planification->type_consultation_id,
                'user_id'=>$user_id,
                'societe_id'=>$societe_id,
            ]);

            $rendez_vous->update([
                'etat'=>3,
            ]);

            return redirect()->route('ad.sante.rendez-vous.consultation');
        }
    }
}
