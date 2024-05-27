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
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">FACTURE ET REGLEMENT </h5>

                  <!-- Default Tabs -->
                  <ul class="nav nav-tabs" id="myTab" role="tablist">

                    <li class="nav-item" role="facturation">
                        <button class="nav-link active" id="facturation-tab" data-bs-toggle="tab" data-bs-target="#facturation" type="button" role="tab" aria-controls="facturation" aria-selected="false">
                            FACTURES</button>
                      </li>
                      <li class="nav-item" role="caisse">
                        <button class="nav-link" id="caisse-tab" data-bs-toggle="tab" data-bs-target="#caisse" type="button" role="tab" aria-controls="caisse" aria-selected="false">
                            REGLEMENT PERCUS</button>
                      </li>
                  </ul>
                  <div class="tab-content pt-2" id="myTabContent">


                      <div class="tab-pane fade show active" id="facturation" role="tabpanel" aria-labelledby="facturation-tab">
                           <!-- Table with stripped rows -->
                           <table class="table datatable">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">N° FAC</th>
                                    <th scope="col">Patient</th>
                                    <th scope="col">date </th>
                                    <th scope="col">type consultation</th>
                                    {{-- <th scope="col">Medecin</th> --}}
                                    <th scope="col">montant</th>
                                    <th scope="col">part assurer</th>
                                    <th scope="col">part patient</th>
                                    <th scope="col">montant payé</th>
                                    <th scope="col">reste à payer</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($facturations as $facturation )
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($facturation->created_at)->format('dmy').''.$facturation->id}}</td>
                                    <td>{{ $facturation->patient->nom}} {{ $facturation->patient->prenom}}</td>
                                    <td>{{ \Carbon\Carbon::parse($facturation->created_at)->format('d-m-Y')}}</td>
                                    <td>{{
                                        $facturation->rendez_vous->planification->tarif_consultation->type_consultation->type_consultation}}
                                    </td>
                                    {{-- <td>{{ $facturation->medecin->prenom.' '.$facturation->medecin->nom}}</td> --}}

                                    <td style="text-align:right">{{
                                        number_format($facturation->montant,2,","," ").'
                                        '.$facturation->user->agence->devise->unite}}
                                        </td>
                                    <td style="text-align:right; color:green">{{
                                        number_format($facturation->montant_assurer,2,","," ").'
                                        '.$facturation->user->agence->devise->unite}}
                                        </td>
                                    <td style="text-align:right">{{
                                        number_format($facturation->montant_patient,2,","," ").'
                                        '.$facturation->user->agence->devise->unite}}
                                        </td>

                                    <td style="text-align:right">{{
                                        number_format($facturation->montant_paye,2,","," ").'
                                        '.$facturation->user->agence->devise->unite}}
                                    </td>

                                    <td style="text-align:right; color:red">{{
                                        number_format($facturation->reste_a_payer,2,","," ").'
                                        '.$facturation->user->agence->devise->unite}}
                                    </td>
                                    <td>
                                        @if($facturation->etat==0)
                                        <span class="badge bg-danger"> à payé</span>
                                        @endif
                                        @if($facturation->etat==1)
                                        <span class="badge bg-success">payée</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- <a href=""> <button type="button" class="btn btn-primary btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </a> --}}
                                        @if($facturation->etat==0)
                                        <a href="{{route('ad.sante.recu.consultation',encrypt($facturation->id))}}">
                                            <button class="btn btn-warning btn-sm">
                                                <i class="ri ri-bank-card-2-line"></i></button>
                                        </a>
                                        @endif
                                        @if($facturation->etat==1)
                                        <a href="{{route('ad.sante.recu.consultation',encrypt($facturation->id))}}">
                                        <button class="btn btn-secondary btn-sm">
                                            <i class="bx bx-printer"></i></button>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                      </div>
                      <div class="tab-pane fade" id="caisse" role="tabpanel" aria-labelledby="caisse-tab">
                         <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead class="bg-primary text-white">
                            <tr>
                                <!-- <th scope="col">#</th> -->
                                <th scope="col">patient</th>
                                <th scope="col">Telephone patient</th>
                                <th scope="col">Date operation</th>
                                <th scope="col">agent caisse</th>
                                <th scope="col">motif reglement</th>
                                <th scope="col">type reglement</th>
                                <th scope="col">Montant reglé</th>
                                <th scope="col">Status</th>
                                {{-- <th scope="col">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paiements as $paiement )
                            <tr>
                                <td>{{ $paiement->facturation->patient->nom.' '.$paiement->facturation->patient->prenom}}</td>
                                <td>{{ $paiement->facturation->patient->telephone}}</td>
                                <td>{{ \Carbon\Carbon::parse($paiement->date_operation)->format('d-m-Y')}}</td>

                                <td>{{ $paiement->user->nom.' '.$paiement->user->prenom}}</td>
                                <td>{{ $paiement->facturation->rendez_vous->planification->tarif_consultation->type_consultation->type_consultation}}</td>
                                <td>{{ $paiement->reglement->reglement}}</td>
                                <td style="text-align:right; color:green">{{
                                    number_format($paiement->montant,2,","," ").'
                                    '.$paiement->user->agence->devise->unite}}
                                    </td>
                                    <td>
                                    @if($paiement->etat==0)
                                    <span class="badge bg-success">perçu</span>
                                    @endif
                                </td>
                                <td>
                                    {{-- <a href="" > <button type="button" class="btn btn-primary btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    </a>
                                    <button class="btn btn-warning btn-sm"><i class="ri ri-bank-card-2-line"></i></button>
                                    <button class="btn btn-danger btn-sm"><i class="bx bx-trash"></i></button> --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                      </div>

                  </div><!-- End Default Tabs -->

                </div>
              </div>
        </div>
    </section>

</main>
<!-- End #main -->
