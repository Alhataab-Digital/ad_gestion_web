@extends('../layouts.app')

@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
        <h1>ENVOI CHANGE</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
            <li class="breadcrumb-item">Opération change</li>
            <li class="breadcrumb-item active">Envoi change</li>
            </ol>
        </nav>
        </div><!-- End Page Title -->
        <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Envoi change</h5>
                    <p>

                        @if ($message=Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <i class="bi bi-check-circle me-1"></i>
                          {{ $message }}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if ($message=Session::get('danger'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <i class="bi bi-exclamation-octagon me-1"></i>
                          {{ $message }}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif


                    </p>

                    <!-- Multi Columns Form -->

                    <form class="row g-3" >
                        @csrf

                            <div class="bg-secondary">
                                <p class="text-white text-center"> INFO EXPEDITEUR </p>
                            </div>
                            <div class="col-md-6">
                                <label for="inputName5" class="form-label">Expediteur</label>
                                <input type="text" name="nom_client" value="{{ $operation->client->nom_client }}" class="form-control" id="inputName5">
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail5" class="form-label">Telephone expediteur</label>
                                <input type="text" name="telephone" value="{{ $operation->client->telephone }}" class="form-control" id="inputEmail5" readonly="true">
                            </div>
                            <div class="bg-secondary">
                                <p class="text-white text-center"> INFO OPERATION D'ENVOI</p>
                            </div>

                            <div class="col-md-6" >
                                <label for="inputCity" class="form-label">Montant envoi</label>
                                <input onchange="deduction()" type="text" name="montant" value="{{ number_format($operation->montant,2,","," ").' '.$agence->devise->unite}}" class="form-control" id="montant" >
                            </div>
                            <div class="col-md-6" >
                                <label for="inputCity" class="form-label">frais d'envoi (1% du montant)</label>
                                <input onkeyup="deduction()" type="text" name="frais" value="{{ number_format($operation->frais_envoi,2,","," ").' '.$agence->devise->unite}}" class="form-control" id="frais" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="inputState" class="form-label">Condition d'envoi</label>
                                <select onchange="calcul()" class="form-select" name="type_frais" id="type_frais">
                                    @if($operation->type_frais==1)
                                    <option value="1">frais d'envoi inclus</option>
                                    @else
                                    <option value="0">frais d'envoi exclus</option>
                                    @endif
                                </select>
                            </div>

                            <div class="col-md-6" >
                                <label for="inputCity" class="form-label">Montant total</label>
                                <input  type="text" name="ttc" value="{{ number_format($operation->montant_ttc,2,","," ").' '.$agence->devise->unite}}" class="form-control" id="ttc">
                            </div>
                            <div class="bg-secondary">
                                <p class="text-white text-center"> INFO DESTINATAIRE </p>
                            </div>

                                <div class="col-md-12">
                                    <label for="inputState" class="form-label">Destination</label>
                                    <select id="inputState" class="form-select" name="region_id">
                                        <option >{{ $operation->region->nom }}</option>

                                    </select>
                                </div>

                                <div class="col-4">
                                    <label for="inputAddress5" class="form-label">taux d'echange</label>
                                    <input type="text" name="nom_destinataire" value="{{ $operation->taux_echange }}" class="form-control" id="inputAddres5s" >
                                </div>
                                <div class="col-md-6" >
                                    <label for="inputCity" class="form-label">Montant a receptionné</label>
                                    @if($operation->type_envoi==1)
                                    <input  type="text" value="{{ number_format(round($operation->montant_ttc/$operation->taux_echange),2,","," ").' '.$agence_destination->devise->unite}}" class="form-control" id="montant" >
                                    @endif
                                    @if($operation->type_envoi==0)
                                    <input  type="text" value="{{ number_format(round($operation->montant/$operation->taux_echange),2,","," ").' '.$agence_destination->devise->unite}}" class="form-control" id="montant" >
                                    @endif
                                </div>
                                <div class="col-6">
                                    <label for="inputAddress5" class="form-label">Nom et prenom destinateur</label>
                                    <input type="text" name="nom_destinataire" value="{{ $operation->nom_destinataire }}" class="form-control" id="inputAddres5s" >
                                </div>
                                <div class="col-6">
                                    <label for="inputAddress2" class="form-label">Telephone destinataire</label>
                                    <input type="text" name="telephone_destinataire" value="{{ $operation->telephone_destinataire }}" class="form-control" id="inputAddress2" >
                                </div>
                            <div class="bg-secondary">
                            <hr>
                            </div>
                            <div class="col-md-3">
                                <label for="inputState" class="form-label">devise</label>
                                <select id="inputState" class="form-select">
                                    <option>{{ $operation->devise->unite }}</option>
                                </select>
                            </div>
                            @if($operation->etat==0 )
                            <div class="col-6">
                                <label for="inputAddress2" class="form-label">Code d'envoi</label>
                                <input type="text" name="" value="{{ $operation->code_envoi }}" class="form-control" id="inputAddress2" >
                            </div>
                            @endif
                            <div class="text-center">
                                @if($operation->etat==0)
                                <a href="{{ route('envoi.print',$operation->id) }}">
                                <div class="btn btn-primary"> Imprimer</div>
                                </a>
                                @endif
                                <a href="{{ route('envoi') }}">
                                    <div class="btn btn-secondary"> Quitter</div>
                                    </a>
                              </div>
                    </form><!-- End Multi Columns Form -->

                    </div>
                </div>

            </div>

            {{-- <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Vertical Form</h5>

                    <!-- Vertical Form -->
                    <form class="row g-3">
                        <div class="col-12">
                        <label for="inputNanme4" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="inputNanme4">
                        </div>
                        <div class="col-12">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" class="form-control" id="inputEmail4">
                        </div>
                        <div class="col-12">
                        <label for="inputPassword4" class="form-label">Password</label>
                        <input type="password" class="form-control" id="inputPassword4">
                        </div>
                        <div class="col-12">
                        <label for="inputAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                        </div>
                        <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form><!-- Vertical Form -->

                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">No Labels / Placeholders as labels Form</h5>

                    <!-- No Labels Form -->
                    <form class="row g-3">
                        <div class="col-md-12">
                        <input type="text" class="form-control" placeholder="Your Name">
                        </div>
                        <div class="col-md-6">
                        <input type="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="col-md-6">
                        <input type="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="col-12">
                        <input type="text" class="form-control" placeholder="Address">
                        </div>
                        <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="City">
                        </div>
                        <div class="col-md-4">
                        <select id="inputState" class="form-select">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                        </div>
                        <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="Zip">
                        </div>
                        <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form><!-- End No Labels Form -->

                    </div>
                </div>


            </div> --}}
        </div>
        </section>
    </main><!-- End #main -->

    <script src="{{asset('assets/js/jquery.js')}}"></script>
  <script type="text/javascript">


      function calcul(){
            var montant = Number(document.getElementById("montant").value);
            var type_frais = Number(document.getElementById("type_frais").value);
            var frais = Number(document.getElementById("frais").value);

            // frais.value=Number(montant.value)*Number(taux.value);

                document.getElementById("ttc").value = ttc;

                    // var taux= document.querySelector("#taux_v");
                    // var montant= document.querySelector("#montant_v");
                    // var ttc= document.querySelector("#ttc");
            if(type_frais==1){
                ttc.value=Number(montant - frais);
            }
            if(type_frais==0){
                ttc.value=Number(montant + frais);
            }

           }
    function deduction(){

        var montant = Number(document.getElementById("montant").value);

        document.getElementById("frais").value = frais;

        frais.value=Number(0.01)*Number(montant);

    }



    </script>


@endsection
