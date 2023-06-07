@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>ATTRIBUTION CAISSE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Acceuil</a></li>
          <li class="breadcrumb-item">caisse</li>
          <li class="breadcrumb-item active">Attribution</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">ATTRIBUTION CAISSE</h5>
              <!-- General Form Elements -->
              <form  method="post" action="{{ route('caisse.attribution.valider') }}">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Caisse Destination</label>
                    <div class="col-sm-10">
                      <select class="form-select" name="caisse_destination" required>
                        <option selected>choisir</option>
                        @foreach ($caisse_destinations as $caisse_destination )
                        <option value="{{ $caisse_destination->id }}">{{$caisse_destination->libelle }}</option>
                        @endforeach
                      </select>
                    </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Montant attribuer</label>
                  <div class="col-sm-10">
                    <input type="text" name="montant" class="form-control" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">commentaire </label>
                  <div class="col-sm-10">
                    <textarea class="form-control" style="height: 100px" name="commentaire"></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  {{-- <label class="col-sm-2 col-form-label">Submit Button</label> --}}
                  <div class="col-sm-10">
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
@endsection
