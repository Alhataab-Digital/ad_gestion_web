<main id="main" class="main">

    {{-- <div class=" pagetitle">
        <h1>Form Elements</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active">Elements</li>
            </ol>
        </nav>
    </div> --}}
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="m-auto form-signin w-80 col-lg-8">

                <!-- Card with header and footer -->
                <div class="card">
                    <div class="text-white card-header bg-dark ">
                        PRISE DE RENDEZ VOUS
                    </div>
                    <div class="card-body">

                        <!-- Multi Columns Form -->
                        <form class="row g-3" wire:submit.prevent='enregistrer'>

                            <div class="col-md-2">
                                <label for="inputState" class="form-label">Civilité <span
                                        style="color: red">*</span></label>
                                <select id="inputState" class="form-select" wire:model='civilite'>
                                    <option selected></option>
                                    @foreach ($civilites as $civilite )
                                    <option value="{{$civilite->id}}"> {{$civilite->civilite}} </option>
                                    @endforeach
                                </select>
                                @error('civilite')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="inputName5" class="form-label">Prenom <span
                                        style="color: red">*</span></label>
                                <input type="text" class="form-control" wire:model='prenom' id="inputName5">
                                @error('prenom')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="inputName5" class="form-label">Nom du pere / Nom de famille <span
                                        style="color: red">*</span></label>
                                <input type="text" class="form-control" wire:model='nom' id="inputName5">
                                @error('nom')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Situation</label>
                                <select id="inputState" class="form-select" wire:model='situation'>

                                    <option selected></option>
                                    @foreach ($situations as $situation )
                                    <option value="{{$situation->id}}"> {{$situation->situation_matrimoniale}} </option>
                                    @endforeach
                                </select>
                                @error('situation')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Profession</label>
                                <input type="text" class="form-control" wire:model='profession' id="inputName5">

                            </div>
                            <div class="col-md-6">
                                <label for="inputPassword5" class="form-label">Date naissance</label>
                                <input type="date" class="form-control" wire:model='date_naissance' id="inputPassword5">

                            </div>
                            <div class="col-md-6">
                                <label for="inputPassword5" class="form-label">Lieu naissance</label>
                                <input type="text" class="form-control" wire:model='lieu_naissance' id="inputPassword5">

                            </div>
                            <div class="col-6">
                                <label for="inputAddress5" class="form-label">Telephone <span
                                        style="color: red">*</span></label>
                                <input type="text" class="form-control" wire:model='telephone' id="inputAddres5s"
                                    readonly>
                                @error('telephone')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="inputAddress2" class="form-label">Addresse <span
                                        style="color: red">*</span></label>
                                <input type="text" class="form-control" wire:model='adresse' id="inputAddress2">
                                @error('adresse')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <br>
                            <hr>

                            <div class="text-white col-md-12 bg-secondary">
                                <label for="inputState" class="form-label">Motif du rendez vous</label>
                                <select id="inputState" class="form-select" wire:model='motif'>
                                    <option selected></option>
                                    @foreach ($motifs as $motif )
                                    <option value="{{$motif->motif}}"> {{$motif->motif}} </option>
                                    @endforeach
                                </select>
                                @error('motif')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <br class="text-white bg-secondary"><br>
                            </div>
                            <div class="text-white col-md-6 bg-secondary">
                                <label for="inputState" class="form-label">type consultation <span
                                        style="color: red">*</span></label>
                                <select id="inputState" class="form-select" name="type_consultation"
                                    wire:model.live='type_consultation'>
                                    <option selected></option>
                                    @foreach ($type_consultations as $type_consultation )
                                    <option value="{{$type_consultation->id}}">{{$type_consultation->type_consultation}}</option>
                                    @endforeach
                                </select>
                                @error('type_consultation')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="text-white col-md-6 bg-secondary">
                                <label for="inputState" class="form-label">Date et heure planifier<span
                                        style="color: red">*</span></label>
                                <select id="inputState" class="form-select" name="planification_date"
                                    wire:model.live='planification_date'>
                                    <option selected></option>
                                    @foreach ($planification_dates as $planification_date )
                                    <option value="{{$planification_date->id}}">
                                        {{ 'Le '.\Carbon\Carbon::parse($planification_date->jour_semaine)->format('d-m-Y').' à '.$planification_date->heure_debut}}
                                    </option>
                                    @endforeach
                                </select>
                                @error('planification_date')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <br class="text-white bg-secondary"><br>
                            </div>
                            <div class="text-white col-md-6 bg-secondary">
                                <label for="inputState" class="form-label">Medecin planifier<span
                                        style="color: red">*</span></label>
                                <select id="inputState" class="form-select" name="planification_medecin"
                                    wire:model.live='planification_medecin'>
                                    <option selected></option>
                                    @foreach ($planification_medecins as $planification_medecin )
                                    <option value="{{$planification_medecin->id}}">
                                        {{$planification_medecin->medecin->nom.'
                                        '.$planification_medecin->medecin->prenom.' :
                                        '.$planification_medecin->medecin->specialite->specialite_medecin}}</option>
                                    @endforeach
                                </select>
                                @error('planification_medecin')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <br class="text-white bg-secondary"><br>
                            </div>

                            <div class="text-white col-6 bg-secondary">
                                <label for="inputAddress2" class="form-label">Tarif consultation<span
                                        style="color: red">*</span></label>
                                <input type="text" class="form-control" wire:model.live='tarif_montant' id="inputAddress2">
                                @error('tarif_montant')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <br class="text-white bg-secondary"><br>
                            </div>
                            <div class="text-white card-footer bg-dark">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    {{-- <button type="reset" class="btn btn-secondary">Reset</button> --}}
                                </div>
                            </div>
                        </form><!-- End Multi Columns Form -->
                    </div><!-- End Card with header and footer -->
                    <!-- Card with header and footer -->

                </div>

            </div>
    </section>

</main><!-- End #main -->
