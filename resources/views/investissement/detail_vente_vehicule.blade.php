@extends('../layouts.app')

@section('content')
<script >



</script>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>VENTE VEHICULE</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
        <li class="breadcrumb-item">Autre operation </li>
        <li class="breadcrumb-item active">Vente vehicule</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body bg-secondary text-white">
            <h5 class="card-title text-white">vente vehicule</h5>

            <!-- Multi Columns Form -->
            <form class="row g-3" method="post" action="{{ route('vente_vehicule.store') }}">
               @csrf
               @method('POST')
               <div class="col-md-6 ">
                    <div class="col-md-12">
                            <input type="hidden" name="c_id" value="{{ $client->id }}" class="form-control" id="telephone">
                        </div>
                        <div class="col-md-12">
                            <label for="inputName5" class="form-label">Telephone client</label>
                            <input type="text" name="telephone" value="{{ $client->telephone }}" class="form-control" id="telephone">
                        </div>
                    <div class="col-md-12">
                            <label for="inputName5" class="form-label">Nom client</label>
                            <input type="text" name="nom_client" value="{{ $client->nom_client }}" class="form-control" id="telephone">
                    </div>
                    <div class="col-md-12">
                            <label for="inputName5" class="form-label">Adresse client</label>
                            <input type="text" name="adresse" value="{{ $client->adresse }}" class="form-control" id="telephone">
                    </div>
                    <br>
               </div>
              <hr>
              <div class="col-md-12">
                  <label for="inputName5" class="form-label">Activite ouverte</label>
                  <div class="col-4" id="activite_id">
                </div>
              </div>
              <hr>
              <div class="col-md-3" >
                <label for="inputZip" class="form-label">Chassis</label>
                <input type="text" name="chassis" class="form-control" id="chassis" require>
              </div>
              <div id="id">
              </div>
              <div class="col-4" id="annee">
              </div>
              <div class="col-4" id="marque">
              </div>
              <div class="col-md-4" id="model">
              </div>

              <div class="col-4" id="charge_usa">
              </div>
              <div class="col-md-4" id="prix_achat">
              </div>
              <div class="col-md-4" id="prix_revient">
              </div>
              <div class="col-md-4" id="prix_vente">
              </div>

              <div class="text-center" id="valider">
              </div>

            </form><!-- End Multi Columns Form -->
            <div class="text-center" id="annuler">
              </div>
          </div>
        </div>

      </div>

    </div>
  </section>

</main><!-- End #main -->

<script src="{{asset('assets/js/jquery.js')}}"></script>
<script type="text/javascript">

      $(document).ready(function(){
          $('#chassis').change(function(event){

              var chassis=this.value;

              $('#annee').html('');
              $.ajax({
                  url:"{{ route('vente_vehicule.chassis') }}",
                  type:'post',
                  dataType:'json',
                  data: {chassis:chassis , _token:"{{ csrf_token() }}"},
                  //alert(data);
                  success:function(response){
                    // console.log(response);
                      //$("#taux").html(' <input type="text" name="taux" class="form-control" >');
                      $.each(response.chassis,function(client,val){
                  // alert(val);
                  $("#activite_id").append(' <input type="hidden" name="activite_id" value="'+val.activite_id+'" class="form-control" id="telephone" >')
                  $("#id").append('<input  type="hidden" name="id_vente" id="" class="form-control"  value="'+val.id+'">');
                  $("#annee").append('<label for="inputAddress2" class="form-label">Annee</label> <input  type="text" name="annee" id="" class="form-control"  value="'+val.annee+'">');
                  $("#marque").append('<label for="inputAddress2" class="form-label">Marque</label> <input  type="text" name="marque" id="" class="form-control"  value="'+val.marque+'">');
                  $("#model").append('<label for="inputAddress2" class="form-label">Model</label> <input  type="text" name="model" id="" class="form-control"  value="'+val.model+'">');
                  $("#charge_usa").append('<label for="inputAddress2" class="form-label"> </label> <input  type="hidden" name="charge_usa" id="" class="form-control"  value="'+val.charge_usa+'">');
                  $("#prix_achat").append('<label for="inputAddress2" class="form-label"> </label> <input  type="hidden" name="prix_achat" id="" class="form-control"  value="'+val.prix_achat+'">');
                  $("#prix_revient").append('<label for="inputAddress2" class="form-label"> </label> <input  type="hidden" name="prix_revient" id="" class="form-control"  value="'+val.prix_revient+'">');
                  $("#prix_vente").append('<label for="inputAddress2" class="form-label">Prix de vente</label> <input  type="text" name="prix_vente" id="" class="form-control" >');
                  $("#valider").append('<button type="submit" class="btn btn-primary">Valider</button> ');
                  $("#annuler").append('<a href="{{route('vente_vehicule')}}"><button class="btn btn-secondary">Annuler</button></a>');
                    })
                  }
              })

          });

      });


      function calcul(){
    var taux = Number(document.getElementById("taux_v").value);

    var montant = Number(document.getElementById("montant_v").value);

           var ttc = Number(taux * montant);
           document.getElementById("ttc").value = ttc;

            // var taux= document.querySelector("#taux_v");
            // var montant= document.querySelector("#montant_v");
            // var ttc= document.querySelector("#ttc");
            ttc.value = Math.round(Number(montant.value)*Number(taux.value));
           }



</script>
@endsection
