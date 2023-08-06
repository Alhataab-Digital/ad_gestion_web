@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>FICHER LOG UTILISATEURS DU SYSTEME</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">param</li>
          <li class="breadcrumb-item active">logs utilisateur</li>
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
                <table class="table table-borderless datatable">
                  <thead class="bg-primary ">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nom Prenom</th>
                      <th scope="col">adresse</th>
                      <th scope="col">Email</th>
                      <th scope="col">Role</th>
                      <th scope="col">Societe</th>
                      <th scope="col">Gestion</th>
                      <th scope="col">Date temps</th>
                      <th scope="col">etat</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($onlines as $online )
                    <tr>
                      <th scope="row">{{ $online->utilisateur->id}}</th>
                      <td>{{ $online->utilisateur->prenom .' '.$online->utilisateur->nom}}</td>
                      <td>{{ $online->utilisateur->adresse}}</td>
                      <td>{{ $online->utilisateur->email}}</td>
                      @if($online->utilisateur->role_id==0)
                      <td></td>
                      @endif
                      @if($online->utilisateur->role_id!=0)
                      <td>{{ $online->utilisateur->role->role }}</td>
                      @endif
                      <td>{{ $online->utilisateur->societe->raison_sociale}}</td>
                      <td>{{ $online->utilisateur->gestion->gestion}}</td>
                      <td>{{ $online->created_at }}</td>
                      <td ><span class="badge bg-success">{{ $online->etat}}</span></td>
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
