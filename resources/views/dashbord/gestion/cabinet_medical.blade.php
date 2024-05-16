<main id="main" class="main">

    <div class="pagetitle">
        <h1>Tableau de bord</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                <li class="breadcrumb-item active">Tableau de bord</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-12">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Caisses</h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <a href="{{route('caisse')}}"><i class="bi bi-cash-stack"></i></a>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$count_caisse_agence}}</h6>
                                        <span class="text-success small pt-1 fw-bold">{{
                                            number_format($montant_total_caisse_agence->total,2,","," ")}}</span> <span
                                            class="text-muted small pt-2 ps-1">{{$agence->devise->unite}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Sales Card -->
                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-12">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Banques</h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <a href="{{route('banque')}}"><i class="bi bi-bank"></i></a>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$count_banque_agence}}</h6>
                                        <span class="text-success small pt-1 fw-bold">{{
                                            number_format($montant_total_banque_agence->total,2,","," ")}}</span>
                                        <span class="text-muted small pt-2 ps-1">{{$agence->devise->unite}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Sales Card -->
                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-12">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Depenses </h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <a href="{{route('operation')}}"><i class="bi bi-basket"></i></a>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $count_charge_agence }}</h6>
                                        <span class="text-danger small pt-2 ps-1 fw-bold">{{
                                            number_format($montant_total_charge_agence->total,2,","," ")}}</span> <span
                                            class="text-danger small pt-2 ps-1"> {{$agence->devise->unite}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Revenue Card -->
                    <div class="col-xxl-3 col-md-12">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Patients</h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <a href="{{route('ad.sante.index.patient')}}"><i class="ri ri-user-add-line"></i></a>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$patient_count}}</h6>
                                        <span class="text-success small pt-2 ps-1 fw-bold"> <a
                                                href="{{route('ad.sante.index.patient')}}"> voir plus</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Revenue Card -->
                    <!-- Sales Card -->
                    <div class="col-xxl-3 col-md-12">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Consultations</h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <a href=""><i class="ri ri-stethoscope-line"></i></a>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$consultation_count}}</h6>
                                        <span class="text-primary small pt-1 fw-bold">voir plus</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Sales Card -->
                    <!-- Sales Card -->
                    <div class="col-xxl-3 col-md-12">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Rendez-vous</h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <a href=""><i class="ri ri-calendar-todo-fill"></i></a>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$rdv_count}}</h6>
                                        <span class="text-info small pt-1 fw-bold">voir plus</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Sales Card -->
                    <!-- End Revenue Card -->
                    <div class="col-xxl-3 col-md-12">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Medecins</h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <a href="{{route('ad.sante.index.medecin')}}"><i class="ri ri-team-line"></i></a>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$medecin_count}}</h6>
                                        <span class="text-success small pt-2 ps-1 fw-bold"> <a
                                                href="{{route('ad.sante.index.medecin')}}"> voir plus</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Revenue Card -->
                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <h5 class="card-title">Rapport</h5>

                                <!-- Line Chart -->
                                <div id="reportsChart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [{
                          name: 'Sales',
                          data: [31, 40, 28, 51, 42, 82, 56],
                        }, {
                          name: 'Revenue',
                          data: [11, 32, 45, 32, 34, 52, 41]
                        }, {
                          name: 'Customers',
                          data: [15, 11, 32, 18, 9, 24, 11]
                        }],
                        chart: {
                          height: 350,
                          type: 'area',
                          toolbar: {
                            show: false
                          },
                        },
                        markers: {
                          size: 4
                        },
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                        fill: {
                          type: "gradient",
                          gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.4,
                            stops: [0, 90, 100]
                          }
                        },
                        dataLabels: {
                          enabled: false
                        },
                        stroke: {
                          curve: 'smooth',
                          width: 2
                        },
                        xaxis: {
                          type: 'datetime',
                          categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                        },
                        tooltip: {
                          x: {
                            format: 'dd/MM/yy HH:mm'
                          },
                        }
                      }).render();
                    });
                                </script>
                                <!-- End Line Chart -->

                            </div>

                        </div>
                    </div><!-- End Reports -->


                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">

                <!-- Recent Activity -->
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">Salle d'attente</h5>
                        <div class="activity">
                            @foreach ($liste_attentes as $liste_attente )
                            @if($liste_attente->patient->civilite=="Monsieur")
                            <div class="activity-item d-flex">
                                <div class="activite-label">{{$liste_attente->created_at->diffForHumans()}} </div>
                                <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                <div class="activity-content">
                                    {{$liste_attente->patient->nom}} <a href="#" class="fw-bold text-dark">{{$liste_attente->patient->prenom}}</a> :=> {{$liste_attente->tarif->libelle_tarif}}
                                </div>
                            </div><!-- End activity item-->
                            @endif
                            @if($liste_attente->patient->civilite=="Madame")
                            <div class="activity-item d-flex">
                                <div class="activite-label">{{$liste_attente->created_at->diffForHumans()}} </div>
                                <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                                <div class="activity-content">
                                    {{$liste_attente->patient->nom}} <a href="#" class="fw-bold text-dark">{{$liste_attente->patient->prenom}}</a> :=> {{$liste_attente->tarif->libelle_tarif}}
                                </div>
                            </div><!-- End activity item-->
                            @endif
                            @if($liste_attente->patient->civilite=="Mademoiselle")
                            <div class="activity-item d-flex">
                                <div class="activite-label">{{$liste_attente->created_at->diffForHumans()}} </div>
                                <i class='bi bi-circle-fill activity-badge text-secondary align-self-start'></i>
                                <div class="activity-content">
                                    {{$liste_attente->patient->nom}} <a href="#" class="fw-bold text-dark">{{$liste_attente->patient->prenom}}</a> :=> {{$liste_attente->tarif->libelle_tarif}}
                                </div>
                            </div><!-- End activity item-->
                            @endif
                            @endforeach

                        </div>

                    </div>
                </div><!-- End Recent Activity -->
                <!-- News & Updates Traffic -->
                <div class="card">

                    <div class="card-body pb-0">
                        <h5 class="card-title">Les Rendez-vous</h5>

                        <div class="news">
                            <div class="post-item clearfix">
                                <img src="assets/img/news-1.jpg" alt="">
                                <h4><a href="#">Nihil blanditiis at in nihil autem</a></h4>
                                <p>Sit recusandae non aspernatur laboriosam. Quia enim eligendi sed ut harum...</p>
                            </div>

                            <div class="post-item clearfix">
                                <img src="assets/img/news-2.jpg" alt="">
                                <h4><a href="#">Quidem autem et impedit</a></h4>
                                <p>Illo nemo neque maiores vitae officiis cum eum turos elan dries werona nande...</p>
                            </div>

                            <div class="post-item clearfix">
                                <img src="assets/img/news-3.jpg" alt="">
                                <h4><a href="#">Id quia et et ut maxime similique occaecati ut</a></h4>
                                <p>Fugiat voluptas vero eaque accusantium eos. Consequuntur sed ipsam et totam...</p>
                            </div>

                            <div class="post-item clearfix">
                                <img src="assets/img/news-4.jpg" alt="">
                                <h4><a href="#">Laborum corporis quo dara net para</a></h4>
                                <p>Qui enim quia optio. Eligendi aut asperiores enim repellendusvel rerum cuder...</p>
                            </div>

                            <div class="post-item clearfix">
                                <img src="assets/img/news-5.jpg" alt="">
                                <h4><a href="#">Et dolores corrupti quae illo quod dolor</a></h4>
                                <p>Odit ut eveniet modi reiciendis. Atque cupiditate libero beatae dignissimos eius...
                                </p>
                            </div>

                        </div><!-- End sidebar recent posts-->

                    </div>
                </div><!-- End News & Updates -->

            </div><!-- End Right side columns -->

        </div>
    </section>

</main><!-- End #main -->
