<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\Consultation;
use App\Models\CabinetMedical\Examen;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BulletinExamen extends Component
{
public $numero_ordre;
    public function render()
    {
        return view('livewire.cabinet-medical.bulletin-examen');
    }

    public function valider()
    {
        $validated = $this->validate(
            [
                'numero_ordre' => 'required',
            ]
        );

        $societe_id = Auth::user()->societe_id;
        $user_id = Auth::user()->id;
        $consultation = Consultation::where('numero_ordre', $validated['numero_ordre'])->where('etat',1)->first();
        // dd($consultation->id);
        if(isset($consultation->id)){
                $bulletin_examen=Examen::where('consultation_id',$consultation->id)->first();
                if(isset($bulletin_examen->consultation_id))
                {
                    return redirect()->to(route('ad.sante.analyse.examen.medical',encrypt($consultation->id)));
                }
                else
                {
                    return redirect()->to(route('ad.sante.bulletin.examen.medical'))->with('danger', "Bulletin traiter");
                }
        }else{
            return redirect()->to(route('ad.sante.bulletin.examen.medical'))->with('danger', "Numero introuvable");
        }
    }
}
