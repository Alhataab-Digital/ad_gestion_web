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
          <div class="card-body bg-secondary text-white">
            <h5 class="card-title text-white">Achat vehicule </h5>

            <!-- Multi Columns Form -->
            <form class="row g-3" method="post" action="{{ route('achat_vehicule.store') }}">
               @csrf
               @method('POST')
               <div class="col-md-6 ">
                    <div class="col-md-12">
                            <input type="hidden" name="f_id" value="{{ $fournisseur->id }}" class="form-control" id="telephone">
                        </div>
                        <div class="col-md-12">
                            <label for="inputName5" class="form-label">Telephone fournisseur</label>
                            <input type="text" name="telephone" value="{{ $fournisseur->telephone }}" class="form-control" id="telephone">
                        </div>
                    <div class="col-md-12">
                            <label for="inputName5" class="form-label">Nom fournisseur</label>
                            <input type="text" name="nom_fournisseur" value="{{ $fournisseur->nom_fournisseur }}" class="form-control" id="telephone">
                    </div>
                    <div class="col-md-12">
                            <label for="inputName5" class="form-label">Adresse fournisseur</label>
                            <input type="text" name="adresse" value="{{ $fournisseur->adresse }}" class="form-control" id="telephone">
                    </div>
                    <br>
               </div>
              <hr>
              <div class="col-md-12">
                  <label for="inputName5" class="form-label">Activite ouverte</label>
                  <input type="hidden" name="activite_id" value="{{ $activite_ouverte->id }}" class="form-control" id="telephone" >
                  <input type="text" name="activite" value="{{ $activite_ouverte->intitule }}" class="form-control" id="telephone" readonly>
              </div>
              <hr>
              <div class="col-md-3" >
                <label for="inputZip" class="form-label">Chassis</label>
                <input type="text" name="chassis" class="form-control" id="ttc" require>
              </div>
              <div class="col-3" id="taux">
                <label for="inputAddress2" class="form-label">Annee</label>
                <input  type="text" name="annee" id="annee" class="form-control" require >
              </div>
              <div class="col-3" id="stock">
                <label for="inputAddress2" class="form-label">Marque</label>
                <input type="text" name="marque" class="form-control" require >
              </div>
              <div class="col-md-3" id="montant">
                <label for="inputCity" class="form-label">Model</label>
                <input type="text" name="model" class="form-control" id="montant_v" require >
              </div>
              <div class="col-4" id="stock">
                <label for="inputAddress2" class="form-label">Charge USA</label>
                <input type="text" onchange="calcul()" name="charge_usa" class="form-control" id="charge_usa" require>
              </div>
              <div class="col-md-4" id="montant">
                <label for="inputCity" class="form-label">Prix achat</label>
                <input type="text" onchange="calcul()" name="prix_achat" class="form-control" id="prix achat" require>
              </div>
              <!-- <div class="col-md-4" >
                <label for="inputZip" class="form-label">Prix de revient</label>
                <input  onkeyup="calcul()" type="text" name="prix_revient" class="form-control" id="prix_revient" >
              </div> -->
              
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


    function calcul(){
    var charge_usa = Number(document.getElementById("charge_usa").value);

    var prix_achat = Number(document.getElementById("prix_achat").value);

           var prix_revient = Number(charge_usa + prix_achat);
           document.getElementById("prix_revient").value = prix_revient;

            // var taux= document.querySelector("#taux_v");
            // var montant= document.querySelector("#montant_v");
            // var ttc= document.querySelector("#ttc");
            prix_revient.value = Math.round(Number(charge_usa.value) + Number(prix_achat.value));
           }



</script>


@endsection
