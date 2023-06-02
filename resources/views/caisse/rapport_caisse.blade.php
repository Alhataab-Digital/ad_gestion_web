@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>RAPPORT CAISSE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">Gestion caisse</li>
          <li class="breadcrumb-item active">Rapport caisse</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        @if ($caisse->etat==0)
              caisse fermer
        @endif
        @if ($caisse->etat==1)
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Rapport operation</h5>

            @if(Auth::user()->gestion->gestion=='Gestion Change')
                <!-- List group With badges -->
                <ul class="list-group">
                    <li class="list-group-item list-group-item-primary d-flex justify-content-between align-items-center">
                    {{ $caisse->libelle }}
                    <span class="badge bg-primary rounded-pill">{{number_format($caisse->compte ,2,","," ").' '.$agence->devise->unite }}</span>
                    </li>
                    <li class="list-group-item list-group-item-success d-flex justify-content-between align-items-center">
                    Operation montant entree
                    <span class="badge bg-success rounded-pill">{{number_format($envoi_change+$vente_change ,2,","," ").' '.$agence->devise->unite }}</span>
                    </li>
                    <li class="list-group-item list-group-item-danger d-flex justify-content-between align-items-center">
                    Operation montant sortie
                    <span class="badge bg-danger rounded-pill">{{number_format($retrait_change+$achat_change ,2,","," ").' '.$agence->devise->unite }}</span>
                    </li>
                    {{-- <li class="list-group-item list-group-item-success d-flex justify-content-between align-items-center">
                    Operation d'achat change
                    <span class="badge bg-success rounded-pill">{{number_format($achat_change ,2,","," ").' '.$agence->devise->unite }}</span>
                    </li>
                    <li class="list-group-item list-group-item-danger d-flex justify-content-between align-items-center">
                    Operation de vente change
                    <span class="badge bg-danger rounded-pill">{{number_format($vente_change ,2,","," ").' '.$agence->devise->unite }}</span>
                    </li> --}}

                </ul><!-- End List With badges -->

            @endif

            @if(Auth::user()->gestion->gestion=='Gestion Investissement')
                <!-- List group With badges -->
                <ul class="list-group">
                    <li class="list-group-item list-group-item-primary d-flex justify-content-between align-items-center">
                    {{ $caisse->libelle }}
                    <span class="badge bg-primary rounded-pill">{{number_format($caisse->compte ,2,","," ").' '.$agence->devise->unite }}</span>
                    </li>
                    <li class="list-group-item list-group-item-success d-flex justify-content-between align-items-center">
                    Operation de versement
                    <span class="badge bg-success rounded-pill">{{number_format($entree ,2,","," ").' '.$agence->devise->unite }}</span>
                    </li>
                    <li class="list-group-item list-group-item-danger d-flex justify-content-between align-items-center">
                    Operation de sortie
                    <span class="badge bg-danger rounded-pill">{{number_format($sortie+$decaissement ,2,","," ").' '.$agence->devise->unite }}</span>
                    </li>
                </ul><!-- End List With badges -->
            @endif

            </div>
          </div>
        </div>

        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">   Nombre d'operation</h5>
            @if(Auth::user()->gestion->gestion=='Gestion Change')
              <!-- List group with custom content -->
              <ol class="list-group list-group-numbered">
                <li class="list-group-item list-group-item-success d-flex justify-content-between align-items-start">
                  <div class="ms-2 me-auto">
                    <div class="fw-bold">Operation d'entree</div>
                    {{ $caisse->libelle }}
                  </div>
                  <span class="badge bg-success rounded-pill">{{ $envoi_change_count+$vente_change_count }}</span>
                </li>
                <li class="list-group-item list-group-item-danger d-flex justify-content-between align-items-start">
                  <div class="ms-2 me-auto">
                    <div class="fw-bold">Operation de sortie</div>
                    {{ $caisse->libelle }}
                  </div>
                  <span class="badge bg-danger rounded-pill">{{ $retrait_change_count+$achat_change_count }}</span>
                </li>

                {{-- <li class="list-group-item list-group-item-success d-flex justify-content-between align-items-start">
                  <div class="ms-2 me-auto">
                    <div class="fw-bold">Operation d'achat change</div>
                    {{ $caisse->libelle }}
                  </div>
                  <span class="badge bg-success rounded-pill">{{ $achat_change_count }}</span>
                </li>
                <li class="list-group-item list-group-item-danger d-flex justify-content-between align-items-start">
                  <div class="ms-2 me-auto">
                    <div class="fw-bold">Operation de vente change</div>
                    {{ $caisse->libelle }}
                  </div>
                  <span class="badge bg-danger rounded-pill">{{ $vente_change_count }}</span>
                </li> --}}
              </ol><!-- End with custom content -->
            @endif
            @if(Auth::user()->gestion->gestion=='Gestion Investissement')
              <!-- List group with custom content -->
              <ol class="list-group list-group-numbered">
                <li class="list-group-item list-group-item-success d-flex justify-content-between align-items-start">
                  <div class="ms-2 me-auto">
                    <div class="fw-bold">Operation de versement</div>
                    {{ $caisse->libelle }}
                  </div>
                  <span class="badge bg-success rounded-pill">{{ $entree_count }}</span>
                </li>
                <li class="list-group-item list-group-item-danger d-flex justify-content-between align-items-start">
                  <div class="ms-2 me-auto">
                    <div class="fw-bold">Operation de retrait</div>
                    {{ $caisse->libelle }}
                  </div>
                  <span class="badge bg-danger rounded-pill">{{ $sortie_count+$activite_count }}</span>
                </li>
              </ol><!-- End with custom content -->

            @endif
            </div>
          </div>

        </div>

        <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">
                    Mouvement caisse
                </h5>

                <!-- Table with stripped rows -->
                <table class="table table-borderless datatable">
                  <thead class="bg-primary ">
                    <tr>
                      {{-- <th scope="col">#</th> --}}
                      <th scope="col">Date</th>
                      <th scope="col">Description</th>
                      <th scope="col" style="text-align:center">Entree</th>
                      <th scope="col" style="text-align:center">Sortie</th>
                      <th scope="col" style="text-align:center">Solde</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($mouvement_caisses as $mouvement_caisse )
                    @if($mouvement_caisse->description=="Ouverture caisse" || $mouvement_caisse->description=="Fermeture caisse")
                    <tr class="table-active">
                      {{-- <th scope="row">{{ $operation->id}}</th> --}}
                      <td>{{ $mouvement_caisse->date_comptable}}</td>
                      <td>{{ $mouvement_caisse->description}}</td>
                      <td style="text-align:right">{{ number_format($mouvement_caisse->entree,2,","," ").' '.$agence->devise->unite}}</td>
                      <td style="text-align:right">{{ number_format($mouvement_caisse->sortie,2,","," ").' '.$agence->devise->unite}}</td>
                      <td style="text-align:right">{{ number_format($mouvement_caisse->solde,2,","," ").' '.$agence->devise->unite}}</td>

                    </tr>
                    @else
                    <tr >
                        {{-- <th scope="row">{{ $operation->id}}</th> --}}
                        <td>{{ $mouvement_caisse->date_comptable}}</td>
                        <td>{{ $mouvement_caisse->description}}</td>
                        <td style="text-align:right">{{ number_format($mouvement_caisse->entree,2,","," ").' '.$agence->devise->unite}}</td>
                        <td style="text-align:right">{{ number_format($mouvement_caisse->sortie,2,","," ").' '.$agence->devise->unite}}</td>
                        <td style="text-align:right">{{ number_format($mouvement_caisse->solde,2,","," ").' '.$agence->devise->unite}}</td>

                      </tr>
                    @endif
                    @endforeach
                  </tbody>
                </table>
                <!-- End Table with stripped rows -->

              </div>
            </div>

          </div>
        @endif
      </div>
    </section>

  </main><!-- End #main -->

  @endsection
