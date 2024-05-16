<?php

namespace App\Livewire\CabinetMedical;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\CabinetMedical\Patient as Patients;
use App\Models\Users\Utilisateur;
use Livewire\Component;

class Patient extends Component
{
    public $patients =[];
    public $utilisateur =[];

    public $civilite ='';
    public $nom ='';
    public $prenom ='';
    public $situation ='';
    public $age ='';
    public $telephone ='';
    public $adresse ='';
    public $taille ='';
    public $poid ='';
    public $mail ='';
    public $password ='';

    public function mount()
    {
        $this->patients=Patients::all();
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

        $validated = $this->validate(
            [
                'civilite'=>'required',
                'nom'=> 'required',
                'prenom'=> 'required',
                'situation'=> 'required',
                'age'=> 'required',
                'telephone'=> 'required | min:8 |unique:patients',
                'adresse'=> 'required',
                'taille'=> '',
                'poid'=> '',
                'mail'=> '',
                'password'=> '',

            ]
        );

        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;

        Patients::create([
                'civilite'=> $validated['civilite'],
                'nom'=> $validated['nom'],
                'prenom'=>$validated['prenom'],
                'situation'=> $validated['situation'],
                'age'=> $validated['age'],
                'telephone'=> $validated['telephone'],
                'adresse'=> $validated['adresse'],
                'taille'=>$validated['taille'],
                'poid'=>$validated['poid'],
                'mail'=>$validated['mail'],
                'password'=>$validated['password'],
                'user_id'=> $user_id,
                'societe_id' => $societe_id,
        ]);

        return redirect()->with('success', 'Patient crée avec succès');
    }
}
