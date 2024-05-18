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
            <div class="form-signin w-80 m-auto col-lg-8">

                <!-- Card with header and footer -->
                <div class="card">
                    <div class="card-header bg-dark text-white ">
                        FORMUMAIRE DE CONSULTATION
                    </div>
                    <div class="card-body">

                        <!-- Multi Columns Form -->
                        <form class="row g-3" wire:submit.prevent='enregistrer'>
                            <div class="col-md-4">
                                <label for="inputState" class="form-label">Civilité <span
                                        style="color: red">*</span></label>
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
                                <label for="inputName5" class="form-label">Prenom <span
                                    style="color: red">*</span></label>
                                <input type="text" class="form-control" wire:model='prenom' id="inputName5">
                                @error('prenom')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="inputName5" class="form-label">Nom du pere / Nom de famille <span
                                    style="color: red">*</span></label>
                                <input type="text" class="form-control" wire:model='nom' id="inputName5">
                                @error('nom')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="inputState" class="form-label">Situation <span
                                    style="color: red">*</span></label>
                                <select id="inputState" class="form-select" wire:model='situation'>
                                    <option selected></option>
                                    <option value="Celibataire">Celibataire</option>
                                    <option value="Marié(e)">Marié(e)</option>
                                    <option value="Veuf(ve)">Veuf(ve)</option>
                                    <option value="Divorcé(e)">Divorcé(e)</option>
                                </select>
                                @error('situation')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="inputPassword5" class="form-label">Age <span
                                    style="color: red">*</span></label>
                                <input type="number" class="form-control" wire:model='age' id="inputPassword5">
                                @error('age')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
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
                            <div class="col-12">
                                <label for="inputAddress2" class="form-label">Addresse <span
                                    style="color: red">*</span></label>
                                <input type="text" class="form-control" wire:model='adresse' id="inputAddress2">
                                @error('adresse')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                    <br><br>
                    <hr>
                    <div>

                    </div>
                        <div class="col-md-6 bg-secondary text-white">
                            <label for="inputState" class="form-label">Type de consultation <span
                                style="color: red">*</span></label>
                            <select id="inputState"  class="form-select" name="consultation" wire:model.live='consultation'>
                                <option selected>Choisir le type consultation</option>
                                @foreach ($tarifs as $tarif )
                                <option value="{{$tarif->id}}">{{$tarif->libelle_tarif}}</option>
                                @endforeach
                            </select>
                            @error('type_consultation')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                        </div>
                        <div class="col-md-6  bg-secondary text-white">
                            <label for="inputState" class="form-label">Medecin<span
                                style="color: red">*</span></label>
                            <select id="inputState" class="form-select" name="planification" wire:model='planification'>
                                <option selected>Choisir le medecin</option>
                                @foreach ($planifications as $planification )
                                <option value="{{$planification->id}}">{{$planification->medecin->nom}}</option>
                                @endforeach
                            </select>
                          <br class="bg-secondary text-white"><br>
                        </div>

                        {{-- <div class="col-md-6">
                            <label for="inputPassword5" class="form-label">Motif consultation</label>
                            <input type="text" class="form-control" wire:model='age' id="inputPassword5">
                            @error('age')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="inputState" class="form-label">Examen clinique</label>
                            <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="inputState" class="form-label">Examen biologique</label>
                            <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="inputState" class="form-label">Examen Radiologique</label>
                            <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="inputState" class="form-label">Diagnostique</label>
                            <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="inputState" class="form-label">Traitement</label>
                            <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
                        </div> --}}
                    </div>
                    <div class="card-footer bg-dark text-white">
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
