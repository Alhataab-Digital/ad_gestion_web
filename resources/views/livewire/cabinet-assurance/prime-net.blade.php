<main id="main" class="main">

    <div class="pagetitle">
        <h1>prime nets</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                <li class="breadcrumb-item">param</li>
                <li class="breadcrumb-item active">prime net</li>
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
                                Ajouter prime_net
                            </button>
                        </h5>
                        <div wire:ignore.self class="modal fade" id="basicModal" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content" >
                                    <div class="modal-header"  style="background-color: silver">
                                        <h5 class="modal-title">Ajouter prime_net</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <!-- Multi Columns Form -->
                                        <form class="row g-3" wire:submit.prevent='save'>
                                            <div class="col-md-12">
                                                <label for="inputState" class="form-label">Usage <span style="color: red">*</span></label>
                                                <select id="inputState" class="form-select" wire:model='usage'>
                                                    <option selected></option>
                                                    @foreach ($usages as $usage )
                                                    <option value="{{$usage->id}}"> {{$usage->code_usage}} </option>
                                                    @endforeach
                                                </select>
                                                @error('usage')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputState" class="form-label">Puissance <span style="color: red">*</span></label>
                                                <select id="inputState" class="form-select" wire:model='puissance'>
                                                    <option selected></option>
                                                    @foreach ($puissances as $puissance )
                                                    <option value="{{$puissance->id}}"> {{$puissance->valeur_puissance.' '.$puissance->devise_puissance}} </option>
                                                    @endforeach
                                                </select>
                                                @error('puissance')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputState" class="form-label">Energie <span style="color: red">*</span></label>
                                                <select id="inputState" class="form-select" wire:model='energie'>
                                                    <option selected></option>
                                                    @foreach ($energies as $energie )
                                                    <option value="{{$energie->id}}"> {{$energie->libelle_energie}} </option>
                                                    @endforeach
                                                </select>
                                                @error('energie')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputState" class="form-label">Zone <span style="color: red">*</span></label>
                                                <select id="inputState" class="form-select" wire:model='zone'>
                                                    <option selected></option>
                                                    @foreach ($zones as $zone )
                                                    <option value="{{$zone->id}}"> {{$zone->code_zone}} </option>
                                                    @endforeach
                                                </select>
                                                @error('zone')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label for="inputState" class="form-label">Groupe <span style="color: red">*</span></label>
                                                <select id="inputState" class="form-select" wire:model='groupe'>
                                                    <option selected></option>
                                                    @foreach ($groupes as $groupe )
                                                    <option value="{{$groupe->id}}"> {{$groupe->code_groupe}} </option>
                                                    @endforeach
                                                </select>
                                                @error('groupe')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputState" class="form-label">Classe <span style="color: red">*</span></label>
                                                <select id="inputState" class="form-select" wire:model='classe'>
                                                    <option selected></option>
                                                    @foreach ($classes as $classe )
                                                    <option value="{{$classe->id}}"> {{$classe->code_classe}} </option>
                                                    @endforeach
                                                </select>
                                                @error('classe')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="inputAddress2" class="form-label">Prime net <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" wire:model='montant'
                                                    id="inputAddress2">
                                                @error('montant')
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
                                    <!-- <th scope="col">#</th> -->
                                    <th scope="col">Usage</th>
                                    <th scope="col">Puissance</th>
                                    <th scope="col">Energie</th>
                                    <th scope="col">Zone</th>
                                    <th scope="col">Groupe</th>
                                    <th scope="col">Classe</th>
                                    <th scope="col">Prime net</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prime_nets as $prime_net )
                                <tr>
                                    <td>{{ $prime_net->usage->code_usage}}</td>
                                    <td>{{ $prime_net->puissance->valeur_puissance.' '.$prime_net->puissance->devise_puissance}}</td>
                                    <td>{{ $prime_net->energie->libelle_energie}}</td>
                                    <td>{{ $prime_net->zone->code_zone}}</td>
                                    <td>{{ $prime_net->groupe->code_groupe}}</td>
                                    <td>{{ $prime_net->classe->code_classe}}</td>
                                    <td style="text-align:right">{{ number_format($prime_net->montant,2,","," ").' '.$prime_net->user->agence->devise->unite}}</td>

                                    <td>
                                        </a>
                                        <a wire:navigate href="/prime_net/{{encrypt($prime_net->id)}}/edit">
                                            <button type="button" class="btn btn-primary"><i
                                                    class="bi bi-pencil"></i></button>
                                        </a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{$prime_net->id}}"><i
                                                class="bi bi-trash"></i></button>
                                        <div wire:ignore.self class="modal fade" id="deleteModal{{$prime_net->id}}"
                                            tabindex="-1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <!-- Vertical Form -->
                                                    <div class="modal-body">
                                                        <div class="alert alert-danger">
                                                            <i class="bx bx-shield-quarter"></i> Confirmer la
                                                            suppression du prime_net : {{ $prime_net->nom}}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer text-center">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit"
                                                            wire:click='deleteConfirmation({{$prime_net->id}})'
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
