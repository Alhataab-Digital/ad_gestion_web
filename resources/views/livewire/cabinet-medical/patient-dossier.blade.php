<div>
    <main id="main" class="main">

        <div class="pagetitle">
            {{-- <h1>DOSSIER PATIENT</h1>
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
                        <div class="text-white card-header bg-secondary">
                            <li class="text-white list-group-item d-flex justify-content-between align-items-center">
                                  <h5> Dossier n° <strong>{{$patient->numero_patient}}</strong>  de  <strong>{{$patient->prenom.' '.$patient->nom.' '.(\Carbon\Carbon::parse($patient->date_naissance)->age.' ans' )}}</strong></h5>
                                <span class=" bg-secondary rounded-pill">
                                    {{-- <a wire:navigate href="{{route('ad.sante.index.patient')}}">
                                        <button class="btn btn-primary "><i class="bi bi-receipt"></i></button>
                                    </a> --}}
                                    <a href="{{route('ad.sante.edit.patient',encrypt($patient->id))}}">
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
                        <div class="card-header ">
                            IDENTITE DU PATIENT
                        </div>

                        <div class="card-body">

                            <!-- Multi Columns Form -->
                            <form class="row g-3">
                                <div class="text-white col-md-6 bg-secondary">
                                    Nom Prenom :
                                </div>
                                <div class="col-md-6">
                                    {{$patient->civilite->civilite}} {{$patient->nom.' '.$patient->prenom}}
                                </div>
                                <div class="text-white col-md-6 bg-secondary">
                                    Situation matrimoniale
                                 </div>
                                <div class="col-md-6">
                                    {{$patient->situation->situation_matrimoniale}}

                                </div>
                                <div class="text-white col-md-6 bg-secondary">
                                    Date de naissance
                                  </div>
                                  <div class="col-md-6">
                                      {{ \Carbon\Carbon::parse($patient->date_naissance)->format('d-m-Y')}}
                                  </div>
                                  <div class="text-white col-md-6 bg-secondary">
                                    Lieu de naissance
                                  </div>
                                  <div class="col-md-6">
                                      {{ $patient->lieu_naissance}}
                                  </div>
                                  <div class="text-white col-md-6 bg-secondary">
                                   Profession
                                  </div>
                                  <div class="col-md-6">
                                      {{ $patient->profession}}
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
                            COORDONNES DU PATIENT
                        </div>

                        <div class="card-body">

                            <!-- Multi Columns Form -->
                            <form class="row g-3">

                                <div class="text-white col-6 bg-secondary">
                                    Telephone
                                </div>
                                <div class="col-6">
                                   {{$patient->telephone}}
                                </div>
                                <div class="text-white col-6 bg-secondary">
                                    Adresse
                                </div>
                                <div class="col-md-6">
                                    {{$patient->adresse}}
                                </div>
                                <div class="text-white col-6 bg-secondary">
                                    Complement adresse
                                </div>
                                <div class="col-md-6">
                                    {{$patient->complement_adresse}}
                                </div>
                                <div class="text-white col-6 bg-secondary">
                                    Email
                                </div>
                                <div class="col-md-6">
                                    {{$patient->mail}}
                                </div>
                                <div class="text-white col-6 bg-secondary">
                                    Personne à contacter
                                </div>
                                <div class="col-md-6">
                                    {{$patient->personne_contact}}
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
                            INFORMATION MEDICALE DU PATIENT
                        </div>

                        <div class="card-body">

                            <!-- Multi Columns Form -->
                            <form class="row g-3">
                                <div class="text-white col-md-6 bg-secondary">
                                    N° Dossier Patient
                               </div>
                                <div class="col-md-6 ">
                                 {{$patient->numero_patient}}
                                </div>
                                <div class="text-white col-md-6 bg-secondary">
                                 Groupe Sanguin
                                </div>
                                <div class="col-md-6">
                                    {{$patient->groupe_sanguin}}
                                </div>
                                <div class="text-white col-md-6 bg-secondary">
                                    poid
                                   </div>
                                   <div class="col-md-6">
                                       {{$patient->poid}} kg
                                   </div>
                                   <div class="text-white col-md-6 bg-secondary">
                                    taille
                                   </div>
                                   <div class="col-md-6">
                                       {{$patient->taille}} m
                                   </div>
                                   <div class="text-white col-md-6 bg-secondary">
                                    Icm (Kg/m²)
                                   </div>
                                   <div class="col-md-6">
                                       @php
                                       if($patient->taille!=null && $patient->poid!=null){
                                            $icm=round( ($patient->poid)/($patient->taille*$patient->taille));
                                                if($icm<16.5){
                                                 echo  $icm.' (Maigreur extrême – dénutrition)';
                                                }else
                                                if(16.5<$icm && $icm<18.5){
                                                    echo    $icm.' (Maigreur)';
                                                }else
                                                if(18.5<$icm && $icm<25){
                                                    echo  $icm.' (Corpulence normale)';
                                                }else
                                                if(25<$icm && $icm<30){
                                                    echo $icm.' (Surpoids ou pré-obésité)';
                                                }else
                                                if(30<$icm && $icm<35){
                                                    echo $icm.' (Obésité modérée (classe I))';
                                                }else
                                                if(35<$icm && $icm<40){
                                                    echo  $icm.' (Obésité sévère (classe II))';
                                                }else
                                                if(40<$icm){
                                                    echo  $icm.' (Obésité morbide (classe III))';
                                                }
                                            }
                                       @endphp
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
                            <li class="nav-item" role="synthese">
                                <button class="nav-link active" id="synthese-tab" data-bs-toggle="tab" data-bs-target="#synthese" type="button" role="tab" aria-controls="synthese" aria-selected="true">
                                  Synthese
                              </button>
                            </li>
                            <li class="nav-item" role="rendez-vous">
                                <button class="nav-link " id="rendez-vous-tab" data-bs-toggle="tab" data-bs-target="#rendez-vous" type="button" role="tab" aria-controls="rendez-vous" aria-selected="true">
                                  Rendez-vous
                              </button>
                              </li>
                            <li class="nav-item" role="hospitalisation">
                                <button class="nav-link" id="consultation-tab" data-bs-toggle="tab" data-bs-target="#consultation" type="button" role="tab" aria-controls="consultation" aria-selected="false">
                                    Consultation
                                </button>
                              </li>
                              <li class="nav-item" role="hospitalisation">
                                <button class="nav-link" id="hospitalisation-tab" data-bs-toggle="tab" data-bs-target="#hospitalisation" type="button" role="tab" aria-controls="hospitalisation" aria-selected="false">
                                    Hospitalisation
                                </button>
                              </li>
                              <li class="nav-item" role="soins">
                                <button class="nav-link" id="soins-tab" data-bs-toggle="tab" data-bs-target="#soins" type="button" role="tab" aria-controls="soins" aria-selected="false">
                                    Soins
                                </button>
                              </li>
                              <li class="nav-item" role="caisse">
                                <button class="nav-link" id="examen-tab" data-bs-toggle="tab" data-bs-target="#examen" type="button" role="tab" aria-controls="examen" aria-selected="false">
                                    Examen
                                </button>
                              </li>
                              <li class="nav-item" role="document">
                                <button class="nav-link" id="document-tab" data-bs-toggle="tab" data-bs-target="#document" type="button" role="tab" aria-controls="document" aria-selected="false">
                                  Documents
                              </button>
                              </li>
                              <li class="nav-item" role="presentation">
                                <button class="nav-link" id="antecedent-tab" data-bs-toggle="tab" data-bs-target="#antecedent" type="button" role="tab" aria-controls="antecedent" aria-selected="false">
                                Antecedent
                              </button>
                              </li>
                          </ul>
                          <div class="pt-2 tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="synthese" role="tabpanel" aria-labelledby="synthese-tab">
                                <div class="card">
                                    <div class="card-header">
                                        CONSULTATION
                                    </div>

                                    <div class="card-body">
                                        {{-- <h5 class="card-title">Card with header and footer</h5> --}}
                                        <table class="table ">
                                            <thead>
                                                <tr  class="text-white bg-secondary">
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Realiser par</th>
                                                    <th scope="col">Motif</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($consultations as $consultation )
                                                <tr>
                                                    <td>{{$consultation->created_at->diffForHumans()}}</td>
                                                    <td scope="row">{{$consultation->tarif_consultation->type_consultation->type_consultation}}</td>
                                                    <td scope="row">{{$consultation->medecin->nom.' '.$consultation->medecin->prenom}}</td>
                                                    <td scope="row">{{$consultation->rendez_vous->motif}}</td>
                                                    {{-- <td style="text-align:right">{{ number_format($consultation->montant,2,","," ").'
                                                        '.$consultation->user->agence->devise->unite}}</td> --}}
                                                    <td>
                                                        @if($consultation->etat==1)
                                                        <span class="badge bg-danger">en cours</span>
                                                        @endif
                                                        @if($consultation->etat==2)
                                                        <span class="badge bg-success">terminer</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div><!-- End Card with header and footer -->
                                <div class="card">
                                    <div class="card-header">
                                       EXAMENS
                                    </div>

                                    <div class="card-body">
                                        {{-- <h5 class="card-title">Card with header and footer</h5> --}}
                                        <table class="table">
                                            <thead>
                                                <tr  class="text-white bg-secondary">
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Prescris par</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Libelle</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($examens as $examen )
                                                <tr>
                                                    <td> {{$examen->created_at}} </td>
                                                    <td> {{$examen->medecin->nom.'
                                                        '.$examen->medecin->prenom}} </td>
                                                    <td> {{$examen->type_examen->type_examen}} </td>
                                                    <td> {{$examen->libelle}} </td>
                                                    <td> {{$examen->resultat}} </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div><!-- End Card with header and footer -->
                                <div class="card">
                                    <div class="card-header">
                                        ANTECEDENT PERSONNEL ET FAMILLIAUX
                                    </div>

                                    <div class="card-body">
                                        {{-- <h5 class="card-title">Card with header and footer</h5> --}}
                                        <table class="table ">
                                            <thead>
                                                <tr class="text-white bg-secondary">
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Libelle</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>

                                </div><!-- End Card with header and footer -->
                                <div class="card">
                                    <div class="card-header">
                                       ALLERGIES
                                    </div>

                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr class="text-white bg-secondary">
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Libelle</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>

                                </div><!-- End Card with header and footer -->
                                <div class="card">
                                    <div class="card-header">
                                        VACCIN
                                    </div>
                                        <div class="card-body">
                                            <table class="table ">
                                                <thead>
                                                    <tr class="text-white bg-secondary">
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Nom du vaccin</th>
                                                        <th scope="col">prevention contre</th>
                                                        <th scope="col">Rappel</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        SOINS
                                    </div>
                                        <div class="card-body">
                                            <table class="table">
                                                <thead>
                                                    <tr class="text-white bg-secondary">
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Realiser pas</th>
                                                        <th scope="col">Categorie</th>
                                                        <th scope="col">libelle</th>
                                                    </tr>
                                                </thead>
                                                @foreach ($soins as $soin )
                                                <tr>
                                                    <td> {{$soin->created_at}} </td>
                                                    <td> {{$soin->medecin->nom.'
                                                        '.$soin->medecin->prenom}} </td>
                                                    <td> {{$soin->type_soins->type_soins}} </td>
                                                    <td> {{$soin->libelle}} </td>
                                                    {{-- <td> {{$soin->observation}} </td> --}}
                                                </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        PRESCRIPTION
                                    </div>
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr class="text-white bg-secondary">
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Prescrit par</th>
                                                    <th scope="col">Libelle</th>
                                                    <th scope="col">Posologie</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($prescriptions as $prescription )
                                                <tr>
                                                    <td> {{$prescription->created_at}} </td>
                                                    <td> {{$prescription->medecin->nom.' '.$prescription->medecin->prenom}} </td>
                                                    <td> {{$prescription->medicament->denomination}} </td>
                                                    {{-- <td> {{$prescription->medicament->voies_administrative}} </td>
                                                    <td> {{$prescription->quantite}} </td> --}}
                                                    <td> {{$prescription->posologie}} </td>
                                                    {{-- <td> {{$prescription->duree}} </td> --}}
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <!-- End Card with header and footer -->
                                 <!-- Card with header and footer -->
                                <div class="card">
                                    <div class="card-header">
                                       AFFECTION LONGUES DUREES
                                    </div>
                                    <div class="card-body">
                                        {{-- <h5 class="card-title">Card with header and footer</h5> --}}
                                        <table class="table">
                                            <thead>
                                                <tr  class="text-white bg-secondary">
                                                    <th scope="col">date</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Libelle</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($facturations as $facturation )
                                                <tr>
                                                </tr>

                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- End Card with header and footer -->
                                <div class="card">
                                    <div class="card-header">
                                        ADDICTIONS
                                    </div>
                                        <div class="card-body">
                                            <table class="table ">
                                                <thead>
                                                    <tr  class="text-white bg-secondary">
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Type</th>
                                                        <th scope="col">Libelle</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        PRISE EN CHARGE
                                    </div>
                                    <div class="card-body">
                                        {{-- <h5 class="card-title">Card with header and footer</h5> --}}
                                        <table class="table ">
                                            <thead>
                                                <tr class="text-white bg-secondary">
                                                    <th scope="col">Maison assurance</th>
                                                    <th scope="col">categorie prise en charge</th>
                                                    <th scope="col">Debut validité</th>
                                                    <th scope="col">Fin validité</th>
                                                    <th scope="col">Prise en charge</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($contrat_assurances as $contrat_assurance )
                                                <tr>
                                                    <td>{{$contrat_assurance->maison_assurance->maison_assurance}}</td>
                                                    {{-- <td>{{$contrat_assurance->id}}</td> --}}
                                                    <td>{{$contrat_assurance->tarif_consultation->type_consultation->type_consultation}}</td>
                                                    <td>{{$contrat_assurance->date_debut}}</td>
                                                    <td>{{$contrat_assurance->date_fin}}</td>
                                                    <td style="text-align:center" >{{$contrat_assurance->taux_couverture.' %'}}</td>
                                                    {{-- <td style="text-align:right">{{ number_format($contrat_assurance->tarif_consultation->montant,2,","," ").'
                                                        '.$contrat_assurance->user->agence->devise->unite}}</td> --}}
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- End Card with header and footer -->
                            </div>
                            <div class="tab-pane fade" id="rendez-vous" role="tabpanel" aria-labelledby="rendez-vous-tab">
                              <!-- Table with stripped rows -->
                              <table class="table datatable">
                                <thead class="text-white bg-secondary">
                                    <tr>
                                        <!-- <th scope="col">#</th> -->
                                        {{-- <th scope="col">Patient</th> --}}
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
                                        {{-- <td>{{ $rendez_vous->patient->nom}} {{ $rendez_vous->patient->prenom}}</td> --}}
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
                              <div class="tab-pane fade" id="consultation" role="tabpanel" aria-labelledby="consultation-tab">
                                <div class="card-body">
                                    {{-- <h5 class="card-title">Card with header and footer</h5> --}}
                                    <table class="table ">
                                        <thead>
                                            <tr  class="text-white bg-secondary">
                                                <th scope="col">Date</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Realiser par</th>
                                                <th scope="col">Motif</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($consutlation_traitement as $consultation )
                                            <tr>
                                                <td>{{$consultation->created_at->diffForHumans()}}</td>
                                                <td scope="row">{{$consultation->tarif_consultation->type_consultation->type_consultation}}</td>

                                                <td scope="row">{{$consultation->medecin->nom.' '.$consultation->medecin->prenom}}</td>
                                                <td scope="row">{{$consultation->rendez_vous->motif}}</te>
                                                {{-- <td style="text-align:right">{{ number_format($consultation->montant,2,","," ").'
                                                    '.$consultation->user->agence->devise->unite}}</td> --}}
                                                <td>
                                                    @if($consultation->etat==1)
                                                    <span class="badge bg-danger">en cours</span>
                                                    @endif
                                                    @if($consultation->etat==2)
                                                    <span class="badge bg-success">terminer</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($consultation->etat==1)
                                                    <a href="{{route('ad.sante.traitement.consultation',encrypt($consultation->id))}}">
                                                        <button class="btn btn-dark btn-sm" > <i class="ri ri-user-unfollow-line"></i> </button>
                                                    </a>
                                                    @endif
                                                    @if($consultation->etat==2)
                                                    <a href="{{route('ad.sante.resultat.consultation',encrypt($consultation->id))}}">
                                                                <button class="btn btn-warning btn-sm" > <i class="ri ri-spam-line"></i> </button>
                                                            </a>
                                                    {{-- <div class="filter">
                                                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                          <li class="dropdown-header text-start">
                                                            <h6>Filter</h6>
                                                          </li>

                                                          <li><a class="dropdown-item" href="{{route('ad.sante.resultat.consultation',encrypt($consultation->id))}}"><button class="btn btn-ligth btn-sm"> Detail</button></a></li>
                                                            <li><button class="dropdown-item btn btn-ligth btn-sm"  wire:click='recuPrint({{$consultation->id}})'>Ordonnance</button></li>
                                                          <li><a class="dropdown-item" href="#">Examen</a></li>
                                                          <li><a class="dropdown-item" href="#">Soins</a></li>
                                                        </ul>
                                                    </div> --}}
                                                    @endif

                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                              </div>
                              <div class="tab-pane fade" id="hospitalisation" role="tabpanel" aria-labelledby="hospitalisation-tab">
                                Hospitalisation
                            </div>
                            <div class="tab-pane fade" id="soins" role="tabpanel" aria-labelledby="soins-tab">
                              Soins
                            </div>
                            <div class="tab-pane fade" id="examen" role="tabpanel" aria-labelledby="examen-tab">
                                Examen
                            </div>
                            <div class="tab-pane fade" id="document" role="tabpanel" aria-labelledby="document-tab">
                                document
                            </div>
                            <div class="tab-pane fade" id="antecedent" role="tabpanel" aria-labelledby="antecedent-tab">

                                <div class="card">
                                    <div class="card-header bg-secondary">

                                    </div>
                                    <div class="card-body">

                                      <!-- Accordion without outline borders -->
                                      <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                          <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                Antécédents personnels et médicaux familiaux
                                            </button>
                                          </h2>
                                          <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                    <!-- Default Table -->
                                                <table class="table">
                                                    <thead class="text-white bg-primary">
                                                    <tr>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Type</th>
                                                        <th scope="col">Libelle</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>

                                                        <td>2016-05-25</td>
                                                        <td>Brandon Jacob</td>
                                                        <td>Designer</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <!-- End Default Table Example -->
                                            </div>
                                          </div>
                                        </div>
                                        <div class="accordion-item">
                                          <h2 class="accordion-header" id="flush-headingThree">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                              Affection
                                            </button>
                                          </h2>
                                          <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                                          </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingAllergie">
                                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseAllergie" aria-expanded="false" aria-controls="flush-collapseThree">
                                                Allergie
                                              </button>
                                            </h2>
                                            <div id="flush-collapseAllergie" class="accordion-collapse collapse" aria-labelledby="flush-headingAllergie" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    Contenus allergie
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingAddiction">
                                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseAddiction" aria-expanded="false" aria-controls="flush-collapseThree">
                                                Addiction
                                              </button>
                                            </h2>
                                            <div id="flush-collapseAddiction" class="accordion-collapse collapse" aria-labelledby="flush-headingAddiction" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    Contenu addiction
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingVaccin">
                                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseVaccin" aria-expanded="false" aria-controls="flush-collapseThree">
                                                Vaccin
                                              </button>
                                            </h2>
                                            <div id="flush-collapseVaccin" class="accordion-collapse collapse" aria-labelledby="flush-headingVaccin" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    contenu vaccin
                                                </div>
                                            </div>
                                        </div>
                                      </div><!-- End Accordion without outline borders -->

                                    </div>
                                  </div>
                          </div><!-- End Default Tabs -->

                        </div>
                      </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
</div>
