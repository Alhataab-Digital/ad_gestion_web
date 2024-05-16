<main id="main" class="main">

    <div class="pagetitle">
        <h1>Patients</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                <li class="breadcrumb-item">param</li>
                <li class="breadcrumb-item active">patient</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <!-- Basic Modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#basicModal">
                                Planification Medecin
                            </button>
                        </h5>
                        <div wire:ignore.self class="modal fade" id="basicModal" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: silver">
                                        <h5 class="modal-title">Ajouter une planification</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <!-- Multi Columns Form -->
                                        <form class="row g-3" wire:submit.prevent='save'>
                                            <div class="col-md-12">
                                                <label for="inputState" class="form-label">Medecin <span
                                                        style="color: red">*</span></label>
                                                <select id="inputState" class="form-select" wire:model='medecin'>
                                                    <option selected>choisir le medecin</option>
                                                    @foreach ($medecins as $medecin )
                                                    <option value="{{$medecin->id}}"> {{$medecin->grade.' : '.$medecin->prenom.' '.$medecin->nom}} </option>
                                                    @endforeach
                                                </select>
                                                @error('medecin')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputState" class="form-label">Domaine d'intervention <span
                                                        style="color: red">*</span></label>
                                                <select id="inputState" class="form-select" wire:model='intervention'>
                                                    <option selected>Choisir l'intervention</option>
                                                    @foreach ($tarif_medicals as $tarif_medical )
                                                    <option value="{{$tarif_medical->id}}"> {{$tarif_medical->libelle_tarif}} </option>
                                                    @endforeach
                                                </select>
                                                @error('intervention')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputName5" class="form-label">Date <span
                                                        style="color: red">*</span></label>
                                                <input type="date" class="form-control" wire:model='date'
                                                    id="inputName5">
                                                @error('date')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-3">
                                                <label for="inputName5" class="form-label">Heure debut <span
                                                        style="color: red">*</span></label>
                                                <input type="time" class="form-control" wire:model='debut'
                                                    id="inputName5">
                                                @error('debut')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-3">
                                                <label for="inputName5" class="form-label">Heure fin <span
                                                        style="color: red">*</span></label>
                                                <input type="time" class="form-control" wire:model='fin'
                                                    id="inputName5">
                                                @error('fin')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>

                                    </div>
                                    <div class="modal-footer" style="background-color: silver">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Valider</button>
                                    </div>
                                    </form><!-- End No Labels Form -->
                                </div>
                            </div>
                        </div>
                        <!-- End Basic Modal-->
                        <P>
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

                        </P>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead class="bg-primary">
                                <tr>
                                    <!-- <th scope="col">#</th> -->
                                    <th scope="col">Nom patient </th>
                                    <th scope="col">Prenom patient</th>
                                    <th scope="col">Interventiont</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">heure debut</th>
                                    <th scope="col">heure fin</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($planifications as $planification )
                                <tr>
                                    <td>{{ $planification->medecin->prenom}}</td>
                                    <td>{{ $planification->medecin->nom}}</td>
                                    <td>{{ $planification->tarif->libelle_tarif}}</td>
                                    <td>{{ $planification->jour_semaine}}</td>
                                    <td>{{ $planification->heure_debut}}</td>
                                    <td>{{ $planification->heure_fin}}</td>
                                    <td>

                                        <a wire:navigate
                                            href="">
                                            <button type="button" class="btn btn-primary"><i
                                                    class="bi bi-pencil"></i></button>
                                        </a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{$planification->id}}"><i
                                                class="bi bi-trash"></i></button>
                                        <div wire:ignore.self class="modal fade" id="deleteModal{{$planification->id}}"
                                            tabindex="-1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <!-- Vertical Form -->
                                                    <div class="modal-body">
                                                        <div class="alert alert-danger">
                                                            <i class="bx bx-shield-quarter"></i> Confirmer la
                                                            suppression la planification : {{ $planification->id}}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer text-center">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit"
                                                            wire:click='deleteConfirmation({{$planification->id}})'
                                                            class="btn btn-danger">Confirmer</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>
<!-- End #main -->
