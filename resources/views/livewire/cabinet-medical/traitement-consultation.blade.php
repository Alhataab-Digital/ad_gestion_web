 <main id="main" class="main">

    <div class="pagetitle">
      {{-- <h1>Form Elements</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Elements</li>
        </ol>
      </nav> --}}
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="card-title text-white">Traitement consultation : {{$consultation->tarif->libelle_tarif}}</h5>
            </div>
            <div class="card-body">
                <br>
              <!-- General Form Elements -->
              <form   wire:submit.prevent='save'>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Motif</label>
                  <div class="col-sm-10">
                    <input type="text" wire:model='motif' class="form-control">
                    @error('motif')
                      <span class="text-danger">{{$message}}</span>
                        @enderror
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Examen biologique</label>
                  <div class="col-sm-10">
                    <textarea wire:model='examen_biologique' class="form-control" style="height: 100px"></textarea>
                    @error('examen_biologique')
                      <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Examen radiologique</label>
                    <div class="col-sm-10">
                      <textarea wire:model='examen_radiologique' class="form-control" style="height: 100px"></textarea>
                      @error('examen_radiologique')
                      <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Examen clinique</label>
                    <div class="col-sm-10">
                      <textarea wire:model='examen_clinique' class="form-control" style="height: 100px"></textarea>
                      @error('examen_clinique')
                      <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">diagnostique</label>
                    <div class="col-sm-10">
                      <textarea wire:model='diagnostique' class="form-control" style="height: 100px"></textarea>
                      @error('diagnostique')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Traitement</label>
                    <div class="col-sm-10">
                        <textarea wire:model='traitement' class="form-control" style="height: 100px"></textarea>
                        @error('traitement')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                  </div>
                <div class="card-footer row mb-3">
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>

        <div class="col-lg-6">

          <div class="card">
            <div class="card-header bg-dark ">
                <h5 class="card-title text-white">Information patient</h5>
            </div>
            <div class="card-body">

             <!-- Multi Columns Form -->
             <form class="row g-3">
                <div class="col-md-4">
                    <label for="inputName5" class="form-label">Civilité</label>
                    <input type="text" class="form-control" wire:model='civilite' id="inputName5">
                    @error('civilite')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-8">
                    <label for="inputName5" class="form-label">Prenom</label>
                    <input type="text" class="form-control" wire:model='prenom' id="inputName5">
                    @error('prenom')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label for="inputName5" class="form-label">Nom du pere / Nom de famille</label>
                    <input type="text" class="form-control" wire:model='nom' id="inputName5">
                    @error('nom')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Situation</label>
                    <input type="text" class="form-control" wire:model='situation' id="inputName5">
                    @error('situation')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label for="inputPassword5" class="form-label">Age</label>
                    <input type="number" class="form-control" wire:model='age' id="inputPassword5">
                    @error('age')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="inputAddress5" class="form-label">Telephone</label>
                    <input type="text" class="form-control" wire:model='telephone' id="inputAddres5s">
                    @error('telephone')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="inputAddress2" class="form-label">Addresse</label>
                    <input type="text" class="form-control" wire:model='adresse' id="inputAddress2">
                    @error('adresse')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">Taille</label>
                    <input type="text" wire:model='taille' class="form-control" id="inputCity">
                </div>
                <div class="col-md-6">
                    <label for="inputZip" class="form-label">Poid</label>
                    <input type="text" wire:model='poid' class="form-control" id="inputZip">
                </div>

            </form><!-- End Multi Columns Form -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

