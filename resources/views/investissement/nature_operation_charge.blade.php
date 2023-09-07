@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>NATURE OPERATION</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">param</li>
          <li class="breadcrumb-item active">nature operation</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
          <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">
              <!-- Basic Modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                  Ajouter nature operation charge
                </button>
              </h5>
              <!-- Vertical Form -->
              <form class="row g-3" method="post" action="{{ route('nature_operation_charge.store') }}" >
                  @csrf
                <div class="modal fade" id="basicModal" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Ajouter nature operation charge</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>

                      <div class="modal-body" >
                          <div class="col-12">
                              <label for="inputNanme4" class="form-label">Nature operation charge</label>
                              <input type="text" name="nature_operation_charge" class="form-control" id="inputNanme4">
                          </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                      </div>

                    </div>
                  </div>
                </div><!-- End Basic Modal-->
            </form><!-- Vertical Form -->
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

                <!-- Table with stripped rows -->
                <table class="table table-borderless datatable">
                    <thead class="bg-primary ">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Type d'activité investissement</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($nature_operation_charges as $nature_operation_charge )
                      <tr>

                        <th scope="row">{{ $nature_operation_charge->id}}</th>
                        <td>{{ $nature_operation_charge->nature_operation_charge}}</td>
                        <td>
                            <a href="{{ route('nature_operation_charge.edit',$nature_operation_charge->id) }}">
                              <button type="button" class="btn btn-primary"><i class="bi bi-pencil"></i></button>
                            </a>

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
      </section>


</main><!-- End #main -->



@endsection
