<div>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1> medicaments</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                    <li class="breadcrumb-item">param</li>
                    <li class="breadcrumb-item active">medicament</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">

                                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addmedicamentModal">
                                    Ajouter medicament
                                </button> --}}
                            </h5>
                            <!-- Basic Modal -->
                            <div wire:ignore.self class="modal fade" id="addmedicamentModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Vertical Form -->
                                        <form method="post" wire:submit.prevent='save'>
                                            @csrf
                                            <div class="modal-header" style="background-color: silver">
                                                <h5 class="modal-title">Ajouter medicament</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="col-md-12">
                                                    <label for="inputNanme5" class="form-label">medicament medicale </label>
                                                    <input type="text" wire:model="medicament" class="form-control"
                                                        id="inputNanme5">
                                                    @error('medicament')
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
                                        <th scope="col">Dénomination  </th>
                                        <th scope="col">Forme pharmaceutique </th>
                                        <th scope="col">Voies d'administration </th>
                                        {{-- <th scope="col">Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($medicaments as $medicament )
                                    <tr>
                                        <td>{{ $medicament->denomination}}</td>
                                        <td>{{ $medicament->forme_pharmaceutique}}</td>
                                        <td>{{ $medicament->voies_administrative}}</td>

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

