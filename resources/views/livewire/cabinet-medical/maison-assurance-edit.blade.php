<main id="main" class="main">

    <div class="pagetitle">
        {{-- <h1>Accordion</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Components</li>
                <li class="breadcrumb-item active">Accordion</li>
            </ol>
        </nav> --}}
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class=" form-signin w-80 m-auto col-lg-8">

                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <h5>MODIFICATION ET MISE A JOUR DE L'ASSURANCE</h5>
                    </div>
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
                    <div class="card-body">
                        <!-- Default Accordion -->
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header " id="headingOne">
                                    <button class="accordion-button bg-secondary text-white" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        MAISON ASSIRANCE
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <!-- Vertical Form -->
                                        <form wire:submit='update' class="row g-0">
                                        <div class="modal-body">
                                            <div class="col-md-12">
                                                <label for="inputNanme5" class="form-label">compagnie assurance </label>
                                                <input type="text" wire:model="maison_assurance" class="form-control"
                                                    id="inputNanme5">
                                                @error('maison_assurance')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputNanme5" class="form-label">Telephone </label>
                                                <input type="text" wire:model="telephone" class="form-control"
                                                    id="inputNanme5">
                                                @error('telephone')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputNanme5" class="form-label">Adresse </label>
                                                <input type="text" wire:model="adresse" class="form-control"
                                                    id="inputNanme5">
                                                @error('adresse')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputNanme5" class="form-label">mail </label>
                                                <input type="text" wire:model="mail" class="form-control"
                                                    id="inputNanme5">
                                                @error('mail')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <br>
                                        <div class="card-footer bg-dark text-white">
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary">Mise à jour</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed bg-secondary text-white" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        CONTRAT ASSURANCE
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#addContraModal">
                                                        Ajouter un contrat
                                                    </button>
                                                </h5>
                                                <!-- Basic Modal -->
                                                <div wire:ignore.self class="modal fade" id="addContraModal"
                                                    tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <!-- Vertical Form -->

                                                                <div class="modal-header"
                                                                    style="background-color: silver">
                                                                    <h5 class="modal-title">Ajouter contrat assurance
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post" wire:submit.prevent='saveContrat'>
                                                                        @csrf
                                                                    <div class="col-12">
                                                                        <label for="inputState" class="form-label">Type consultation <span style="color: red">*</span></label>
                                                                        <select id="inputState" class="form-select" wire:model='tarif_consultation'>
                                                                            <option selected></option>
                                                                            @foreach ($tarif_consultations as $tarif_consultation )
                                                                            <option value="{{$tarif_consultation->id}}"> {{$tarif_consultation->type_consultation->type_consultation}} </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('tarif_consultation')
                                                                        <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <label for="inputNanme5"
                                                                            class="form-label">Date debut validité</label>
                                                                        <input type="date" wire:model="date_debut"
                                                                            class="form-control" id="inputNanme5">
                                                                        @error('date_debut')
                                                                        <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <label for="inputNanme5"
                                                                            class="form-label">Date fin validité</label>
                                                                        <input type="date" wire:model="date_fin"
                                                                            class="form-control" id="inputNanme5">
                                                                        @error('date_fin')
                                                                        <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <label for="inputNanme5" class="form-label">taux couverture(%)
                                                                        </label>
                                                                        <input type="number" wire:model="taux_couverture"
                                                                            class="form-control" id="inputNanme5">
                                                                        @error('taux_couverture')
                                                                        <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer"
                                                                    style="background-color: silver">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Fermer</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Enregistrer</button>
                                                                </div>
                                                            </form><!-- Vertical Form -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Basic Modal-->
                                                <!-- Table with stripped rows -->
                                                <table class="table datatable">
                                                    <thead class="bg-primary text-white">
                                                        <tr>
                                                            <!-- <th scope="col">#</th> -->
                                                            <th scope="col">Maison assurance</th>
                                                            <th scope="col">Type consultation</th>
                                                            <th scope="col">Date debut</th>
                                                            <th scope="col">Date fin</th>
                                                            <th scope="col">taux (%)</th>
                                                            <th scope="col">tarif</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($contrat_assurances as $contrat_assurance)
                                                        <tr>
                                                            <td>{{$contrat_assurance->maison_assurance->maison_assurance}}</td>
                                                            <td>{{$contrat_assurance->tarif_consultation->type_consultation->type_consultation}}</td>
                                                            <td>{{$contrat_assurance->date_debut}}</td>
                                                            <td>{{$contrat_assurance->date_fin}}</td>
                                                            <td>{{$contrat_assurance->taux_couverture}}</td>
                                                            <td style="text-align:right">{{ number_format($contrat_assurance->tarif_consultation->montant,2,","," ").'
                                                                '.$contrat_assurance->user->agence->devise->unite}}</td>
                                                        </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                                <!-- End Table with stripped rows -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><!-- End Default Accordion Example -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->
