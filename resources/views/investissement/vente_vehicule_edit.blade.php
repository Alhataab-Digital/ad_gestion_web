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
          <div class="card-body ">
            <h5 class="card-title text-white">vente vehicule</h5>

            <!-- Multi Columns Form -->
            <form class="row g-3" method="post" action="{{ route('vente_vehicule.update',encrypt($operation->id)) }}">
               @csrf
               @method('POST')
              <div class="col-md-3" >
                <label for="inputZip" class="form-label">Chassis</label>
                <input type="text" name="chassis" class="form-control" id="chassis" value="{{$operation->operation_vehicule_achete->chassis}}" readonly >
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
                <label for="inputAddress2" class="form-label"> Annee</label> <input  type="text"  id="" class="form-control"  value="{{$operation->operation_vehicule_achete->annee}}" readonly>
              </div>
              <div class="col-md-4" id="prix_achat">
                <label for="inputAddress2" class="form-label"> Marque</label> <input  type="text"  id="" class="form-control"  value="{{$operation->operation_vehicule_achete->marque}}" readonly>
              </div>
              <div class="col-md-4" id="prix_revient">
                <label for="inputAddress2" class="form-label"> Modele</label> <input  type="text"  id="" class="form-control"  value="{{$operation->operation_vehicule_achete->model}}" readonly>
              </div>
              <div class="col-md-4" id="prix_vente">
                <label for="inputAddress2" class="form-label">Prix de vente</label> <input  type="text" name="prix_vente" id="" class="form-control"  value="{{$operation->prix_vente}}" >
              </div>

              <div class="text-center" id="valider">
                <button type="submit" class="btn btn-primary">Valider</button>
                <a href="{{route('vente_vehicule')}}"><button class="btn btn-secondary">Annuler</button></a>
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

@endsection
