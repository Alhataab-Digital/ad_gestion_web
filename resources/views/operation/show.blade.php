@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>OPERATION DES CHARGES</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">Autres operation</li>
          <li class="breadcrumb-item active">Operation de charge</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
     <div class=" form-signin w-50 m-auto col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"> </h5>
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
              <form method="post" action="">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Nature operation</label>
                    <div class="col-sm-8">
                        <select class="form-select" aria-label="Default select example" name="nature_operation_id">
                                    <option >{{ $operation->nature_operation_charge->nature_operation_charge }}</option>
                        </select>
                    </div>
                  </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-4 col-form-label">Montant</label>
                  <div class="col-sm-8">
                    <input type="text" name="montant_operation" value='{{number_format($operation->montant_operation,2,","," ")." ".$operation->user->agence->devise->unite}}' class="form-control">
                  </div>
                </div>
                {{-- <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-4 col-form-label">piece jointe</label>
                  <div class="col-sm-8">
                    <input class="form-control" type="file" id="formFile">
                  </div>
                </div> --}}
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-4 col-form-label">commentaire </label>
                  <div class="col-sm-8">
                    <textarea class="form-control" style="height: 100px" name="commentaire">{{ $operation->commentaire }}</textarea>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-10">
                    <!-- <button type="submit" class="btn btn-primary">Valider</button> -->
                    <a href="{{ route('operation') }}">
                    <button type="button" class="btn btn-secondary">Retour</button></a>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>
        </div>
    </section>

  </main><!-- End #main -->
@endsection
