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
            <div class="form-signin w-80 m-auto col-lg-4">

                <!-- Vertical Form -->
                <form wire:submit='valider' class="row g-0">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            PRENDRE RENDEZ VOUS
                        </div>
                        <p>
                            @if ($message=Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if ($message=Session::get('danger'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-octagon me-1"></i>
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        </p>
                        <div class="card-body">
                            <h5 class="card-title">
                                <div class="col-12">
                                    <label for="inputAddress5" class="form-label">Telephone <span
                                            style="color: red">*</span></label>
                                    <input type="text" class="form-control" wire:model='telephone' id="inputAddres5s">
                                    @error('telephone')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                        </div>
                        <div class="card-footer bg-dark text-white">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Valider</button>
                                <a href="">
                                    <button type="button" class="btn btn-secondary">Retour</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </form><!-- Vertical Form -->

            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">GESTION RENDEZ VOUS </h5>

                    <!-- Default Tabs -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">LISTE DES
                                RENDEZ-VOUS</button>
                        </li>
                        <li class="nav-item" role="facturation">
                            <button class="nav-link" id="facturation-tab" data-bs-toggle="tab"
                                data-bs-target="#facturation" type="button" role="tab" aria-controls="facturation"
                                aria-selected="false">FACTURE EN COURS</button>
                        </li>
                        <li class="nav-item" role="caisse">
                            <button class="nav-link" id="caisse-tab" data-bs-toggle="tab" data-bs-target="#caisse"
                                type="button" role="tab" aria-controls="caisse" aria-selected="false">REGLEMENT
                                PERCUS</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                type="button" role="tab" aria-controls="contact" aria-selected="false">SALLE
                                D'ATTENTE</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <!-- <th scope="col">#</th> -->
                                        <th scope="col">Patient</th>
                                        <th scope="col">Date prevus</th>
                                        <th scope="col">Heure prevus</th>
                                        <th scope="col">Type de rendez-vous</th>
                                        <th scope="col">motif rendez-vous</th>
                                        <th scope="col">Medecin</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rendez_vouss as $rendez_vous )
                                    <tr>
                                        <td>{{ $rendez_vous->patient->nom}} {{ $rendez_vous->patient->prenom}}</td>
                                        <td>{{ \Carbon\Carbon::parse($rendez_vous->date_rdv)->format('d-m-Y')}}</td>
                                        <td>{{
                                            \Carbon\Carbon::parse($rendez_vous->planification->heure_debut)->format('H:s').'
                                            à
                                            '.\Carbon\Carbon::parse($rendez_vous->planification->heure_fin)->format('H:s')}}
                                        </td>
                                        <td>{{
                                            $rendez_vous->planification->tarif_consultation->type_consultation->type_consultation}}
                                        </td>
                                        <td>{{ $rendez_vous->motif}}</td>
                                        <td>{{ $rendez_vous->medecin->prenom.' '.$rendez_vous->medecin->nom}}</td>
                                        <td>
                                            @if($rendez_vous->etat==0)
                                            <span class="badge bg-danger"> à venir</span>
                                            @endif
                                            @if($rendez_vous->etat==1)
                                            <span class="badge bg-warning">Facturé</span>
                                            @endif
                                            @if($rendez_vous->etat==2)
                                            <span class="badge bg-success">Payé</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- <a href=""> <button type="button" class="btn btn-primary btn-sm">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                            </a> --}}
                                            @if($rendez_vous->etat==0)
                                            <button class="btn btn-warning btn-sm"
                                                wire:click='facturerRendezVous({{$rendez_vous->id}})'>
                                                <i class="ri ri-bank-card-2-line"></i></button>
                                            @endif
                                            @if($rendez_vous->etat==1)
                                            <button class="btn btn-info btn-sm">
                                                <i class="bx bxs-hide"></i></button>
                                            @endif
                                            @if($rendez_vous->etat==2)
                                            <button class="btn btn-secondary btn-sm"
                                            wire:click='IntroduireSalleAttente({{$rendez_vous->id}})'>
                                            <i class="ri ri-share-forward-line"></i></button>
                                            @endif
                                            @if($rendez_vous->etat==3)
                                            <button class="btn btn-info btn-sm">
                                            <i class="bx bx-share-alt"></i></button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>


                        <div class="tab-pane fade" id="facturation" role="tabpanel" aria-labelledby="facturation-tab">

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
                                                <button class="btn btn-success btn-sm">
                                                    <i class="bi bi-wallet2"></i></button>
                                            </a>
                                            @endif
                                            @if($facturation->etat==1)
                                            <button class="btn btn-light btn-sm">
                                                <i class="ri ri-file-earmark-text"></i></button>
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
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            SALLE EN ATTENTE
                        </div>
                    </div><!-- End Default Tabs -->

                </div>
            </div>
        </div>
    </section>

</main>
<!-- End #main -->
