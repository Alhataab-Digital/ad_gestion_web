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
                    <!-- Default Tabs -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                        <li class="nav-item" role="consultation">
                            <button class="nav-link active" id="consultation-tab" data-bs-toggle="tab" data-bs-target="#consultation"
                                type="button" role="tab" aria-controls="consultation" aria-selected="false">CONSULTATION
                                <span class="badge bg-danger badge-number"></span></button>
                        </li>
                        <li class="nav-item" role="facturation">
                            <button class="nav-link" id="facturation-tab" data-bs-toggle="tab"
                                data-bs-target="#facturation" type="button" role="tab" aria-controls="facturation"
                                aria-selected="false">FACTURE EN COURS <span
                                    class="badge bg-danger badge-number">{{$fac_en_cours}}</span></button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                type="button" role="tab" aria-controls="contact" aria-selected="false">SALLE
                                D'ATTENTE
                                <span class="badge bg-danger badge-number">{{$cons_en_attente}}</span>
                            </button>
                        </li>
                    </ul>
                    <div class="pt-2 tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="consultation" role="tabpanel" aria-labelledby="consultation-tab">
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead class="text-white bg-primary">
                                    <tr>
                                        <th scope="col">Dossier</th>
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
                                        <td>{{ $consultation->patient->numero_patient}}</td>
                                        <td>{{ $consultation->patient->nom}} {{ $consultation->patient->prenom}}</td>
                                        <td>{{ \Carbon\Carbon::parse($consultation->created_at)->format('d-m-Y')}}</td>
                                        <td>{{ $consultation->type_consultation->type_consultation}}</td>
                                        <td>{{ $consultation->rendez_vous->motif}}</td>
                                        <td>{{ $consultation->medecin->prenom.' '.$consultation->medecin->nom}}</td>
                                        <td>
                                            @if($consultation->etat==0)
                                            <span class="badge bg-secondary">en instance</span>
                                            @endif
                                            @if($consultation->etat==1)
                                            <span class="badge bg-danger">facturé</span>
                                            @endif
                                            @if($consultation->etat==2)
                                            <span class="badge bg-success">payer</span>
                                            @endif
                                            @if($consultation->etat==3)
                                            <span class="badge bg-info">en attente</span>
                                            @endif
                                            @if($consultation->etat==4)
                                            <span class="badge bg-info">en cours</span>
                                            @endif
                                            @if($consultation->etat==5)
                                            <span class="badge bg-warning">terminer</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- <a href="" > <button type="button" class="btn btn-primary btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            </a> --}}
                                            @if($consultation->etat==0)
                                            <button class="btn btn-info btn-sm"
                                                        wire:click='facturerConsultation({{$consultation->id}})'>
                                                        <i class="ri ri-bank-card-2-line"></i></button>
                                            {{-- <button class="btn btn-warning btn-sm" '>
                                                <i class="bx bxs-hide"></i></button> --}}
                                            @endif
                                            @if($consultation->etat==1)
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="bx bxs-hide"></i></button>
                                            @endif
                                            @if($consultation->etat==2)
                                                <button class="btn btn-success btn-sm"
                                                    wire:click='IntroduireSalleAttente({{$consultation->id}})'>
                                                    <i class="ri ri-share-forward-line"></i>
                                                </button>
                                            @endif
                                            @if($consultation->etat==3)
                                                <button class="btn btn-ligth btn-sm">
                                                    <i class="bx bxs-hide"></i></button>
                                            @endif
                                            @if($consultation->etat==4)
                                                <button class="btn btn-default btn-sm">
                                                    <i class="bx bxs-hide"></i></button>
                                            @endif
                                            @if($consultation->etat==5)
                                                <a href="{{route('ad.sante.resultat.consultation',encrypt($consultation->id))}}">
                                                <button class="btn btn-dark btn-sm">
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
                       <div class="tab-pane fade" id="facturation" role="tabpanel" aria-labelledby="facturation-tab">

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead class="text-white bg-primary">
                                    <tr>
                                        <th scope="col">N° FAC</th>
                                        <th scope="col">Patient</th>
                                        <th scope="col">date </th>
                                        <th scope="col">numero ordre</th>
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
                                        <td>{{$facturation->numero_piece}}
                                        </td>
                                        {{-- <td>{{
                                            \Carbon\Carbon::parse($facturation->created_at)->format('dmy').''.$facturation->id}}
                                        </td> --}}
                                        <td>{{ $facturation->patient->nom}} {{ $facturation->patient->prenom}}</td>
                                        <td>{{ \Carbon\Carbon::parse($facturation->created_at)->format('d-m-Y')}}</td>
                                        <td>{{
                                            $facturation->numero_ordre}}
                                        </td>

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
                                            <button class="btn btn-danger btn-sm">
                                                <i class="bx bxs-hide"></i></button>
                                            @endif
                                            @if($facturation->etat==1)
                                            <a href="{{route('ad.sante.recu.consultation',encrypt($facturation->id))}}">
                                                <button class="btn btn-light btn-sm">
                                                    <i class="ri ri-file-earmark-text"></i></button>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        </div>

                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead class="text-white bg-primary">
                                    <tr>
                                        <th scope="col">Numero ordre</th>
                                        <th scope="col">Patient</th>
                                        <th scope="col">Date prevus</th>
                                        <th scope="col">Numero ordre</th>
                                        <th scope="col">motif rendez-vous</th>
                                        <th scope="col">Medecin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cons_en_attentes as $consultation )
                                    <tr>
                                        <td>{{ $consultation->numero_ordre}}</td>
                                        <td>{{ $consultation->patient->nom}} {{ $consultation->patient->prenom}}</td>
                                        <td>{{
                                            \Carbon\Carbon::parse($consultation->rendez_vous->date_rdv)->format('d-m-Y')}}
                                        </td>
                                        <td>{{
                                            $consultation->rendez_vous->planification->type_consultation->type_consultation}}
                                        </td>

                                        <td>{{ $consultation->rendez_vous->motif}}</td>
                                        <td>{{ $consultation->medecin->prenom.' '.$consultation->medecin->nom}}</td>


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
