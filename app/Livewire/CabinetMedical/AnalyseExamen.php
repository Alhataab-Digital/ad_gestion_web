<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\Consultation;
use App\Models\CabinetMedical\Examen;
use App\Models\CabinetMedical\Patient;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AnalyseExamen extends Component
{

    public $examens=[];
    public $consultation;

    public function mount($id)
    {
        $id = decrypt($id);
        $this->consultation =Consultation::where('id', $id)->first();
        $this->examens =Examen::where('consultation_id', $id)->get();

    }

    public function render()
    {
        return view('livewire.cabinet-medical.analyse-examen');
    }



}
