<main id="main" class="main">

    <div class="pagetitle">
        <h1>MEDECIN ASSOCIERS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                <li class="breadcrumb-item">param</li>
                <li class="breadcrumb-item active">association medecin utilisateur</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <P>
                    @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if ($message = Session::get('danger'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-octagon me-1"></i>
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                </P>
                <div class="card">
                    <div class="card-body">

                        <!-- Vertical Form -->
                        <form class="row g-3" wire:submit.prevent='save'>
                            @csrf
                            <div class="col-12">
                                <div class="col-12">
                                    <label for="validationDefault04" class="form-label">Role utilisateur</label>
                                    <select class="form-select" id="role" name="role" wire:model.live='role'>
                                        <option selected></option>
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->role }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="validationDefault04" class="form-label">Utilisateur</label>
                                    <select class="form-select" id="agence" name="utilisateur" wire:model='utilisateur'>
                                        <option selected></option>
                                        @foreach ($utilisateurs as $utilisateur)
                                        <option value="{{ $utilisateur->id }}">{{ $utilisateur->nom }}</option>
                                        @endforeach
                                    </select>
                                    @error('utilisateur')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <label for="validationDefault04" class="form-label">Medecin</label>
                                <select class="form-select" id="agence" name="medecin" wire:model='medecin'>
                                    <option selected></option>
                                    @foreach ($medecins as $medecin)
                                    <option value="{{ $medecin->id }}">{{ $medecin->nom }}</option>
                                    @endforeach
                                </select>
                                @error('medecin')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form><!-- Vertical Form -->
                    </div>
                <div>
            </div>
            
    </section>

</main><!-- End #main -->
