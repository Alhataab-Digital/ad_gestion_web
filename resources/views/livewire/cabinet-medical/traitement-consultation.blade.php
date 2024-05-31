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
                        <h5>Consultation du {{$consultation->rendez_vous->date_rdv}} du patient :
                            {{$consultation->patient->civilite->civilite.' '.$consultation->patient->prenom.'
                            '.$consultation->patient->nom.'
                            '.(\Carbon\Carbon::parse($consultation->patient->date_naissance)->age.' ans' )}} pour :
                            {{$consultation->rendez_vous->motif}}</h5>
                    </div>
                    <div class="card-body">

                        <!-- Bordered Tabs Justified -->
                        <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100 active" id="information-tab" data-bs-toggle="tab"
                                    data-bs-target="#bordered-justified-information" type="button" role="tab"
                                    aria-controls="information" aria-selected="false">
                                    Informations
                                </button>
                            </li>
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100" id="constante-vitaux-tab" data-bs-toggle="tab"
                                    data-bs-target="#bordered-justified-constante-vitaux" type="button" role="tab"
                                    aria-controls="constante-vitaux" aria-selected="true">
                                    Constantes vitaux
                                </button>
                            </li>
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100" id="soins-tab" data-bs-toggle="tab"
                                    data-bs-target="#bordered-justified-soins" type="button" role="tab"
                                    aria-controls="soins" aria-selected="false">
                                    Soins medicaux
                                </button>
                            </li>
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100" id="examen-tab" data-bs-toggle="tab"
                                    data-bs-target="#bordered-justified-examen" type="button" role="tab"
                                    aria-controls="examen" aria-selected="false">
                                    Prescription d'examens
                                </button>
                            </li>
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100" id="medicament-tab" data-bs-toggle="tab"
                                    data-bs-target="#bordered-justified-medicament" type="button" role="tab"
                                    aria-controls="medicament" aria-selected="false">
                                    Presciption de medicament
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                            <div class="tab-pane fade show active" id="bordered-justified-information" role="tabpanel"
                                aria-labelledby="information-tab">
                                <div class="card-header bg-secondary text-white text-center">
                                    Information de base de la consultation
                                </div>
                                <!-- Default Accordion -->
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                Motif et Diagnostique
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="card">
                                                    <form method="post" wire:submit.prevent='save'>
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{$consultation->rendez_vous->motif}}
                                                        </h5>

                                                        <div class="form-floating mb-3">
                                                            <textarea class="form-control"
                                                                placeholder="Leave a comment here" id="floatingTextarea"
                                                                style="height: 100px;" wire:model='diagnostique'></textarea>
                                                            <label for="floatingTextarea">Conte rendu /
                                                                Diagnostique</label>
                                                                @error('diagnostique')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <textarea class="form-control"
                                                                placeholder="Leave a comment here" id="floatingTextarea"
                                                                style="height: 100px;" wire:model='conclusion'></textarea>
                                                            <label for="floatingTextarea">Conclusion</label>
                                                            @error('conclusion')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                        </div>
                                                        <div class="col-12">
                                                        @if ($traitement)
                                                        <button class="btn btn-warning"
                                                        type="submit">Mise à jour</button>
                                                        @else
                                                        <button class="btn btn-primary"
                                                        type="submit">Valider</button>
                                                        @endif

                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed bg-secondary text-white" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                Liste d'intervention
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                            aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <strong>This is the second item's accordion body.</strong> It is hidden
                                                by default, until the collapse plugin adds the appropriate classes that
                                                we use to style each element. These classes control the overall
                                                appearance, as well as the showing and hiding via CSS transitions. You
                                                can modify any of this with custom CSS or overriding our default
                                                variables. It's also worth noting that just about any HTML can go within
                                                the <code>.accordion-body</code>, though the transition does limit
                                                overflow.
                                            </div>
                                        </div>
                                    </div>

                                </div><!-- End Default Accordion Example -->

                            </div>
                            <div class="tab-pane fade " id="bordered-justified-constante-vitaux" role="tabpanel"
                                aria-labelledby="constante-vitaux-tab">
                                constante-vitaux
                            </div>
                            <div class="tab-pane fade" id="bordered-justified-soins" role="tabpanel"
                                aria-labelledby="soins-tab">
                                soins
                            </div>
                            <div class="tab-pane fade" id="bordered-justified-examen" role="tabpanel"
                                aria-labelledby="examen-tab">
                                <div class="card">
                                    <div class="card-header bg-secondary text-center text-white">
                                        Prescription examen
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title text-end">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#addExamenModal">
                                                Ajouter
                                            </button>
                                            <button type="button" class="btn btn-secondary">
                                                imprimer
                                            </button>
                                        </h5>
                                        <!-- Basic Modal -->
                                        <div wire:ignore.self class="modal fade" id="addExamenModal"
                                            tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- Vertical Form -->
                                                    <form method="post" wire:submit.prevent='saveExamen'>
                                                        @csrf
                                                        <div class="modal-header" style="background-color: silver">
                                                            <h5 class="modal-title">Ajouter examen</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-12">
                                                                <label for="inputState" class="form-label">Type examen
                                                                    <span style="color: red">*</span></label>
                                                                <select id="inputState" class="form-select"
                                                                    wire:model='type_examen'>
                                                                    <option selected></option>
                                                                    {{-- @foreach ($type_consultations as
                                                                    $type_consultation )
                                                                    <option value="{{$type_consultation->id}}">
                                                                        {{$type_consultation->type_consultation}}
                                                                    </option>
                                                                    @endforeach --}}
                                                                </select>
                                                                @error('type_examen')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="inputNanme5" class="form-label">libelle
                                                                    examen</label>
                                                                <input type="text" wire:model="libelle"
                                                                    class="form-control" id="inputNanme5">
                                                                @error('libelle')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="inputNanme5"
                                                                    class="form-label">Commentaire</label>
                                                                <textarea class="form-control" name="" id="" cols="30"
                                                                    rows="10" wire:model='commentaire'></textarea>
                                                                @error('commentaire')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer" style="background-color: silver">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </form><!-- Vertical Form -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Basic Modal-->
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
                            <div class="tab-pane fade" id="bordered-justified-medicament" role="tabpanel"
                                aria-labelledby="medicament-tab">
                                <div class="card">
                                    <div class="card-header bg-secondary text-center text-white">
                                        Prescription medicament
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title text-end">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#addMedicamentModal">
                                                Ajouter
                                            </button>
                                            <button type="button" class="btn btn-secondary" wire:click='recuPrint({{$consultation->id}})'>
                                                imprimer
                                            </button>
                                        </h5>
                                        <!-- Basic Modal -->
                                        <div wire:ignore.self class="modal fade" id="addMedicamentModal"
                                            tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- Vertical Form -->
                                                    <form method="post" wire:submit.prevent='saveMedicament'>
                                                        @csrf
                                                        <div class="modal-header" style="background-color: silver">
                                                            <h5 class="modal-title">Ajouter medicament</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-12">
                                                                <label for="inputState" class="form-label">medicament
                                                                    <span style="color: red">*</span></label>
                                                                <select id="inputState" class="form-select"
                                                                    wire:model='medicament'>
                                                                    <option selected></option>
                                                                    @foreach($medicaments as $medicament )
                                                                    <option value="{{$medicament->id}}">
                                                                        {{$medicament->denomination.' / '.$medicament->forme_pharmaceutique.' / ' .$medicament->voies_administrative}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('medicament')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="inputNanme5" class="form-label">Quantite</label>
                                                                <input type="text" wire:model="quantite"
                                                                    class="form-control" id="inputNanme5">
                                                                @error('quantite')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="inputNanme5" class="form-label">Posologie</label>
                                                                <input type="text" wire:model="posologie"
                                                                    class="form-control" id="inputNanme5">
                                                                @error('posologie')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="inputNanme5" class="form-label">Duree</label>
                                                                <input type="text" wire:model="duree"
                                                                    class="form-control" id="inputNanme5">
                                                                @error('duree')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                            {{-- <div class="col-12">
                                                                <label for="inputNanme5"
                                                                    class="form-label">Commentaire</label>
                                                                <textarea class="form-control" name="" id="" cols="30"
                                                                    rows="10" wire:model='commentaire'></textarea>
                                                                @error('commentaire')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div> --}}
                                                        </div>
                                                        <div class="modal-footer" style="background-color: silver">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </form><!-- Vertical Form -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Basic Modal-->
                                        <!-- Table with stripped rows -->
                                        <table class="table">
                                            <thead class="bg-primary text-white">
                                                <tr>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">prescrit par</th>
                                                    <th scope="col">Denomination </th>
                                                    <th scope="col">voix </th>
                                                    <th scope="col">qte </th>
                                                    <th scope="col">posologie </th>
                                                    <th scope="col">duree </th>
                                                    {{-- <th scope="col">Action</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($prescriptions as $prescription )
                                                <tr>
                                                    <td> {{$prescription->created_at}} </td>
                                                    <td> {{$prescription->medecin->nom.' '.$prescription->medecin->prenom}} </td>
                                                    <td> {{$prescription->medicament->denomination}} </td>
                                                    <td> {{$prescription->medicament->voies_administrative}} </td>
                                                    <td> {{$prescription->quantite}} </td>
                                                    <td> {{$prescription->posologie}} </td>
                                                    <td> {{$prescription->duree}} </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                        <!-- End Table with stripped rows -->
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Bordered Tabs Justified -->

                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-warning btn-sm" wire:click='terminerConsultation({{$consultation->id}})'>Terminer la consultation</button>
                        <a wire:navigate
                            href="{{route('ad.sante.dossier.patient',encrypt($consultation->patient->id))}}">
                            <button class="btn btn-secondary btn-sm">Retour</button>
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->
