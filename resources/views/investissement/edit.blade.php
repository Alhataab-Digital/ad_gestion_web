@extends('../layouts.app')

@section('content')


<main id="main" class="main">

    <div class="pagetitle">
      <h1>MODIFICATION DE L'INVESTISSEUR</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">Investisseur</li>
          <li class="breadcrumb-item active">Investisseur</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">


        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
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

            </h5>

              <!-- Vertical Form -->
              <form action="{{ route('investisseur.update',encrypt($investisseur->id)) }}" method="post" class="row g-3" >
                @csrf

                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Nom</label>
                    <input type="text" name="nom" value="{{ $investisseur->nom }}" class="form-control" id="inputNanme4">
                  </div>
                  <div class="col-12">
                    <label for="inputNanme4" class="form-label">Prenom</label>
                    <input type="text" name="prenom" value="{{ $investisseur->prenom }}" class="form-control" id="inputNanme4">
                  </div>
                  <div class="col-12">
                  <label for="inputEmail4" class="form-label">Email</label>
                  <input type="email" name="email" value="{{ $investisseur->email }}" class="form-control" id="inputEmail4">
                </div>
                <div class="col-12">
                  <label for="inputEmail4" class="form-label">Telephone</label>
                  <input type="text" name="telephone" value="{{ $investisseur->telephone }}" class="form-control" id="inputEmail4">
                </div>
                <div class="col-12">
                  <label for="inputAddress" class="form-label">Heritier</label>
                  <input type="text" name="heritier" value="{{ $investisseur->heritier }}" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Modifer</button>
                  <a href="{{ route('investisseur') }}">
                    <button type="button" class="btn btn-secondary">Retour</button></a>
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>
        </div>
       
        <div class="col-lg-6">
            @if($investisseur->password==NULL)
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                         <!-- Vertical Form -->
                         <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                            L'investisseur n'a pas creer de compte
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <!-- Vertical Form -->
                </div>
              </div>
            @else
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Initialiser Mot de passe</h5>
                         <!-- Vertical Form -->
                    <form action="{{ route('investisseur.password', encrypt($investisseur->id)) }}" method="post" class="row g-3" >
                        @csrf
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Nouveau mot de passe</label>
                            <input type="password" name="password"  class="form-control" id="inputNanme4" required>
                        </div>

                        <div class="text-center">
                        <button type="submit" class="btn btn-primary">Valider</button>
                        <a href="{{ route('investisseur') }}">
                            <button type="button" class="btn btn-secondary">Retour</button></a>
                        </div>
                    </form><!-- Vertical Form -->
                </div>
              </div>
            @endif
              


        </div>
      </div>
    </section>

  </main><!-- End #main -->



@endsection
