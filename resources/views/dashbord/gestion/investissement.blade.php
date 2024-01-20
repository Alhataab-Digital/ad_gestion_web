<main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
    @if(Auth::user()->agence_id!="0")
      <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">
          @if(Auth::user()->role_id=="0"||Auth::user()->role_id=="1"||Auth::user()->role_id=="2")
            <!-- Sales Card -->
            <div class="col-xxl-3 col-md-12">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Caisses agence</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <a href="{{route('caisse')}}"><i class="bi bi-cash-stack"></i></a>
                    </div>
                    <div class="ps-3">
                      <h6>{{$count_caisse_agence}}</h6>
                      <span class="text-success small pt-1 fw-bold">{{ number_format($montant_total_caisse_agence->total,2,","," ")}}</span> <span class="text-muted small pt-2 ps-1">{{$agence->devise->unite}}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Sales Card -->
            <!-- Sales Card -->
            <div class="col-xxl-3 col-md-12">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Banques agence</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <a href="{{route('banque')}}"><i class="bi bi-bank"></i></a>
                    </div>
                    <div class="ps-3">
                      <h6>{{$count_banque_agence}}</h6>
                      <span class="text-success small pt-1 fw-bold">{{ number_format($montant_total_banque_agence->total,2,","," ")}}</span> <span class="text-muted small pt-2 ps-1">{{$agence->devise->unite}}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
              <div class="col-xxl-3 col-md-12">
                <div class="card info-card revenue-card">
                  <div class="card-body">
                    <h5 class="card-title">Depense agence </h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <a href="{{route('operation')}}"><i class="bi bi-basket"></i></a>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $count_charge_agence }}</h6>
                        <span class="text-muted small pt-2 ps-1 fw-bold">{{ number_format($montant_total_charge_agence->total,2,","," ")}}</span> <span class="text-muted small pt-2 ps-1"> {{$agence->devise->unite}}</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-3 col-xl-12">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Nombre d'investisseur </h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <a href="{{route('investisseur')}}"><i class="bi bi-people"></i></a>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $count_investisseur }}</h6>
                      <span class="text-muted small pt-2 ps-1 fw-bold">{{ number_format($montant_total_investisseur->total,2,","," ")}}</span> <span class="text-muted small pt-2 ps-1"> F cfa</span>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Customers Card -->

            <div class="col-lg-12">
              <div class="card bg-primary">
                  <div class="divider">
                    <hr>
                  </div>
              </div>
            </div>
            <!-- Sales Card -->
            <div class="col-xxl-3 col-md-4">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Factures impayées</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <a href="{{route('facture')}}"><i class="bi bi-cart"></i></a>
                    </div>
                    <div class="ps-3">
                      <h6>{{$facture_valider}}</h6>
                        <span class="text-success small pt-1 fw-bold">{{ number_format(($total_valider->total),2,","," ")}}</span> <span class="text-muted small pt-2 ps-1">{{$agence->devise->unite}}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Sales Card -->
            <!-- Sales Card -->
            <div class="col-xxl-3 col-md-4">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Factures à écheance</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <a href="{{route('facture')}}"><i class="bi bi-cart"></i></a>
                    </div>
                    <div class="ps-3">
                      <h6>{{$facture_echeance}}</h6>
                        <span class="text-success small pt-1 fw-bold">{{ number_format(($total_echeance->total),2,","," ")}}</span> <span class="text-muted small pt-2 ps-1">{{$agence->devise->unite}}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Sales Card -->
            <!-- Sales Card -->
            <div class="col-xxl-3 col-md-4">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Factures Payées</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <a href="{{route('facture')}}"><i class="bi bi-cart"></i></a>
                    </div>
                    <div class="ps-3">
                      <h6>{{$facture_payer}}</h6>
                      <span class="text-success small pt-1 fw-bold">{{ number_format($total_payer->total,2,","," ")}}</span> <span class="text-muted small pt-2 ps-1">{{$agence->devise->unite}}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Sales Card -->
            <!-- Sales Card -->
            <div class="col-xxl-3 col-md-4">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Factures non validées</h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <a href="{{route('facture')}}"><i class="bi bi-cart"></i></a>
                      </div>
                      <div class="ps-3">
                        <h6>{{$facture_non_valider}}</h6>
                        <span class="text-success small pt-1 fw-bold">{{ number_format($total_non_valider->total,2,","," ")}}</span> <span class="text-muted small pt-2 ps-1">{{$agence->devise->unite}}</span>
                      </div>
                    </div>
                </div>
              </div>
            </div><!-- End Sales Card -->

            <div class="col-lg-12">
              <div class="card bg-primary">
                  <div class="divider">
                    <hr>
                  </div>
              </div>
            </div>
            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Activités en cours</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <a href="{{ route('activite_investissement.valider') }}"><i class="bx bx-book"></i></a>
                    </div>
                    <div class="ps-3">
                      <h6>{{$activite_encours}}</h6>
                        <span class="text-success small pt-1 fw-bold">{{ number_format($montant_activite_encours->total,2,","," ")}}</span> <span class="text-muted small pt-2 ps-1">{{$agence->devise->unite}}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Sales Card -->
            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Activités terminées</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <a href="{{ route('activite_investissement.terminer') }}"><i class="bx bx-book-bookmark"></i></a>
                    </div>
                    <div class="ps-3">
                      <h6>{{$activite_terminer}}</h6>
                      <span class="text-success small pt-1 fw-bold">{{ number_format($montant_activite_terminer->total,2,","," ")}}</span> <span class="text-muted small pt-2 ps-1">{{$agence->devise->unite}}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Sales Card -->
            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Activités non validées</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <a href="{{ route('activite_investissement') }}"><i class="bx bx-book-alt"></i></a>
                    </div>
                    <div class="ps-3">
                      <h6>{{$activite_non_valider}}</h6>
                      <span class="text-success small pt-1 fw-bold">{{ number_format($montant_activite_non_valider->total,2,","," ")}}</span> <span class="text-muted small pt-2 ps-1">{{$agence->devise->unite}}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Sales Card -->
          @endif
          @if(Auth::user()->role_id=="3"||Auth::user()->role_id=="4"||Auth::user()->role_id=="5"||Auth::user()->role_id=="6"||Auth::user()->role_id=="7")
            <!-- Sales Card -->
            <div class="col-xxl-3 col-md-12">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">solde caisse</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <a href="#"><i class="bi bi-cash-stack"></i></a>
                    </div>
                    <div class="ps-3">
                      <h6>{{$count_caisse}}</h6>
                      <span class="text-success small pt-1 fw-bold">{{ number_format($montant_total_caisse->total,2,","," ")}}</span> <span class="text-muted small pt-2 ps-1">{{$agence->devise->unite}}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Sales Card -->
            <!-- Sales Card -->
            <div class="col-xxl-3 col-md-12">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Depense </h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <a href="{{route('operation')}}"><i class="bi bi-basket"></i></a>
                    </div>
                    <div class="ps-3">
                      <h6>{{$count_charge}}</h6>
                      <span class="text-muted small pt-2 ps-1">{{ number_format($montant_total_charge->total,2,","," ")}} {{$agence->devise->unite}}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Sales Card -->

          @endif
          @if(Auth::user()->role_id=="0"||Auth::user()->role_id=="1"||Auth::user()->role_id=="2"||Auth::user()->role_id=="3"||Auth::user()->role_id=="4")
            <!-- Sales Card -->

