@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>CLIENTS</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">Client</li>
          <li class="breadcrumb-item active">Client</li>
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
                Ajouter client
              </button>
            </h5>
            <!-- Vertical Form -->
            <form class="row g-3" method="post" action="{{ route('users.store') }}" >
                @csrf
              <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Ajouter client</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body" >
                        <div class="col-12">
                            <input type="hidden" name="societe" value="{{ Auth::user()->societe_id }}" class="form-control" id="inputNanme4">
                        </div>
                        <div class="col-12">
                            <input type="hidden" name="gestion" value="{{ Auth::user()->gestion_id }}" class="form-control" id="inputNanme4">
                        </div>

                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Nom complet</label>
                            <input type="text" name="nom" class="form-control" id="inputNanme4">
                        </div>

                        <div class="col-12">
                            <label for="inputPassword4" class="form-label">sexe</label>
                            <input type="password" name="password" class="form-control" id="inputPassword4">
                        </div>

                        <div class="col-12">
                            <label for="inputPassword4" class="form-label">Telephone</label>
                            <input type="password" name="password" class="form-control" id="inputPassword4">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Address</label>
                            <input type="text" name="adresse" class="form-control" id="inputAddress" >
                        </div>
                       <div class="col-12">
                            <label for="inputEmail4" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="inputEmail4">
                        </div>
                        <div class="col-12">
                            <label for="inputPassword4" class="form-label">type client</label>
                            <input type="password" name="passwordconfirme" class="form-control" id="inputPassword4">
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
                    <th scope="col">Nom Prenom</th>
                    <th scope="col">Telephone</th>
                    <th scope="col">adresse</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client )
                  <tr>

                    <th scope="row">{{ $client->id}}</th>
                    <td>{{ $client->nom_client }}</td>
                    <td>{{ $client->telephone}}</td>
                    <td>{{ $client->adresse}}</td>
                    <td>
                        <a href="{{ route('client.edit',encrypt($client->id)) }}">
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

