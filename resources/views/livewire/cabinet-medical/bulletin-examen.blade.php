<main id="main" class="main">

    <div class="pagetitle">
        {{-- <h1>Consultation</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                <li class="breadcrumb-item">param</li>
                <li class="breadcrumb-item active">Consultation</li>
            </ol>
        </nav> --}}
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="form-signin w-80 m-auto col-lg-4">
                <form wire:submit.prevent='valider' class="row g-0">
                    @csrf
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            Numero bulletin examen medicale
                        </div>
                        <p>
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
                        </p>
                        <div class="card-body">
                        <div class="col-12">
                            {{-- <label for="inputAddress5" class="form-label"><span
                                    style="color: red">*</span></label> --}}
                            <input type="text" class="form-control" wire:model='numero_ordre'
                                id="inputAddres5s">
                            @error('numero_ordre')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                        <br><br>
                        <div class="card-footer bg-dark text-white text-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Valider</button>
                        </div>
                </form><!-- Vertical Form -->
            </div>
        </div>
        </div>
    </section>

</main>
<!-- End #main -->
