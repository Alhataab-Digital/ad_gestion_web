@extends('../layouts.app')

@section('content')
<script >



</script>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>ACHAT VEHICULE</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
        <li class="breadcrumb-item">Autre operation </li>
        <li class="breadcrumb-item active">Achat vehicule</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body ">
            <h5 class="card-title text-white">Achat vehicule</h5>

            <!-- Multi Columns Form -->
            <form class="row g-3" method="post" action="">
               @csrf
               @method('POST')
               <div class="col-md-6 ">
                    <div class="col-md-12">
                        </div>
                        <div class="col-md-12">
                            <label for="inputName5" class="form-label">Telephone fournisseur</label>
                            <input type="text" name="telephone" value="{{  $operation->fournisseur->telephone }}" class="form-control" id="telephone">
                        </div>
                    <div class="col-md-12">
                            <label for="inputName5" class="form-label">Nom fournisseur</label>
                            <input type="text" name="nom_fournisseur" value="{{  $operation->fournisseur->nom_fournisseur }}" class="form-control" id="telephone">
                    </div>
                    <div class="col-md-12">
                            <label for="inputName5" class="form-label">Adresse fournisseur</label>
                            <input type="text" name="adresse" value="{{  $operation->fournisseur->adresse }}" class="form-control" id="telephone">
                    </div>
                    <br>
               </div>
              <hr >
              <div class="col-3" id="taux">
                <label for="inputAddress2" class="form-label">Annee</label>
                <input  type="text" name="annee" value="{{  $operation->annee }}" id="annee" class="form-control" require >
              </div>
              <div class="col-3" id="stock">
                <label for="inputAddress2" class="form-label">Marque</label>
                <input type="text" name="marque"  value="{{  $operation->marque }}" class="form-control" require >
              </div>
              <div class="col-md-3" id="montant">
                <label for="inputCity" class="form-label">Model</label>
                <input type="text" name="model"  value="{{  $operation->model }}" class="form-control" id="montant_v" require >
              </div>
              <div class="col-md-3" >
                <label for="inputZip" class="form-label">Chassis</label>
                <input type="text" name="chassis"  value="{{  $operation->chassis }}" class="form-control" id="ttc" require>
              </div>
              <div class="col-4" id="stock">
                <label for="inputAddress2" class="form-label">Charge USA</label>
                <input type="text" name="charge_usa"  value='{{ number_format($operation->charge_usa,2,","," ") }}' class="form-control"  require>
              </div>
              <div class="col-md-4" id="montant">
                <label for="inputCity" class="form-label">Prix achat</label>
                <input type="text" name="prix_achat"  value='{{ number_format($operation->prix_achat,2,","," ") }}' class="form-control" id="montant_v" require>
              </div>
              <div class="col-md-4" >
                <label for="inputZip" class="form-label">Prix de revient</label>
                <input   type="text" name="prix_revient"  value='{{ number_format($operation->prix_revient,2,","," ") }}' class="form-control" id="ttc" require>
              </div>
              
              <div class="text-center">
                <!-- <button type="submit" class="btn btn-primary">Valider</button> -->
                <button type="reset" class="btn btn-secondary">imprimer</button>
              </div>

            </form><!-- End Multi Columns Form -->

          </div>
        </div>

      </div>

    </div>
  </section>

</main><!-- End #main -->
<script src="{{asset('assets/js/jquery.js')}}"></script>
<script type="text/javascript">

      $(document).ready(function(){
          $('#devise').vehicule(function(event){

              var devise_id=this.value;

              $('#taux').html('');
              $.ajax({
                  url:"{{ route('achat_devise.taux') }}",
                  type:'post',
                  dataType:'json',
                  data: {id:devise_id , _token:"{{ csrf_token() }}"},
                  //alert(data);
                  success:function(response){
                    // console.log(response);

                      //$("#taux").html(' <input type="text" name="taux" class="form-control" >');
                      $.each(response.devises,function(fournisseur,val){
                  // alert(val);
                      $("#taux").append('<label for="inputAddress2" class="form-label">Taux</label> <input onvehicule="calcul()" type="text" name="taux" id="taux_v" class="form-control"  value="'+val.taux+'">');

                    })
                  }
              })

              $('#stock').html('');
              $.ajax({
                  url:"{{ route('achat_devise.stock') }}",
                  type:'post',
                  dataType:'json',
                  data: {id:devise_id , _token:"{{ csrf_token() }}"},
                  //alert(data);
                  success:function(response){
                    // console.log(response);
                    //   $("#stock").html(' <label for="inputAddress2" class="form-label">Montant stock</label><input type="text" name="taux" class="form-control" >');
                      $.each(response.stocks,function(fournisseur,val){
                  // alert(val);
                      $("#stock").append('<label for="inputAddress2" class="form-label">Montant stock</label> <input type="text" name="stock" value="'+val.montant+'" class="form-control"  readonly>');
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
