<div>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1> maison assurances</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                    <li class="breadcrumb-item">param</li>
                    <li class="breadcrumb-item active">Structure d'assurance</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addmaison_assuranceModal">
                                    Ajouter une structure d'assurance
                                </button>
                            </h5>
                            <!-- Basic Modal -->
                            <div wire:ignore.self class="modal fade" id="addmaison_assuranceModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Vertical Form -->
                                        <form method="post" wire:submit.prevent='save'>
                                            @csrf
                                            <div class="modal-header" style="background-color: silver">
                                                <h5 class="modal-title">Ajouter une structure d'assurance</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-12">
                                                    <label for="inputNanme5" class="form-label">structure assurance </label>
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
                                            <div class="modal-footer" style="background-color: silver">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Fermer</button>
                                                <button type="submit" class="btn btn-primary">Enregistrer</button>
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
                            <table class="table datatable">
                                <thead class="bg-primary">
                                    <tr>
                                        <!-- <th scope="col">#</th> -->
                                        <th scope="col">Structure </th>
                                        <th scope="col">telephone </th>
                                        <th scope="col">adresse </th>
                                        <th scope="col">email </th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($maison_assurances as $maison_assurance )
                                    <tr>
                                        <td>{{ $maison_assurance->maison_assurance}}</td>
                                        <td>{{ $maison_assurance->telephone}}</td>
                                        <td>{{ $maison_assurance->adresse}}</td>
                                        <td>{{ $maison_assurance->mail}}</td>
                                       <td>
                                            <a href="{{route('ad.sante.maison.assurance.edit',encrypt($maison_assurance->id))}}" > <button type="button" class="btn btn-primary">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </a>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal"><i class="bi bi-trash"></i></button>

                                            <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <!-- Vertical Form -->
                                                        <div class="modal-body">
                                                            <form method="post" wire:submit.prevent='update'>
                                                                @csrf
                                                                <div class="modal-header"
                                                                    style="background-color: silver">
                                                                    <h5 class="modal-title">Ajouter maison_assurance</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <div class="col-12">
                                                                        <label for="inputNanme5"
                                                                            class="form-label">Libellé </label>
                                                                        <input type="text" wire:model="libelle_maison_assurance"
                                                                            class="form-control" id="inputNanme5">
                                                                        @error('libelle_maison_assurance')
                                                                        <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label for="inputNanme5"
                                                                            class="form-label">prix</label>
                                                                        <input type="text" wire:model="prix"
                                                                            class="form-control" id="inputNanme5">
                                                                        @error('prix')
                                                                        <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer"
                                                                    style="background-color: silver">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save
                                                                        changes</button>
                                                                </div>
                                                            </form><!-- Vertical Form -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <!-- Vertical Form -->
                                                            <div class="modal-body">
                                                                <div class="alert alert-danger">
                                                                    <i class="bx bx-shield-quarter"></i> Confirmer la
                                                                    suppression de la structure : {{ $maison_assurance->libelle_maison_assurance}}
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer text-center">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    wire:click='deleteConfirmation({{$maison_assurance->id}})'
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
</div>

