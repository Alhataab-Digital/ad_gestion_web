@extends('../layouts.app')

@section('content')


<main id="main" class="main">

    <div class="pagetitle">
      <h1>MODIFICATION DU ENTREPOT</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">Gestion stock</li>
          <li class="breadcrumb-item active">Entrepot</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">


        <div class="form-signin w-50 m-auto col-lg-6">

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
              <form action="{{ route('entrepot.update',encrypt($entrepot->id)) }}" method="post" class="row g-3" >
                @csrf

                <div class="col-12">
                              <label for="inputNanme4" class="form-label">Nom ntrepot</label>
                              <input type="text" name="nom"  value="{{ $entrepot->nom_entrepot }}" class="form-control" id="inputNanme4">
                          </div>
                          <div class="col-12">
                              <label for="inputAddress" class="form-label">Adresse entrepot</label>
                              <input type="text" name="adresse" value="{{ $entrepot->adresse_entrepot }}" class="form-control" id="inputAddress" >
                          </div>
                          <div class="col-12">
                              <label for="inputAddress" class="form-label">Capacite entrepot</label>
                              <input type="text" name="capacite" value="{{ $entrepot->capacite_entrepot }}" class="form-control" id="inputAddress" >
                          </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Modifer</button>
                  <a href="{{ route('entrepot') }}">
                    <button type="button" class="btn btn-secondary">Retour</button></a>
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>
        </div>

      </div>
    </section>

  </main><!-- End #main -->



@endsection
