@extends('../layouts.app')

@section('content')


<main id="main" class="main">

    <div class="pagetitle">
      <h1>MODIFICATION DE L'UTILISATEUR</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Layouts</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">


        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
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

            </h5>

              <!-- Vertical Form -->
              <form action="{{ route('users.update',$utilisateur->id) }}" method="post" class="row g-3" >
                @csrf

                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Nom</label>
                    <input type="text" name="nom" value="{{ $utilisateur->nom }}" class="form-control" id="inputNanme4">
                  </div>
                  <div class="col-12">
                    <label for="inputNanme4" class="form-label">Prenom</label>
                    <input type="text" name="prenom" value="{{ $utilisateur->prenom }}" class="form-control" id="inputNanme4">
                  </div>
                <div class="col-12">
                  <label for="inputEmail4" class="form-label">Email</label>
                  <input type="email" name="email" value="{{ $utilisateur->email }}" class="form-control" id="inputEmail4">
                </div>
                <div class="col-12">
                  <label for="inputAddress" class="form-label">Address</label>
                  <input type="text" name="adresse" value="{{ $utilisateur->adresse }}" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Modifer</button>
                  <a href="{{ route('users.index') }}">
                    <button type="button" class="btn btn-secondary">Retour</button></a>
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>
        </div>

        <div class="col-lg-6">

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title ">
                        <div style="text-transform:uppercase">
                        Role de <strong>{{ $utilisateur->prenom.' '.$utilisateur->nom }}</strong>
                        </div>

                        <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Role & permission</h5>

                              <!-- Advanced Form Elements -->
                              <form  action="{{ route('users.role', $utilisateur->id) }}" method="post">
                                @csrf
                                <div class="row mb-5">
                                  <div class="col-sm-10">
                                    @foreach ($roles as $role )
                                    @if ($utilisateur->role_id==$role->id)
                                    <div class="form-check form-switch">
                                      <input class="form-check-input" type="checkbox" name="role" value="{{ $role->id}}"  id="flexSwitchCheckChecked" checked>
                                      <label class="form-check-label" for="flexSwitchCheckDefault">{{ $role->role }}</label>
                                    </div>
                                    @else
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="role" value="{{ $role->id}}" id="flexSwitchCheckDefault">
                                      <label class="form-check-label" for="flexSwitchCheckChecked">{{ $role->role }}</label>
                                    </div>
                                    @endif
                                    @endforeach
                                  </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                    <a href="{{ route('users.index') }}">
                                      <button type="button" class="btn btn-secondary">Retour</button></a>
                                </div>
                              </form><!-- End General Form Elements -->

                    </h4>
                </div>
              </div>


              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Initialiser Mot de passe</h5>
                         <!-- Vertical Form -->
              <form action="{{ route('users.password', $utilisateur->id) }}" method="post" class="row g-3" >
                @csrf

                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Nouveau mot de passe</label>
                    <input type="password" name="password"  class="form-control" id="inputNanme4">
                  </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Valider</button>
                  <a href="{{ route('users.index') }}">
                    <button type="button" class="btn btn-secondary">Retour</button></a>
                </div>
              </form><!-- Vertical Form -->


                </div>
              </div>


        </div>
      </div>
    </section>

  </main><!-- End #main -->



@endsection
