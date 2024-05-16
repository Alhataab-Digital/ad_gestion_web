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
                                Nouveau Dossier
                            </button>
                        </h5>
                        <div wire:ignore.self class="modal fade" id="basicModal" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content" >
                                    <div class="modal-header"  style="background-color: silver">
                                        <h5 class="modal-title">Ajouter dossier</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <!-- Multi Columns Form -->
                                        <form class="row g-3" wire:submit.prevent='save'>
                                            <div class="col-md-4">
                                                <label for="inputState" class="form-label">Civilité <span style="color: red">*</span></label>
                                                <select id="inputState" class="form-select" wire:model='civilite'>
                                                    <option selected></option>
                                                    <option value="Monsieur"> Monsieur </option>
                                                    <option value="Madame"> Madame </option>
                                                    <option value="Mademoiselle"> Mademoiselle </option>
                                                </select>
                                                @error('civilite')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-8">
                                                <label for="inputName5" class="form-label">Prenom <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" wire:model='prenom'
                                                    id="inputName5">
                                                @error('prenom')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputName5" class="form-label">Nom du pere / Nom de famille <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" wire:model='nom'
                                                    id="inputName5">
                                                @error('nom')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputState" class="form-label">Situation <span style="color: red">*</span></label>
                                                <select id="inputState" class="form-select" wire:model='situation'>
                                                    <option selected></option>
                                                    <option value="Celibataire">Celibataire</option>
                                                    <option value="Marié(e)">Marié(e)</option>
                                                    <option value="Veuf(ve)">Veuf(ve)</option>
                                                    <option value="Divorcé(e)">Divorcé(e)</option>
                                                </select>
                                                @error('situation')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <label for="inputPassword5" class="form-label">Age <span style="color: red">*</span></label>
                                                <input type="number" class="form-control" wire:model='age'
                                                    id="inputPassword5">
                                                @error('age')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label for="inputAddress5" class="form-label">Telephone <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" wire:model='telephone'
                                                    id="inputAddres5s">
                                                @error('telephone')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="inputAddress2" class="form-label">Addresse <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" wire:model='adresse'
                                                    id="inputAddress2">
                                                @error('adresse')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputCity" class="form-label">Taille</label>
                                                <input type="text" class="form-control" wire:model='taille' id="inputCity">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputZip" class="form-label">Poid</label>
                                                <input type="text" class="form-control" wire:model='poid' id="inputZip">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEmail5" class="form-label">Email</label>
                                                <input type="email" class="form-control" wire:model='mail'
                                                    id="inputEmail5">

                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputPassword5" class="form-label">Password</label>
                                                <input type="password" class="form-control" wire:model='password' id="inputPassword5">
                                            </div>
                                    </div>
                                    <div class="modal-footer"  style="background-color: silver">
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
                                    <th scope="col">Civilité</th>
                                    <th scope="col">Nom patient </th>
                                    <th scope="col">Prenom patient</th>
                                    <th scope="col">telephone patient</th>
                                    {{-- <th scope="col">Age</th> --}}
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patients as $patient )
                                <tr>
                                    <td>{{ $patient->civilite}}</td>
                                    <td>{{ $patient->nom}}</td>
                                    <td>{{ $patient->prenom}}</td>
                                    <td>{{ $patient->telephone}}</td>
                                    {{-- <td>{{ $patient->age}}</td> --}}
                                    <td>

                                        {{-- <a wire:navigate href="/patient/{{encrypt($patient->id)}}/consultation">
                                            <button type="button" class="btn btn-warning"><i
                                                    class="ri ri-user-unfollow-line"></i> Consultation</button>
                                        </a>
                                        <a wire:navigate href="/patient/{{encrypt($patient->id)}}/rdv">
                                            <button type="button" class="btn btn-info"><i
                                                    class="ri ri-user-shared-2-line"></i> Rendez vous</button>
                                        </a>
                                        <a wire:navigate href="/patient/{{encrypt($patient->id)}}/vaccin">
                                            <button type="button" class="btn btn-dark"><i
                                                    class="ri ri-syringe-line"></i> Vaccin</button>
                                        </a>
                                        <a wire:navigate href="/patient/{{encrypt($patient->id)}}/ordonnance">
                                            <button type="button" class="btn btn-light"><i
                                                    class="ri ri-file-add-line"></i> Ordonnance</button>
                                        </a> --}}
                                        <a wire:navigate href="{{route('ad.sante.dossier',encrypt($patient->id))}}">
                                            <button type="button" class="btn btn-secondary"><i
                                                    class="bx bx-folder-plus"></i></button>
                                        </a>
                                        <a wire:navigate href="{{route('ad.sante.edit.patient',encrypt($patient->id))}}">
                                            <button type="button" class="btn btn-primary"><i
                                                    class="bi bi-pencil"></i></button>
                                        </a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{$patient->id}}"><i
                                                class="bi bi-trash"></i></button>
                                        <div wire:ignore.self class="modal fade" id="deleteModal{{$patient->id}}"
                                            tabindex="-1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <!-- Vertical Form -->
                                                    <div class="modal-body">
                                                        <div class="alert alert-danger">
                                                            <i class="bx bx-shield-quarter"></i> Confirmer la
                                                            suppression du patient : {{ $patient->nom}}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer text-center">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit"
                                                            wire:click='deleteConfirmation({{$patient->id}})'
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
@push('scripts')
<script>
    windows.addEventListner('show-delete-confirmation-modal', event=>{
        $('#deleteModal').modal('show');
    })
</script>

@endpush
