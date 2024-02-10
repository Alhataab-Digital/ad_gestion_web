@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>caisses</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">param</li>
          <li class="breadcrumb-item active">caisse</li>
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
                Ajouter caisse
              </button>
            </h5>
              <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content" style="background-color: silver">
                    <div class="modal-header">
                      <h5 class="modal-title">Ajouter caisse</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Vertical Form -->
                    <form class="row g-3" method="post" action="{{ route('caisse.store') }}" >
                        @csrf
                    <div class="modal-body" >
                        <div class="col-12">
                            <label for="validationDefault04" class="form-label">State</label>
                            <select class="form-select" id="validationDefault04" name="agence_id" required>
                              <option selected disabled value="">Choose...</option>
                              @foreach ( $agences as $agence )
                              <option value="{{ $agence->id }}"  >{{ $agence->nom }}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Libelle</label>
                            <input type="text" name="libelle" class="form-control" id="inputNanme4">
                        </div>
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Montant maximum</label>
                            <input type="text" name="montant_min" class="form-control" id="inputNanme4">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Montant minimum</label>
                            <input type="text" name="montant_max" class="form-control" id="inputAddress" >
                        </div>
                       <div class="col-12">
                            <label for="inputEmail4" class="form-label">Compte</label>
                            <input type="text" name="compte" class="form-control" id="inputEmail4">
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form><!-- Vertical Form -->
                  </div>
                </div>
              </div>
              <!-- End Basic Modal-->
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
              <table class="table datatable">
                <thead class="bg-primary">
                  <tr>
                    <!-- <th scope="col">#</th> -->
                    <th scope="col">Libelle </th>
                    {{-- <th scope="col">montant min</th>
                    <th scope="col">montant max</th> --}}
                    <th scope="col">montant caisse</th>
                    <!-- <th scope="col">montant dividende</th> -->
                    <th scope="col">Agence</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($caisses as $caisse )

                    @foreach ($agences as $agence )
                    @if($agence->id==$caisse->agence_id)

                  <tr>
                    <!-- <th scope="row">{{ $caisse->id}}</th> -->
                    <td>{{ $caisse->libelle}}</td>
                    {{-- <td>{{ $caisse->montant_min}}</td>
                    <td>{{ $caisse->montant_max}}</td> --}}
                    <td style="text-align:right">{{ number_format($caisse->compte,2,","," ").' '.$agence->devise->unite}}</td>
                    <!-- <td>{{ $caisse->compte_dividende_societe}}</td> -->

                    <td>{{ $caisse->agence->nom}}</td>
                    <td>
                        <a href="{{ route('caisse.edit',encrypt($caisse->id)) }}">
                          <button type="button" class="btn btn-primary"><i class="bi bi-pencil"></i></button>
                        </a>
                        <!-- <a href="">
                            <button type="button" class="btn btn-success"><i class="bi bi-check-circle"></i></button>
                        </a>
                        <a href="">
                            <button type="button" class="btn btn-danger"><i class="bi bi-exclamation-octagon"></i></button>
                        </a> -->
                    </td>
                  </tr>
                  @endif
                  @endforeach
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
