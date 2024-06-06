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
        <div class="row align-items-top">
            <div class="col-lg-12">
                <div class="card-header bg-secondary text-white">
                    <li class="list-group-item d-flex justify-content-between align-items-center text-white">
                        <h5>Consultation du {{$consultation->rendez_vous->date_rdv}} du patient :
                            {{$consultation->patient->civilite->civilite.' '.$consultation->patient->prenom.'
                            '.$consultation->patient->nom.'
                            '.(\Carbon\Carbon::parse($consultation->patient->date_naissance)->age.' ans' )}} pour :
                            {{$consultation->rendez_vous->motif}}</h5>
                        <span class=" bg-secondary rounded-pill">
                            <button class="btn btn-warning btn-sm"
                                wire:click='terminerConsultation({{$consultation->id}})'>Terminer la
                                consultation</button>
                            <a wire:navigate
                                href="{{route('ad.sante.dossier.patient',encrypt($consultation->patient->id))}}">
                                <button class="btn btn-dark btn-sm">Retour</button>
                            </a>
                        </span>
                    </li>
                </div>
            </div>
            <div class="col-lg-6">

                <!-- Default Card -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Informations</h5>
                        <form method="post" wire:submit.prevent='save'>
                            <div class="card-body">
                                <div>Motif consultation : <strong> {{$consultation->rendez_vous->motif}}</strong></div>

                                <br>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" placeholder="Leave a comment here"
                                        id="floatingTextarea" style="height: 100px;"
                                        wire:model='diagnostique'></textarea>
                                    <label for="floatingTextarea">Conte rendu /
                                        Diagnostique</label>
                                    @error('diagnostique')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="inputPassword5" class="form-label">Maladie</label>
                                    <input type="text" class="form-control" id="inputPassword5"  wire:model='conclusion' >
                                    @error('conclusion')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <br>
                                <div class="card-header bg-secondary text-white">
                                    <div class="text-end ">
                                        @if ($traitement)
                                        <button class="btn btn-warning" type="submit">Mise à jour</button>
                                        @else
                                        <button class="btn btn-primary" type="submit">Valider</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- End Default Card -->
<!-- Card with header and footer -->
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Signes vitaux</h5>
        <form class="row g-3" wire:submit.prevent='saveSigne'>
            {{-- <div class="card-header bg-secondary text-center text-white">
                Constantes Physiques
            </div>
            <div class="col-md-3">
                <label for="inputName5" class="form-label">Taille</label>
                <input type="text" class="form-control" id="inputName5">
            </div>
            <div class="col-md-3">
                <label for="inputEmail5" class="form-label">Poid</label>
                <input type="text" class="form-control" id="inputEmail5">
            </div>
            <div class="col-md-6">
                <label for="inputPassword5" class="form-label">IMC (Indice de Masse Corporelle) </label>
                <input type="text" class="form-control" id="inputPassword5" disabled>
            </div>
            <div class="col-6">
                <label for="inputAddress5" class="form-label">Circonférence abdominale</label>
                <input type="text" class="form-control" id="inputAddres5s">
            </div>
            <div class="col-6">
                <label for="inputAddress2" class="form-label">Indice de graisse corporelle</label>
                <input type="text" class="form-control" id="inputAddress2">
            </div>
            <div class="card-header bg-secondary text-center text-white">
                Signe vitaux
            </div> --}}
            <div class="col-md-4">
                <label for="inputName5" class="form-label">Température corporelle</label>
                <input type="text" class="form-control" id="inputName5">
            </div>
            <div class="col-md-4">
                <label for="inputEmail5" class="form-label">Fréquence cardiaque</label>
                <input type="text" class="form-control" id="inputEmail5">
            </div>
            <div class="col-md-4">
                <label for="inputPassword5" class="form-label">Fréquence respiratoire </label>
                <input type="text" class="form-control" id="inputPassword5">
            </div>
            <div class="col-4">
                <label for="inputAddress5" class="form-label">Pression artérielle</label>
                <input type="text" class="form-control" id="inputAddres5s">
            </div>
            <div class="col-4">
                <label for="inputAddress2" class="form-label">Saturation en oxygène (SpO2)</label>
                <input type="text" class="form-control" id="inputAddress2">
            </div>
            <div class="col-md-4">
                <label for="inputCity" class="form-label">Douleur </label>
                <input type="text" class="form-control" id="inputCity">
            </div>
            <div class="card-header bg-secondary text-white">
                <div class="text-end ">
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </div>

        </form><!-- End Multi Columns Form -->
    </div>
</div>
<!-- End Card with header and footer -->


            </div>

            <div class="col-lg-6">

 <!-- Card with an image on left -->
 <div class="card mb-3">
    <div class="row g-0">
        {{-- <div class="col-md-4">
            <img src="assets/img/card.jpg" class="img-fluid rounded-start" alt="...">
        </div> --}}
        <div class="col-md-12">
            <div class="card-body">
                <h5 class="card-title ">
                    <li class="list-group-item d-flex justify-content-between align-items-center ">
                        Soins medicaux
                        <span class=" bg-secondary rounded-pill">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addSoinsModal">
                                Ajouter
                            </button>
                            <button type="button" class="btn btn-secondary btn-sm">
                                imprimer
                            </button>
                        </span>
                    </li>
                </h5>
                <!-- Basic Modal -->
                <div wire:ignore.self class="modal fade" id="addSoinsModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Vertical Form -->
                            <form method="post" wire:submit.prevent='saveSoins'>
                                @csrf
                                <div class="modal-header" style="background-color: silver">
                                    <h5 class="modal-title">Ajouter soins</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-12">
                                        <label for="inputState" class="form-label">Type Soins
                                            <span style="color: red">*</span></label>
                                        <select id="inputState" class="form-select"
                                            wire:model='type_soin'>
                                            <option selected></option>
                                            @foreach ($type_soins as $type_soin )
                                            <option value="{{$type_soin->id}}">
                                                {{$type_soin->type_soins}}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('type_soin')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="inputNanme5" class="form-label">libelle
                                            soins</label>
                                        <input type="text" wire:model="libelle" class="form-control"
                                            id="inputNanme5">
                                        @error('libelle')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="inputNanme5" class="form-label">Observation</label>
                                        <textarea class="form-control" name="" id="" cols="30" rows="10"
                                            wire:model='observation'></textarea>
                                        @error('observation')
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
                            <th scope="col">Type de soins </th>
                            <th scope="col">Libelle soins </th>
                            <th scope="col">Observation </th>
                            {{-- <th scope="col">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($soins as $soin )
                        <tr>
                            <td> {{$soin->created_at}} </td>
                            <td> {{$soin->medecin->nom.'
                                '.$soin->medecin->prenom}} </td>
                            <td> {{$soin->type_soins->type_soins}} </td>
                            <td> {{$soin->libelle}} </td>
                            <td> {{$soin->observation}} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->
            </div>
        </div>
    </div>
</div><!-- End Card with an image on left -->
<!-- Card with an image on top -->
<div class="card">
    {{-- <img src="assets/img/card.jpg" class="card-img-top" alt="..."> --}}
    <div class="card-body">
        <h5 class="card-title ">
            <li class="list-group-item d-flex justify-content-between align-items-center ">
                Examen
                <span class=" bg-secondary rounded-pill">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#addExamenModal">
                        Ajouter
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm"
                    wire:click='ExamenPrint({{$consultation->id}})'>
                        imprimer
                    </button>
                </span>
            </li>
        </h5>
        <!-- Basic Modal -->
        <div wire:ignore.self class="modal fade" id="addExamenModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Vertical Form -->
                    <form method="post" wire:submit.prevent='saveExamen'>
                        @csrf
                        <div class="modal-header" style="background-color: silver">
                            <h5 class="modal-title">Ajouter examen</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <label for="inputState" class="form-label">Type examen
                                    <span style="color: red">*</span></label>
                                <select id="inputState" class="form-select" wire:model='type_examen'>
                                    <option selected></option>
                                    @foreach($type_examens as $type_examen )
                                    <option value="{{$type_examen->id}}">
                                        {{$type_examen->type_examen}}
                                    </option>
                                    @endforeach
                                </select>
                                @error('type_examen')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="inputNanme5" class="form-label">Libelle</label>
                                <input type="text" wire:model="libelle" class="form-control"
                                    id="inputNanme5">
                                @error('libelle')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            {{-- <div class="col-12">
                                <label for="inputNanme5" class="form-label">Commentaire</label>
                                <textarea class="form-control" name="" id="" cols="30" rows="10"
                                    wire:model='commentaire'></textarea>
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
                    <th scope="col">Type examen </th>
                    <th scope="col">Libelle </th>
                    <th scope="col">Resultat </th>
                    {{-- <th scope="col">Action</th> --}}
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
        <!-- End Table with stripped rows -->
    </div>
</div>

<!-- Card with an image on bottom -->
<div class="card">
    <div class="card-body">
        <h5 class="card-title ">
            <li class="list-group-item d-flex justify-content-between align-items-center ">
                Ordonnance
                <span class=" bg-secondary rounded-pill">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#addMedicamentModal">
                        Ajouter
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm"
                        wire:click='recuPrint({{$consultation->id}})'>
                        imprimer
                    </button>
                </span>
            </li>
        </h5>
        <!-- Basic Modal -->
        <div wire:ignore.self class="modal fade" id="addMedicamentModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Vertical Form -->
                    <form method="post" wire:submit.prevent='saveMedicament'>
                        @csrf
                        <div class="modal-header" style="background-color: silver">
                            <h5 class="modal-title">Ajouter medicament</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <label for="inputState" class="form-label">medicament
                                    <span style="color: red">*</span></label>
                                <select id="inputState" class="form-select" wire:model='medicament'>
                                    <option selected></option>
                                    @foreach($medicaments as $medicament )
                                    <option value="{{$medicament->id}}">
                                        {{$medicament->denomination.' /
                                        '.$medicament->forme_pharmaceutique.' / '
                                        .$medicament->voies_administrative}}
                                    </option>
                                    @endforeach
                                </select>
                                @error('medicament')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="inputNanme5" class="form-label">Quantite</label>
                                <input type="text" wire:model="quantite" class="form-control"
                                    id="inputNanme5">
                                @error('quantite')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="inputNanme5" class="form-label">Posologie</label>
                                <input type="text" wire:model="posologie" class="form-control"
                                    id="inputNanme5">
                                @error('posologie')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="inputNanme5" class="form-label">Duree</label>
                                <input type="text" wire:model="duree" class="form-control"
                                    id="inputNanme5">
                                @error('duree')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            {{-- <div class="col-12">
                                <label for="inputNanme5" class="form-label">Commentaire</label>
                                <textarea class="form-control" name="" id="" cols="30" rows="10"
                                    wire:model='commentaire'></textarea>
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
                    <td> {{$prescription->medecin->nom.'
                        '.$prescription->medecin->prenom}} </td>
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
    {{-- <img src="assets/img/card.jpg" class="card-img-bottom" alt="..."> --}}
</div><!-- End Card with an image on bottom -->

            </div>

        </div>
    </section>
</main><!-- End #main -->
