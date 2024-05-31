@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>TYPE ACTIVITE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">param</li>
          <li class="breadcrumb-item active">type activité</li>
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
                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                  Ajouter type activité
                </button> --}}
              </h5>
              <!-- Vertical Form -->
              <form class="row g-3" method="post" action="" >
                  @csrf
                <div class="modal fade" id="basicModal" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Ajouter type activite</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>

                      <div class="modal-body" >
                          <div class="col-12">
                              <label for="inputNanme4" class="form-label">Type d'activité</label>
                              <input type="text" name="role" class="form-control" id="inputNanme4">
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
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role )
                      <tr>

                        <th scope="row">{{ $role->id}}</th>
                        <td>{{ $role->role}}</td>
                        <td>
                            <a href="{{ route('role.edit',encrypt($role->id)) }}">
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
