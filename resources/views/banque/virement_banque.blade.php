@extends('../layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>VIREMENT BANQUE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueille</a></li>
          <li class="breadcrumb-item">BANQUE</li>
          <li class="breadcrumb-item active">VIREMENT BANQUE</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">VIREMENT BANQUE</h5>

              <!-- General Form Elements -->
              <form>
                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">Source</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example">
                      <option selected>Choix compte banque source</option>
                      @foreach ($banques_s as $banque )
                        <option value="{{ $banque->id }}">{{$banque->libelle.' : '.$banque->numero_compte_banque }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">Destination</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example">
                      <option selected>Choix compte banque destination</option>
                      @foreach ($banques_d as $banque )
                        <option value="{{ $banque->id }}">{{$banque->libelle.' : '.$banque->numero_compte_banque }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">Montant</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control">
                  </div>
                </div>
               
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-3 col-form-label">Commentaire</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" style="height: 100px"></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-3 col-form-label">Piece jointe</label>
                  <div class="col-sm-9">
                    <input class="form-control" type="file" id="formFile">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Valider</button>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

<!-- End #main -->
@endsection
