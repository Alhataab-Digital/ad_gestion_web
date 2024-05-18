<div>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>MODIFICATION TARIF</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                    <li class="breadcrumb-item">param</li>
                    <li class="breadcrumb-item active">TARIF MEDICAL</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
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
                            </h5>
                            <!-- Vertical Form -->
                            <form wire:submit='update' class="row g-3">
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Libelle</label>
                                    <input type="text" wire:model="libelle_tarif" class="form-control" id="inputNanme4">
                                    @error('libelle_tarif')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Montant</label>
                                    <input type="text" wire:model="prix" class="form-control" id="inputNanme4">
                                    @error('prix')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Modifer</button>
                                    <a href="">
                                        <button type="button" class="btn btn-secondary">Retour</button>
                                    </a>
                                </div>
                            </form><!-- Vertical Form -->

                        </div>
                    </div>
                </div>

            </div>
        </section>

    </main><!-- End #main -->

</div>
