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
                        <div class="card-header bg-secondary text-white">
                            <li class="list-group-item d-flex justify-content-between align-items-center text-white">
                                INFORMATION GENERAL DU PATIENT <strong>  <h2> {{$patient->prenom.' '.$patient->nom.' '.(\Carbon\Carbon::parse($patient->date_naissance)->age.' ans' )}}</h2></strong>
                                <span class=" bg-secondary rounded-pill">
                                    <a wire:navigate href="{{route('ad.sante.index.patient')}}">
                                        <button class="btn btn-primary "><i class="bi bi-receipt"></i></button>
                                    </a>
                                    <a href="{{route('ad.sante.edit.patient',encrypt($patient->id))}}">
                                    <button class="btn btn-info"><i class="bi bi-pencil"></i></button>
                                    </a>
                                </span>
                              </li>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Card with header and footer -->
                    <div class="card">
                        <div class="card-header bg-secondary text-white ">
                            IDENTITE DU PATIENT
                        </div>

                        <div class="card-body">

                            <!-- Multi Columns Form -->
                            <form class="row g-3">
                                <div class="col-md-2">
                                    <label for="inputName5" class="form-label">Civilité</label>
                                    <input type="text" class="form-control" wire:model='civilite' id="inputName5">

                                </div>
                                <div class="col-md-5">
                                    <label for="inputName5" class="form-label">Prenom</label>
                                    <input type="text" class="form-control" wire:model='prenom' id="inputName5">

                                </div>
                                <div class="col-md-5">
                                    <label for="inputName5" class="form-label">Nom du père</label>
                                    <input type="text" class="form-control" wire:model='nom' id="inputName5">

                                </div>
                                <div class="col-md-6">
                                    <label for="inputState" class="form-label">Situation</label>
                                    <input type="text" class="form-control" wire:model='situation' id="inputName5">

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
                            </form>
                            <!-- End Multi Columns Form -->
                        </div>
                    </div><!-- End Card with header and footer -->
                    <!-- Card with header and footer -->

                </div>
                <div class="col-lg-4">
                    <!-- Card with header and footer -->
                    <div class="card">
                        <div class="card-header bg-secondary text-white ">
                            COORDONNES DU PATIENT

                        </div>

                        <div class="card-body">

                            <!-- Multi Columns Form -->
                            <form class="row g-3">

                                <div class="col-6">
                                    <label for="inputAddress5" class="form-label">Telephone</label>
                                    <input type="text" class="form-control" wire:model='telephone' id="inputAddres5s">

                                </div>
                                <div class="col-6">
                                    <label for="inputAddress2" class="form-label">Addresse</label>
                                    <input type="text" class="form-control" wire:model='adresse' id="inputAddress2">

                                </div>
                                <div class="col-12">
                                    <label for="inputAddress2" class="form-label">Complement</label>
                                    <input type="text" class="form-control" wire:model='complement_adresse' id="inputAddress2">

                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail5" class="form-label">Email</label>
                                    <input type="email" class="form-control" wire:model='mail' id="inputEmail5">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword5" class="form-label">Personne à contacter</label>
                                    <input type="text" class="form-control" id="inputPassword5" wire:model='personne_contact'>
                                </div>
                            </form><!-- End Multi Columns Form -->
                        </div>
                    </div><!-- End Card with header and footer -->
                    <!-- Card with header and footer -->

                </div>
                <div class="col-lg-4">
                    <!-- Card with header and footer -->
                    <div class="card">
                        <div class="card-header bg-secondary text-white ">
                            INFORMATION MEDICALE DU PATIENT
                        </div>

                        <div class="card-body">

                            <!-- Multi Columns Form -->
                            <form class="row g-3">
                                <div class="col-md-12">
                                    <label for="inputCity" class="form-label">N° Patient</label>
                                    <input type="text" wire:model='numero_patient' class="form-control" id="inputCity" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Taille (m)</label>
                                    <input type="text" wire:model='taille' class="form-control" id="inputCity">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputZip" class="form-label">Poid (kg)</label>
                                    <input type="text" wire:model='poid' class="form-control" id="inputZip">
                                </div>
                                <div class="col-md-4">
                                    <label for="inputEmail5" class="form-label">Groupe sanguin</label>
                                    <input type="email" class="form-control" wire:model='groupe_sanguin' id="inputEmail5">
                                </div>
                                <div class="col-md-8">
                                    <label for="inputPassword5" class="form-label">ICM</label>
                                    <input type="text" class="form-control" wire:model='icm' id="inputPassword5" disabled>
                                </div>
                            </form><!-- End Multi Columns Form -->
                        </div>

                    </div><!-- End Card with header and footer -->
                    <!-- Card with header and footer -->

                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            CONSULTATION PATIENT
                        </div>

                        <div class="card-body">
                            {{-- <h5 class="card-title">Card with header and footer</h5> --}}
                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Realiser par</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Motif</th>
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

                    </div><!-- End Card with header and footer -->
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                           EXAMENS
                        </div>

                        <div class="card-body">
                            {{-- <h5 class="card-title">Card with header and footer</h5> --}}
                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Prescris par</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Libelle</th>
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

                    </div><!-- End Card with header and footer -->
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            ANTECEDENT PERSONNEL ET FAMILLIAUX
                        </div>

                        <div class="card-body">
                            {{-- <h5 class="card-title">Card with header and footer</h5> --}}
                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Libelle</th>
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

                    </div><!-- End Card with header and footer -->
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                           ALLERGIES
                        </div>

                        <div class="card-body">
                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Libelle</th>
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

                    </div><!-- End Card with header and footer -->
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            VACCIN
                        </div>
                            <div class="card-body">
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Nom du vaccin</th>
                                            <th scope="col">prevention contre</th>
                                            <th scope="col">Rappel</th>
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
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            SOINS
                        </div>
                            <div class="card-body">
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Realiser pas</th>
                                            <th scope="col">Categorie</th>
                                            <th scope="col">libelle</th>
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
                    </div>
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            PRESCRIPTION
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Prescrit par</th>
                                        <th scope="col">Libelle</th>
                                        <th scope="col">Posologie</th>
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

                    </div><!-- End Card with header and footer -->
                    <!-- Card with header and footer -->
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                           AFFECTION LONGUES DUREES
                        </div>
                        <div class="card-body">
                            {{-- <h5 class="card-title">Card with header and footer</h5> --}}
                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">date</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Libelle</th>
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
                    </div><!-- End Card with header and footer -->
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            ADDICTIONS
                        </div>
                            <div class="card-body">
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Libelle</th>
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
                    </div>
                    <div class="card">
                        <div class="card-header bg-secondary text-white">
                            ASSUREURS
                        </div>
                        <div class="card-body">
                            {{-- <h5 class="card-title">Card with header and footer</h5> --}}
                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">Nom assureur</th>
                                        <th scope="col">Debut validité</th>
                                        <th scope="col">Fin validité</th>
                                        <th scope="col">Prise en charge</th>
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
                    </div><!-- End Card with header and footer -->
                </div>
            </div>
        </section>

    </main><!-- End #main -->
</div>
