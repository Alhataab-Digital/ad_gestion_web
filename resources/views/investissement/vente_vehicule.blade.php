@extends('../layouts.app')

@section('content')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Vente vehicule</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
        <li class="breadcrumb-item">autre operation </li>
        <li class="breadcrumb-item active">Vente vehicule</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-3">
        <div class="card">
          <div class="card-body bg-success text-white">
            <h5 class="card-title text-white">Vente vehicule</h5>
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
            <form class="row g-3" method="POST" action="{{ route('vente_vehicule.client') }}">
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
                Vente vehicule
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
                  <th scope="col">clients</th>
                  <th scope="col">Tel client</th>
                  <th scope="col">annee</th>
                  <th scope="col">Marque</th>
                  <th scope="col">Model </th>
                  <th scope="col">Chassis </th>
                  <th scope="col">prix achat</th>
                  <th scope="col">charge USA</th>
                  <th scope="col">prix vendu</th>
                  <th scope="col">Marge</th>
                  <th scope="col">date operation</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($operations as $operation )
                <tr>

                  {{-- <th scope="row">{{ $operation->id}}</th> --}}
                  <td>{{ $operation->client->nom_client}}</td>
                  <td>{{ $operation->client->telephone}}</td>
                  <td style="text-align:right">{{ $operation->operation_vehicule_achete->annee}}</td>
                  <td>{{ $operation->operation_vehicule_achete->marque}}</td>
                  <td>{{ $operation->operation_vehicule_achete->model}}</td>
                  <td>{{ $operation->operation_vehicule_achete->chassis}}</td>
                  <td style="text-align:right">{{ number_format($operation->operation_vehicule_achete->prix_achat,2,","," ")}}</td>
                  <td style="text-align:right">{{ number_format($operation->operation_vehicule_achete->charge_usa,2,","," ")}}</td>
                  <td style="text-align:right">{{ number_format($operation->prix_vente,2,","," ")}}</td>
                  <td style="text-align:right">{{ number_format($operation->marge,2,","," ")}}</td>

                  <td>{{ $operation->date_comptable}}</td>
                  <td>
                  <a href="{{ route('vente_vehicule.show',encrypt($operation->id)) }}">
                          <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
                      </a>
                    @if($operation->etat==NULL)
                      <a href="{{ route('vente_vehicule.valider',encrypt($operation->id)) }}">
                          <button type="button" class="btn btn-success"><i class="bi bi-check-circle"></i></button>
                      </a>
                    @elseif($operation->etat=='payer')
                      <a href="{{ route('vente_vehicule.annuler',encrypt($operation->id)) }}">
                          <button type="button" class="btn btn-danger"><i class="bi bi-exclamation-octagon"></i></button>
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