{{--
            <div class="col-lg-12">
              <div class="card bg-primary">
                  <div class="divider">
                    <hr>
                  </div>
              </div>
            </div> --}}
            <!-- Sales Card -->
            <div class="col-xxl-3 col-md-4">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Vehicule  Acheté</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <a href="{{route('facture')}}"><i class="bi bi-cart"></i></a>
                    </div>
                    <div class="ps-3">
                      <h6>{{$count_vehicule_achete}}</h6>
                        <span class="text-success small pt-1 fw-bold">{{ number_format(($total_vehicule_achete->total),2,","," ")}}</span> <span class="text-muted small pt-2 ps-1">{{$agence->devise->unite}}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Sales Card -->
            <!-- Sales Card -->
            <div class="col-xxl-3 col-md-4">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Vehicule vendu</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <a href="{{route('facture')}}"><i class="bi bi-cart"></i></a>
                    </div>
                    <div class="ps-3">
                      <h6>{{$count_vehicule_vendu}}</h6>
                        <span class="text-success small pt-1 fw-bold">{{ number_format(($total_vehicule_vendu->total),2,","," ")}}</span> <span class="text-muted small pt-2 ps-1">{{$agence->devise->unite}}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Sales Card -->
            <!-- Sales Card -->
            {{-- <div class="col-xxl-3 col-md-4">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Activite de base en cours</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <a href="{{route('facture')}}"><i class="bi bi-cart"></i></a>
                    </div>
                    <div class="ps-3">
                      <h6>{{$facture_payer}}</h6>
                      <span class="text-success small pt-1 fw-bold">{{ number_format($total_payer->total,2,","," ")}}</span> <span class="text-muted small pt-2 ps-1">{{$agence->devise->unite}}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div> --}}
            <!-- End Sales Card -->
            <!-- Sales Card -->
            {{-- <div class="col-xxl-3 col-md-4">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Activite vehicule </h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <a href="{{route('facture')}}"><i class="bi bi-cart"></i></a>
                      </div>
                      <div class="ps-3">
                        <h6>{{$count_activite_vehicule}}</h6>
                        <span class="text-success small pt-1 fw-bold">{{ number_format($total_activite_vehicule->total,2,","," ")}}</span> <span class="text-muted small pt-2 ps-1">{{$agence->devise->unite}}</span>
                      </div>
                    </div>
                </div>
              </div>
            </div><!-- End Sales Card --> --}}


            <!-- End Sales Card -->
          @endif

          <!-- <div class="col-lg-12">
          <div class="card bg-primary">
            <div class="divider">
              <hr>
            </div>
          </div>
        </div>

          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Statistique des dividendes</h5>

                <canvas id="doughnutChart" style="max-height: 400px;"></canvas>
                <script>
                  document.addEventListener("DOMContentLoaded", () => {
                    new Chart(document.querySelector('#doughnutChart'), {
                      type: 'doughnut',
                      data: {
                        labels: [
                          'Red',
                          'Blue',
                          'Yellow'
                        ],
                        datasets: [{
                          label: 'My First Dataset',
                          data: [300, 50, 100],
                          backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)'
                          ],
                          hoverOffset: 4
                        }]
                      }
                    });
                  });
                </script>

              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title"> Statistique des activits</h5>

                <canvas id="barChart" style="max-height: 400px;"></canvas>
                <script>
                  document.addEventListener("DOMContentLoaded", () => {
                    new Chart(document.querySelector('#barChart'), {
                      type: 'bar',
                      data: {
                        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                        datasets: [{
                          label: 'Bar Chart',
                          data: [65, 59, 80, 81, 56, 55, 40],
                          backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                          ],
                          borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)'
                          ],
                          borderWidth: 1
                        }]
                      },
                      options: {
                        scales: {
                          y: {
                            beginAtZero: true
                          }
                        }
                      }
                    });
                  });
                </script>
              </div>
            </div>
          </div> -->
      </div>

    @endif
    @if(Auth::user()->agence_id=="0")

      <!-- Card with an image on left -->
      <div class="card mb-3">
                <div class="row g-0">
                  <div class="col-md-4">
                    @if(isset(Auth::user()->societe->logo))
                    <img src="{{ asset('/images/logo/'.Auth::user()->societe->logo) }}" class="img-fluid rounded-start" alt="...">
                    @else
                    <img src="{{ asset('/images/logo/'.Auth::user()->societe->logo) }}" class="img-fluid rounded-start" alt="...">
                    @endif

                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title">Bienvenu à la société {{Auth::user()->societe->raison_sociale}}</h5>
                      <p class="card-text">
                        Pour tout renseignement ou en cas de besoin d'aide appeler le <strong> {{Auth::user()->societe->telephone}}</strong>
                        ou nous ecrire par mail à l'adresse <strong> {{Auth::user()->societe->email}}</strong>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          <i class="bi bi-exclamation-octagon me-1"></i>
                          Votre compte utilisateur n'est pas lié à une agence
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                      </p>
                    </div>
                  </div>
                </div>
              </div><!-- End Card with an image on left -->




    @endif
    </section>

  </main><!-- End #main -->
