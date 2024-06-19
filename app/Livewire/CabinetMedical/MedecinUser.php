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
    public $users;

    public $roles=[];
    public $role=null ;

    public function mount()
    {
        $societe_id = Auth::user()->societe_id;
        $this->roles=Role::where('Role','Medecin')->get();
        // $this->utilisateurs=Utilisateur::where('espace_id',0)->where('role_id','!=',0)->where('societe_id', $societe_id)->get();
        $this->users=Utilisateur::where('espace_id','!=',0)->get();
        $this->medecins=Medecin::where('societe_id', $societe_id)->get();
    }

    public function updatedRole($roleId)
    {

        $this->utilisateurs = Utilisateur::where('role_id', $roleId)
        ->where('espace_id',0)
            ->get();
            $this->utilisateur=null ;
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
                return redirect()->route('ad.sante.medecin.user')->with('danger', 'Medecin déjà associé');
            }else{
            $user=Utilisateur::where('id',$validated['utilisateur'])->first();
            $user->update([
                'espace_id'=>$validated['medecin'],
            ]);
            return redirect()->route('ad.sante.medecin.user')->with('success', 'Medecin associé avec succès');
            }
            dd('reo');

    }
    public function delete($id)
    {
        $utilisateur = Utilisateur::find($id);
        $utilisateur->update([
            'espace_id'=> 0,
        ]);
        return redirect()->route('ad.sante.medecin.user')->with('danger', 'Medecin dissocié ');
    }

}
