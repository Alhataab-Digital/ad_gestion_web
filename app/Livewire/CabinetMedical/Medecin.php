<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\Medecin as CabinetMedicalMedecin;
use App\Models\Users\Utilisateur;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Medecin extends Component
{

    public $medecins =[];
    public $utilisateur =[];

    public $civilite ='';
    public $nom ='';
    public $prenom ='';
    public $situation ='';
    public $age ='';
    public $telephone ='';
    public $grade ='';
    public $adresse ='';
    public $taille ='';
    public $poid ='';
    public $mail ='';
    public $password ='';

    public function mount()
    {
        $this->medecins=CabinetMedicalMedecin::all();
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
                'age'=> 'required',
                'telephone'=> 'required | min:8|unique:medecins',
                'grade'=> 'required',
                'adresse'=> 'required',
                'taille'=> '',
                'poid'=> '',
                'mail'=> '',
                'password'=> '',

            ]
        );

        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;

        CabinetMedicalMedecin::create([
                'civilite'=> $validated['civilite'],
                'nom'=> $validated['nom'],
                'prenom'=>$validated['prenom'],
                'situation'=> $validated['situation'],
                'age'=> $validated['age'],
                'telephone'=> $validated['telephone'],
                'grade'=> $validated['grade'],
                'adresse'=> $validated['adresse'],
                'taille'=>$validated['taille'],
                'poid'=>$validated['poid'],
                'mail'=>$validated['mail'],
                'password'=>$validated['password'],
                'user_id'=> $user_id,
                'societe_id' => $societe_id,
        ]);

        return redirect()->route('ad.sante.index.medecin')->with('success', 'medecin crée avec succès');
    }
}

