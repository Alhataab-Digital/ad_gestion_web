@extends('../layouts.app')

@section('content')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>CONSULTATION COMPTE</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
        <li class="breadcrumb-item">Gestion investisseur</li>
        <li class="breadcrumb-item active">Consultation compte</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body ">
            <h5 class="card-title ">Activation / desactivation compte investisseur</h5>
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
            <!-- Multi Columns Form -->
            <form class="row g-3" method="POST" action="{{ route('investisseur.consulter') }}">
                @csrf
              <div class="col-md-12">
                <label for="inputName5" class="form-label">Code investisseur</label>
                <input type="text" name="code" class="form-control" id="telephone">
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary">Valider</button>
              </div>
            </form><!-- End Multi Columns Form -->


          </div>
        </div>

      </div>

    </div>
  </section>

</main><!-- End #main -->
  @endsection
