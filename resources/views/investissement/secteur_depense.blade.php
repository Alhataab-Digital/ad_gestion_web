@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>SECTEUR DEPENSE ACTIVITE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">param</li>
          <li class="breadcrumb-item active">Secteur depense activite</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
          <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">
              <!-- Basic Modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                  Ajouter Secteur depense activite
                </button>
              </h5>
              <!-- Vertical Form -->
              <form class="row g-3" method="post" action="{{ route('secteur_depense.store') }}" >
                  @csrf
                <div class="modal fade" id="basicModal" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Ajouter Secteur depense activite</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>

                      <div class="modal-body" >
                          <div class="col-12">
                              <label for="inputNanme4" class="form-label">Secteur depense activite</label>
                              <input type="text" name="secteur_depense" class="form-control" id="inputNanme4">
                          </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
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
                        <th scope="col">Secteur de depense activite</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($secteur_depenses as $secteur_depense )
                      <tr>

                        <th scope="row">{{ $secteur_depense->id}}</th>
                        <td>{{ $secteur_depense->secteur_depense}}</td>
                        <td>
                            <a href="{{ route('secteur_depense.edit',$secteur_depense->id) }}">
                              <button type="button" class="btn btn-primary"><i class="bi bi-pencil"></i></button>
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
