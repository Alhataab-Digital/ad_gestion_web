<main id="main" class="main">

    <div class="pagetitle">
        {{-- <h1>Consultation</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                <li class="breadcrumb-item">param</li>
                <li class="breadcrumb-item active">Consultation</li>
            </ol>
        </nav> --}}
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="m-auto form-signin w-80 col-lg-12 bg-primary">
                    <h5 class="text-center text-white card-title">GESTION CONSULTATION </h5>
            </div>
            <div class="card">

                <div class="card-body">


                      <!-- Table with stripped rows -->
                      <table class="table datatable">
                        <thead class="text-white bg-primary">
                            <tr>
                                <!-- <th scope="col">#</th> -->
                                <th scope="col">Patient</th>
                                <th scope="col">Date prevus</th>
                                <th scope="col">Type de consultation</th>
                                <th scope="col">motif consultation</th>
                                <th scope="col">Medecin</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($consultations as $consultation )
                            <tr>
                                <td>{{ $consultation->patient->nom}} {{ $consultation->patient->prenom}}</td>
                                <td>{{ \Carbon\Carbon::parse($consultation->created_at)->format('d-m-Y')}}</td>
                                <td>{{ $consultation->tarif_consultation->type_consultation->type_consultation}}</td>
                                <td>{{ $consultation->rendez_vous->motif}}</td>
                                <td>{{ $consultation->medecin->prenom.' '.$consultation->medecin->nom}}</td>
                                <td>
                                    @if($consultation->etat==0)
                                    <span class="badge bg-danger">en attente</span>
                                    @endif
                                    @if($consultation->etat==1)
                                    <span class="badge bg-secondary">en cours</span>
                                    @endif
                                    @if($consultation->etat==2)
                                    <span class="badge bg-info">Terminer</span>
                                    @endif
                                </td>
                                <td>
                                    {{-- <a href="" > <button type="button" class="btn btn-primary btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    </a> --}}
                                    @if($consultation->etat==0)
                                    <button class="btn btn-warning btn-sm" '>
                                        <i class="bx bxs-hide"></i></button>
                                    @endif
                                    @if($consultation->etat==1)
                                        <button class="btn btn-danger btn-sm">
                                            <i class="bx bxs-hide"></i></button>
                                        @endif
                                        @if($consultation->etat==2)
                                        <a href="{{route('ad.sante.resultat.consultation',encrypt($consultation->id))}}">
                                        <button class="btn btn-secondary btn-sm">
                                        <i class="bx bxs-show"></i></button>
                                        </a>
                                        @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
              </div>
        </div>
    </section>

</main>
<!-- End #main -->
