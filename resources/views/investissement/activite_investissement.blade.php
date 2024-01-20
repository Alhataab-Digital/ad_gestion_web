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
        <div class="form-signin w-50 m-auto col-lg-12">


          <div class="card bg-secondary text-white">
            <div class="card-body">
              <h5 class="card-title text-white">Creer une nouvelle activité</h5>
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
                @if ($caisse->etat==0 )
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-octagon me-1"></i>
                    Caisse fermer
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if ($caisse->etat==1 && $caisse->date_comptable == date("Y-m-d"))
              <!-- Multi Columns Form -->
              <form class="row g-3" method="post" action="{{ route('activite_investissement.store') }}">
                  @csrf
                <div class="col-md-12">
                  <label for="inputState" class="form-label">Type activité</label>
                  <select id="inputState" class="form-select" name="type_activite" required>
                    <option selected>Choose...</option>
                    @foreach ($type_activites as $type_activite )
                    <option value="{{ $type_activite->id }}">{{ $type_activite->type_activite }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-12">
                  <label for="inputName5" class="form-label">Montant activité</label>
                  <input type="text" class="form-control" id="inputName5" name="montant_decaisse" required>
                </div>
                
                <!-- <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                      Check me out
                    </label>
                  </div>
                </div> -->
                <div class="text-end">
                  <button type="submit" class="btn btn-primary">Enregister</button>
                  <!-- <button type="reset" class="btn btn-secondary">Reset</button> -->
                </div>
              </form><!-- End Multi Columns Form -->
              @endif
            </div>
          </div>

        </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
@endsection
