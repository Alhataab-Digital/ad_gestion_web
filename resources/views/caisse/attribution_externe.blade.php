@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>ATTRIBUTION CAISSE EXTERNE</h1>
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
              <h5 class="card-title">ATTRIBUTION CAISSE EXTERNE</h5>
              <P>
              @if ($caisse->etat==1 && $caisse->date_comptable!= date("Y-m-d") )
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-octagon me-1"></i>
                    La date operation n'est pas a jour
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if ($caisse->etat==0 )
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-octagon me-1"></i>
                    Caisse fermer
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if ($caisse->etat==1 && $caisse->date_comptable == date("Y-m-d"))
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
              <form  method="post" action="{{ route('caisse.attribution_externe.valider') }}">
                @csrf
                <div class=" mb-6">
                    <label class="col-sm-6 col-form-label">Caisse Destination</label>
                    <div class="col-sm-10">
                      <select class="form-select" name="caisse_destination" required>
                        <option selected>choisir</option>
                        @foreach ($caisse_destinations as $caisse_destination )
                        <option value="{{ $caisse_destination->id }}">{{$caisse_destination->libelle }}</option>
                        @endforeach
                      </select>
                    </div>
                </div>
                <div class="col-sm-10">
                  <label for="inputText" class="col-sm-6 col-form-label">Montant attribuer</label>
                  <div class="col-sm-10">
                    <input type="text" name="montant_operation" class="form-control" required>
                  </div>
                </div>
                <div class="col-sm-10">
                  <label for="inputPassword" class="col-sm-6 col-form-label">commentaire </label>
                  <div class="col-sm-10">
                    <textarea class="form-control" style="height: 100px" name="commentaire"></textarea>
                  </div>
                </div>
                <br>
                <div class="col-sm-10">
                  {{-- <label class="col-sm-2 col-form-label">Submit Button</label> --}}
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Valider</button>
                  </div>
                </div>
              </form><!-- End General Form Elements -->
            </div>
            @endif
          </div>

        </div>
        @if ($caisse->etat==1 && $caisse->date_comptable== date("Y-m-d") )
        <div class="col-lg-6">

            <!-- Special title treatmen -->
            <div class="card text-center">

                <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                      <h4 style="text-decoration:uppercase;">Opération attribution</h4>
                    <!--a class="nav-link active" href="#">Active</a-->
                    </li>
                </ul>
                </div>

                <div class="card-body">

                    <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead class="bg-primary">
                  <tr>
                    <!-- <th scope="col">#</th> -->
                    <th scope="col">Commentaire </th>
                    <th scope="col">Montant</th>
                    <th scope="col">Montant Destination</th>
                    <th scope="col">caisse Destination</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach ($operations as $operation )
                  <tr>
                    <!-- <th scope="row">{{ $operation->id}}</th> -->
                    <td>{{ $operation->commentaire}}</td>
                    <td style="text-align:right">{{ number_format($operation->montant_operation,2,","," ").' '.$operation->caisse->agence->devise->unite}}</td>
                    <td style="text-align:right">{{number_format(ceil(($operation->montant_operation)/($operation->taux)),2,","," ").' '.$operation->caisse_destination->agence->devise->unite}}</td>
                    <td>{{ $operation->caisse_destination->libelle}}</td>

                    <td>
                        <a href="{{ route('caisse.attribution_externe.edit',encrypt($operation->id)) }}">
                            <button type="button" class="btn btn-primary"><i class="bi bi-pencil"></i></button>
                        </a>
                        <a href="{{ route('caisse.attribution.delete',encrypt($operation->id)) }}">
                            <button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                        </a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
                <h5 ></h5>
                    <p class="card-text"></p>
                </div>

            </div><!-- End Special title treatmen -->

            </div>
        </div>
        @endif
      </div>
    </section>

  </main><!-- End #main -->
@endsection
