@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>DEVISE DU SYSTEME</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">param</li>
          <li class="breadcrumb-item active">devise</li>
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
                Ajouter devise
              </button>
            </h5>
            <!-- Vertical Form -->
            <form class="row g-3" method="post" action="{{ route('devise.store') }}" >
                @csrf
              <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Ajouter devise</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body" >
                        <div class="col-12">
                            <input type="hidden" name="societe_id" value="{{ Auth::user()->societe_id }}" class="form-control" id="inputNanme4">
                        </div>
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Monnaie</label>
                            <input type="text" name="monnaie" class="form-control" id="inputNanme4">
                        </div>
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Devise</label>
                            <input type="text" name="devise" class="form-control" id="inputNanme4">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Unite</label>
                            <input type="text" name="unite" class="form-control" id="inputAddress" >
                        </div>
                        <!-- <div class="col-12">
                            <label for="inputAddress" class="form-label">Taux</label>
                            <input type="text" name="taux" class="form-control" id="inputAddress" >
                        </div> -->

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
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
                    <th scope="col">Monnaie</th>
                    <th scope="col">devise</th>
                    <th scope="col">unite</th>
                    {{-- <th scope="col">taux</th> --}}
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($devises as $devise )
                  <tr>

                    <th scope="row">{{ $devise->id}}</th>
                    <td>{{ $devise->monnaie}}</td>
                    <td>{{ $devise->devise}}</td>
                    <td>{{ $devise->unite}}</td>
                    {{-- <td>{{ $devise->taux}}</td> --}}
                    <td>
                        <a href="{{ route('devise.edit',$devise->id) }}">
                          <button type="button" class="btn btn-primary"><i class="bi bi-pencil"></i></button>
                        </a>
                        <!-- <a href="">
                            <button type="button" class="btn btn-success"><i class="bi bi-check-circle"></i></button>
                        </a>
                        <a href="">
                            <button type="button" class="btn btn-danger"><i class="bi bi-exclamation-octagon"></i></button>
                        </a> -->
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
