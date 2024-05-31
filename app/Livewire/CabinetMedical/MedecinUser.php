<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\Medecin;
use App\Models\Users\Role;
use App\Models\Users\Utilisateur;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MedecinUser extends Component
{
    public $medecins=[];
    public $utilisateurs=[];
    public $utilisateur=null ;
    public $medecin;

    public $roles=[];
    public $role=null ;

    public function mount()
    {
        $this->roles=Role::all();
        $this->utilisateurs=Utilisateur::all();
        $this->medecins=Medecin::all();
    }

    public function updatedRole($roleId)
    {

        $this->utilisateurs = Utilisateur::where('role_id', $roleId)
            ->get();
    }


    public function render()
    {
        return view('livewire.cabinet-medical.medecin-user');
    }
    public function save()
    {

        $validated = $this->validate(
            [
                'role'=> 'required',
                'medecin'=> 'required',
                'utilisateur'=> 'required',
            ]
        );

    if(isset(Utilisateur::where('espace_id',$validated['medecin'])->first()->id)){
            return redirect()->route('ad.sante.medecin.user')->with('danger', 'Medecin deja associe');
        }else{
        $user=Utilisateur::where('id',$validated['utilisateur'])->first();

        $user->update([
            'espace_id'=>$validated['medecin'],
        ]);
        return redirect()->route('ad.sante.medecin.user')->with('success', 'medecin associer avec succès');
        }
dd('reo');


    }

}
