@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>OPERATION ENCAISSEMENT</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">autre operation</li>
          <li class="breadcrumb-item active">encaissement</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
            </h5>

              <P>

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

              </P>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead class="bg-primary">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Commentaire </th>
                    <th scope="col">Montant</th>
                    <th scope="col">Caisse provenance</th>
                    <th scope="col">Utilisateur</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach ($operations as $operation )
                  <tr>
                    <th scope="row">{{ $operation->id}}</th>
                    <td>{{ $operation->commentaire}}</td>
                    <td>{{ $operation->montant_operation}}</td>
                    <td>{{ $operation->caisse->libelle}}</td>
                    <td>{{ $operation->user->nom}}</td>
                    <td>
                        <a href="{{ route('caisse.encaissement.valider',$operation->id) }}">
                            <button type="button" class="btn btn-success"><i class="ri ri-arrow-down-line"></i></button>
                        </a>

                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->



@endsection
