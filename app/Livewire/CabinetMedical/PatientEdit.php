<?php

namespace App\Livewire\CabinetMedical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\CabinetMedical\Patient;
use Livewire\Component;

class PatientEdit extends Component
{

    public $patients;
    public $civilite ;
    public $nom ;
    public $prenom ;
    public $situation;
    public $age;
    public $telephone;
    public $adresse;
    public $taille;
    public $poid;
    public $mail ;
    public $password;

    public function mount(Patient $patients, $id)
    {
        $id = decrypt($id);
        $patients = Patient::where('id', $id)->first();

        $this->patients = $patients->id;
        $this->civilite = $patients->civilite;
        $this->nom = $patients->nom;
        $this->prenom = $patients->prenom;
        $this->situation = $patients->situation;
        $this->age = $patients->age;
        $this->telephone = $patients->telephone;
        $this->adresse = $patients->adresse;
        $this->taille = $patients->taille;
        $this->poid = $patients->poid;
        $this->mail = $patients->mail;
        $this->password = $patients->password;
    }

    public function render()
    {
        return view('livewire.cabinet-medical.patient-edit');
    }

    public function update()
    {
        $patients = Patient::where('id', $this->patients)->first();

        $validated = $this->validate(
            [
                'civilite'=>'required',
                'nom'=> 'required',
                'prenom'=> 'required',
                'situation'=> 'required',
                'age'=> 'required',
                'telephone'=> 'required',
                'adresse'=> 'required',
                'taille'=> '',
                'poid'=> '',
                'mail'=> '',
                'password'=> '',
            ]
        );

        $patients->update([
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
            'password'=>$validated['password']
        ]);

        return redirect()->route('ad.sante.index.patient')->with('success', 'Opération modifié avec succès');
    }
}
