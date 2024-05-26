<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\CategorieMedecin;
use App\Models\CabinetMedical\Medecin as CabinetMedicalMedecin;
use App\Models\CabinetMedical\Specialite;
use App\Models\CabinetMedical\SpecialiteMedecin;
use App\Models\Civilite;
use App\Models\SituationMatrimoniale;
use App\Models\Users\Utilisateur;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Medecin extends Component
{

    public $medecins =[];
    public $utilisateur =[];
    public $civilites =[];
    public $situations =[];
    public $categories =[];
    public $specialites =[];


    public $civilite ='';
    public $nom ='';
    public $prenom ='';
    public $situation ='';
    public $date_naissance ='';
    public $lieu_naissance ='';
    public $telephone ='';
    public $titre ='';
    public $specialite ='';
    public $categorie ='';
    public $adresse ='';
    public $mail ='';
    public $matricule ='';

    public function mount()
    {
        $this->medecins=CabinetMedicalMedecin::all();
        $this->civilites=Civilite::all();
        $this->situations=SituationMatrimoniale::all();
        $this->categories=CategorieMedecin::all();
        $this->specialites=SpecialiteMedecin::all();
        $user_id = Auth::user()->id;
        $this->utilisateur=Utilisateur::where('id',$user_id)->first();
        $this->telephone=$this->utilisateur->agence->region->indicatif;
    }

    public function render()
    {

        return view('livewire.cabinet-medical.medecin');
    }

    public function save()
    {

        $validated = $this->validate(
            [
                'civilite'=>'required',
                'nom'=> 'required',
                'prenom'=> 'required',
                'situation'=> 'required',
                'date_naissance'=> 'required',
                'lieu_naissance'=> 'required',
                'titre'=> 'required',
                'telephone'=> 'required | min:8|unique:medecins',
                'specialite'=> 'required',
                'adresse'=> 'required',
                'categorie'=> 'required',
                'mail'=> 'required',

            ]
        );

        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;
        $matricule ='MP/'.mt_rand(1000, 9999).'/'.date('Y');

        CabinetMedicalMedecin::create([
                'matricule'=>$matricule,
                'civilite_id'=> $validated['civilite'],
                'nom'=> $validated['nom'],
                'prenom'=>$validated['prenom'],
                'situation_matrimoniale_id'=> $validated['situation'],
                'date_naissance'=> $validated['date_naissance'],
                'lieu_naissance'=> $validated['lieu_naissance'],
                'telephone'=> $validated['telephone'],
                'titre'=> $validated['titre'],
                'specialite_id'=> $validated['specialite'],
                'adresse'=> $validated['adresse'],
                'categorie_medicale_id'=>$validated['categorie'],
                'mail'=>$validated['mail'],
                'user_id'=> $user_id,
                'societe_id' => $societe_id,
        ]);

        return redirect()->route('ad.sante.index.medecin')->with('success', 'medecin crée avec succès');
    }
}

