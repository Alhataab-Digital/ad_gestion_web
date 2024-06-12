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
                                                    @foreach ($civilites as $civilite )
                                                    <option value="{{$civilite->id}}"> {{$civilite->civilite}} </option>
                                                    @endforeach
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
                                                    @foreach ($situations as $situation )
                                                    <option value="{{$situation->id}}"> {{$situation->situation_matrimoniale}} </option>
                                                    @endforeach
                                                </select>
                                                @error('situation')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputPassword5" class="form-label">Date de naissance <span style="color: red">*</span></label>
                                                <input type="date" class="form-control" wire:model='date_naissance'
                                                    id="inputPassword5">
                                                @error('date_naissance')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputPassword5" class="form-label">Lieu de naissance <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" wire:model='lieu_naissance'
                                                    id="inputPassword5">
                                                @error('lieu_naissance')
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
                                            <div class="col-6">
                                                <label for="inputAddress2" class="form-label">Addresse <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" wire:model='adresse'
                                                    id="inputAddress2">
                                                @error('adresse')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
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
                                    <th scope="col">N° Dossier</th>
                                    <th scope="col">Nom patient </th>
                                    <th scope="col">Prenom patient</th>
                                    <th scope="col">Age</th>
                                    <th scope="col">telephone patient</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patients as $patient )
                                <tr>
                                    <td>{{ $patient->numero_patient}}</td>
                                    @if ($patient->civilite_id !=null)
                                    <td>{{ $patient->civilite->civilite.' '.$patient->prenom}}</td>
                                    @else
                                    <td>{{ $patient->prenom}}</td>
                                    @endif

                                    <td>{{ $patient->nom}}</td>
                                    <td>{{(\Carbon\Carbon::parse($patient->date_naissance)->age )}}</td>
                                    <td>{{ $patient->telephone}}</td>

                                    <td>
                                        @if (Auth::user()->id==6)
                                        <a wire:navigate href="{{route('ad.sante.dossier.patient',encrypt($patient->id))}}">
                                            <button type="button" class="btn btn-secondary"><i
                                                    class="bx bx-folder-plus"></i></button>
                                        </a>
                                        @endif
                                        <a wire:navigate href="{{route('ad.sante.edit.patient',encrypt($patient->id))}}">
                                            <button type="button" class="btn btn-info"><i
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
