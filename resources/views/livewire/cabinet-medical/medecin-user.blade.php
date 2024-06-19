
<main id="main" class="main">

    <div class="pagetitle">
        <h1>MEDECIN ASSOCIERS UTILISATEUR</h1>
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
            <div class="col-lg-12">
                <div class="card-header bg-secondary text-white" >
                    MEDECIN ASSOCIERS UTILISATEUR
                </div>
                <div class="card">
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
                    <div class="card-body">
                        <div class="card-title">
                            ASSICIER UN MEDECIN
                        </div>
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
                                        <option value="{{ $utilisateur->id }}">{{ $utilisateur->nom.' '.$utilisateur->prenom.' '.$utilisateur->role->role }}</option>
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
                                    <option value="{{ $medecin->id }}">{{ $medecin->titre.' '.$medecin->nom.' '.$medecin->prenom}} <strong>({{ $medecin->specialite->specialite_medecin}})</strong></option>
                                    @endforeach
                                </select>
                                @error('medecin')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form><!-- Vertical Form -->
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">

                        </h5>

                    </div>
                    <div>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead class="bg-primary">
                                <tr>
                                    <!-- <th scope="col">#</th> -->
                                    <th scope="col">Nom </th>
                                    <th scope="col">Prenom</th>
                                    <th scope="col">Adresse</th>
                                    <th scope="col">Medecin associer</th>
                                    <th scope="col">Categorie</th>
                                    <th scope="col">Specialité</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <!-- <th scope="row">{{ $user->id }}</th> -->
                                    <td>{{ $user->nom }}</td>
                                    <td>{{ $user->prenom }}</td>
                                    <td>{{ $user->adresse }}</td>
                                    <td>{{ $user->medecin->categorie->categorie_medecin}}</td>
                                    <td>{{ $user->medecin->titre.' '.$user->medecin->nom.' '.$user->medecin->prenom }}</td>
                                    <td>{{ $user->medecin->specialite->specialite_medecin}}</td>

                                    <td>
                                        <!--a href="">
                                <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
                            </a>
                            <a href="">
                                <button type="button" class="btn btn-success"><i class="bi bi-check-circle"></i></button>
                            </a-->
                                            <button type="button" class="btn btn-danger"  wire:click='delete({{$user->id}})' ><i
                                                    class="bi bi-exclamation-octagon"></i></button>
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

</main><!-- End #main -->
