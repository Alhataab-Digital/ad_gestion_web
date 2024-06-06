<div>
    <main id="main" class="main">

        <div class="pagetitle">
            <div class="card-header bg-info ">
                <h1>
                    <li class="list-group-item d-flex justify-content-between align-items-center text-white">
                        MISE A JOUR INFORMATION GENERALE DU  MEDECIN
                        <span class=" bg-info rounded-pill">
                            <a wire:navigate href="{{route('ad.sante.index.medecin')}}">
                                <button class="btn btn-primary "><i class="bi bi-receipt"></i></button>
                                </a>
                                <a wire:navigate href="{{route('ad.sante.dossier.medecin',encrypt($medecin->id))}}">
                                    <button type="button" class="btn btn-secondary"><i
                                            class="bx bx-folder-plus"></i></button>
                                </a>
                        </span>
                      </li>
                </h1>
            </div>

            {{-- <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                    <li class="breadcrumb-item">param</li>
                    <li class="breadcrumb-item active">medecin </li>
                </ol>
            </nav> --}}
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <h5 >
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
                <div class=" form-signin w-90 m-auto col-lg-4">
                            <!-- Card with header and footer -->
                            <div class="card">
                                <div class="card-header bg-info text-white ">
                                   MODIFICATION IDENTITE medecin
                                </div>

                                <div class="card-body">

                                    <!-- Multi Columns Form -->
                                    <form class="row g-3" wire:submit.prevent='update'>
                                        <div class="col-md-4">
                                            <label for="inputState" class="form-label">Civilité <span style="color: red">*</span></label>
                                            <select id="inputState" class="form-select" wire:model='civilite'>
                                                @foreach ($civilites as $civilite )
                                                <option value="{{$civilite->id}}"> {{$civilite->civilite}} </option>
                                                @endforeach
                                            </select>
                                            @error('civilite')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-8">
                                            <label for="inputName5" class="form-label">Prenom</label>
                                            <input type="text" class="form-control" wire:model='prenom'
                                                id="inputName5">
                                            @error('prenom')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputName5" class="form-label">Nom du pere / Nom de famille</label>
                                            <input type="text" class="form-control" wire:model='nom'
                                                id="inputName5">
                                            @error('nom')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputState" class="form-label">Situation</label>
                                            <select id="inputState" class="form-select" wire:model='situation'>
                                                @foreach ($situations as $situation )
                                                    <option value="{{$situation->id}}"> {{$situation->situation_matrimoniale}} </option>
                                                @endforeach
                                            </select>
                                            @error('situation')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputPassword5" class="form-label"> date naissance</label>
                                            <input type="date" class="form-control" wire:model='date_naissance'
                                                id="inputPassword5">
                                            @error('date_naissance')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputPassword5" class="form-label"> Lieu naissance</label>
                                            <input type="text" class="form-control" wire:model='lieu_naissance'
                                                id="inputPassword5">
                                            @error('lieu_naissance')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputPassword5" class="form-label"> Profession</label>
                                            <input type="text" class="form-control" wire:model='profession'
                                                id="inputPassword5">
                                            @error('profession')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>


                                </div>
                                <div class="card-footer">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Mise à jour identite</button>
                                        {{-- <button type="reset" class="btn btn-secondary">Reset</button> --}}
                                    </div>
                                </form><!-- End Multi Columns Form -->
                                </div>
                            </div><!-- End Card with header and footer -->
                            <!-- Card with header and footer -->

                </div>
                <div class=" form-signin w-90 m-auto col-lg-4">

                    <!-- Card with header and footer -->
                    <div class="card">
                        <div class="card-header bg-info text-white ">
                            MODIFICATION COORDONNEES DU medecin
                        </div>

                        <div class="card-body">

                            <!-- Multi Columns Form -->
                            <form class="row g-3" wire:submit.prevent='updateCoordonnees'>

                                <div class="col-6">
                                    <label for="inputAddress5" class="form-label">Telephone</label>
                                    <input type="text" class="form-control" wire:model='telephone'
                                        id="inputAddres5s">
                                    @error('telephone')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="inputAddress2" class="form-label">Addresse</label>
                                    <input type="text" class="form-control" wire:model='adresse'
                                        id="inputAddress2">
                                    @error('adresse')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="inputAddress2" class="form-label">Complement adresse</label>
                                    <input type="text" class="form-control" wire:model='complement_adresse'
                                        id="inputAddress2">
                                    @error('complement_adresse')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="inputEmail5" class="form-label">Email</label>
                                    <input type="email" class="form-control" wire:model='mail'
                                        id="inputEmail5">
                                    @error('mail')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="inputPassword5" class="form-label">Personne à contacter</label>
                                    <input type="text" class="form-control" id="inputPassword5" wire:model='personne_contact'>
                                </div>

                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Mise à jour coordonnées</button>
                                {{-- <button type="reset" class="btn btn-secondary">Reset</button> --}}
                            </div>
                        </form><!-- End Multi Columns Form -->
                        </div>
                    </div><!-- End Card with header and footer -->
                    <!-- Card with header and footer -->

                </div>
                <div class=" form-signin w-90 m-auto col-lg-4">
                    <!-- Card with header and footer -->
                    <div class="card">
                        <div class="card-header bg-info text-white ">
                            MODIFICATION INFORMATION PROFESSIONNEL DU MEDECIN
                        </div>

                        <div class="card-body">

                            <!-- Multi Columns Form -->
                            <form class="row g-3" wire:submit.prevent='updateInfoMedicale'>

                                <div class="col-md-12">
                                    <label for="inputName5" class="form-label">N° Matricule</label>
                                    <input type="text" class="form-control" wire:model='matricule'
                                        id="inputName5" disabled>
                                    @error('matricule')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="inputState" class="form-label">Specialite </label>
                                    <select id="inputState" class="form-select" wire:model='specialite'>
                                        <option selected></option>
                                        @foreach ($specialites as $specialite )
                                        <option value="{{$specialite->id}}"> {{$specialite->specialite_medecin}} </option>
                                        @endforeach
                                    </select>
                                    @error('specialite')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="inputState" class="form-label">Categorie </label>
                                    <select id="inputState" class="form-select" wire:model='categorie'>
                                        <option selected></option>
                                        @foreach ($categories as $categorie )
                                        <option value="{{$categorie->id}}"> {{$categorie->categorie_medecin}} </option>
                                        @endforeach
                                    </select>
                                    @error('categorie')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="inputEmail5" class="form-label">Titre</label>
                                    <input type="text" class="form-control" wire:model='titre'
                                        id="inputEmail5">
                                    @error('titre')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Mise à jour info medicale</button>
                                {{-- <button type="reset" class="btn btn-secondary">Reset</button> --}}
                            </div>
                        </form><!-- End Multi Columns Form -->
                        </div>
                    </div><!-- End Card with header and footer -->
                    <!-- Card with header and footer -->

                </div>

            </div>
        </section>

    </main>
    <!-- End #main -->

</div>
