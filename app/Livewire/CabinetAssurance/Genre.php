<?php

namespace App\Livewire\CabinetAssurance;

use App\Models\CabinetAssurance\Genre as CabinetAssuranceGenre;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Genre extends Component
{
    public $genres = [];
    public $libelle_genre = '';

    public function mount()
    {
            $societe_id = Auth::user()->societe_id;
            $this->genres = CabinetAssurancegenre::where('societe_id', $societe_id)->get();

    }
    public function render()
    {
        return view('livewire.cabinet-assurance.genre');
    }

    public function save()
    {

        $validated = $this->validate(
            [
                'libelle_genre' => 'required',
            ]
        );
        $user_id = Auth::user()->id;
        $societe_id = Auth::user()->societe_id;

        CabinetAssuranceGenre::create([
            'libelle_genre' => $validated['libelle_genre'],
            'user_id' => $user_id,
            'societe_id' => $societe_id,
        ]);

        return redirect()->route('index.genre')->with('success', 'genre crée avec succès');
    }
}
