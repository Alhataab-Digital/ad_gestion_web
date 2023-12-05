@extends('../layouts.app')

@section('content')
<script >



</script>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>ACHAT CHANGE</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
        <li class="breadcrumb-item">Operation change</li>
        <li class="breadcrumb-item active">Achat change</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Achat change</h5>

            <!-- Multi Columns Form -->
            <form class="row g-3" method="post" action="{{ route('achat_devise.store') }}">
               @csrf
               @method('POST')
                <div class="col-md-12">
                    <input type="hidden" name="f_id" value="{{ $client->id }}" class="form-control" id="telephone">
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
                    <label for="inputName5" class="form-label">Adresse</label>
                    <input type="text" name="adresse" value="{{ $client->adresse }}" class="form-control" id="telephone">
              </div>
              <div class="col-md-12">
                <label for="inputState" class="form-label">Devise</label>
                <select onchange="calcul()" id="devise" name="devise" class="form-select">
                    <option selected>Choix...</option>
                    @foreach ($devise_agences as $devise_agence)
                    <option  value="{{ $devise_agence->devise_id }}">{{ $devise_agence->devise->devise .' : '.$devise_agence->devise->unite }}</option>
                    @endforeach
                </select>
              </div>
              <div class="col-6" id="taux">
                <label for="inputAddress2" class="form-label">Taux</label>
                <input onchange="calcul()" type="text" name="taux_v" id="taux_v" class="form-control"  >
              </div>
              <div class="col-6" id="stock">
                <label for="inputAddress2" class="form-label">Montant stock</label>
                <input type="text" name="stock" class="form-control"  disabled>
              </div>

              <div class="col-md-6" id="montant">
                <label for="inputCity" class="form-label">Montant devise</label>
                <input type="text" name="montant" class="form-control" id="montant_v" onchange="calcul()" >
              </div>
              <div class="col-md-6" >
                <label for="inputZip" class="form-label">Total</label>
                <input  onkeyup="calcul()" type="text" name="total" class="form-control" id="ttc" disabled>
              </div>
              <div class="col-md-12">
                <label for="inputState" class="form-label">Reglement</label>
                <select id="inputState" name="reglement" class="form-select">
                  @foreach ($reglements as $reglement )
                    <option value="{{ $reglement->id }}">{{ $reglement->reglement }}</option>
                  @endforeach
                </select>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary">Valider</button>
                <button type="reset" class="btn btn-secondary">Annuler</button>
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
          $('#devise').change(function(event){

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
                      $.each(response.devises,function(client,val){
                  // alert(val);
                      $("#taux").append('<label for="inputAddress2" class="form-label">Taux</label> <input onchange="calcul()" type="text" name="taux" id="taux_v" class="form-control"  value="'+val.taux+'">');

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
                      $.each(response.stocks,function(client,val){
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

           var ttc =  Math.round(Number(taux * montant));
           document.getElementById("ttc").value = ttc;

            // var taux= document.querySelector("#taux_v");
            // var montant= document.querySelector("#montant_v");
            // var ttc= document.querySelector("#ttc");
            ttc.value = Math.round(Number(montant.value)*Number(taux.value));
           }



</script>


@endsection
