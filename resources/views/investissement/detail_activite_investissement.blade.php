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
    <form method="post" action="{{ route('detail_activite_investissement.store') }}">
        @csrf
        <div class="row">

            <div class="col-lg-12">

                <div class="card recent-sales overflow-auto">


                  <div class="card-body">
                    <h5 class="card-title">
                       <div class="col-sm-12">
                                <button type="submit" class="btn btn-success">Valider</button>

                                <a href="{{ route('activite_investissement.delete',$activite_investissement->id) }}">
                                    <button type="button" class="btn btn-danger">Supprimer</button>
                                </a>
                                {{-- <a href="{{ route('activite_investissement.update',$activite_investissement->id) }}">
                                    <button type="button" class="btn btn-info">Modifier</button>
                                </a> --}}
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
                                <input class="form-control"  type="hidden" name="activite_id" id="" value="{{ $activite_investissement->id }}">
                                <input class="form-control" type="hidden" name="montant" id="" value="{{ $activite_investissement->capital_activite }}">
                            </td>



                        </table>
                    </h5>
                    <hr>
                    <table class="table table-borderless datatable">
                      <thead class="bg-primary text-white">
                        <tr>
                        {{-- @if(Auth::user()->role_id=="0" || Auth::user()->role_id=="1" || Auth::user()->role_id=="2")
                          <th scope="col">code</th>
                        @endif --}}
                          <th scope="col">nom investisseur</th>
                          <th scope="col">Montant investis </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($investisseurs as $investisseur )

                        <tr>
                            {{-- @if(Auth::user()->role_id=="0" || Auth::user()->role_id=="1" || Auth::user()->role_id=="2")
                            <td>{{ $investisseur->id }}</td>
                            @endif --}}
                            <td scope="row">
                                <select class="form-select" name="investisseur_id[]" id="">
                                    <option value="{{ $investisseur->id }}">{{ $investisseur->nom }}</option>
                                </select></td>
                                <td scope="row">
                                    <input class="form-control" type="text" name="montant_investis[]" id="" value="{{round( ($investisseur->compte_investisseur*$activite_investissement->montant_decaisse)/$activite_investissement->capital_activite) }}" readonly>
                                </td>
                                <td scope="row">
                                    <input class="form-control" type="hidden" name="montant_restant[]" id="" value="{{ round($investisseur->compte_investisseur-(($investisseur->compte_investisseur*$activite_investissement->montant_decaisse)/$activite_investissement->capital_activite)) }}" readonly>
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
