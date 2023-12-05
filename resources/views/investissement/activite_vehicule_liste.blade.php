@extends('../layouts.app')

@section('content')


<main id="main" class="main">

    <div class="pagetitle">
      <h1>ACTIVITES VEHICULES </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Accueil</a></li>
          <li class="breadcrumb-item">Gestion activite</li>
          <li class="breadcrumb-item active"> activites vehicules</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">

        <div class="col-lg-12">
            <div class="card recent-sales overflow-auto">


              <div class="card-body">
                <h5 class="card-title"> activites vehicules</h5>
                @if ($caisse->etat==1 && $caisse->date_comptable!= date("Y-m-d") )
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-octagon me-1"></i>
                    La date operation n'est pas a jour
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if ($caisse->etat==0 )
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-octagon me-1"></i>
                    Caisse fermer
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if ($caisse->etat==1 && $caisse->date_comptable == date("Y-m-d"))
                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                    {{-- @if(Auth::user()->role_id=="0" || Auth::user()->role_id=="1" || Auth::user()->role_id=="2")
                      <th scope="col">code</th>
                    @endif --}}
                    <th>Date</th>
                      <th scope="col">Type Activite</th>
                      <th scope="col">Montant </th>
                      <th scope="col">Agent</th>
                      <th scope="col">Caisse</th>
                      <th scope="col">Agence</th>
                      <th scope="col">status</th>
                      <th scope="col">action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($activites as $activite )

                    <tr>
                        {{-- @if(Auth::user()->role_id=="0" || Auth::user()->role_id=="1" || Auth::user()->role_id=="2")
                        <td>{{ $activite->id }}</td>
                        @endif --}}
                        <td scope="row">{{ $activite->date_comptable }}</td>
                        <td scope="row">{{ 'Activite N°'.$activite->id.' : '.$activite->intitule }}</td>
                        <td>{{ number_format($activite->montant_ouverture,2,","," ").' '.$activite->user->agence->devise->unite}}</td>
                        <td>{{ $activite->user->nom.' '.$activite->user->prenom }}</td>
                        <td>{{ $activite->caisse->libelle }}</td>
                        <td>{{ $activite->agence->nom }}</td>
                        @if($activite->etat_activite=="fermer")
                        <td><span class="badge bg-danger">{{ $activite->etat_activite }}</span></td>
                        @else
                        <td><span class="badge bg-info">{{ $activite->etat_activite }}</span></td>
                        @endif
                        <td>
                            <a href="{{ route('activite_vehicule.repartition',$activite->id) }}">
                                <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
                            </a>
                        </td>
                    </tr>

                    @endforeach


                  </tbody>
                </table>
                @endif
              </div>

            </div>
          </div><!-- End Recent Sales -->

      </div>
    </section>

  </main><!-- End #main -->

  @endsection
