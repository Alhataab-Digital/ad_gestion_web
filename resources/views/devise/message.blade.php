@extends('../layouts.app')

@section('content')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Message </h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
        <li class="breadcrumb-item">Message </li>
        <li class="breadcrumb-item active">Message </li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Message alert </h5>

              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-octagon me-1"></i>
                Verifiez l'usage du montant des investisseurs
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>


          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->
  @endsection
