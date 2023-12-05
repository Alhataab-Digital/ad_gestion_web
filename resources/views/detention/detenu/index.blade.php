@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>DETENUS</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">param</li>
          <li class="breadcrumb-item active">detenu</li>
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
                    <a href="">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                        Ajouter detenu
                        </button>
                    </a>
                </h5>
                <!-- Vertical Form -->
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
                      <th scope="col">Nom </th>
                      <th scope="col">Prix achat </th>
                      <th scope="col">Prix revient</th>
                      <th scope="col">Prix vente </th>
                      <th scope="col">stock minimum</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($detenus as $detenu )
                    <tr>

                      <td>{{ $detenu->nom_prenom}}</td>
                      <td>{{ $detenu->date_naissance}}</td>
                      <td>{{ $detenu->lieu_naissance}}</td>
                      <td>{{ $detenu->date_detention}}</td>
                      <td>{{ $detenu->motif_detention}}</td>
                      <td>
                          <a href="{{ route('edit.detenu',$detenu->id) }}">
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
