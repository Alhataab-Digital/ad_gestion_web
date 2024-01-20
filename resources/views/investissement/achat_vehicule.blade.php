@extends('../layouts.app')

@section('content')

<main id="main" class="main ">

  <div class="pagetitle">
    <h1>Achat vehicule</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
        <li class="breadcrumb-item">operation change</li>
        <li class="breadcrumb-item active">Achat vehicule</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-6 form-signin w-50 m-auto">
        <div class="card">
          <div class="card-body bg-danger text-white">
            <h5 class="card-title text-white">Achat vehicule</h5>
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
            <form class="row g-3" method="POST" action="{{ route('achat_vehicule.fournisseur') }}">
                @csrf
              <div class="col-md-12">
                <label for="inputName5" class="form-label">Telephone fournisseur</label>
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
      <div class="col-lg-12 form-signin w-100 m-auto">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">
                Achat vehicule
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
                  <th scope="col">fournisseurs</th>
                  <th scope="col">Tel fournisseur</th>
                  <th scope="col">Marque</th>
                  <th scope="col">Model </th>
                  <th scope="col">Chassis </th>
                  <th scope="col">prix achat</th>
                  <th scope="col">charge USA</th>
                  <th scope="col">Montant Total</th>
                  <th scope="col">date operation</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($operations as $operation )
                <tr>

                  {{-- <th scope="row">{{ $operation->id}}</th> --}}
                  <td>{{ $operation->fournisseur->nom_fournisseur}}</td>
                  <td>{{ $operation->fournisseur->telephone}}</td>
                  <td>{{ $operation->marque}}</td>
                  <td>{{ $operation->model}}</td>
                  <td>{{ $operation->chassis}}</td>
                  <td style="text-align:right">{{ number_format($operation->prix_achat,2,","," ")}}</td>
                  <td style="text-align:right">{{ number_format($operation->charge_usa,2,","," ")}}</td>
                  <td style="text-align:right">{{ number_format($operation->prix_revient,2,","," ")}}</td>

                  <td>{{ $operation->date_comptable}}</td>
                  <td>
                      <a href="{{ route('achat_vehicule.show',encrypt($operation->id)) }}">
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
