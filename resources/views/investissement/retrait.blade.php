@extends('../layouts.app')

@section('content')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>RETRAIT INVESTISSEUR</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
        <li class="breadcrumb-item">Gestion investisseur</li>
        <li class="breadcrumb-item active">retrait investisseur</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-6">
        <div class="card bg-danger text-white">
          <div class="card-body ">
            <h5 class="card-title text-white">retrait compte investisseur</h5>
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
            <!-- Multi Columns Form -->
            <form class="row g-3" method="POST" action="{{ route('i_retrait.retrait') }}">
                @csrf
              <div class="col-md-12">
                <label for="inputName5" class="form-label">Code investisseur</label>
                <input type="text" name="code" class="form-control" id="telephone">
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary">Suivant</button>
              </div>
            </form><!-- End Multi Columns Form -->
        @endif


          </div>
        </div>

      </div>

    </div>
    @if ($caisse->etat==1)
    <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">
                Operations
            </h5>

            <!-- Table with stripped rows -->
            <table class="table table-borderless datatable">
              <thead class="bg-primary ">
                <tr>
                  {{-- <th scope="col">#</th> --}}
                  <th scope="col">Investisseur</th>
                  <th scope="col">Tel Investisseur</th>
                  <th scope="col">agent caisse</th>
                  <th scope="col">reglement </th>
                  <th scope="col">Montant operation</th>
                  <th scope="col">date operation</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($operations as $operation )
                <tr>

                  {{-- <th scope="row">{{ $operation->id}}</th> --}}
                  <td>{{ $operation->investisseur->nom}}</td>
                  <td>{{ $operation->investisseur->telephone}}</td>
                  <td>{{ $operation->user->nom.' '.$operation->prenom}}</td>
                  <td>{{ $operation->reglement->reglement}}</td>
                  <td style="text-align:right">{{ number_format($operation->montant_operation,2,","," ").' '.$operation->user->agence->devise->unite}}</td>

                  <td>{{ $operation->date_comptable}}</td>
                  <td>
                      <a href="{{ route('i_retrait.show',$operation->id) }}">
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
    @endif
  </section>

</main><!-- End #main -->
  @endsection
