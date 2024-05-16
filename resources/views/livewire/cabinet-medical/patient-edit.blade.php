<div>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>MODIFICATION PATIENT</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                    <li class="breadcrumb-item">param</li>
                    <li class="breadcrumb-item active">PATIENT </li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">


                <div class=" form-signin w-90 m-auto col-lg-10">

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
                            <!-- Card with header and footer -->
                            <div class="card">
                                <div class="card-header bg-info text-white ">
                                    MODIFICATION DU PATIENT
                                </div>

                                <div class="card-body">

                                    <!-- Multi Columns Form -->
                                    <form class="row g-3" wire:submit.prevent='update'>
                                        <div class="col-md-4">
                                            <label for="inputState" class="form-label">Civilité <span style="color: red">*</span></label>
                                            <select id="inputState" class="form-select" wire:model='civilite'>
                                                <option selected></option>
                                                <option value="Monsieur"> Monsieur </option>
                                                <option value="Madame"> Madame </option>
                                                <option value="Mademoiselle"> Mademoiselle </option>
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
                                        <div class="col-md-4">
                                            <label for="inputState" class="form-label">Situation</label>
                                            <select id="inputState" class="form-select" wire:model='situation'>
                                                <option value="Celibataire">Celibataire</option>
                                                <option value="Marié(e)">Marié(e)</option>
                                                <option value="Veuf(ve)">Veuf(ve)</option>
                                                <option value="Divorcé(e)">Divorcé(e)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="inputPassword5" class="form-label">Age</label>
                                            <input type="number" class="form-control" wire:model='age'
                                                id="inputPassword5">
                                            @error('age')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <label for="inputAddress5" class="form-label">Telephone</label>
                                            <input type="text" class="form-control" wire:model='telephone'
                                                id="inputAddres5s">
                                            @error('telephone')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="inputAddress2" class="form-label">Addresse</label>
                                            <input type="text" class="form-control" wire:model='adresse'
                                                id="inputAddress2">
                                            @error('adresse')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCity" class="form-label">Taille</label>
                                            <input type="text" class="form-control" id="inputCity">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputZip" class="form-label">Poid</label>
                                            <input type="text" class="form-control" id="inputZip">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputEmail5" class="form-label">Email</label>
                                            <input type="email" class="form-control" wire:model='mail'
                                                id="inputEmail5">
                                            @error('mail')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputPassword5" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="inputPassword5">
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Modifier</button>
                                            {{-- <button type="reset" class="btn btn-secondary">Reset</button> --}}
                                        </div>
                                    </form><!-- End Multi Columns Form -->
                                </div>
                                <div class="card-footer bg-info text-white">
                                    MODIFICATION DU PATIENT
                                </div>
                            </div><!-- End Card with header and footer -->
                            <!-- Card with header and footer -->

                </div>

            </div>
        </section>

    </main>
    <!-- End #main -->

</div>
