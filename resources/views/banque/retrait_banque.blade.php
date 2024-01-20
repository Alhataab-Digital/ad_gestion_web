@extends('../layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>RETRAIT BANQUE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueille</a></li>
          <li class="breadcrumb-item">BANQUE</li>
          <li class="breadcrumb-item active">RETRAIT BANQUE</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
      @if ($caisse->etat==1 && $caisse->date_comptable == date("Y-m-d") )
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">RETRAIT BANQUE</h5>

              <!-- General Form Elements -->
              <form method="post" action="{{ route('banque.retrait.create') }}">
                @csrf
              <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">Banque</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="source" required> 
                      <option selected>Choix compte banque</option>
                      @foreach ($banques as $banque )
                        <option value="{{ $banque->id }}">{{$banque->libelle.' : '.$banque->numero_compte_banque }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <fieldset class="row mb-3">
                  <legend class="col-form-label col-sm-3 pt-0">Destination</legend>
                  <div class="col-sm-9">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="destination" id="gridRadios1" value="caisse">
                      <label class="form-check-label" for="gridRadios1">
                        De la Caisse / du coffre fort
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="destination" id="gridRadios2" value="autre">
                      <label class="form-check-label" for="gridRadios2">
                        Simple
                      </label>
                    </div>  
                  </div>
                </fieldset>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">Montant</label>
                  <div class="col-sm-9">
                    <input type="text" name="montant" class="form-control" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-3 col-form-label">Commentaire</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" style="height: 100px" name="commentaire"></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-3 col-form-label">Piece jointe</label>
                  <div class="col-sm-9">
                    <input class="form-control" type="file" name="piece" id="formFile">
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
        <div class="col-lg-6">

            <!-- Special title treatmen -->
            <div class="card text-center">

                <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                      <h4 style="text-decoration:uppercase;">Opération de dépôt</h4>
                    <!--a class="nav-link active" href="#">Active</a-->
                    </li>
                </ul>
                </div>

                <div class="card-body">

                    <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead class="bg-primary">
                  <tr>
                    <th scope="col">Banque Destination</th>
                    <th scope="col">Montant</th>
                    <th scope="col">Source </th>
                    <th scope="col">Commentaire </th>
                    <th scope="col">Date operation</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach ($operations as $operation )
                  <tr>
                    <td>{{ $operation->banque->libelle.' - '.$operation->banque->numero_compte_banque}}</td>
                    <td>{{ $operation->montant_operation}}</td>
                    <td>{{ $operation->source}}</td>
                    <td>{{ $operation->description}}</td>
                    <th scope="row">{{ $operation->date_comptable}}</th>
                    <td>
                        <!-- <a href="{{ route('banque.retrait.valider',$operation->id) }}">
                            <button type="button" class="btn btn-primary"><i class="bi bi-pencil"></i></button>
                        </a>
                        <a href="{{ route('banque.retrait.edit',$operation->id) }}">
                            <button type="button" class="btn btn-primary"><i class="bi bi-pencil"></i></button>
                        </a> -->
                      @if($caisse->date_comptable==$operation->date_comptable)
                        <a href="{{ route('banque.retrait.delete',$operation->id) }}">
                            <button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                        </a>
                      @endif
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
          @elseif ($caisse->etat==1 && $caisse->date_comptable!= date("Y-m-d") )
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="bi bi-exclamation-octagon me-1"></i>
                La date operation de caisse n'est pas a jour
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @else
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-octagon me-1"></i>
                  Caisse fermée
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          @endif
        </div>
      </div>
    </section>

  </main><!-- End #main -->

<!-- End #main -->
@endsection
