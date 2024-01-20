@extends('../layouts.app')

@section('content')


<main id="main" class="main">

    <div class="pagetitle">
      <h1>NOUVEAU INVESTISSEUR</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Accueil</a></li>
          <li class="breadcrumb-item">Gestion investisseur</li>
          <li class="breadcrumb-item active">Nouveau investisseur</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
            <div class="card recent-sales overflow-auto">
              <div class="card-body">
                <h5 class="card-title">Liste investisseur</h5>
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
                <table class="table table-borderless datatable">
                  <thead class="bg-primary text-white">
                    <tr>
                    @if(Auth::user()->role_id=="0" || Auth::user()->role_id=="1" || Auth::user()->role_id=="2")
                      <th scope="col">code</th>
                    @endif
                      <th scope="col">Nom</th>
                      <th scope="col">Prenom</th>
                      <th scope="col">Email</th>
                      <th scope="col">Telephone</th>
                      @if(Auth::user()->role_id=="0" || Auth::user()->role_id=="1" || Auth::user()->role_id=="2")
                      <th scope="col">Montant investis</th>
                      <!-- <th scope="col">Compte investissement</th> -->
                      <th scope="col">Dividende</th>
                      <th scope="col">Date creation</th>
                      @endif
                      <th scope="col">heritier</th>
                      <th scope="col">status</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($investisseurs as $investisseur )

                    <tr>
                        @if(Auth::user()->role_id=="0" || Auth::user()->role_id=="1" || Auth::user()->role_id=="2")
                        <td>{{ $investisseur->code }}</td>
                        @endif
                        <th scope="row"><a href="#">{{ $investisseur->nom }}</a></th>
                        <td>{{ $investisseur->prenom }}</td>
                        <td><a href="#" class="text-primary">{{ $investisseur->email }}</a></td>
                        <td>{{ $investisseur->telephone }}</td>
                        @if(Auth::user()->role_id=="0" || Auth::user()->role_id=="1" || Auth::user()->role_id=="2")
                        <td>{{ $investisseur->montant_investis }}</td>
                        <!-- <td>{{ $investisseur->compte_investisseur }}</td> -->
                        <td>{{ $investisseur->compte_dividende }}</td>
                        <td>{{ $investisseur->date_creation }}</td>
                        @endif
                        <td>{{ $investisseur->heritier }}</td>
                        @if($investisseur->etat==0)
                        <td><span class="badge bg-danger">compte non actif</span></td>
                        @endif
                        @if($investisseur->etat==1)
                        <td><span class="badge bg-success">compte actif</span></td>
                        @endif
                        <td>
                        <a href="{{ route('investisseur.edit',encrypt($investisseur->id)) }}">
                            <button type="button" class="btn btn-primary"><i class="bi bi-pencil"></i></button>
                        </a>
                         <a href="">
                            <button type="button" class="btn btn-secondary"><i class="bi bi-eye"></i></button>
                        </a>
                        <!-- <a href="">
                            <button type="button" class="btn btn-danger"><i class="bi bi-exclamation-octagon"></i></button>
                        </a> -->
                    </td>
                    </tr>

                    @endforeach


                  </tbody>
                </table>

              </div>

            </div>
          </div><!-- End Recent Sales -->

      </div>
    </section>

  </main><!-- End #main -->

  @endsection
