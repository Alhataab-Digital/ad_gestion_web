@extends('../layouts.app')

@section('content')
<script >



</script>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>VENTE CHANGE</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
        <li class="breadcrumb-item">Operation change</li>
        <li class="breadcrumb-item active">Vente change</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Vente change</h5>

            <!-- Multi Columns Form -->
            <form class="row g-3" method="post" action="{{ route('vente_devise.store') }}">
               @csrf
               @method('POST')
                <div class="col-md-12">
                    <input type="hidden" name="c_id" value="{{ $client->id }}" class="form-control" id="telephone">
                </div>
                <div class="col-md-12">
                    <label for="inputName5" class="form-label">Telephone Client</label>
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
              <div class="col-2" id="marge">
                <label for="inputAddress2" class="form-label">Coefficient taux</label>
                <input onchange="calcul_marge()" type="text" name="marge" id="marge" class="form-control" readonly >
              </div>
              <div class="col-4" id="taux">
                <label for="inputAddress2" class="form-label">Taux vente</label>
                <input onchange="calcul()" type="text" name="taux_v" id="taux_v" class="form-control" readonly >
              </div>

              <div class="col-6" id="stock">
                <label for="inputAddress2" class="form-label">Montant stock</label>
                <input type="text" name="stock" class="form-control"  disabled>
              </div>

              <div class="col-md-6" id="montant">
                <label for="inputCity" class="form-label">Saisie le montant change en {{ $agence->devise->unite }}</label>
                <input type="text" name="montant" class="form-control" id="montant_v" onchange="calcul()" >
              </div>
              {{-- <div class="col-md-3">
                <label for="inputCity" class="form-label"> Marge devise</label>
                <input onkeyup="calcul_marge()" type="text" name="marge_devise" class="form-control" id="marge_devise" readonly >
              </div> --}}
              <div class="col-md-6" >
                <label for="inputZip" class="form-label">Montant vente</label>
                <input  onkeyup="calcul()" type="text" name="ttc" class="form-control" id="ttc" readonly>
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
              $('#marge').html('');
              $.ajax({
                  url:"{{ route('vente_devise.taux') }}",
                  type:'post',
                  dataType:'json',
                  data: {id:devise_id , _token:"{{ csrf_token() }}"},
                  //alert(data);
                  success:function(response){
                    // console.log(response);

                      //$("#taux").html(' <input type="text" name="taux" class="form-control" >');
                      $.each(response.devises,function(fournisseur,val){
                  // alert(val);
                  $("#taux").append('<label for="inputAddress2" class="form-label">Taux</label> <input onchange="calcul()" type="text" name="taux_v" id="taux_v" class="form-control"  value="'+(val.taux+0.01)+'" readonly>');
                  $("#marge").append('<label for="inputAddress2" class="form-label">Coefficient taux</label> <input onchange="calcul_marge()" type="text" name="marge" id="marge_v" class="form-control"  value="'+0.01+'" readonly>');

                    })
                  }
              })

              $('#stock').html('');
              $.ajax({
                  url:"{{ route('vente_devise.stock') }}",
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

                var ttc = Math.round(Number(montant/taux));
        //    var ttc = Math.round(Number(montant/taux)* 100) / 100;

           document.getElementById("ttc").value = ttc;

            // var taux= document.querySelector("#taux_v");
            // var montant= document.querySelector("#montant_v");
            // var ttc= document.querySelector("#ttc");
            // ttc.value = Number(montant.value)*Number(taux.value);
           }

function calcul_marge(){
    var marge = Number(document.getElementById("marge_v").value);

    var montant = Number(document.getElementById("montant_v").value);

                var marge_devise = Math.round(Number(montant/marge));
        //    var ttc = Math.round(Number(montant/taux)* 100) / 100;

           document.getElementById("marge_devise").value = marge_devise;
}


    </script>

  @endsection
