@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>AGENCES</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">param</li>
          <li class="breadcrumb-item active">Agence</li>
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
                Ajouter agence
              </button>
            </h5>
            <!-- Vertical Form -->
            <form class="row g-3" method="post" action="{{ route('agence.store') }}" >
                @csrf
              <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Ajouter agence</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <div class="modal-body" >
                        <div class="col-12">
                            <input type="hidden" name="societe" value="{{ Auth::user()->societe_id }}" class="form-control" id="inputNanme4">
                        </div>
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Nom</label>
                            <input type="text" name="nom" class="form-control" id="inputNanme4">
                        </div>
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Adresse</label>
                            <input type="text" name="adresse" class="form-control" id="inputNanme4">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Telephone</label>
                            <input type="text" name="telephone" class="form-control" id="inputAddress" >
                        </div>
                       <div class="col-12">
                            <label for="inputEmail4" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="inputEmail4">
                        </div>
                        <div class="col-12">
                            <label for="validationDefault04" class="form-label">Pays / Region</label>
                            <select class="form-select" id="validationDefault04" name="region_id" required>
                            <option selected disabled value="">Choose...</option>
                            @foreach ( $regions as $region )
                            <option value="{{ $region->id }}">{{ $region->nom }}</option>
                            @endforeach
                            </select>
                        </div><div class="col-12">
                            <label for="validationDefault04" class="form-label">Devise</label>
                            <select class="form-select" id="validationDefault04" name="devise_id" required>
                            <option selected disabled value="">Choose...</option>
                            @foreach ( $devises as $devise )
                            <option value="{{ $devise->id }}">{{ $devise->devise }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                <!-- Vertical Form -->
                  </div>
                </div>
              </div><!-- End Basic Modal-->
            </form>

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
                    <th scope="col">Nom </th>
                    <th scope="col">adresse</th>
                    <th scope="col">Telephone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Pays / Region </th>
                    <th scope="col">Societe</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($agences as $agence )
                  <tr>

                    <th scope="row">{{ $agence->id}}</th>
                    <td>{{ $agence->nom}}</td>
                    <td>{{ $agence->adresse}}</td>
                    <td>{{ $agence->telephone}}</td>
                    <td>{{ $agence->email}}</td>
                    <td>{{ $agence->region->nom}}</td>
                    <td>{{ $agence->societe->raison_sociale}}</td>
                    <td>
                        <a href="{{ route('agence.edit',encrypt($agence->id)) }}">
                          <button type="button" class="btn btn-primary"><i class="bi bi-pencil"></i></button>
                        </a>
                        <!-- <a href="">
                            <button type="button" class="btn btn-success"><i class="bi bi-check-circle"></i></button>
                        </a>
                        <a href="">
                            <button type="button" class="btn btn-danger"><i class="bi bi-exclamation-octagon"></i></button>
                        </a> -->
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
