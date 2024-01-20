@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>OUVERTURE ACTIVITE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">Activite vehicule</li>
          <li class="breadcrumb-item active">Ouverture activite</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-6 form-signin w-50 m-auto">

           <div class="card bg-secondary text-white">

                <div class="card-body">
                <h5 class="card-title">Ouverture activité</h5>
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
                <!-- General Form Elements -->
                <form method="post" action="{{ route('activite_vehicule.store') }}">
                    @csrf
                    <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">intitule</label>
                    <div class="col-sm-10">
                        <input type="text" name="intitule" class="form-control">
                    </div>
                    </div>
                    <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Budget</label>
                    <div class="col-sm-10">
                        <input type="text" name="montant_ouverture" class="form-control">
                    </div>
                    </div>
                    <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Detail </label>
                    <div class="col-sm-10">
                        <textarea name="detail"  class="form-control" style="height: 100px"></textarea>
                    </div>
                    </div>
                    <div class="row mb-3">
                    {{-- <label class="col-sm-2 col-form-label">Submit Button</label> --}}
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                    </div>
                </form><!-- End General Form Elements -->
                @endif
                </div>
            </div>
        </div>

      </div>
    </section>

  </main><!-- End #main -->
@endsection
