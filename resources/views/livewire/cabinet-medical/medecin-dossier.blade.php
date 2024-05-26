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
                                INFORMATION GENERAL<strong>  <h2> {{$medecin->titre.' '.$medecin->prenom.' '.$medecin->nom}}</h2></strong>
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
                        <div class="card-header bg-secondary text-white ">
                            IDENTITE
                        </div>

                        <div class="card-body">

                            <!-- Multi Columns Form -->
                            <form class="row g-3">
                                <div class="col-md-2">
                                    <label for="inputName5" class="form-label">Civilité</label>
                                    <input type="text" class="form-control" wire:model='civilite' id="inputName5">

                                </div>
                                <div class="col-md-5">
                                    <label for="inputName5" class="form-label">Prenom</label>
                                    <input type="text" class="form-control" wire:model='prenom' id="inputName5">

                                </div>
                                <div class="col-md-5">
                                    <label for="inputName5" class="form-label">Nom du père</label>
                                    <input type="text" class="form-control" wire:model='nom' id="inputName5">

                                </div>


                                <div class="col-md-6">
                                    <label for="inputPassword5" class="form-label">Date naissance</label>
                                    <input type="date" class="form-control" wire:model='date_naissance' id="inputPassword5">

                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword5" class="form-label">Lieu naissance</label>
                                    <input type="text" class="form-control" wire:model='lieu_naissance' id="inputPassword5">

                                </div>
                                <div class="col-md-12">
                                    <label for="inputState" class="form-label">Situation</label>
                                    <input type="text" class="form-control" wire:model='situation' id="inputName5">

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
                        <div class="card-header bg-secondary text-white ">
                            COORDONNES

                        </div>

                        <div class="card-body">

                            <!-- Multi Columns Form -->
                            <form class="row g-3">

                                <div class="col-12">
                                    <label for="inputAddress5" class="form-label">Telephone</label>
                                    <input type="text" class="form-control" wire:model='telephone' id="inputAddres5s">
                                </div>
                                <div class="col-12">
                                    <label for="inputAddress2" class="form-label">Addresse</label>
                                    <input type="text" class="form-control" wire:model='adresse' id="inputAddress2">
                                </div>
                                <div class="col-md-12">
                                    <label for="inputEmail5" class="form-label">Email</label>
                                    <input type="email" class="form-control" wire:model='mail' id="inputEmail5">
                                </div>
                            </form><!-- End Multi Columns Form -->
                        </div>
                    </div><!-- End Card with header and footer -->
                    <!-- Card with header and footer -->
                </div>
                <div class="col-lg-4">
                    <!-- Card with header and footer -->
                    <div class="card">
                        <div class="card-header bg-secondary text-white ">
                            INFORMATION MEDICALE
                        </div>
                        <div class="card-body">
                            <!-- Multi Columns Form -->
                            <form class="row g-3">
                                <div class="col-md-12">
                                    <label for="inputCity" class="form-label">N° Matricule</label>
                                    <input type="text" wire:model='matricule' class="form-control" id="inputCity" disabled>
                                </div>
                                <div class="col-md-12">
                                    <label for="inputState" class="form-label">Titre</label>
                                    <input type="text" class="form-control" wire:model='titre' id="inputName5">

                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail5" class="form-label">Categorie</label>
                                    <input type="email" class="form-control" wire:model='categorie' id="inputEmail5">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword5" class="form-label">Specialité</label>
                                    <input type="text" class="form-control" wire:model='specialite' id="inputPassword5" disabled>
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
                                CONSULTATIONS
                            </button>
                            </li>
                            <li class="nav-item" role="hospitalisation">
                                <button class="nav-link" id="hospitalisation-tab" data-bs-toggle="tab" data-bs-target="#hospitalisation" type="button" role="tab" aria-controls="hospitalisation" aria-selected="false">
                                    HOSPITALISATION
                                </button>
                              </li>
                              <li class="nav-item" role="hospitalisation">
                                <button class="nav-link" id="soins-tab" data-bs-toggle="tab" data-bs-target="#soins" type="button" role="tab" aria-controls="soins" aria-selected="false">
                                    SOINS
                                </button>
                              </li>
                              <li class="nav-item" role="caisse">
                                <button class="nav-link" id="agenda-tab" data-bs-toggle="tab" data-bs-target="#agenda" type="button" role="tab" aria-controls="agenda" aria-selected="false">
                                    AGENDA
                                </button>
                              </li>
                              <li class="nav-item" role="presentation">
                                <button class="nav-link" id="rdv-tab" data-bs-toggle="tab" data-bs-target="#rdv" type="button" role="tab" aria-controls="rdv" aria-selected="false">
                                  RENDEZ-VOUS
                              </button>
                              </li>
                              <li class="nav-item" role="presentation">
                                <button class="nav-link" id="attente-tab" data-bs-toggle="tab" data-bs-target="#attente" type="button" role="tab" aria-controls="attente" aria-selected="false">
                                 SALLE D'ATTENTE
                              </button>
                              </li>
                              <li class="nav-item" role="presentation">
                                <button class="nav-link" id="acte-tab" data-bs-toggle="tab" data-bs-target="#acte" type="button" role="tab" aria-controls="acte" aria-selected="false">
                                 ACTE AUTORISE
                              </button>
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

                                    <tr>

                                    </tr>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                            </div>


                              <div class="tab-pane fade" id="facturation" role="tabpanel" aria-labelledby="facturation-tab">
                                FACTURATION
                              </div>
                              <div class="tab-pane fade" id="caisse" role="tabpanel" aria-labelledby="caisse-tab">
                                REGLEMENT
                              </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                SALLE EN ATTENTE
                            </div>
                          </div><!-- End Default Tabs -->

                        </div>
                      </div>
                </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
</div>
