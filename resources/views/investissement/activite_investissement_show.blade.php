@extends('../layouts.app')

@section('content')


<main id="main" class="main">

    <div class="pagetitle">
      <h1>Activité N° {{ $activite_investissement->id }} : {{ $activite_investissement->type_activite->type_activite }}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Accueil</a></li>
          <li class="breadcrumb-item">Gestion investisseur</li>
          <li class="breadcrumb-item active"> investisseur en cours</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
    <form method="post" >
        @csrf
        <div class="row">

            <div class="col-lg-12">

                <div class="card recent-sales overflow-auto">
                  <div class="card-body">
                    <h5 class="card-title">
                       <div class="col-sm-12">
                                <a href="{{ route('activite_investissement.terminer') }}">
                                    <button type="button" class="btn btn-secondary">Quitter</button>
                                </a>
                        </div>
                    </h5>
                    <hr>
                    <h5 class="bg-secondary text-white">
                        <table>
                            <tr>
                                <th>Montant activite</th>
                                <th>depense activite</th>
                                <th>Benefice activite</th>
                                <th>Dividende societe</th>
                                <th>Dividende investisseurs</th>
                            </tr>
                            <tr>
                              <td>
                               <input type="text" class="form-control" name="montant" id="" value="{{ number_format($activite_investissement->montant_decaisse,2,","," ") }}">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="benefice" id="" value="{{ number_format($activite_investissement->total_depense,2,","," ") }}">
                               </td>
                               <td>
                                <input type="text" class="form-control" name="benefice" id="" value="{{ number_format($activite_investissement->montant_benefice,2,","," ") }}">
                               </td>
                               <td>
                                <input type="text" class="form-control" name="benefice" id="" value="{{ number_format(($activite_investissement->montant_benefice)/2 ,2,","," ") }}">
                               </td>
                               <td>
                                <input type="text" class="form-control" name="benefice" id="" value="{{ number_format(($activite_investissement->montant_benefice)/2,2,","," ") }}">
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
                          <th scope="col">Dividente par investisseur </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($detail_activite_investissements as $detail_activite_investissement )

                        <tr>
                            {{-- @if(Auth::user()->role_id=="0" || Auth::user()->role_id=="1" || Auth::user()->role_id=="2")
                            <td>{{ $investisseur->id }}</td>
                            @endif --}}
                            <td scope="row">
                                <select class="form-select" name="investisseur[]" id="">
                                    <option value="">{{ $detail_activite_investissement->investisseur->nom.' '.$detail_activite_investissement->investisseur->prenom }}</option>
                                </select></td>
                            <td scope="row">
                                <input class="form-control" type="text"  id="" value="{{ number_format($detail_activite_investissement->montant_investis,2,","," ")}}">
                            </td>
                            <td scope="row">
                                <input class="form-control" type="text"  id="" value="{{  number_format(((($detail_activite_investissement->taux)/100)*($activite_investissement->montant_benefice/2)),2,","," ") }}">
                            </td>
                            {{-- <td scope="row">
                                <input type="text"  id="" value="{{  number_format(($detail_activite_investissement->taux),2,","," ") }}">
                            </td> --}}

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
