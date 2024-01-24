@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>FERMETURE ACTIVITE DE BASE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">Activite vehicule</li>
          <li class="breadcrumb-item active">Fermeture activite</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

           <div class="card">

                <div class="card-body">
                <h5 class="card-title">Fermeture activité de base</h5>
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
                <!-- General Form Elements -->
                @csrf
                <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">Activite</th>
                        <th scope="col">Date ouverture </th>
                        <th scope="col">Montant decaissé</th>
                        <th scope="col">Utilisateur</th>
                        <th scope="col">Caisse</th>
                        <th scope="col">Agence</th>
                        <th scope="col">status</th>
                        <th scope="col">action</th>
                      </tr>
                    </thead>
                    <tbody>
                @foreach ($activite_ouvertes as $activite )
                    <tr>
                        <td>{{ "Activite n° ".$activite->id }} {{" :".$activite->intitule }}</td>
                        <td scope="row">{{ $activite->date_comptable }}</td>
                        <td>{{ number_format($activite->ouverture,2,","," ").' '.$activite->user->agence->devise->unite}}</td>
                        <td>{{ $activite->user->nom.' '.$activite->user->prenom }}</td>
                        <td>{{ $activite->caisse->libelle }}</td>
                        <td>{{ $activite->agence->nom }}</td>
                        <td>en cours</td>
                        <td>
                            <a href="{{ route('detail_activite_vehicule.edit',encrypt($activite->id)) }}">
                                <button type="button" class="btn btn-secondary"><i class="bx bxs-folder-open"></i></button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
<!-- End General Form Elements -->
                @endif
                </div>
            </div>
        </div>

      </div>
    </section>

  </main><!-- End #main -->
@endsection
