@extends('../layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>GESTION CAISSE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">Operation</li>
          <li class="breadcrumb-item active">Gestion caisse</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    @foreach ($caisses as $caisse )
        <section class="section">
        <div class="row align-items-top">
            <div class="col-lg-6">

            <!-- Card with an image on left -->
            <div class="card mb-3">
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
                <div class="row g-0">
                <div class="col-md-4">
                    @if($caisse->etat==1)
                    <img src="{{ url('assets/img/caisse.jpg') }}" class="img-fluid rounded-start" alt="...">
                    @else
                    <img src="{{ url('assets/img/caisse-fermer.jpg') }}" class="img-fluid rounded-start" alt="...">
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                    @if ($caisse->etat==1)
                    <p class="card-text"> {{ $caisse->user->societe->nom }}</p>
                    <p class="card-text"> {{ $caisse->agence->nom }}</p>
                    <h4 class="card-title">Caisse de <span >{{ $caisse->user->prenom .' '.$caisse->user->nom }}</span></h4>
                    <p class="card-text">Intitule caisse : <span>{{ $caisse->libelle }}</span> </p>
                    <p class="card-text">Montant caisse : <span>{{number_format($caisse->compte,2,","," ").' '.$agence->devise->unite }}</span></p>

                    {{-- <a href="" class="btn btn-danger">Fermer</a> --}}
                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">
                             <!-- Basic Modal -->
                          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#Fermer">
                           Fermer la caisse
                          </button>
                        </h5>
                         <!-- Vertical Form -->
                         <form class="row g-3" method="post" action="{{ route('caisse.fermeture',$caisse->id) }}" >
                                    @csrf
                          <div class="modal fade" id="Fermer" tabindex="-1">
                            <div class="modal-dialog">
                              <div class="modal-content" style="background-color: silver">
                                <div class="modal-header">
                                  <h5 class="modal-title">Ajouter caisse</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" >
                                   <div class="col-12">
                                        <label for="inputEmail4" class="form-label">Date de fermeture</label>
                                        <input type="text" name="date" value="{{ $caisse->date_comptable }}" class="form-control" id="inputEmail4" readonly>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-danger">Valider</button>
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Quitter</button>

                                </div>
                            
                              </div>
                            </div>
                          </div>
                          </form><!-- Vertical Form -->
                          <!-- End Basic Modal-->
                          </P>

                        </div>
                    </div>
                    @else
                    <br><br>
                    {{-- <a href="" class="btn btn-success">Ouvrir</a> --}}

                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">
                             <!-- Basic Modal -->
                          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Fermer">
                            Ouvrer la caisse
                          </button>
                        </h5>
                        <!-- Vertical Form -->
                        <form class="row g-3" method="post" action="{{ route('caisse.ouverture',$caisse->id) }}" >
                                    @csrf
                          <div class="modal fade" id="Fermer" tabindex="-1">
                            <div class="modal-dialog">
                              <div class="modal-content" style="background-color: silver">
                                <div class="modal-header">
                                  <h5 class="modal-title">Ajouter caisse</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                
                                <div class="modal-body" >
                                   <div class="col-12">
                                        <label for="inputEmail4" class="form-label">Date d'ouverture</label>
                                        <input type="date" name="date" value="{{ date('Y-m-d') }}" class="form-control" id="inputEmail4">
                                    </div>
                                </div>
                                <div class="modal-footer"> <button type="submit" class="btn btn-success">Valider</button>
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Quitter</button>

                                </div>
                            
                              </div>
                            </div>
                          </div><!-- End Basic Modal-->
                          </form><!-- Vertical Form -->
                          </P>
                        </div>
                    </div>

                    @endif
                    </div>
                </div>
                </div>
            </div><!-- End Card with an image on left -->

            </div>
@if(Auth::user()->gestion->gestion=="Change")
            <div class="col-lg-6">

            <!-- Special title treatmen -->
            <div class="card text-center">
                @if($caisse->etat==1)
                <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                      <h4 style="text-decoration:uppercase;">Stock devise</h4>
                    <!--a class="nav-link active" href="#">Active</a-->
                    </li>
                </ul>
                </div>

                <div class="card-body">

                    <Table class="table datatable">
                        <thead>
                            <tr class="card-title ">
                                <th>Devise</th>
                                <th>Montant</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stocks as $stock )
                            <tr>
                                <td>{{ $stock->devise->devise }}</td>
                                <td>{{ $stock->montant .' '.$stock->devise->unite}}</td>
                            </tr>
                            @endforeach
                        </tbody>

                    </Table>
                <h5 ></h5>
                <p class="card-text"></p>
                </div>
                @else
                {{-- <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                          <h4 style="text-decoration:uppercase;">Caisse fermer</h4>
                        <!--a class="nav-link active" href="#">Active</a-->
                        </li>
                    </ul>
                    </div> --}}
                @endif
            </div><!-- End Special title treatmen -->

            </div>
@endif

        </div>
        </section>
    @endforeach
  </main><!-- End #main -->

@endsection
