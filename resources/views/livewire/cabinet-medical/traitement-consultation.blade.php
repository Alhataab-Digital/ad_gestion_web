 <main id="main" class="main">

    <div class="pagetitle">
      {{-- <h1>Form Elements</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Elements</li>
        </ol>
      </nav> --}}
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-12">

            <div class="card">
                <div class="card-header bg-dark text-white">
                  <h5>Consultation du {{$consultation->rendez_vous->date_rdv}} du patient : {{$consultation->patient->civilite->civilite.' '.$consultation->patient->prenom.' '.$consultation->patient->nom.' '.(\Carbon\Carbon::parse($consultation->patient->date_naissance)->age.' ans' )}} pour : {{$consultation->rendez_vous->motif}}</h5>
                </div>
                <div class="card-body">

                  <!-- Bordered Tabs Justified -->
                  <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100 active" id="information-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-information" type="button" role="tab" aria-controls="information" aria-selected="false">
                          Informations
                      </button>
                      </li>
                    <li class="nav-item flex-fill" role="presentation">
                      <button class="nav-link w-100" id="constante-vitaux-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-constante-vitaux" type="button" role="tab" aria-controls="constante-vitaux" aria-selected="true">
                        Constantes vitaux
                    </button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                      <button class="nav-link w-100" id="soins-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-soins" type="button" role="tab" aria-controls="soins" aria-selected="false">
                        Soins medicaux
                    </button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="examen-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-examen" type="button" role="tab" aria-controls="examen" aria-selected="false">
                            Prescription d'examens
                        </button>
                      </li>
                      <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="medicament-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-medicament" type="button" role="tab" aria-controls="medicament" aria-selected="false">
                            Presciption de medicament
                        </button>
                      </li>
                  </ul>
                  <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                    <div class="tab-pane fade show active" id="bordered-justified-information" role="tabpanel" aria-labelledby="information-tab">
                        <div class="card">
                            <div class="card-header bg-secondary text-white text-center">
                                Information de base de la consultation
                            </div>
                            <div class="card-body">
                              <h5 class="card-title">{{$consultation->rendez_vous->motif}}</h5>

                              <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px;"></textarea>
                                <label for="floatingTextarea">Conte rendu / Diagnostique</label>
                              </div>
                              <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px;"></textarea>
                                <label for="floatingTextarea">Conclusion</label>
                              </div>
                              <div class="col-12">
                                <button class="btn btn-primary" type="submit">Valider</button>
                              </div>
                            </div>
                          </div>
                    </div>
                    <div class="tab-pane fade " id="bordered-justified-constante-vitaux" role="tabpanel" aria-labelledby="constante-vitaux-tab">
                        constante-vitaux
                    </div>
                    <div class="tab-pane fade" id="bordered-justified-soins" role="tabpanel" aria-labelledby="soins-tab">
                        soins
                    </div>
                    <div class="tab-pane fade" id="bordered-justified-examen" role="tabpanel" aria-labelledby="examen-tab">
                        <div class="card">
                            <div class="card-header bg-secondary text-center text-white">
                                Prescription examen
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-end">

                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addtarif_consultationModal">
                                        Ajouter
                                    </button>
                                    <button type="button" class="btn btn-secondary" >
                                    imprimer
                                    </button>
                                </h5>
                                <!-- Basic Modal -->
                                <div wire:ignore.self class="modal fade" id="addtarif_consultationModal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Vertical Form -->
                                            <form method="post" wire:submit.prevent='saveExamen'>
                                                @csrf
                                                <div class="modal-header" style="background-color: silver">
                                                    <h5 class="modal-title">Ajouter tarif_consultation</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col-12">
                                                        <label for="inputState" class="form-label">Type examen <span style="color: red">*</span></label>
                                                        <select id="inputState" class="form-select" wire:model='type_examen'>
                                                            <option selected></option>
                                                            {{-- @foreach ($type_consultations as $type_consultation )
                                                            <option value="{{$type_consultation->id}}"> {{$type_consultation->type_consultation}} </option>
                                                            @endforeach --}}
                                                        </select>
                                                        @error('type_examen')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="inputNanme5" class="form-label">libelle examen</label>
                                                        <input type="text" wire:model="libelle" class="form-control"
                                                            id="inputNanme5">
                                                        @error('libelle')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="inputNanme5" class="form-label">Commentaire</label>
                                                        <textarea class="form-control" name="" id="" cols="30" rows="10" wire:model='commentaire'></textarea>
                                                        @error('commentaire')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer" style="background-color: silver">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form><!-- Vertical Form -->
                                        </div>
                                    </div>
                                </div>
                                <!-- End Basic Modal-->
                                <P>
                                    @if ($message=Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-1"></i>
                                    {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                                @endif
                                @if ($message=Session::get('danger'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-octagon me-1"></i>
                                    {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                                @endif

                                </P>
                                <!-- Table with stripped rows -->
                                <table class="table">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">prescrit par</th>
                                            <th scope="col">Type d'examen </th>
                                            <th scope="col">Libelle examen </th>
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
                        </div>
                    </div>
                    <div class="tab-pane fade" id="bordered-justified-medicament" role="tabpanel" aria-labelledby="medicament-tab">
                        prescription de medicament
                    </div>
                  </div><!-- End Bordered Tabs Justified -->

                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-warning btn-sm">Terminer la consultation</button>
                    <a wire:navigate href="{{route('ad.sante.dossier.patient',encrypt($consultation->patient->id))}}">
                        <button class="btn btn-secondary btn-sm">Retour</button>
                    </a>

                </div>
              </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

