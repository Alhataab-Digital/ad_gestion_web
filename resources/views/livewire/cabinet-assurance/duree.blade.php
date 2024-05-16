<main id="main" class="main">

    <div class="pagetitle">
        <h1>durees</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                <li class="breadcrumb-item">param</li>
                <li class="breadcrumb-item active">duree</li>
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
                                Ajouter duree
                            </button>
                        </h5>
                        <div wire:ignore.self class="modal fade" id="basicModal" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content" >
                                    <div class="modal-header"  style="background-color: silver">
                                        <h5 class="modal-title">Ajouter duree</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <!-- Multi Columns Form -->
                                        <form class="row g-3" wire:submit.prevent='save'>

                                            <div class="col-md-4">
                                                <label for="inputName5" class="form-label">Code <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" wire:model='nbr_duree'
                                                    id="inputName5">
                                                @error('nbr_duree')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-8">
                                                <label for="inputName5" class="form-label">Libelle <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" wire:model='libelle_duree'
                                                    id="inputName5">
                                                @error('libelle_duree')
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
                                    <th scope="col">Code</th>
                                    <th scope="col">Libelle </th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($durees as $duree )
                                <tr>
                                    <td>{{ $duree->nbr_duree}}</td>
                                    <td>{{ $duree->libelle_duree}}</td>
                                    <td>
                                        <a wire:navigate href="/duree/{{encrypt($duree->id)}}/edit">
                                            <button type="button" class="btn btn-primary"><i
                                                    class="bi bi-pencil"></i></button>
                                        </a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{$duree->id}}"><i
                                                class="bi bi-trash"></i></button>
                                        <div wire:ignore.self class="modal fade" id="deleteModal{{$duree->id}}"
                                            tabindex="-1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <!-- Vertical Form -->
                                                    <div class="modal-body">
                                                        <div class="alert alert-danger">
                                                            <i class="bx bx-shield-quarter"></i> Confirmer la
                                                            suppression du duree : {{ $duree->nbr_duree}}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer text-center">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit"
                                                            wire:click='deleteConfirmation({{$duree->id}})'
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

