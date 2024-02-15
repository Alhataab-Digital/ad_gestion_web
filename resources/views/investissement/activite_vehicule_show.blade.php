@extends('../layouts.app')

@section('content')


<main id="main" class="main">

    <div class="pagetitle">
      <h1>ACTIVITE VEHICULE TERMINER</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Accueil</a></li>
          <li class="breadcrumb-item">Activite vehicule</li>
          <li class="breadcrumb-item active"> Activite vehicule cloturé</li>
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
                       Activité vehicule N° {{ $activite_vehicule->id .' : '. $activite_vehicule->intitule}}
                       <div class="text-end">
                                <a href="{{ route('activite_vehicule.terminer') }}">
                                    <button type="button" class="btn btn-secondary">Quitter</button>
                                </a>
                       </div>

                        </div>
                    </h5>
                    <hr>
                    <h5 class="bg-secondary text-white">
                    <table>
                            <tr>
                                <!-- <th>Capital activite</th> -->
                                <th>Recette activite</th>
                                <th>Depense activite</th>
                                <th>Benefice activite</th>
                                <th>Dividende societe</th>
                                <th>Dividende investisseurs</th>
                                <th>Montant de securite</th>
                            </tr>
                            <tr>
                                <!-- <td>
                                    <input type="text" class="form-control" name="montant" id="" value="{{ number_format(($activite_vehicule->montant_ouverture),2,","," ") }}">
                                </td> -->
                                <td>
                                    <input type="text" class="form-control" name="montant" id="" value='{{ number_format(($activite_vehicule->montant_vente),2,","," ")." ".$activite_vehicule->user->agence->devise->unite }}'>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="montant" id="" value='{{ number_format(($activite_vehicule->total_depense),2,","," ")." ".$activite_vehicule->user->agence->devise->unite  }}'>
                                </td>

                               <td>
                                <input type="text" class="form-control" name="benefice" id="" value='{{ number_format($activite_vehicule->montant_benefice,2,","," ")." ".$activite_vehicule->user->agence->devise->unite }}'>
                               </td>
                               <td>
                                <input type="text" class="form-control" name="benefice" id="" value='{{ number_format(($activite_vehicule->montant_benefice)/2 ,2,","," ")." ".$activite_vehicule->user->agence->devise->unite  }}'>
                               </td>
                               <td>
                                <input type="text" class="form-control" name="benefice" id="" value='{{ number_format((($activite_vehicule->montant_benefice)/2)-((($activite_vehicule->montant_benefice)/2)*0.1),2,","," ")." ".$devise->unite }}'>
                               </td>
                               <td>
                                <input type="text" class="form-control" name="benefice" id="" value='{{ number_format((($activite_vehicule->montant_benefice)/2)*0.1,2,","," ")." ".$activite_vehicule->user->agence->devise->unite  }}'>
                               </td>

                        </table>
                    </h5>
                    <table class="table table-borderless bg-danger text-white"  >
                        <thead class=" ">
                            <tr>
                                <th>Achat vehicule</th>
                                <th>Montant </th>
                                <th scope="col">
                                    <!-- <button type="button" class="btn btn-success add_item_btn" ><i class="bi bi-plus-circle"></i> </button> -->
                                </th>
                            </tr>
                        </thead>
                            @foreach ($operation_achats as $operation_achat )
                            <tr>
                                <td scope="row">
                                    <select class="form-select" name="" id=""  readonly>
                                        <option value="">{{'Achat vehicule CH :'.$operation_achat->chassis }}</option>
                                    </select></td>
                                <td scope="row">
                                <input class="form-control"  value='{{ number_format($operation_achat->prix_revient,2,","," ")." ".$devise->unite}}' readonly>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <table class="table table-borderless bg-success text-white"  >
                        <thead class=" ">
                            <tr>
                                <th>Vente vehicule</th>
                                <th>Montant </th>
                                <th scope="col">
                                    <!-- <button type="button" class="btn btn-success add_item_btn" ><i class="bi bi-plus-circle"></i> </button> -->
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($operation_ventes as $operation_vente )
                            <tr>
                                <td scope="row">
                                    <select class="form-select" name="" id=""  readonly>
                                        <option value="">{{'Vente vehicule CH :'.$operation_vente->operation_vehicule_achete->chassis }}</option>
                                    </select></td>
                                <td scope="row">
                                <input class="form-control"  value='{{ number_format(round($operation_vente->prix_vente/$operation_vente->taux_devise),2,","," ")." ".$devise->unite}}' readonly>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
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
                        @foreach ($detail_activite_vehicules as $detail_activite_vehicule )

                        <tr>
                            {{-- @if(Auth::user()->role_id=="0" || Auth::user()->role_id=="1" || Auth::user()->role_id=="2")
                            <td>{{ $investisseur->id }}</td>
                            @endif --}}
                            <td scope="row">
                                <select class="form-select" name="investisseur[]" id="">
                                    <option value="">{{ $detail_activite_vehicule->investisseur->nom.' '.$detail_activite_vehicule->investisseur->prenom }}</option>
                                </select></td>
                            <td scope="row">
                                <input class="form-control" type="text"  id="" value='{{ number_format($detail_activite_vehicule->montant_investis,2,","," ")." ".$devise->unite}}'>
                            </td>
                            <td scope="row">
                                <input class="form-control" type="text"  id="" value='{{  number_format(round((((($detail_activite_vehicule->taux)/100)*($activite_vehicule->montant_benefice/2))-((($detail_activite_vehicule->taux)/100)*($activite_vehicule->montant_benefice/2))*0.1),2),2,","," ")." ".$devise->unite }}'>
                            </td>
                            {{-- <td scope="row">
                                <input type="text"  id="" value='{{  number_format(($detail_activite_vehicule->taux),2,","," ")." ".$detail_activite_vehicule->activite_vehicule->user->agence->devise->unite }}'>
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
