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
  <div class="card-body">
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
          <img src="{{asset('assets/img/profile-img.jpg')}}" alt="Profile">
          <br>
          <br>
                <div class="form-floating">
                  <input type="file" name="photo" class="form-control" id="floatingName" placeholder="Nom de la mere">
                  <label for="floatingName">Photo identité</label>
                </div>
        </div>
        <div class="col-md-4">
        <div class="form-floating mb-3">
          <select class="form-select" id="floatingSelect" aria-label="State" name="sexe">
            <option selected>Choix civilité</option>
            <option value="F"> Monsieur</option>
            <option value="M"> Madame</option>
            <option value="M"> Mademoiselle</option>
          </select>
          <label for="floatingSelect">Civilite</label>
        </div>
      </div>
        <div class="col-md-4">
        <div class="form-floating">
          <input type="text" name="prenom" class="form-control" id="floatingName" placeholder="Nom de la mere">
          <label for="floatingName">Prenom</label>
        </div>
      </div>
        <div class="col-md-4">
        <div class="form-floating">
          <input type="text" name="nom" class="form-control" id="floatingName" placeholder="Nom prenom">
          <label for="floatingName">Nom</label>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="form-floating mb-3">
          <select class="form-select" id="floatingSelect" aria-label="State" name="sexe">
            <option selected>Choix sexe</option>
            <option value="F"> Feminin</option>
            <option value="M"> Masculin</option>
          </select>
          <label for="floatingSelect">Sexe</label>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-floating">
          <input type="date" name="date_naissance" class="form-control" id="floatingEmail" placeholder="Date de naissance">
          <label for="floatingEmail">Date de naissance</label>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-floating">
          <input type="text" name="lieu_naissance" class="form-control" id="floatingPassword" placeholder="Lieu de naissance">
          <label for="floatingPassword">Lieu de naissance</label>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-floating">
          <input type="text" name="nom_mere" class="form-control" id="floatingName" placeholder="Nom de la mere">
          <label for="floatingName">Nom du pére</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-floating">
          <input type="text" name="nom_mere" class="form-control" id="floatingName" placeholder="Nom de la mere">
          <label for="floatingName">Nom de la mere</label>
        </div>
      </div>


      <div class="col-md-12">
        <div class="form-floating">
          <input type="text" name="examen_medical" class="form-control" id="floatingName" placeholder="Examen médical à l’admission (EMA)">
          <label for="floatingName">Examen médical à l’admission (EMA)</label>
        </div>
      </div>
      
      <div class="col-md-12">
        <div class="form-floating">
          <input type="date" name="date_detention" class="form-control" id="floatingName" placeholder="Date de detention">
          <label for="floatingName">Date de detention</label>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-floating mb-3">
          <select class="form-select" id="floatingSelect" aria-label="State" name="sexe">
            <option selected>Choix</option>
            <option value="F"> Oui</option>
            <option value="M"> Nom</option>
          </select>
          <label for="floatingSelect">Mineur accompagnant bébé</label>
        </div>
      </div>
      <div class="col-8">
        <div class="form-floating">
          <textarea class="form-control" placeholder="Motif de la detention" id="floatingTextarea" style="height: 100px;" name="motif_detention"></textarea>
          <label for="floatingTextarea">Motif de la detention</label>
        </div>
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-primary">Valider</button>
        <!-- <button type="reset" class="btn btn-secondary">Reset</button> -->
      </div>
    </form><!-- End floating Labels Form -->

  </div>
</div>

</div>

<div class="col-lg-6 text-center">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">LIBERATION DETENU</h5>

          <!-- Floating Labels Form -->
          <form class="row g-3">
            <div class="col-md-12">
              <div class="form-floating">
                <input type="date" class="form-control" id="floatingName" placeholder="Date de detention">
                <label for="floatingName">Date de liberation</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-floating">
                <input type="date" class="form-control" id="floatingName" placeholder="Date de transfèrement dans une maison d’arrêt (MA)">
                <label for="floatingName">Date de transfèrement dans une maison d’arrêt (MA)</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-floating mb-3">
                <select class="form-select" id="floatingSelect" aria-label="State">
                  <option selected>Maison d'arret</option>
                  <option value="1">Niamey</option>
                  <option value="2">Kollo</option>
                </select>
                <label for="floatingSelect"> Nom de la maison d’arrêt</label>
              </div>
            </div>
            <div class="text-end">
              <!-- <button type="submit" class="btn btn-primary">Valider</button> -->
              <!-- <button type="reset" class="btn btn-secondary">Reset</button> -->
            </div>
          </form><!-- End floating Labels Form -->

        </div>
      </div>

    </div>
  </div>
</section>

</main><!-- End #main -->

@endsection