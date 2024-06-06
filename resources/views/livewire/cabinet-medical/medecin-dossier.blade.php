<div>
    <main id="main" class="main">

        <div class="pagetitle">
            {{-- <h1>DOSSIER medecin</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Components</li>
                    <li class="breadcrumb-item active">Tabs</li>
                </ol>
            </nav> --}}
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-secondary text-white">
                            <li class="list-group-item d-flex justify-content-between align-items-center text-white">
                               <h5>Espace de travail de  <strong>  {{$medecin->civilite->civilite.' '.$medecin->prenom.' '.$medecin->nom}} : {{$medecin->titre}} </strong></h5>
                                <span class=" bg-secondary rounded-pill">
                                    <a wire:navigate href="{{route('ad.sante.index.medecin')}}">
                                        <button class="btn btn-primary "><i class="bi bi-receipt"></i></button>
                                    </a>
                                    <a href="{{route('ad.sante.edit.medecin',encrypt($medecin->id))}}">
                                    <button class="btn btn-info"><i class="bi bi-pencil"></i></button>
                                    </a>
                                </span>
                              </li>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Card with header and footer -->
                    <div class="card">
                        <div class="card-header">
                            IDENTITE
                        </div>
                        <div class="card-body">

                            <!-- Multi Columns Form -->
                            <form class="row g-3">
                                <div class="col-md-6 bg-secondary text-white">
                                    Nom Prénom
                               </div>
                                <div class="col-md-6 ">
                                 {{$medecin->civilite->civilite.' '.$medecin->nom.' '.$medecin->prenom}}
                                </div>
                                <div class="col-md-6 bg-secondary text-white">
                                    Date naissance
                                </div>
                                <div class="col-md-6 ">
                                    {{ \Carbon\Carbon::parse($medecin->date_naissance)->format('d-m-Y')}}
                                </div>
                                <div class="col-md-6 bg-secondary text-white">
                                    Lieu de naissance
                               </div>
                                <div class="col-md-6 ">
                                 {{$medecin->lieu_naissance}}
                                </div>
                                <div class="col-md-6 bg-secondary text-white">
                                    Situation matrimoniale
                               </div>
                                <div class="col-md-6 ">
                                 {{$medecin->situation->situation_matrimoniale}}
                                </div>
                            </form>
                            <!-- End Multi Columns Form -->
                        </div>
                    </div><!-- End Card with header and footer -->
                    <!-- Card with header and footer -->

                </div>
                <div class="col-lg-4">
                    <!-- Card with header and footer -->
                    <div class="card">
                        <div class="card-header ">
                            COORDONNES

                        </div>

                        <div class="card-body">

                            <!-- Multi Columns Form -->
                            <form class="row g-3">

                                <div class="col-md-6 bg-secondary text-white">
                                    Téléphone
                               </div>
                                <div class="col-md-6 ">
                                 {{$medecin->telephone}}
                                </div>
                                <div class="col-md-6 bg-secondary text-white">
                                    Adresse
                               </div>
                                <div class="col-md-6 ">
                                 {{$medecin->adresse}}
                                </div>
                                <div class="col-md-6 bg-secondary text-white">
                                    Complement adresse
                               </div>
                                <div class="col-md-6 ">
                                 {{$medecin->complement_adresse}}
                                </div>
                                <div class="col-md-6 bg-secondary text-white">
                                    Email
                               </div>
                                <div class="col-md-6 ">
                                 {{$medecin->mail}}
                                </div>
                            </form><!-- End Multi Columns Form -->
                        </div>
                    </div><!-- End Card with header and footer -->
                    <!-- Card with header and footer -->
                </div>
                <div class="col-lg-4">
                    <!-- Card with header and footer -->
                    <div class="card">
                        <div class="card-header ">
                            INFORMATION PROFESSIONNEL
                        </div>
                        <div class="card-body">
                            <!-- Multi Columns Form -->
                            <form class="row g-3">
                                <div class="col-md-6 bg-secondary text-white">
                                    Matricule
                               </div>
                                <div class="col-md-6 ">
                                 {{$medecin->matricule}}
                                </div>
                                <div class="col-md-6 bg-secondary text-white">
                                    Categorie
                               </div>
                                <div class="col-md-6 ">
                                 {{$medecin->categorie->categorie_medecin}}
                                </div>
                                <div class="col-md-6 bg-secondary text-white">
                                    Specialité
                               </div>
                                <div class="col-md-6 ">
                                 {{$medecin->specialite->specialite_medecin}}
                                </div>
                                <div class="col-md-6 bg-secondary text-white">
                                    Titre
                               </div>
                                <div class="col-md-6 ">
                                 {{$medecin->titre}}
                                </div>

                            </form><!-- End Multi Columns Form -->
                        </div>

                    </div><!-- End Card with header and footer -->
                    <!-- Card with header and footer -->

                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                          <!-- Default Tabs -->
                          <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="consultation-tab" data-bs-toggle="tab" data-bs-target="#consultation" type="button" role="tab" aria-controls="consultation" aria-selected="true">
                                Consultation
                            </button>
                            </li>
                            <li class="nav-item" role="hospitalisation">
                                <button class="nav-link" id="hospitalisation-tab" data-bs-toggle="tab" data-bs-target="#hospitalisation" type="button" role="tab" aria-controls="hospitalisation" aria-selected="false">
                                    Hospitalisation
                                </button>
                              </li>
                              <li class="nav-item" role="hospitalisation">
                                <button class="nav-link" id="soins-tab" data-bs-toggle="tab" data-bs-target="#soins" type="button" role="tab" aria-controls="soins" aria-selected="false">
                                    Soins
                                </button>
                              </li>
                              <li class="nav-item" role="agenda">
                                <button class="nav-link" id="agenda-tab" data-bs-toggle="tab" data-bs-target="#agenda" type="button" role="tab" aria-controls="agenda" aria-selected="false">
                                    Agenda
                                </button>
                              </li>
                              <li class="nav-item" role="presentation">
                                <button class="nav-link" id="rdv-tab" data-bs-toggle="tab" data-bs-target="#rdv" type="button" role="tab" aria-controls="rdv" aria-selected="false">
                                Rendez-vous
                                <span class="badge bg-danger badge-number">{{$nbr_rdv}}</span>
                              </button>
                              </li>
                              <li class="nav-item" role="presentation">
                                <button class="nav-link" id="attente-tab" data-bs-toggle="tab" data-bs-target="#attente" type="button" role="tab" aria-controls="attente" aria-selected="false">
                               Salle d'attente
                               <span class="badge bg-danger badge-number">{{$nbr_consultation_attente}}</span>
                              </button>
                              </li>
                              <li class="nav-item" role="presentation">
                                <button class="nav-link" id="acte-tab" data-bs-toggle="tab" data-bs-target="#acte" type="button" role="tab" aria-controls="acte" aria-selected="false">
                                 Autorisation
                              </button>
                              </li>
                          </ul>
                            <div class="tab-content pt-2" id="myTabContent">
                                <div class="tab-pane fade show active" id="consultation" role="tabpanel" aria-labelledby="consultation-tab">
                                    <!-- Table with stripped rows -->
                                    <table class="table">
                                        <thead class="bg-secondary text-white">
                                            <tr>
                                                <!-- <th scope="col">#</th> -->
                                                <th scope="col">Patient</th>
                                                <th scope="col">Date prevus</th>
                                                <th scope="col">Type de rendez-vous</th>
                                                <th scope="col">motif rendez-vous</th>
                                                <th scope="col">Medecin</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($consultation_en_cours as $consultation_en_cour )
                                        <tr>
                                            <td>{{ $consultation_en_cour->patient->nom}} {{ $consultation_en_cour->patient->prenom}}</td>
                                            <td>{{ \Carbon\Carbon::parse($consultation_en_cour->rendez_vous->date_rdv)->format('d-m-Y')}}</td>
                                            <td>{{
                                                $consultation_en_cour->rendez_vous->planification->tarif_consultation->type_consultation->type_consultation}}
                                            </td>

                                            <td>{{ $consultation_en_cour->rendez_vous->motif}}</td>
                                            <td>{{ $consultation_en_cour->medecin->prenom.' '.$consultation_en_cour->medecin->nom}}</td>

                                            <td>
                                                @if($consultation_en_cour->etat==0)
                                                <span class="badge bg-secondary"> attente</span>
                                                @endif
                                                @if($consultation_en_cour->etat==1)
                                                <span class="badge bg-danger">en cours</span>
                                                @endif
                                                @if($consultation_en_cour->etat==2)
                                                <span class="badge bg-success">Terminer</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{-- <a href=""> <button type="button" class="btn btn-primary btn-sm">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                </a> --}}
                                                @if($consultation_en_cour->etat==0)
                                                <button type="button" class="btn btn-dark btn-sm" wire:click='AppelPatient({{$consultation_en_cour->id}})'><i class="ri ri-user-unfollow-line"></i></button>
                                                @endif
                                                @if($consultation_en_cour->etat==1)
                                                <a wire:navigate href="{{route('ad.sante.dossier.patient',encrypt($consultation_en_cour->patient->id))}}">
                                                    <button class="btn btn-dark btn-sm">
                                                        <i class="ri ri-user-unfollow-line"></i>
                                                        </button>
                                                </a>

                                                @endif
                                                @if($consultation_en_cour->etat==2)
                                                <a href="{{route('ad.sante.resultat.consultation',encrypt($consultation_en_cour->id))}}">
                                                    <button class="btn btn-secondary btn-sm" > <i class="bx bx-printer"></i> </button>
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
                            <!-- End Default Tabs -->
                            <div class="tab-content pt-2" id="myTabContent">
                                <div class="tab-pane fade " id="agenda" role="tabpanel" aria-labelledby="agenda-tab">

                                    <!-- Table with stripped rows -->
                                    <table class="table datatable">
                                        <thead class="bg-secondary text-white">
                                            <tr>
                                                <th scope="col">Consultation</th>
                                                <th scope="col">Date </th>
                                                <th scope="col">Heure debut</th>
                                                <th scope="col">Heure de fin</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($planifications as $planification )
                                            <tr>
                                                <td>{{
                                                $planification->tarif_consultation->type_consultation->type_consultation}}
                                            </td>
                                                <td>{{ \Carbon\Carbon::parse($planification->jour_semaine)->format('d-m-Y')}}</td>
                                                <td>{{ \Carbon\Carbon::parse($planification->heure_debut)->format('H:s')}}</td>
                                                <td>{{ \Carbon\Carbon::parse($planification->heure_fin)->format('H:s')}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- End Table with stripped rows -->
                                </div>
                            </div>
                            <!-- End Default Tabs -->
                            <div class="tab-content pt-2" id="myTabContent">
                                <div class="tab-pane fade" id="hospitalisation" role="tabpanel" aria-labelledby="hospitalisation-tab">
                                       <!-- Table with stripped rows -->
                                    <table class="table datatable">
                                        <thead class="bg-secondary text-white">
                                            <tr>
                                                <!-- <th scope="col">#</th> -->
                                                <th scope="col">Patient</th>
                                                <th scope="col">Date prevus</th>
                                                <th scope="col">Type consultation</th>
                                                <th scope="col">motif rendez-vous</th>
                                                <th scope="col">Medecin</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <!-- End Table with stripped rows -->
                                </div>
                            </div>
                            <!-- End Default Tabs -->
                            <div class="tab-content pt-2" id="myTabContent">
                                <div class="tab-pane fade" id="soins" role="tabpanel" aria-labelledby="soins-tab">
                                    <!-- Table with stripped rows -->
                                    <table class="table datatable">
                                        <thead class="bg-secondary text-white">
                                            <tr>
                                                <!-- <th scope="col">#</th> -->
                                                <th scope="col">Patient</th>
                                                <th scope="col">Date prevus</th>
                                                <th scope="col">Type consultation</th>
                                                <th scope="col">motif rendez-vous</th>
                                                <th scope="col">Medecin</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <tr>Soins</tr>
                                        </tbody>
                                    </table>
                                    <!-- End Table with stripped rows -->
                                </div>
                            </div>
                            <!-- End Default Tabs -->
                            <div class="tab-content pt-2" id="myTabContent">
                                <div class="tab-pane fade" id="rdv" role="tabpanel" aria-labelledby="rdv-tab">
                                    <!-- Table with stripped rows -->
                                    <table class="table datatable">
                                        <thead class="bg-secondary text-white">
                                            <tr>
                                                <!-- <th scope="col">#</th> -->
                                                <th scope="col">Patient</th>
                                                <th scope="col">Date prevus</th>
                                                <th scope="col">Heure rendez vous</th>
                                                <th scope="col">Type consultation</th>
                                                <th scope="col">motif rendez-vous</th>
                                                <th scope="col">Status</th>
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
                                                <td>
                                                    @if($rendez_vous->etat==0)
                                                    <span class="badge bg-info"> à venir</span>
                                                    @endif
                                                    @if($rendez_vous->etat==1)
                                                    <span class="badge bg-danger">Facturé</span>
                                                    @endif
                                                    @if($rendez_vous->etat==2)
                                                    <span class="badge bg-success">Payé</span>
                                                    @endif
                                                    @if($rendez_vous->etat==3)
                                                    <span class="badge bg-secondary">Pris</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- End Table with stripped rows -->
                                </div>
                            </div>
                            <!-- End Default Tabs -->
                            <div class="tab-content pt-2" id="myTabContent">
                                <div class="tab-pane fade" id="attente" role="tabpanel" aria-labelledby="attente-tab">
                                    <!-- Table with stripped rows -->
                                    <table class="table datatable">
                                        <thead class="bg-secondary text-white">
                                            <tr>
                                                <!-- <th scope="col">#</th> -->
                                                <th scope="col">Patient</th>
                                                <th scope="col">Date prevus</th>
                                                <th scope="col">Type consultation</th>
                                                <th scope="col">motif rendez-vous</th>
                                                <th scope="col">Medecin</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($consultations as $consultation )
                                            <tr>
                                                <td>{{ $consultation->patient->nom}} {{ $consultation->patient->prenom}}</td>
                                                <td>{{ \Carbon\Carbon::parse($consultation->rendez_vous->date_rdv)->format('d-m-Y')}}</td>
                                                <td>{{
                                                    $consultation->rendez_vous->planification->tarif_consultation->type_consultation->type_consultation}}
                                                </td>

                                                <td>{{ $consultation->rendez_vous->motif}}</td>
                                                <td>{{ $consultation->medecin->prenom.' '.$consultation->medecin->nom}}</td>

                                                <td>
                                                    @if($consultation->etat==0)
                                                    <span class="badge bg-secondary"> attente</span>
                                                    @endif
                                                    @if($consultation->etat==1)
                                                    <span class="badge bg-danger">en cours</span>
                                                    @endif
                                                    @if($consultation->etat==2)
                                                    <span class="badge bg-success">Terminer</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{-- <a href=""> <button type="button" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                    </a> --}}
                                                    @if($consultation->etat==0)
                                                    <button type="button" class="btn btn-dark btn-sm" wire:click='AppelPatient({{$consultation->id}})'><i class="ri ri-user-unfollow-line"></i></button>
                                                    @endif
                                                    @if($consultation->etat==1)
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="bx bxs-hide"></i></button>
                                                    @endif
                                                    @if($consultation->etat==2)
                                                    <button class="btn btn-secondary btn-sm">
                                                    <i class="bx bxs-hide"></i></button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- End Table with stripped rows -->
                                </div>
                            </div>
                            <!-- End Default Tabs -->

                        </div>
                      </div>
                </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
</div>
