<?php

namespace App\Livewire\CabinetMedical;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\CabinetMedical\Patient as Patients;
use App\Models\Civilite;
use App\Models\SituationMatrimoniale;
use App\Models\Users\Utilisateur;
use Livewire\Component;

class Patient extends Component
{
    public $patients =[];
    public $utilisateur =[];
    public $civilites =[];
    public $situations =[];

    public $civilite ='';
    public $nom ='';
    public $prenom ='';
    public $situation ='';
    public $date_naissance ='';
    public $lieu_naissance ='';
    public $telephone ='';
    public $adresse ='';

    public function mount()
    {
        $this->patients=Patients::where('civilite_id','!=',null)->orderBy('id',"DESC")->get();
        $this->civilites=Civilite::all();
        $this->situations=SituationMatrimoniale::all();
        $user_id = Auth::user()->id;
        $this->utilisateur=Utilisateur::where('id',$user_id)->first();
        $this->telephone=$this->utilisateur->agence->region->indicatif;
    }

    public function render()
    {

        return view('livewire.cabinet-medical.patient');
    }

    public function save()
    {
        $numero_patient = 'P'.mt_rand(100, 999).'-'.date('dmy');

        $validated = $this->validate(
            [
                'civilite'=>'required',
                'nom'=> 'required',
                'prenom'=> 'required',
                'situation'=> 'required',
                'date_naissance'=> 'required',
                'lieu_naissance'=> 'required',
                'telephone'=> 'required | min:8 |unique:patients',
                'adresse'=> 'required',

            ]
        );

        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;

        Patients::create([
                'civilite_id'=> $validated['civilite'],
                'nom'=> $validated['nom'],
                'prenom'=>$validated['prenom'],
                'situation_matrimoniale_id'=> $validated['situation'],
                'date_naissance'=> $validated['date_naissance'],
                'lieu_naissance'=> $validated['lieu_naissance'],
                'telephone'=> $validated['telephone'],
                'adresse'=> $validated['adresse'],
                'numero_patient'=> 'PAT/'.$numero_patient.'/'.date('dmY'),
                'user_id'=> $user_id,
                'societe_id' => $societe_id,
        ]);

        $this->civilite ='';
        $this->nom ='';
        $this->prenom ='';
        $this->situation ='';
        $this->date_naissance ='';
        $this->lieu_naissance ='';
        $this->telephone ='';
        $this->adresse ='';

        return redirect()->route('ad.sante.index.patient')->with('success', 'Patient crée avec succès');
    }
}
