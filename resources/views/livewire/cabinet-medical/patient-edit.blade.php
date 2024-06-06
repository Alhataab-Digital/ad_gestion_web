<div>
    <main id="main" class="main">

        <div class="pagetitle">
            <div class="card-header bg-info ">
                <h1>
                    <li class="list-group-item d-flex justify-content-between align-items-center text-white">
                        MISE A JOUR INFORMATION GENERALE DU  PATIENT
                        <span class=" bg-info rounded-pill">
                            <a wire:navigate href="{{route('ad.sante.index.patient')}}">
                                <button class="btn btn-primary "><i class="bi bi-receipt"></i></button>
                                </a>
                                <a wire:navigate href="{{route('ad.sante.dossier.patient',encrypt($patient->id))}}">
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
                    <li class="breadcrumb-item active">PATIENT </li>
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
                                   MODIFICATION IDENTITE PATIENT
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
                                            <label for="inputPassword5" class="form-label"> Profession</label>
                                            <input type="text" class="form-control" wire:model='profession'
                                                id="inputPassword5">
                                            @error('profession')
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
                            MODIFICATION COORDONNEES DU PATIENT
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
                            MODIFICATION INFORMATION MEDICALE DU PATIENT
                        </div>

                        <div class="card-body">

                            <!-- Multi Columns Form -->
                            <form class="row g-3" wire:submit.prevent='updateInfoMedicale'>

                                <div class="col-md-12">
                                    <label for="inputName5" class="form-label">N° Patient</label>
                                    <input type="text" class="form-control" wire:model='numero_patient'
                                        id="inputName5" disabled>
                                    @error('prenom')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Taille(m)</label>
                                    <input type="text" class="form-control" id="inputCity" wire:model='taille'>
                                    @error('taille')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="inputZip" class="form-label">Poid (kg)</label>
                                    <input type="text" class="form-control" id="inputZip" wire:model='poid'>
                                    @error('poid')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                {{-- <div class="col-md-6">
                                    <label for="inputEmail5" class="form-label">Temperature</label>
                                    <input type="text" class="form-control" wire:model='temperature'
                                        id="inputEmail5">
                                    @error('temperature')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> --}}
                                <div class="col-md-12">
                                    <label for="inputEmail5" class="form-label">groupe sanguin</label>
                                    <input type="text" class="form-control" wire:model='groupe_sanguin'
                                        id="inputEmail5">
                                    @error('groupe_sanguin')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="inputPassword5" class="form-label">ICM</label>
                                    <input type="text" class="form-control" id="inputPassword5"  wire:model='icm' disabled>

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
                <div class="form-signin w-90 m-auto col-lg-8">
                    <div class="card">
                        <div class="card-header bg-ligth text-white">
                            <li class="list-group-item d-flex justify-content-between align-items-center text-white">
                                ASSUREURS
                                <span class=" bg-primary rounded-pill">
                                    @if($prise_en_charges)
                                    @else
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#addAssurance"><i class="bi bi-plus"></i></button>
                                    @endif

                                </span>
                              </li>
                        </div>
                         <!-- Basic Modal -->
                         <div wire:ignore.self class="modal fade" id="addAssurance" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Vertical Form -->
                                    <form method="post" wire:submit.prevent='savePriseEnCharge'>
                                        @csrf
                                        <div class="modal-header" style="background-color: silver">
                                            <h5 class="modal-title">Ajouter assureur</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="col-md-12">
                                                <label for="inputState" class="form-label">Assureur <span style="color: red">*</span></label>
                                                <select id="inputState" class="form-select" wire:model='maison_assurance'>
                                                    <option selected></option>
                                                    @foreach ($maison_assurances as $maison_assurance )
                                                    <option value="{{$maison_assurance->id}}"> {{$maison_assurance->maison_assurance}} </option>
                                                    @endforeach
                                                </select>
                                                @error('maison_assurance')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="inputNanme5" class="form-label">N° adherant </label>
                                                <input type="text" wire:model="numero_assurer" class="form-control"
                                                    id="inputNanme5">
                                                @error('numero_assurer')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <fieldset class="row mb-12">
                                                <legend class="col-form-label col-sm-6 pt-0">Etes vous l'assuré principale ?</legend>
                                                <div class="col-sm-6">
                                                  <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gridRadios" wire:model='confirm_assurer' id="gridRadios1" value="oui" checked>
                                                    <label class="form-check-label" for="gridRadios1">
                                                      Oui
                                                    </label>
                                                  </div>
                                                  <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gridRadios" wire:model='confirm_assurer' id="gridRadios2" value="non">
                                                    <label class="form-check-label" for="gridRadios2">
                                                      Non
                                                    </label>
                                                  </div>
                                                </div>
                                              </fieldset>
                                            <div class="col-12">
                                                <label for="inputNanme5" class="form-label">Nom & prenom assureur principale</label>
                                                <input type="text" wire:model='nom_assurer' class="form-control"
                                                    id="inputNanme5">
                                                @error('nom_assurer')
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
                        <div class="card-body">
                            {{-- <h5 class="card-title">Card with header and footer</h5> --}}
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nom assureur</th>
                                        <th scope="col">N° contrat</th>
                                        <th scope="col">Type consultation</th>
                                        <th scope="col">Debut validité</th>
                                        <th scope="col">Fin validité</th>
                                        <th scope="col">Recouvrement en %</th>
                                        {{-- <th scope="col">Numero adherant</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contrat_assurances as $contrat_assurance )
                                    <tr>
                                        <td>{{$contrat_assurance->maison_assurance->maison_assurance}}</td>
                                        <td>{{$contrat_assurance->id}}</td>
                                        <td>{{$contrat_assurance->tarif_consultation->type_consultation->type_consultation}}</td>
                                        <td>{{$contrat_assurance->date_debut}}</td>
                                        <td>{{$contrat_assurance->date_fin}}</td>
                                        <td style="text-align:center" >{{$contrat_assurance->taux_couverture.' %'}}</td>
                                        {{-- <td style="text-align:right">{{ number_format($contrat_assurance->tarif_consultation->montant,2,","," ").'
                                            '.$contrat_assurance->user->agence->devise->unite}}</td> --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- End Card with header and footer -->
                </div>

            </div>
        </section>

    </main>
    <!-- End #main -->

</div>
