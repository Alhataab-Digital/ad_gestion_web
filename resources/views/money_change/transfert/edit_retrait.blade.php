@extends('../layouts.app')

@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
        <h1>RETRAIT CHANGE</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
            <li class="breadcrumb-item">Opération change</li>
            <li class="breadcrumb-item active">Retrait change</li>
            </ol>
        </nav>
        </div><!-- End Page Title -->
        <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Retrait change</h5>
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

                    <form class="row g-3" method="post" action="{{ route('retrait.update',$operation->id) }}" >
                        @csrf

                            <div class="bg-primary">
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
                            <div class="col-md-4">
                                <label for="inputState" class="form-label">Provenance</label>
                                <select id="inputState" class="form-select" name="region_id">
                                    <option >{{ $operation->agence->region->nom }}</option>

                                </select>
                            </div>
                            <div class="bg-primary">
                                <p class="text-white text-center"> INFO DESTINATAIRE </p>
                            </div>
                                <div class="col-6">
                                    <label for="inputAddress5" class="form-label">Nom et prenom destinateur</label>
                                    <input type="text" name="nom_destinataire" value="{{ $operation->nom_destinataire }}" class="form-control" id="inputAddres5s" >
                                </div>
                                <div class="col-6">
                                    <label for="inputAddress2" class="form-label">Telephone destinataire</label>
                                    <input type="text" name="telephone_destinataire" value="{{ $operation->telephone_destinataire }}" class="form-control" id="inputAddress2" >
                                </div>

                                <input  type="hidden" name="taux" value="{{ $operation->taux_echange}}" class="form-control" id="taux" >

                                <div class="col-md-6" >
                                    <label for="inputCity" class="form-label">Montant receptionné</label>
                                    @if($operation->type_envoi==1)
                                    <input  type="text" name="montant" value="{{ round($operation->montant_ttc/$operation->taux_echange)}}" class="form-control" id="montant" >
                                    @endif
                                    @if($operation->type_envoi==0)
                                    <input  type="text" name="montant" value="{{ round($operation->montant/$operation->taux_echange)}}" class="form-control" id="montant" >
                                    @endif
                                </div>
                            <div class="bg-primary">
                                <p class="text-white text-center"> INFO OPERATION DE RETRAIT</p>
                            </div>

                            <div class="col-md-4">
                                <label for="inputState" class="form-label">Type de piece</label>
                                <select  class="form-select" name="type_piece" id="">
                                    <option value="">Choix...</option>
                                    @foreach ($pieces as $piece)

                                        <option value="{{ $piece->id }}">{{ $piece->type_piece }}</option>

                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-6" >
                                <label for="inputCity" class="form-label">Numero de la piece</label>
                                <input  type="text" name="numero_piece"  class="form-control" id="" >
                            </div>


                            <div class="bg-primary">
                            <hr>
                            </div>
                            <div class="col-md-3">
                                <label for="inputState" class="form-label">devise</label>
                                <select id="inputState" class="form-select">
                                    <option>{{ $agence->devise->unite }}</option>
                                </select>
                            </div>
                            {{-- <div class="col-6">
                                <label for="inputAddress2" class="form-label">Code d'RETRAIT</label>
                                <input type="text" name="" value="{{ $operation->code_RETRAIT }}" class="form-control" id="inputAddress2" >
                            </div> --}}
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Valider</button>

                                <a href="{{ route('retrait') }}">
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


    //   function calcul(){

    //     var montant = Number(document.getElementById("montant").value);
    //         var montant_ttc = Number(document.getElementById("montant_ttc").value);
    //         var type_frais = Number(document.getElementById("type_frais").value);
    //         var taux = Number(document.getElementById("taux").value);

    //         // frais.value=Number(montant.value)*Number(taux.value);

    //             document.getElementById("ttc").value = ttc;

    //                 // var taux= document.querySelector("#taux_v");
    //                 // var montant= document.querySelector("#montant_v");
    //                 // var ttc= document.querySelector("#ttc");
    //         if(type_frais==1){
    //             ttc.value=Number(montant_ttc*taux);
    //         }
    //         if(type_frais==0){
    //             ttc.value=Number(montant * taux);
    //         }

    //        }




    </script>


@endsection
