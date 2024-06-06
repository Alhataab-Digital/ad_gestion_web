<?php

namespace App\Livewire\CabinetMedical;

use App\Models\CabinetMedical\CategorieMedecin;
use App\Models\CabinetMedical\Medecin;
use App\Models\CabinetMedical\SpecialiteMedecin;
use App\Models\Civilite;
use App\Models\SituationMatrimoniale;
use Livewire\Component;

class MedecinEdit extends Component
{
    public $medecins =[];
    public $utilisateur =[];
    public $civilites =[];
    public $situations =[];
    public $categories =[];
    public $specialites =[];


    public $civilite ;
    public $nom ;
    public $prenom ;
    public $situation ;
    public $date_naissance ;
    public $lieu_naissance ;
    public $telephone ;
    public $titre ;
    public $specialite ;
    public $categorie ;
    public $adresse ;
    public $mail ;
    public $matricule ;

    public function mount(medecin $medecins, $id)
    {
        $id = decrypt($id);
        $medecin = Medecin::where('id', $id)->first();

        $this->civilites = Civilite::all();
        $this->situations = SituationMatrimoniale::all();
        $this->categories = CategorieMedecin::all();
        $this->specialites = SpecialiteMedecin::all();

        $this->matricule = $medecin->matricule;
        $this->medecins = $medecin->id;
        $this->civilite = $medecin->civilite_id;
        $this->nom = $medecin->nom;
        $this->prenom = $medecin->prenom;
        $this->situation = $medecin->situation_matrimoniale_id;
        $this->titre = $medecin->titre;
        $this->date_naissance = $medecin->date_naissance;
        $this->lieu_naissance = $medecin->lieu_naissance;
        $this->telephone = $medecin->telephone;
        $this->adresse = $medecin->adresse;
        $this->mail = $medecin->mail;

        $this->specialite = $medecin->specialite_id;
        $this->categorie = $medecin->categorie_medicale_id;


    }
    public function render()
    {
        $medecin = medecin::where('id',  $this->medecins)->first();
        return view('livewire.cabinet-medical.medecin-edit', compact('medecin'));
    }

    public function update()
    {
        $medecins = Medecin::where('id', $this->medecins)->first();

        $validated = $this->validate(
            [
                'civilite' => 'required',
                'nom' => 'required',
                'prenom' => 'required',
                'situation' => 'required',
                'date_naissance' => 'required',
                'lieu_naissance' => 'required',

            ]
        );

        $medecins->update([
            'civilite_id' => $validated['civilite'],
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'situation_matrimoniale_id' => $validated['situation'],
            'date_naissance' => $validated['date_naissance'],
            'lieu_naissance' => $validated['lieu_naissance'],
        ]);

        return redirect()->route('ad.sante.edit.medecin', encrypt($medecins->id))->with('success', 'Opération modifié avec succès');
    }

    public function updateCoordonnees()
    {
        $medecins = Medecin::where('id', $this->medecins)->first();

        $validated = $this->validate(
            [
                'telephone' => 'required',
                'adresse' => 'required',
                'mail' => '',

            ]
        );

        $medecins->update([
            'telephone' => $validated['telephone'],
            'adresse' => $validated['adresse'],
            'mail' => $validated['mail'],
        ]);

        return redirect()->route('ad.sante.edit.medecin', encrypt($medecins->id))->with('success', 'Opération modifié avec succès');

    }

    public function updateInfoMedicale()
    {
        $medecins = medecin::where('id', $this->medecins)->first();

        $validated = $this->validate(
            [
                'specialite' => '',
                'categorie' => '',
                'titre' => '',

            ]
        );

        $medecins->update([
            'specialite_id' => $validated['specialite'],
            'categorie_medicale_id' => $validated['categorie'],
            'titre' => $validated['titre'],
        ]);

        return redirect()->route('ad.sante.edit.medecin', encrypt($medecins->id))->with('success', 'Opération modifié avec succès');
    }
}
