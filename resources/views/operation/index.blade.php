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
        
      @if ($caisse->etat==1 && $caisse->date_comptable == date("Y-m-d") )
        <div class=" form-signin w-50 m-auto col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Formulaire de saisie</h5>
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
              <form method="post" action="{{ route('operation.store') }}">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Nature operation</label>
                    <div class="col-sm-8">
                        <select class="form-select" aria-label="Default select example" name="nature_operation_id">
                            <option selected>Choisir la nature</option>
                                @foreach ($nature_operations as $nature_operation )
                                    <option value="{{ $nature_operation->id }}">{{ $nature_operation->nature_operation_charge }}</option>
                                @endforeach
                          </select>
                    </div>
                  </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-4 col-form-label">Montant</label>
                  <div class="col-sm-8">
                    <input type="number" name="montant_operation" class="form-control">
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
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
                  Operations
              </h5>
              <!-- Table with stripped rows -->
              <table class="table table-borderless datatable">
                <thead class="bg-primary ">
                  <tr>
                    {{-- <th scope="col">#</th> --}}
                    <th scope="col">Nature operation </th>
                    <th scope="col">Montant operation</th>
                    <th scope="col">agent caisse</th>
                    <!-- <th scope="col">sens</th> -->
                    <th scope="col">date operation</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($operations as $operation )
                  <tr>

                    <td>{{ $operation->nature_operation_charge->nature_operation_charge}}</td> 
                    <td >{{ number_format($operation->montant_operation,2,","," ").' '.$operation->user->agence->devise->unite}}</td>
                    <td>{{ $operation->user->nom.' '.$operation->prenom}}</td>
                    <!-- <td>{{ $operation->sens_operation}}</td> -->
                  
                    <td>{{ $operation->date_comptable}}</td>
                    <td>
                      @if($operation->date_comptable == date("Y-m-d"))
                        <a href="{{ route('operation.delete',encrypt($operation->id)) }}">
                            <button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                        </a>
                      @else
                      <a href="{{ route('operation.show',encrypt($operation->id)) }}">
                            <button type="button" class="btn btn-secondary"><i class="bi bi-eye"></i></button>
                        </a>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

          </div>
        </div>
      @elseif ($caisse->etat==1 && $caisse->date_comptable!= date("Y-m-d") )
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-octagon me-1"></i>
                    La date operation n'est pas a jour
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @else
      
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-octagon me-1"></i>
                    Caisse fermer
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
      
      @endif
    </section>

  </main><!-- End #main -->
@endsection
