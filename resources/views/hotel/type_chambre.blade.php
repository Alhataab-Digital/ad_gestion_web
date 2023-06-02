@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>TYPE DE CHAMBRE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">param</li>
          <li class="breadcrumb-item active">type de chambre</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
          <div class="col-lg-6">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">
              <!-- Basic Modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                  Ajouter type de chambre
                </button>
              </h5>
              <!-- Vertical Form -->
              <form class="row g-3" method="post" action="{{ route('type_chambre.store') }}" >
                  @csrf
                <div class="modal fade" id="basicModal" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Ajouter type de chambre</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>

                      <div class="modal-body" >
                          <div class="col-12">
                              <input type="hidden" name="societe" value="{{ Auth::user()->societe_id }}" class="form-control" id="inputNanme4">
                          </div>
                          <div class="col-12">
                              <label for="inputNanme4" class="form-label">Nom type de chambre</label>
                              <input type="text" name="nom_type_chambre" class="form-control" id="inputNanme4">
                          </div>
                          <div class="col-12">
                              <label for="inputNanme4" class="form-label">Prix</label>
                              <input type="text" name="prix" class="form-control" id="inputNanme4">
                          </div>
                          <div class="col-12">
                              <label for="inputAddress" class="form-label">Capacite</label>
                              <input type="text" name="capacite" class="form-control" id="inputAddress" >
                          </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </div>

                    </div>
                  </div>
                </div><!-- End Basic Modal-->
              </form><!-- Vertical Form -->
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
                <table class="table table-borderless datatable">
                  <thead class="bg-primary ">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nom type de chambre</th>
                      <th scope="col">Prix</th>
                      <th scope="col">Capacite</th>
                      <th scope="col">Societe</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($type_chambres as $type_chambre )
                    <tr>

                      <th scope="row">{{ $type_chambre->id}}</th>
                      <td>{{ $type_chambre->nom_type_chambre}}</td>
                      <td>{{ $type_chambre->prix}}</td>
                      <td>{{ $type_chambre->capacite}}</td>
                      <td>{{ $type_chambre->societe->raison_sociale}}</td>
                      <td>
                          <a href="{{ route('type_chambre.edit',$type_chambre->id) }}">
                              <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
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
