@extends('../layouts.app')

@section('content')


<main id="main" class="main">

    <div class="pagetitle">
      <h1>REGLEMENT FACTURE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Acceuil</a></li>
          <li class="breadcrumb-item">Reglement & recouvrement</li>
          <li class="breadcrumb-item active">Reglement facture</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Reglement facture</h5>
              <p>
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
                </p>
                @if ($caisse->etat==1 && $caisse->date_comptable!= date("Y-m-d") )
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-octagon me-1"></i>
                        La date operation n'est pas a jour
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if ($caisse->etat==0 )
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-octagon me-1"></i>
                Caisse fermer
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if ($caisse->etat==1 && $caisse->date_comptable == date("Y-m-d"))
              <!-- Horizontal Form -->
              <form class="row g-3" method="POST" action="{{ route('reglement.numero_client') }}">
                @csrf
                    <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Numero du client</label>
                    <div class="col-sm-8">
                        <input type="text" name="numero" class="form-control" id="inputText">
                    </div>
                    </div>
                    
                    <div class="text-center">
                    <button type="submit" class="btn btn-primary">Suivant</button>
                    </div>
                </form><!-- End Horizontal Form -->
                @endif
            </div>
          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->

@endsection