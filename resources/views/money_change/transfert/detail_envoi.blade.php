@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>ENVOI CHANGE</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                <li class="breadcrumb-item">Opération change</li>
                <li class="breadcrumb-item active">Envoi changet</li>
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

                        <form class="row g-3" method="post" action="{{ route('envoi.store') }}">
                            @csrf
                            {{-- @foreach ($devise_agences as $devise_agence)
                            @if ($agence->devise->id == $devise_agence->devise_id)
                            <input type="text" name="devise" value="{{ $devise_agence->taux }}" class="form-control"
                                id="inputName5">
                            @endif
                            @endforeach --}}

                            <input type="hidden" name="devise_id" value="{{ $agence->devise->id }}">
                            <input type="hidden" name="c_id" value="{{ $client->id }}">

                            <div class="bg-primary">
                                <p class="text-white text-center"> INFO EXPEDITEUR </p>
                            </div>
                            <div class="col-md-6">
                                <label for="inputName5" class="form-label">Expediteur</label>
                                <input type="text" name="nom_client" value="{{ $client->nom_client }}"
                                    class="form-control" id="inputName5">
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail5" class="form-label">Telephone expediteur</label>
                                <input type="text" name="telephone" value="{{ $client->telephone }}"
                                    class="form-control" id="inputEmail5" readonly="true">
                            </div>
                            <div class="bg-primary">
                                <p class="text-white text-center"> INFO OPERATION D'ENVOI</p>
                            </div>

                            <div class="col-md-6">
                                <label for="inputCity" class="form-label">Montant envoi</label>
                                <input onchange="deduction()" type="text" name="montant" class="form-control"
                                    id="montant">
                            </div>
                            <div class="col-md-6">
                                <label for="inputCity" class="form-label">frais d'envoi (1% du montant)</label>
                                <input onkeyup="deduction()" type="text" name="frais" class="form-control" id="frais"
                                    readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="inputState" class="form-label">Condition d'envoi</label>
                                <select onchange="calcul() " class="form-select" name="type_frais" id="type_frais">
                                    <option selected>Choose...</option>
                                    <option value="1">frais d'envoi inclus</option>
                                    <option value="0">frais d'envoi exclus</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="inputCity" class="form-label">Montant total</label>
                                <input onkeyup="calcul()" type="text" name="ttc" class="form-control" id="ttc">
                            </div>
                            <div class="bg-primary">
                                <p class="text-white text-center"> INFO DESTINATAIRE </p>
                            </div>
                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Destination</label>
                                <select onchange="calcul()" id="region" class="form-select" name="region_id">
                                    <option selected>Choose...</option>
                                    @foreach ($regions as $region )
                                    <option value="{{ $region->id }}">{{ $region->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6" id="taux" onchange="info()">
                                <label for="inputAddress5" class="form-label">Taux d'echange</label>
                                <input type="text" id="taux_d" class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="inputAddress5" class="form-label">Montant à receptionné</label>
                                <input onkeyup="info()" type="text" class="form-control" id="montant_recu">
                            </div>
                            <div class="col-6">
                                <label for="inputAddress5" class="form-label">Nom et prenom destinateur</label>
                                <input type="text" name="nom_destinataire" class="form-control" id="inputAddres5s">
                            </div>
                            <div class="col-6" id="telephone_destinataire">
                                <label for="inputAddress2" class="form-label">Telephone destinataire</label>
                                <input type="text" name="telephone_destinataire" class="form-control"
                                    id="inputAddress2">
                            </div>
                            <div class="bg-primary">
                                <hr>
                            </div>
                            <input type="hidden" name="agence_id" value="{{ $agence->id }}" class="form-control"
                                id="inputAddress2">
                            <div class="col-md-3">
                                <label for="inputState" class="form-label">devise</label>
                                <select id="inputState" class="form-select">
                                    <option>{{ $agence->devise->unite }}</option>
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Valider</button>
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
    $(document).ready(function(){
              $('#region').change(function(event){

                  var region_id=this.value;
        //    alert(region_id);
                  $('#taux').html('');
                  $.ajax({
                      url:"{{ route('envoi.info') }}",
                      type:'post',
                      dataType:'json',
                      data: {id:region_id , _token:"{{ csrf_token() }}"},
                      //alert(data);
                      success:function(response){
                        // console.log(response);

                          //$("#taux").html(' <input type="text" name="taux" class="form-control" >');
                          $.each(response.devise,function(numero_client,val){
                      // alert(val);
                      $("#taux").append('<label for="inputAddress2" class="form-label">Taux destination</label> <input onchange="infO()" type="text" name="taux" id="taux_d" class="form-control"  value="'+val.taux+'">');
                        })
                      }
                  })

              });

          });


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

    function info(){

        var taux = Number(document.getElementById("taux_d").value);
        var region_recu = Number(document.getElementById("region").value);
        var montant = Number(document.getElementById("montant").value);
        var type_frais = Number(document.getElementById("type_frais").value);
        var frais = Number(document.getElementById("frais").value);

            // frais.value=Number(montant.value)*Number(taux.value);

                document.getElementById("montant_recu").value = montant_recu;

                    // var taux= document.querySelector("#taux_v");
                    // var montant= document.querySelector("#montant_v");
                    // var ttc= document.querySelector("#ttc");
                    // Math.round(Number(montant/taux)* 100) / 100;
            if(type_frais==1){
                montant_recu.value= Math.round((Number(montant - frais))/(Number(taux)));
                // montant_recu.value=Number(taux);
            }
            if(type_frais==0){
                montant_recu.value=Math.round((Number(montant))/(Number(taux)));
                // montant_recu.value= Number(taux);
            }

}
    $(document).ready(function() {
            $('#region').change(function(event) {

                var region_id = this.value;

            //    alert(region_id);

                $('#telephone_destinataire').html('');
                $.ajax({
                    url: "{{ route('envoi_devise.code') }}",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        id: region_id,
                        _token: "{{ csrf_token() }}"
                    },
                    //alert(data);
                    success: function(response) {
                        console.log(response);
                        $.each(response.code, function(index, val) {
                            // alert(val);
                            $("#telephone_destinataire").append('<label for="inputAddress" class="form-label">Telephone</label><input type="text" name="telephone_destinataire" value='+val.indicatif+' class="form-control" id="telephone_destinataire">');
                        })
                    }
                })

            });

        });
</script>


@endsection
