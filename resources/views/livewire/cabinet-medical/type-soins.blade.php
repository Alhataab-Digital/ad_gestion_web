<div>
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-white card-header bg-secondary">
                        <li class="list-group-item d-flex justify-content-between align-items-center ">
                            Type soins
                            <span class=" bg-secondary rounded-pill">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addtype_soinsModal">
                                    Ajouter
                                </button>
                                {{-- <button type="button" class="btn btn-primary ">
                                    Nouvelle vente medicament
                                </button> --}}
                            </span>
                        </li>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">

                                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addtype_soinsModal">
                                    Ajouter type soins
                                </button> --}}
                            </h5>
                            <!-- Basic Modal -->
                            <div wire:ignore.self class="modal fade" id="addtype_soinsModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Vertical Form -->
                                        <form method="post" wire:submit.prevent='save'>
                                            @csrf
                                            <div class="modal-header" style="background-color: silver">
                                                <h5 class="modal-title">Ajouter type_soins</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="col-md-12">
                                                    <label for="inputNanme5" class="form-label">type soins medicale </label>
                                                    <input type="text" wire:model="type_soins" class="form-control"
                                                        id="inputNanme5">
                                                    @error('type_soins')
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
                            <table class="table datatable">
                                <thead class="bg-primary">
                                    <tr>
                                        <!-- <th scope="col">#</th> -->
                                        <th scope="col">type soins </th>
                                        {{-- <th scope="col">contenu </th> --}}
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($type_soinss as $type_soins )
                                    <tr>
                                        <td>{{ $type_soins->type_soins}}</td>
                                       <td>
                                            <a href="{{route('ad.sante.edit.type.soins',encrypt($type_soins->id))}}" > <button type="button" class="btn btn-primary">
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
                                                                    <h5 class="modal-title">Ajouter type_soins</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <div class="col-12">
                                                                        <label for="inputNanme5"
                                                                            class="form-label">Libellé </label>
                                                                        <input type="text" wire:model="libelle_type_soins"
                                                                            class="form-control" id="inputNanme5">
                                                                        @error('libelle_type_soins')
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
                                                                    suppression du type_soins : {{ $type_soins->libelle_type_soins}}
                                                                </div>
                                                            </div>
                                                            <div class="text-center modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    wire:click='deleteConfirmation({{$type_soins->id}})'
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

