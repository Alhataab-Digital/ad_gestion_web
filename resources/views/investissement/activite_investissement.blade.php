@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>NOUVELLE ACTIVITE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">Activite investissement</li>
          <li class="breadcrumb-item active">Nouvelle activite</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-10">

           <div class="card">

                <div class="card-body">
                <h5 class="card-title">Formulaire d'enregistrement activité</h5>
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
                <form method="post" action="{{ route('activite_investissement.store') }}">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Type d'activité</label>
                        <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" name="type_activite" require>
                            <option >Choisir...</option>
                            @foreach ($type_activites as $type_activite )
                            <option value="{{ $type_activite->id }}">{{ $type_activite->type_activite }}</option>
                            @endforeach

                        </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Budget decaisser</label>
                    <div class="col-sm-10">
                        <input type="text" name="montant_decaisse" class="form-control">
                    </div>
                    </div>
                    <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">commentaire </label>
                    <div class="col-sm-10">
                        <textarea name="commentaire"  class="form-control" style="height: 100px"></textarea>
                    </div>
                    </div>

                    <div class="row mb-3">
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
