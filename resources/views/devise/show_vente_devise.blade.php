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

                <div class="col-md-12">
                    <input type="hidden" name="c_id" value="{{ $operation->client->id }}" class="form-control" id="telephone">
                </div>
                <div class="col-md-12">
                    <label for="inputName5" class="form-label">Telephone client</label>
                    <input type="text" name="telephone" value="{{ $operation->client->telephone }}" class="form-control" id="telephone">
                </div>
               <div class="col-md-12">
                    <label for="inputName5" class="form-label">Nom client</label>
                    <input type="text" name="nom" value="{{ $operation->client->nom_client }}" class="form-control" id="telephone">
               </div>
               <div class="col-md-12">
                    <label for="inputName5" class="form-label">Adresse</label>
                    <input type="text" name="adresse" value="{{ $operation->client->adresse }}" class="form-control" id="telephone">
              </div>
              <div class="col-md-12">
                <label for="inputState" class="form-label">Devise</label>
                <select onchange="calcul()" id="devise" name="devise" class="form-select">
                <option  value="">{{ $operation->devise->monnaie .' : '.$operation->devise->devise }}</option>

                </select>
              </div>
              <div class="col-6" id="taux">
                <label for="inputAddress2" class="form-label">Taux vente</label>
                <input  type="text"  name="taux_v" value="{{ $operation->taux }}" id="taux_v" class="form-control"  >
              </div>


              <div class="col-md-6" id="montant">
                <label for="inputCity" class="form-label">Montant devise vente</label>
                <input type="text" name="montant" value="{{ number_format(round($operation->montant_operation/$operation->taux),2,","," ").' '.$operation->devise->unite }}" class="form-control" id="montant_v" >
              </div>
              <div class="col-md-6">
                <label for="inputState" class="form-label">Reglement</label>
                <select id="inputState" name="reglement" class="form-select">

                    <option value="">{{ $operation->reglement->reglement }}</option>

                </select>
             </div>
              <div class="col-md-6" >
                <label for="inputZip" class="form-label">Total</label>
                <input   type="text" name="total" value="{{ number_format($operation->montant_operation,2,","," ").' '.$agence->devise->unite }}" class="form-control" id="ttc" disabled>
              </div>
              <div class="text-center">
                <a href="{{ route('vente_devise.print',$operation->id) }}">
                <div class="btn btn-primary"> Imprimer</div>
                </a>
                <a href="{{ route('vente_devise') }}">
                    <div class="btn btn-secondary"> Quitter</div>
                    </a>
              </div>

            </form><!-- End Multi Columns Form -->

          </div>
        </div>

      </div>

    </div>
  </section>

</main><!-- End #main -->

  @endsection
