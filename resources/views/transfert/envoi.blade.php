@extends('../layouts.app')

@section('content')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>ENVOI CHANGE</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
        <li class="breadcrumb-item">operation de change</li>
        <li class="breadcrumb-item active">Envoi change</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-3">
        <div class="card">
          <div class="card-body bg-secondary text-white">
            <h5 class="card-title text-white">Envoi change</h5>
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
            <!-- Multi Columns Form -->
            <form class="row g-3" method="POST" action="{{ route('envoi.numero_client') }}">
                @csrf
              <div class="col-md-12">
                <label for="inputName5" class="form-label">Telephone client</label>
                <input type="text" name="telephone" class="form-control" id="telephone">
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary">Suivant</button>
              </div>
            </form><!-- End Multi Columns Form -->
        @endif


          </div>
        </div>

      </div>

      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">
                Envoi change
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
                  {{-- <th scope="col">#</th> --}}
                  <th scope="col">client</th>
                  <th scope="col">Tel client</th>
                  <th scope="col">Montant envoi</th>
                  <th scope="col">frais envoi</th>
                  <th scope="col">Montant Total</th>
                  <th scope="col">date operation</th>
                  <td>etat</td>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($operations as $operation )
                <tr>

                  {{-- <th scope="row">{{ $operation->id}}</th> --}}
                  <td>{{ $operation->client->nom_client}}</td>
                  <td>{{ $operation->client->telephone}}</td>
                  <td style="text-align:right">{{ number_format($operation->montant,2,","," ").' '.$operation->devise->unite}}</td>
                  <td style="text-align:right">{{ number_format($operation->frais_envoi,2,","," ").' '.$agence->devise->unite}}</td>
                  <td style="text-align:right">{{ number_format($operation->montant_ttc,2,","," ").' '.$agence->devise->unite}}</td>

                  <td>{{ $operation->date_envoi}}</td>

                  @if ($operation->etat==0)
                  <td><span class="badge bg-danger">En attente</span></td>
                  @endif
                  @if ($operation->etat==1)
                  <td><span class="badge bg-success">Retirer</span></td>
                  @endif

                  <td>
                      <a href="{{ route('envoi.show',$operation->id) }}">
                          <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
                      </a>
                      {{-- <a href="">
                          <button type="button" class="btn btn-success"><i class="bi bi-check-circle"></i></button>
                      </a>
                      <a href="">
                          <button type="button" class="btn btn-danger"><i class="bi bi-exclamation-octagon"></i></button>
                      </a> --}}
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
