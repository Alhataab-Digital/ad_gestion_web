@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>UTILISATEURS DU SYSTEME</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">param</li>
          <li class="breadcrumb-item active">Utilisateur</li>
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
                  Ajouter utilisateur
                </button>
              </h5>
              <!-- Vertical Form -->
              <form class="row g-3" method="post" action="{{ route('users.store') }}" >
                  @csrf
                <div class="modal fade" id="basicModal" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" style="background-color: silver">
                        <h5 class="modal-title">Ajouter utilisateur</h5>
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
                              <input type="hidden" name="terms" value="1" class="form-control" id="inputNanme4">
                          </div>
                          <div class="col-12">
                              <label for="inputNanme4" class="form-label">Nom</label>
                              <input type="text" name="nom" class="form-control" id="inputNanme4">
                          </div>
                          <div class="col-12">
                              <label for="inputNanme4" class="form-label">Prenom</label>
                              <input type="text" name="prenom" class="form-control" id="inputNanme4">
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
                              <label for="inputPassword4" class="form-label">Password</label>
                              <input type="password" name="password" class="form-control" id="inputPassword4">
                          </div>
                          <div class="col-12">
                              <label for="inputPassword4" class="form-label">Confirme Password</label>
                              <input type="password" name="passwordconfirme" class="form-control" id="inputPassword4">
                          </div>

                      </div>
                      <div class="modal-footer" style="background-color: silver">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Valider</button>
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
                      <!-- <th scope="col">#</th> -->
                      <th scope="col">Nom Prenom</th>
                      <th scope="col">adresse</th>
                      <th scope="col">Email</th>
                      <th scope="col">Role</th>
                      <th scope="col">Societe</th>
                      <th scope="col">Gestion</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($utilisateurs as $utilisateur )
                    <tr>

                      <!-- <th scope="row">{{ $utilisateur->id}}</th> -->
                      <td>{{ $utilisateur->prenom .' '.$utilisateur->nom}}</td>
                      <td>{{ $utilisateur->adresse}}</td>
                      <td>{{ $utilisateur->email}}</td>
                      @if($utilisateur->role_id==0)
                      <td></td>
                      @endif
                      @if($utilisateur->role_id!=0)
                      <td>{{ $utilisateur->role->role }}</td>
                      @endif
                      <td>{{ $utilisateur->societe->raison_sociale}}</td>
                      <td>{{ $utilisateur->gestion->gestion}}</td>
                      <td>
                          <a href="{{ route('users.edit',encrypt($utilisateur->id)) }}">
                              <button type="button" class="btn btn-primary"><i class="bi bi-pencil"></i></button>
                          </a>
                      @if ($utilisateur->etat==0)
                      <a href="{{ route('users.active',$utilisateur->id)}}">
                          <button type="button" class="btn btn-danger"><i class="bi bi-exclamation-octagon"></i></button>
                      </a>
                      @endif
                      @if ($utilisateur->etat==1)
                      <a href="{{ route('users.inactive',$utilisateur->id)}}">
                          <button type="button" class="btn btn-success"><i class="bi bi-check-circle"></i></button>
                      </a>
                      @endif

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
