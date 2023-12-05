@extends('../layouts.app')

@section('content')

<main id="main" class="main">

<div class="pagetitle">
  <h1>NOUVEAU DETENU</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
      <li class="breadcrumb-item">Detenu</li>
      <li class="breadcrumb-item active">Nouvel detenu</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<section class="section">
  <div class="row">
 
  <div class="col-lg-12 text-center">

<div class="card">
  <div class="card-body ">
    <h5 class="card-title">FICHE DU DETENU</h5>
    <P>

                    @if ($message=Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <i class="bi bi-check-circle me-1"></i>
                      {{ $message }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if ($message=Session::get('danger'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <i class="bi bi-exclamation-octagon me-1"></i>
                      {{ $message }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                </P>
    <!-- Floating Labels Form -->
    <form class="row g-3" method="post" action="{{route('store.detenu')}}" >
        @csrf 
      <div class="col-md-12 text-center">
          <!-- <img src="{{asset('assets/img/profile-img.jpg')}}" alt="Profile"> -->
        <div class="bg-secondary text-white">
        <hr>
        <p>identité detenu</p>
        <hr>
        </div>
                <div class="form-floating">
                  <input type="file" name="photo" class="form-control" id="floatingName" placeholder="">
                  <label for="floatingName">Photo identité</label>
                </div>
        </div>
        <div class="col-md-2">
        <div class="form-floating mb-3">
          <select class="form-select" id="floatingSelect" aria-label="State" name="civilite" required>
            <option value="Monsieur"> Monsieur</option>
            <option value="Madame"> Madame</option>
            <option value="Mademoiselle"> Mademoiselle</option>
          </select>
          <label for="floatingSelect">Civilite</label>
        </div>
      </div>
        <div class="col-md-5">
        <div class="form-floating">
          <input type="text" name="prenom" class="form-control" id="floatingName" placeholder="" required>
          <label for="floatingName">Prenom</label>
        </div>
      </div>
        <div class="col-md-5">
        <div class="form-floating">
          <input type="text" name="nom" class="form-control" id="floatingName" placeholder="" required>
          <label for="floatingName">Nom</label>
        </div>
      </div>
      
      <div class="col-md-2">
        <div class="form-floating mb-3">
          <select class="form-select" id="floatingSelect" aria-label="State" name="sexe" required>
            <option value="Masculin"> Masculin</option>
            <option value="Feminin"> Feminin</option>
          </select>
          <label for="floatingSelect">Sexe</label>
        </div>
      </div>
      <div class="col-md-5">
        <div class="form-floating">
          <input type="date" name="date_naissance" class="form-control" id="floatingEmail" placeholder="" required>
          <label for="floatingEmail">Date de naissance</label>
        </div>
      </div>
      <div class="col-md-5">
        <div class="form-floating">
          <input type="text" name="lieu_naissance" class="form-control" id="floatingPassword" placeholder="" required>
          <label for="floatingPassword">Lieu de naissance</label>
        </div>
      </div>
      
      <div class="col-md-6">
        <div class="form-floating">
          <input type="text" name="nom_pere" class="form-control" id="floatingName" placeholder="" required>
          <label for="floatingName">Profession</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-floating">
          <input type="text" name="nom_mere" class="form-control" id="floatingName" placeholder="" required>
          <label for="floatingName">Niveau d'étude</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-floating">
          <input type="text" name="nom_pere" class="form-control" id="floatingName" placeholder="" required>
          <label for="floatingName">Telephone</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-floating">
          <input type="text" name="nom_pere" class="form-control" id="floatingName" placeholder="" required>
          <label for="floatingName">Numero piece d'identité</label>
        </div>
      </div>
      <div class="bg-secondary text-white">
        <hr>
        <p>Lien parents</p>
        <hr>
      </div>
      <div class="col-md-6">
        <div class="form-floating">
          <input type="text" name="nom_pere" class="form-control" id="floatingName" placeholder="" required>
          <label for="floatingName">Nom du pére</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-floating">
          <input type="text" name="nom_mere" class="form-control" id="floatingName" placeholder="" required>
          <label for="floatingName">Nom de la mere</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-floating">
          <input type="text" name="nom_pere" class="form-control" id="floatingName" placeholder="" required>
          <label for="floatingName">Personne contact</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-floating">
          <input type="text" name="nom_pere" class="form-control" id="floatingName" placeholder="" required>
          <label for="floatingName">Telephone personne contact</label>
        </div>
      </div>

      <div class="bg-secondary text-white">
        <hr>
        <p>Situation sanitaire</p>
        <hr>
      </div>
      
      <div class="col-md-6">
        <div class="form-floating">
          <input type="text" name="nom_mere" class="form-control" id="floatingName" placeholder="" required>
          <label for="floatingName">Taille</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-floating">
          <input type="text" name="nom_pere" class="form-control" id="floatingName" placeholder="" required>
          <label for="floatingName">Poid</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-floating">
          <input type="text" name="nom_mere" class="form-control" id="floatingName" placeholder="" required>
          <label for="floatingName">Signe particulière</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-floating">
          <input type="text" name="nom_pere" class="form-control" id="floatingName" placeholder="" required>
          <label for="floatingName">Groupe sanguin</label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-floating">
          <input type="text" name="examen_medical" class="form-control" id="floatingName" placeholder="Examen médical à l’admission (EMA)" required>
          <label for="floatingName">Examen médical à l’admission (EMA)</label>
        </div>
      </div>
      <div class="bg-secondary text-white">
        <hr>
        <p>Date et raison de detention</p>
        <hr>
      </div>
      <div class="col-md-12">
        <div class="form-floating">
          <input type="date" name="date_detention" class="form-control" id="floatingName" placeholder="Date de detention" required>
          <label for="floatingName">Date de detention</label>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-floating mb-3">
          <select class="form-select" id="floatingSelect" aria-label="State" name="mineur" required>
            <option selected>Choix</option>
            <option value="Oui"> Oui</option>
            <option value="Non"> Non</option>
          </select>
          <label for="floatingSelect">Mineur accompagnant bébé</label>
        </div>
      </div>
      <div class="col-8">
        <div class="form-floating">
          <textarea class="form-control" placeholder="Motif de la detention" id="floatingTextarea" style="height: 100px;" name="motif_detention" required></textarea>
          <label for="floatingTextarea">Motif de la detention</label>
        </div>
      </div>
        <hr>
      <div class="text-center d-grid gap-1 mt-2">
      <button class="btn btn-primary" type="submit">Valider</button>
        <!-- <button type="reset" class="btn btn-secondary">Reset</button> -->
      </div>
    </form><!-- End floating Labels Form -->

  </div>
</div>

</div>
 
</section>

</main><!-- End #main -->

@endsection