@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>BENEFICE INVESTISSEMENT</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">Activite investissement</li>
          <li class="breadcrumb-item active">Saisie benefice  activite</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-10">

           <div class="card">

                <div class="card-body">
                <h5 class="card-title">Benefice activite</h5>
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
                @if ($caisse->etat==0)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <i class="bi bi-exclamation-octagon me-1"></i>
                      Caisse fermer
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if ($caisse->etat==1)
                <!-- General Form Elements -->
                <form method="post" action="{{ route('activite_investissement.update',$activite->id) }}">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Type d'activité</label>
                        <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" name="type_activite" disabled>
                            <option value="">{{ $activite->type_activite }}</option>
                        </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Budget decaisser</label>
                    <div class="col-sm-10">
                        <input type="hidden" value="{{ $activite->montant_decaisse }}" name="montant_decaisser" class="form-control" >
                        <input type="text" value="{{ $activite->montant_decaisse }}"  class="form-control" disabled>
                    </div>
                    </div>
                    <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">commentaire </label>
                    <div class="col-sm-10">
                        <textarea name="commentaire"  class="form-control" style="height: 100px" disabled>{{ $activite->commentaire }}</textarea>
                    </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Montant benefice activite</label>
                        <div class="col-sm-5">
                            <input type="text"  name="montant_benefice" class="form-control" placeholder="Saisie du benefice">
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
