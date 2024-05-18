<div>
    <main id="main" class="main">

        <div class="pagetitle">
            {{-- <h1>DOSSIER PATIENT</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Components</li>
                    <li class="breadcrumb-item active">Tabs</li>
                </ol>
            </nav> --}}
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">DOSSIER N°/{{$patient->id}}</h5>
                            <h4>PATIENT(E) : <span style="text-transform: uppercase"> <strong> {{$patient->nom.' '.$patient->prenom}}</strong></span></h4>
                            <h4>CONTACT : <strong> {{$patient->telephone}}</strong></h4>
                            <h4>
                                {{-- <div class="text-end">
                                     <!-- Large Modal -->
                                     <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                                     data-bs-target="#largeModal">
                                    CONSULTATION
                                 </button>

                                 <div class="modal fade" id="largeModal" tabindex="-1">
                                     <div class="modal-dialog modal-lg">
                                         <div class="modal-content">
                                             <div class="modal-header bg-dark text-white">
                                                 <h5 class="modal-title">Large Modal</h5>
                                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                     aria-label="Close"></button>
                                             </div>
                                             <div class="modal-body">
                                                 Non omnis incidunt qui sed occaecati magni asperiores est mollitia.
                                                 Soluta
                                                 at et reprehenderit. Placeat autem numquam et fuga numquam. Tempora
                                                 in
                                                 facere consequatur sit dolor ipsum. Consequatur nemo amet incidunt
                                                 est
                                                 facilis. Dolorem neque recusandae quo sit molestias sint
                                                 dignissimos.
                                             </div>
                                             <div class="modal-footer bg-dark text-white">
                                                 <button type="button" class="btn btn-secondary"
                                                     data-bs-dismiss="modal">Close</button>
                                                 <button type="button" class="btn btn-primary">Save changes</button>
                                             </div>
                                         </div>
                                     </div>
                                 </div><!-- End Large Modal-->
                                    <!-- Small Modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#smallModal">
                                      RENDEZ-VOUS
                                    </button>

                                    <div class="modal fade" id="smallModal" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title">Small Modal</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Non omnis incidunt qui sed occaecati magni asperiores est mollitia.
                                                    Soluta
                                                    at et reprehenderit. Placeat autem numquam et fuga numquam. Tempora
                                                    in
                                                    facere consequatur sit dolor ipsum. Consequatur nemo amet incidunt
                                                    est
                                                    facilis. Dolorem neque recusandae quo sit molestias sint
                                                    dignissimos.
                                                </div>
                                                <div class="modal-footer bg-primary text-white">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End Small Modal-->



                                </div> --}}
                            </h4>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- Card with header and footer -->
                    <div class="card">
                        <div class="card-header bg-success text-white ">
                            INFORMATION DU PATIENT
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
                                <div class="col-md-6">
                                    <label for="inputEmail5" class="form-label">Email</label>
                                    <input type="email" class="form-control" wire:model='mail' id="inputEmail5">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword5" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="inputPassword5">
                                </div>
                                {{-- <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div> --}}
                            </form><!-- End Multi Columns Form -->
                        </div>
                        <div class="card-footer bg-success text-white">
                            INFORMATION DU PATIENT
                        </div>
                    </div><!-- End Card with header and footer -->
                    <!-- Card with header and footer -->

                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            CONSULTATION PATIENT
                        </div>
                        <div class="card-body">
                            {{-- <h5 class="card-title">Card with header and footer</h5> --}}
                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">Type de consultation</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Nom medecin</th>
                                        <th scope="col">Prenom medecin</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($consultations as $consultation )
                                    <tr>
                                        <th scope="row"><a href="#">{{$consultation->tarif->libelle_tarif}}</a></th>
                                       <th>{{$consultation->created_at->diffForHumans()}}</th>
                                        <th scope="row"><a href="#">{{$consultation->medecin->nom}}</a></th>
                                        <th scope="row"><a href="#">{{$consultation->medecin->prenom}}</a></th>
                                        {{-- <td style="text-align:right">{{ number_format($consultation->montant,2,","," ").'
                                            '.$consultation->tarif->user->agence->devise->unite}}</td> --}}
                                        <td>
                                            @if($consultation->etat==0)
                                            <span class="badge bg-danger">Instance</span>
                                            @endif
                                            @if($consultation->etat==1)
                                            <span class="badge bg-success">Traité</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($consultation->etat==0)
                                            <a href="{{route('ad.sante.traitement.consultation',encrypt($consultation->id))}}">
                                                <button class="btn btn-dark btn-sm" > <i class="ri ri-user-unfollow-line"></i> </button>
                                            </a>
                                            @endif
                                            @if($consultation->etat==1)
                                            <a href="{{route('ad.sante.resultat.consultation',encrypt($consultation->id))}}">
                                                <button class="btn btn-secondary btn-sm" > <i class="bx bx-printer"></i> </button>
                                            </a>
                                            @endif

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer bg-dark text-white">
                            CONSULTATION PATIENT
                        </div>
                    </div><!-- End Card with header and footer -->

                    <div class="card">
                        <div class="card-header bg-secondary text-white">
                            CONSULTATION TRAITEE
                        </div>
                        <div class="card-body">
                            {{-- <h5 class="card-title">Card with header and footer</h5> --}}
                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">Type de consultation</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Nom medecin</th>
                                        <th scope="col">Prenom medecin</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($consutlation_traiters as $consultation )
                                    <tr>
                                        <th scope="row"><a href="#">{{$consultation->tarif->libelle_tarif}}</a></th>
                                       <th>{{$consultation->created_at->diffForHumans()}}</th>
                                        <th scope="row"><a href="#">{{$consultation->medecin->nom}}</a></th>
                                        <th scope="row"><a href="#">{{$consultation->medecin->prenom}}</a></th>
                                        {{-- <td style="text-align:right">{{ number_format($consultation->montant,2,","," ").'
                                            '.$consultation->tarif->user->agence->devise->unite}}</td> --}}
                                        <td>
                                            @if($consultation->etat==0)
                                            <span class="badge bg-danger">Instance</span>
                                            @endif
                                            @if($consultation->etat==1)
                                            <span class="badge bg-success">Traité</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($consultation->etat==0)
                                            <a href="{{route('ad.sante.traitement.consultation',encrypt($consultation->id))}}">
                                                <button class="btn btn-dark btn-sm" > <i class="ri ri-user-unfollow-line"></i> </button>
                                            </a>
                                            @endif
                                            @if($consultation->etat==1)
                                            <a href="{{route('ad.sante.resultat.consultation',encrypt($consultation->id))}}">
                                                <button class="btn btn-secondary btn-sm" > <i class="bx bx-printer"></i> </button>
                                            </a>
                                            @endif

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer bg-secondary text-white">
                            CONSULTATION TRAITEE
                        </div>
                    </div><!-- End Card with header and footer -->
                    <!-- Card with header and footer -->



                    <div class="card">
                        <div class="card-header bg-danger text-white">
                            FACTURATION
                        </div>
                        <div class="card-body">
                            {{-- <h5 class="card-title">Card with header and footer</h5> --}}
                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">Type de consultation</th>
                                        <th scope="col">date</th>
                                        <th scope="col">montant</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($facturations as $facturation )
                                    <tr>
                                        <th scope="row"><a href="#">{{$facturation->tarif->libelle_tarif}}</a></th>
                                        <th scope="row"><a href="#">{{$facturation->created_at->diffForHumans()}}</a></th>
                                        <td style="text-align:right">{{ number_format($facturation->montant,2,","," ").'
                                            '.$facturation->tarif->user->agence->devise->unite}}</td>
                                        <td>
                                            @if($facturation->etat=="instance")
                                            <span class="badge bg-danger">{{$facturation->etat}}</span>
                                            @endif
                                            @if($facturation->etat!="instance")
                                            <span class="badge bg-success">{{$facturation->etat}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($facturation->etat=="instance")
                                            <a href="{{route('ad.sante.recu.consultation',encrypt($facturation->id))}}">
                                                <button class="btn btn-success btn-sm" > <i class="ri ri-bank-card-2-line"></i> </button>
                                            </a>
                                            @endif
                                            @if($facturation->etat=="payé")
                                            <a href="{{route('ad.sante.recu.consultation',encrypt($facturation->id))}}">
                                                <button class="btn btn-secondary btn-sm" > <i class="bx bx-printer"></i> </button>
                                            </a>
                                            @endif

                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer bg-danger text-white">
                            FACTURATION
                        </div>
                    </div><!-- End Card with header and footer -->

                    {{-- <div class="card">
                        <div class="card-header bg-primary text-white">
                            RENDEZ-VOUS
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Card with header and footer</h5>
                            <!-- Table with stripped rows -->
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Position</th>
                                        <th scope="col">Age</th>
                                        <th scope="col">Start Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Brandon Jacob</td>
                                        <td>Designer</td>
                                        <td>28</td>
                                        <td>2016-05-25</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Bridie Kessler</td>
                                        <td>Developer</td>
                                        <td>35</td>
                                        <td>2014-12-05</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Ashleigh Langosh</td>
                                        <td>Finance</td>
                                        <td>45</td>
                                        <td>2011-08-12</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Ashleigh Langosh</td>
                                        <td>Finance</td>
                                        <td>45</td>
                                        <td>2011-08-12</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        </div>
                        <div class="card-footer bg-primary text-white">
                            RENDEZ-VOUS
                        </div>
                    </div> --}}
                    <!-- End Card with header and footer -->
                </div>
            </div>
        </section>

    </main><!-- End #main -->
</div>
