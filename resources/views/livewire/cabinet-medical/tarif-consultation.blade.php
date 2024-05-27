<div>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>tarif consultations</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                    <li class="breadcrumb-item">param</li>
                    <li class="breadcrumb-item active">tarif consultation</li>
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
                                    data-bs-target="#addtarif_consultationModal">
                                    Ajouter tarif consultation
                                </button>
                            </h5>
                            <!-- Basic Modal -->
                            <div wire:ignore.self class="modal fade" id="addtarif_consultationModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Vertical Form -->
                                        <form method="post" wire:submit.prevent='save'>
                                            @csrf
                                            <div class="modal-header" style="background-color: silver">
                                                <h5 class="modal-title">Ajouter tarif_consultation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-12">
                                                    <label for="inputState" class="form-label">Civilité <span style="color: red">*</span></label>
                                                    <select id="inputState" class="form-select" wire:model='type_consultation'>
                                                        <option selected></option>
                                                        @foreach ($type_consultations as $type_consultation )
                                                        <option value="{{$type_consultation->id}}"> {{$type_consultation->type_consultation}} </option>
                                                        @endforeach
                                                    </select>
                                                    @error('type_consultation')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputNanme5" class="form-label">tarif</label>
                                                    <input type="text" wire:model="montant" class="form-control"
                                                        id="inputNanme5">
                                                    @error('montant')
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
                                        <th scope="col">Type consultation </th>
                                        <th scope="col">Tarif consultation </th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tarif_consultations as $tarif_consultation )
                                    <tr>
                                        <td>{{ $tarif_consultation->type_consultation->type_consultation}}</td>
                                        <td style="text-align:right">{{ number_format($tarif_consultation->montant,2,","," ").'
                                            '.$tarif_consultation->user->agence->devise->unite}}</td>
                                        <td>
                                            <a href="{{route('ad.sante.edit.tarif.consultation',encrypt($tarif_consultation->id))}}" > <button type="button" class="btn btn-primary">
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
                                                                    <h5 class="modal-title">Ajouter tarif_consultation</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <div class="col-12">
                                                                        <label for="inputNanme5"
                                                                            class="form-label">Libellé </label>
                                                                        <input type="text" wire:model="libelle_tarif_consultation"
                                                                            class="form-control" id="inputNanme5">
                                                                        @error('libelle_tarif_consultation')
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
                                                                    suppression du tarif_consultation : {{ $tarif_consultation->libelle_tarif_consultation}}
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer text-center">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    wire:click='deleteConfirmation({{$tarif_consultation->id}})'
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
@push('scripts')
<script>
    windows.addEventListner('close-modal', event=>{
        $('#addtarif_consultationModal').modal('hide');
    })
    windows.addEventListner('show-edit-modal', event=>{
        $('#editModal').modal('show');
    })
</script>

@endpush
