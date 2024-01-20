@extends('../layouts.app')

@section('content')


<main id="main" class="main">

    <div class="pagetitle">
      <h1>NOUVEAU INVESTISSEUR</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Accueil</a></li>
          <li class="breadcrumb-item">Gestion investisseur</li>
          <li class="breadcrumb-item active">Nouveau investisseur</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">

        <div class="col-lg-6">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Nouveau investisseur</h5>
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
                    <!-- No Labels Form -->
                    <form class="row g-3" method="post" action="{{ route('investisseur.store') }}">
                        @csrf
                        <div class="col-md-6">
                            <input type="text" name="nom" class="form-control" placeholder="Nom">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="prenom" class="form-control" placeholder="Prenom">
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="telephone" class="form-control" placeholder="Telephone">
                        </div>
                        <div class="col-md-6">
                            <input type="email" name="email" class="form-control" placeholder="Email">
                        </div>

                        <div class="col-12">
                            <input type="text" name="heritier" class="form-control" placeholder="Nom heritier">
                        </div>
                        {{-- <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="City">
                        </div>
                        <div class="col-md-4">
                            <select id="inputState" class="form-select">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" placeholder="Zip">
                        </div> --}}
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Valider</button>
                        </div>
                    </form><!-- End No Labels Form -->

                </div>
            </div>


        </div>
    </section>

  </main><!-- End #main -->

  @endsection
