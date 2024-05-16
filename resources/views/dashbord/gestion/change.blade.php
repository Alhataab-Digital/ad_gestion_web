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
            <div class="col-lg-8">
                <div class="row">
                    @if(Auth::user()->role_id=="0"||Auth::user()->role_id=="1"||Auth::user()->role_id=="2"||
                    Auth::user()->role_id=="4")

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Caisses agence</h5>
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
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">

                            <div class="card-body">
                                <h5 class="card-title">Montant <span>| Depense</span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>$3,264</h6>
                                        <span class="text-success small pt-1 fw-bold">8%</span> <span
                                            class="text-muted small pt-2 ps-1">increase</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card customers-card">

                            <div class="card-body">
                                <h5 class="card-title">Situation <span>| Banque</span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>1244</h6>
                                        <span class="text-danger small pt-1 fw-bold">12%</span> <span
                                            class="text-muted small pt-2 ps-1">decrease</span>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Customers Card -->

                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Change argent</h5>
                                <p>Operation de change</p>

                                <!-- Tooltips Examples -->
                                <a href="{{ route('achat_devise') }}">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="ACHAT CHANGE">
                                        Achat change
                                    </button>
                                </a>
                                <a href="{{ route('vente_devise') }}">
                                    <button type="button" class="btn btn-success" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="VENTE CHANGE">
                                        vente change
                                    </button>
                                </a>
                                <a href="{{ route('envoi') }}">
                                    <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="DEPOT CHANGE">
                                        Envoi change
                                    </button>
                                </a>
                                <a href="{{ route('retrait') }}">
                                    <button type="button" class="btn btn-info" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="RETRAIT CHANGE">
                                        Retrait change
                                    </button>
                                </a>
                                <!-- End Tooltips Examples -->

                            </div>
                        </div>

                    </div>

                    {{--
                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">

                            <div class="card-body">
                                <h5 class="card-title">Les taux <span>| d'échange</span></h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Monnaie</th>
                                            <th scope="col">Devise</th>
                                            <th scope="col">Taux</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($devises as $devise )
                                        <tr>
                                            <td>{{ $devise->monnaie}}</td>
                                            <td>{{ $devise->devise}}</td>
                                            <td>{{ $devise->taux.' '.$devise->unite}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Recent Sales --> --}}

                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">

                <!-- Budget Report >
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body pb-0">
              <h5 class="card-title">Budget Report <span>| This Month</span></h5>

              <div id="budgetChart" style="min-height: 400px;" class="echart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                    legend: {
                      data: ['Allocated Budget', 'Actual Spending']
                    },
                    radar: {
                      // shape: 'circle',
                      indicator: [{
                          name: 'Sales',
                          max: 6500
                        },
                        {
                          name: 'Administration',
                          max: 16000
                        },
                        {
                          name: 'Information Technology',
                          max: 30000
                        },
                        {
                          name: 'Customer Support',
                          max: 38000
                        },
                        {
                          name: 'Development',
                          max: 52000
                        },
                        {
                          name: 'Marketing',
                          max: 25000
                        }
                      ]
                    },
                    series: [{
                      name: 'Budget vs spending',
                      type: 'radar',
                      data: [{
                          value: [4200, 3000, 20000, 35000, 50000, 18000],
                          name: 'Allocated Budget'
                        },
                        {
                          value: [5000, 14000, 28000, 26000, 42000, 21000],
                          name: 'Actual Spending'
                        }
                      ]
                    }]
                  });
                });
              </script>

            </div>
          </div>< End Budget Report -->

                <!-- Website Traffic -->
                <div class="card">

                    <div class="card-body pb-0">
                        <h5 class="card-title">Statistique <span>| Devise</span></h5>

                        <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

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
                      name: 'Access From',
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
                      data: [{
                          value: 1048,
                          name: 'Search Engine'
                        },
                        {
                          value: 735,
                          name: 'Direct'
                        },
                        {
                          value: 580,
                          name: 'Email'
                        },
                        {
                          value: 484,
                          name: 'Union Ads'
                        },
                        {
                          value: 300,
                          name: 'Video Ads'
                        }
                      ]
                    }]
                  });
                });
                        </script>

                    </div>
                </div><!-- End Website Traffic -->


            </div><!-- End Right side columns -->
            @endif
            @if(Auth::user()->role_id=="3"||
            Auth::user()->role_id=="5"||Auth::user()->role_id=="6"||Auth::user()->role_id=="7")
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
                                <span class="text-success small pt-1 fw-bold">{{
                                    number_format($montant_total_caisse->total,2,","," ")}}</span> <span
                                    class="text-muted small pt-2 ps-1">{{$agence->devise->unite}}</span>
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
                                <span class="text-muted small pt-2 ps-1">{{
                                    number_format($montant_total_charge->total,2,","," ")}}
                                    {{$agence->devise->unite}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Sales Card -->
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Change argent</h5>
                        <p>Operation de change</p>

                        <!-- Tooltips Examples -->
                        <a href="{{ route('achat_devise') }}">
                            <button type="button" class="btn btn-danger" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" title="ACHAT CHANGE">
                                Achat change
                            </button>
                        </a>
                        <a href="{{ route('vente_devise') }}">
                            <button type="button" class="btn btn-success" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" title="VENTE CHANGE">
                                vente change
                            </button>
                        </a>
                        <a href="{{ route('envoi') }}">
                            <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" title="DEPOT CHANGE">
                                Envoi change
                            </button>
                        </a>
                        <a href="{{ route('retrait') }}">
                            <button type="button" class="btn btn-info" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" title="RETRAIT CHANGE">
                                Retrait change
                            </button>
                        </a>
                        <!-- End Tooltips Examples -->

                    </div>
                </div>

            </div>
            @endif
        </div>
    </section>

</main><!-- End #main -->
