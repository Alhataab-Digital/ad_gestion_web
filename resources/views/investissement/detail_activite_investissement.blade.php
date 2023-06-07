@extends('../layouts.app')

@section('content')


<main id="main" class="main">

    <div class="pagetitle">
      <h1>REPARTISSION DIVIDENTE SUR L'ACTIVITE {{ $activite_investissement->type_activite->type_activite }}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Accueil</a></li>
          <li class="breadcrumb-item">Gestion investisseur</li>
          <li class="breadcrumb-item active"> investisseur en cours</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
    <form method="post" action="{{ route('activite_investissement.repartie') }}">
        @csrf
        <div class="row">

            <div class="col-lg-12">

                <div class="card recent-sales overflow-auto">


                  <div class="card-body">
                    <h5 class="card-title">
                       <div class="col-sm-12">
                                <button type="submit" class="btn btn-danger">Cloturer l'activité</button>

                                <a href="{{ route('activite_investissement') }}">
                                    <button type="button" class="btn btn-secondary">Quitter</button>
                                </a>
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
                        </div>
                    </h5>
                    <hr>
                    <h5 class="bg-secondary text-white">
                        <table>
                            <tr>
                                {{-- <th>Capital activité</th> --}}
                                <th>Montant activite</th>
                            </tr>
                            <tr>
                                <td>
                                    <input class="form-control" type="text" name="montant_activite" id="" value="{{ $activite_investissement->montant_decaisse }}">
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="montant_benefice" id="" required>
                                </td>
                              <td>
                                <input class="form-control"  type="hidden" name="activite_id" id="" value="{{ $activite_investissement->id }}">
                                <input class="form-control" type="hidden" name="montant" id="" value="{{ $activite_investissement->capital_activite }}">
                            </td>



                        </table>
                    </h5>
                    <hr>
                    <table class="table table-borderless datatable">
                      <thead class="bg-primary text-white">
                        <tr>

                          <th scope="col">nom investisseur</th>
                          <th scope="col">Montant investis </th>
                          <th scope="col">Taux </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($detail_activite_investissements as $detail_activite_investissement )

                        <tr>
                            <td scope="row">
                                <select class="form-select" name="investisseur_id[]" id="">
                                    <option value="{{ $detail_activite_investissement->investisseur->id }}">{{ $detail_activite_investissement->investisseur->nom }}</option>
                                </select></td>
                                <td scope="row">
                                    <input class="form-control" type="text" name="montant_investis[]" id="" value="{{round( $detail_activite_investissement->montant_investis) }}" readonly>
                                </td>
                                <td scope="row">
                                    <input class="form-control" type="text" name="taux[]" id="" value="{{ $detail_activite_investissement->taux/100 }} " readonly>
                                </td>

                        </tr>

                        @endforeach


                      </tbody>
                </table>
                </div>

            </div>

        </div><!-- End Recent Sales -->

      </div>
    </form>

    </section>

  </main><!-- End #main -->

  @endsection
