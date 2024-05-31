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
                        @if(Auth::user()->role_id =="1" || Auth::user()->role_id =="0"|| Auth::user()->role_id =="2"||Auth::user()->role_id =="3"||Auth::user()->role_id =="4"||Auth::user()->role_id =="5"||Auth::user()->role_id =="6"||Auth::user()->role_id =="7")
                        @if(Auth::user()->role_id =="1" || Auth::user()->role_id =="0"|| Auth::user()->role_id =="2"||Auth::user()->role_id =="3"||Auth::user()->role_id =="4")
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
                                                class="text-muted small pt-2 ps-1">@if (isset($agence->devise->unite))
                                                {{$agence->devise->unite}}
                                                @endif</span>
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
                                            <span class="text-muted small pt-2 ps-1">@if (isset($agence->devise->unite))
                                                {{$agence->devise->unite}}
                                                @endif</span>
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
                                                class="text-danger small pt-2 ps-1">@if (isset($agence->devise->unite))
                                                {{$agence->devise->unite}}
                                                @endif</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- End Revenue Card -->
                        <div class="col-xxl-4 col-md-12">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Patients</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <a href="{{route('ad.sante.index.patient')}}"><i
                                                    class="ri ri-user-add-line"></i></a>
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
                        <!-- End Revenue Card -->
                        <div class="col-xxl-4 col-md-12">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Medecins</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <a href="{{route('ad.sante.index.medecin')}}"><i
                                                    class="ri ri-team-line"></i></a>
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
                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-12">
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
                        <div class="col-xxl-4 col-md-12">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Totat rendez-vous</h5>
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
                        </div>
                        <!-- End Sales Card -->
                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-12">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Nouveau rendez-vous </h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <a href=""><i class="ri ri-calendar-todo-fill"></i></a>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{$nouveau_rdv_count}}</h6>
                                            <span class="text-info small pt-1 fw-bold">voir plus</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Sales Card -->
                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-12">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Rendez-vous d'aujourd'hui </h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <a href=""><i class="ri ri-calendar-todo-fill"></i></a>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{$rdv_jour_count}}</h6>
                                            <span class="text-info small pt-1 fw-bold">voir plus</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Sales Card -->
                        @endif
                        @if(Auth::user()->role_id =="1" || Auth::user()->role_id =="0"|| Auth::user()->role_id =="2"||Auth::user()->role_id =="3"||Auth::user()->role_id =="4")
                        <!-- Reports -->
                        <div class="col-12">
                            <div class="card">
                                @php
                                $data_revenu= array();
                                $date_revenu= array();
                                @endphp
                                @foreach ($rapport_revenus as $rapport_revenu)
                                @php
                                $data_revenu[]=$rapport_revenu->total;
                                $date_revenu[]=\Carbon\Carbon::parse($rapport_revenu->date_operation)->format('d/m/Y');
                                @endphp

                                @endforeach

                                @php
                                $data_depense= array();
                                $date_revenu= array();
                                @endphp
                                @foreach ($rapport_depenses as $rapport_depense)
                                @php
                                $data_depense[]=$rapport_depense->total;
                                $date_depense[]=\Carbon\Carbon::parse($rapport_depense->date_comptable)->format('d/m/Y');
                                @endphp
                                @endforeach
                                <div class="card-body">
                                    <h5 class="card-title">Rapport de revenu et depense</h5>

                                    <!-- Line Chart -->
                                    <div id="reportsChart"></div>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", () => {
                                            new ApexCharts(document.querySelector("#reportsChart"), {
                                                series: [
                                                {
                                                    name: 'Revenue',
                                                    data:<?=json_encode($data_revenu)?>
                                                },
                                                {
                                                    name: 'Depense',
                                                    data: <?=json_encode($data_depense)?>
                                                }
                                                ],
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
                                                colors: ['#2eca6a', '#ff771d', '#4154f1' ],
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
                                                categories:["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
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
                        @endif

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
                                @if($liste_attente->patient->civilite->civilite=="Mr")
                                <div class="activity-item d-flex">
                                    <div class="activite-label">{{$liste_attente->created_at->diffForHumans()}} </div>
                                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                    <div class="activity-content">
                                        {{$liste_attente->patient->nom}} <a href="#"
                                            class="fw-bold text-dark">{{$liste_attente->patient->prenom}}</a> :=>
                                        {{$liste_attente->tarif_consultation->type_consultation->type_consultation}}
                                    </div>
                                </div><!-- End activity item-->
                                @endif
                                @if($liste_attente->patient->civilite->civilite=="Mme")
                                <div class="activity-item d-flex">
                                    <div class="activite-label">{{$liste_attente->created_at->diffForHumans()}} </div>
                                    <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                                    <div class="activity-content">
                                        {{$liste_attente->patient->nom}} <a href="#"
                                            class="fw-bold text-dark">{{$liste_attente->patient->prenom}}</a> :=>
                                        {{$liste_attente->tarif_consultation->type_consultation->type_consultation}}
                                    </div>
                                </div><!-- End activity item-->
                                @endif
                                @if($liste_attente->patient->civilite->civilite=="Mlle")
                                <div class="activity-item d-flex">
                                    <div class="activite-label">{{$liste_attente->created_at->diffForHumans()}} </div>
                                    <i class='bi bi-circle-fill activity-badge text-secondary align-self-start'></i>
                                    <div class="activity-content">
                                        {{$liste_attente->patient->nom}} <a href="#"
                                            class="fw-bold text-dark">{{$liste_attente->patient->prenom}}</a> :=>
                                        {{$liste_attente->tarif_consultation->type_consultation->type_consultation}}
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
                            <h5 class="card-title">Agenda des medecins du jour</h5>

                            <div class="news">
                                @foreach ($planifications as $planification )
                                <div class="post-item clearfix">
                                    <img src="assets/img/medecin.jpg" alt="">
                                    {{-- <i class="ri ri-team-line"></i> --}}
                                    <h4><a href="#">
                                        {{$planification->medecin->titre}} {{$planification->medecin->nom.'
                                        '.$planification->medecin->prenom}}</h4>
                                    <p>
                                    <strong>Specialite :</strong> {{$planification->medecin->specialite->specialite_medecin}}
                                    <br>
                                    <span><strong>Heure planifier :</strong>
                                        {{
                                                \Carbon\Carbon::parse($planification->heure_debut)->format('H:s').'
                                                à
                                                '.\Carbon\Carbon::parse($planification->heure_fin)->format('H:s')
                                    }}
                                    </span>
                                    <br>
                                    <span>
                                    <strong>Coût prestation :</strong>
                                    {{
                                                number_format($planification->tarif_consultation->montant,2,","," ").'
                                                '.$planification->user->agence->devise->unite}}
                                    </span>
                                    </p>

                                </div>
                                @endforeach

                            </div><!-- End sidebar recent posts-->

                        </div>
                    </div><!-- End News & Updates -->
                    <!-- Website Traffic -->
                    <div class="card">

                        <div class="card-body pb-0">
                            <h5 class="card-title">Statistique des consultations</h5>

                            <div id="trafficChart" style="min-height: 400px;" class="echart"></div>
                            @foreach ($rapport_consultations as $rapport_consultation)
                            @php
                            $data[]=[
                                        'value' => json_encode($rapport_consultation->total, JSON_UNESCAPED_UNICODE),
                                        'name' => json_encode($rapport_consultation->tarif_consultation->type_consultation->type_consultation, JSON_UNESCAPED_UNICODE)
                                    ];
                            @endphp
                            @endforeach
                            {{-- {{json_encode($data)}} --}}
                    <script>
                    document.addEventListener("DOMContentLoaded", () => {
                    echarts.init(document.querySelector("#trafficChart")).setOption({
                        tooltip: {
                        trigger: 'item'
                        },
                        legend: {
                        top: '5%',
                        left: 'center'
                        },
                        series: [{
                        name: '',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        label: {
                            show: false,
                            position: 'center'
                        },
                        emphasis: {
                            label: {
                            show: true,
                            fontSize: '18',
                            fontWeight: 'bold'
                            }
                        },
                        labelLine: {
                            show: false
                        },
                        data: <?=json_encode($data)?>,
                        }]
                    });
                    });
                            </script>
                        </div>
                    </div><!-- End Website Traffic -->



                </div><!-- End Right side columns -->

        </div>
    </section>

</main><!-- End #main -->
