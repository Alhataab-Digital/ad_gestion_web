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

                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            NOUVELLE HOSPITALISATION PATIENT
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
                            <h5 class="card-title text-end">
                                <li class="list-group-item d-flex justify-content-between align-items-center ">
                                    <span class=" rounded-pill">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#nouveauModal">
                                        Numero telephone
                                    </button>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#basicModal">
                                        Numero dossier
                                    </button>
                                    </span>
                                </li>
                                <!-- Basic Modal -->

                            </h5>

                <!-- Vertical Form -->
                <form wire:submit.prevent='validerNouveau' class="row g-0">
                    @csrf
                            <div wire:ignore.self class="modal fade" id="nouveauModal" tabindex="-1">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: silver">
                                            <h5 class="modal-title">Numero telephone</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-12">
                                                <label for="inputAddress5" class="form-label">Telephone <span
                                                        style="color: red">*</span></label>
                                                <input type="text" class="form-control" wire:model='telephone'
                                                    id="inputAddres5s">
                                                @error('telephone')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer" style="background-color: silver">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Valider</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- End Basic Modal-->
                        </form><!-- Vertical Form -->

                <!-- Vertical Form -->
                <form wire:submit.prevent='validerAncien' class="row g-0">
                    @csrf
                            <div wire:ignore.self class="modal fade" id="basicModal" tabindex="-1">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: silver">
                                            <h5 class="modal-title">Numero dossier</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-12">
                                                <label for="inputAddress5" class="form-label">Numero dossier <span
                                                        style="color: red">*</span></label>
                                                <input type="text" class="form-control" wire:model='numero_patient'
                                                    id="inputAddres5s">
                                                @error('numero_patient')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer" style="background-color: silver">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Valider</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- End Basic Modal-->
                        </form><!-- Vertical Form -->
                        </div>
                        <div class="card-footer bg-dark text-white">
                            <div class="text-center">

                            </div>
                        </div>
                    </div>


            </div>
            <div class="card">
                <div class="card-body">
                    {{-- <h5 class="card-title">GESTION HOSPITALISATIONS </h5> --}}

                    <!-- Default Tabs -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">LISTE DES
                                HOSPITALISATIONS</button>
                        </li>
                        {{-- <li class="nav-item" role="facturation">
                            <button class="nav-link" id="facturation-tab" data-bs-toggle="tab"
                                data-bs-target="#facturation" type="button" role="tab" aria-controls="facturation"
                                aria-selected="false">FACTURE EN COURS <span
                                    class="badge bg-danger badge-number">12</span></button>
                        </li> --}}
                        {{-- <li class="nav-item" role="caisse">
                            <button class="nav-link" id="caisse-tab" data-bs-toggle="tab" data-bs-target="#caisse"
                                type="button" role="tab" aria-controls="caisse" aria-selected="false">REGLEMENT
                                PERCUS</button>
                        </li> --}}
                        {{-- <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                type="button" role="tab" aria-controls="contact" aria-selected="false">SALLE
                                D'ATTENTE
                                <span class="badge bg-danger badge-number">11</span>
                            </button>
                        </li> --}}
                    </ul>
                    <div class="tab-content pt-2" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th scope="col">Dossier</th>
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
                                    
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        </div>
                        <div class="tab-pane fade" id="caisse" role="tabpanel" aria-labelledby="caisse-tab">
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th scope="col">Dossier</th>
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

                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th scope="col">Numero ordre</th>
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
                    </div><!-- End Default Tabs -->

                </div>
            </div>
        </div>
    </section>

</main>
<!-- End #main -->
