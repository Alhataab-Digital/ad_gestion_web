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
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">ATTRIBUTION CAISSE</h5>
              <P>

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

              </P>
              <!-- General Form Elements -->
              <form  method="post" action="{{ route('caisse.attribution.modifier') }}">
                @csrf

                <input type="hidden" name="operation_id" value="{{$operation->id}}" class="form-control" required>
                  
                <div class=" mb-6">
                    <label class="col-sm-6 col-form-label">Caisse Destination</label>
                    <div class="col-sm-10">
                      <select class="form-select" name="caisse_destination" required>
                      <option value="{{ $operation->caisse_destination->id }}">{{$operation->caisse_destination->libelle }}</option>
                        @foreach ($caisse_destinations as $caisse_destination )
                        <option value="{{ $caisse_destination->id }}">{{$caisse_destination->libelle }}</option>
                        @endforeach
                      </select>
                    </div>
                </div>
                <div class="col-sm-10">
                  <label for="inputText" class="col-sm-6 col-form-label">Montant attribuer</label>
                  <div class="col-sm-10">
                    <input type="text" name="montant_operation" value="{{$operation->montant_operation}}" class="form-control" required>
                  </div>
                </div>
                <div class="col-sm-10">
                  <label for="inputPassword" class="col-sm-6 col-form-label">commentaire </label>
                  <div class="col-sm-10">
                    <textarea class="form-control" style="height: 100px" name="commentaire">{{$operation->commentaire}}</textarea>
                  </div>
                </div>
                <br>
                <div class="col-sm-10">
                  {{-- <label class="col-sm-2 col-form-label">Submit Button</label> --}}
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Modifier</button>
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
