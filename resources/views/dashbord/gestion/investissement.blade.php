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
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-12">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Montant total caisses agence</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $montant_total_caisse_agence->total }}</h6>
                      {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-12">
              <div class="card info-card revenue-card">


                <div class="card-body">
                  <h5 class="card-title">Nombre d'utilisateur </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ri-account-pin-box-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $count_user }}</h6>
                      {{-- <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">


                <div class="card-body">
                  <h5 class="card-title">Nombre d'investisseur </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $count_investisseur }}</h6>
                      {{-- <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span> --}}

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
                <div class="col-xxl-4 col-md-4">
                      <div class="card info-card sales-card">

                        <div class="card-body">
                          <h5 class="card-title">Facture Payé</h5>

                          <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bi bi-cart"></i>
                            </div>
                            <div class="ps-3">
                              <h6>{{$facture_payer}}</h6>
                              <span class="text-success small pt-1 fw-bold">{{$total_payer->total}}</span> <span class="text-muted small pt-2 ps-1">Fcfa</span>

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
                          <h5 class="card-title">Facture non valider</h5>

                          <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bi bi-cart"></i>
                            </div>
                            <div class="ps-3">
                              <h6>{{$facture_non_valider}}</h6>
                              <span class="text-success small pt-1 fw-bold">{{$total_non_valider->total}}</span> <span class="text-muted small pt-2 ps-1">Fcfa</span>

                            </div>
                          </div>
                        </div>
                      </div>
                    </div><!-- End Sales Card -->

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-4">
                      <div class="card info-card sales-card">

                        <div class="card-body">
                          <h5 class="card-title">Facture impayer</h5>

                          <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bi bi-cart"></i>
                            </div>
                            <div class="ps-3">
                              <h6>{{$facture_impayer}}</h6>
                              <span class="text-success small pt-1 fw-bold">{{$total_impayer->total}}</span> <span class="text-muted small pt-2 ps-1">Fcfa</span>

                            </div>
                          </div>
                        </div>
                      </div>
          </div>
          <!-- End Sales Card -->

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
                          <h5 class="card-title">Activité(s) en cours</h5>

                          <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bi bi-cart"></i>
                            </div>
                            <div class="ps-3">
                              <h6>{{$activite_encours}}</h6>
                              {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

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
                          <h5 class="card-title">Activité(s) cloturé</h5>

                          <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bi bi-cart"></i>
                            </div>
                            <div class="ps-3">
                              <h6>{{$activite_terminer}}</h6>
                              {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                            </div>
                          </div>
                        </div>
                      </div>
                    </div><!-- End Sales Card -->

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-4">
                      <div class="card info-card sales-card">

                        <div class="card-body">
                          <h5 class="card-title">Activité(s) non validé</h5>

                          <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bi bi-cart"></i>
                            </div>
                            <div class="ps-3">
                              <h6>{{$activite_non_valider}}</h6>
                              {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

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

          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Statistique des dividendes</h5>

                <!-- Doughnut Chart -->
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
                <!-- End Doughnut CHart -->

              </div>
            </div>
          </div>


          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title"> Statistique des activits</h5>

                <!-- Bar Chart -->
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
                <!-- End Bar CHart -->

              </div>
            </div>
          </div>

      </div>
    </section>

  </main><!-- End #main -->
