@extends('../layouts.app')

@section('content')


<main id="main" class="main">

    <div class="pagetitle">
      <h1>MODIFICATION DE L'AGENCE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Layouts</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title ">
                        <div style="text-transform:uppercase">
                            Devise d'echange : <strong></strong>
                        </div>
                            <br>
                        <!-- Small Modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#smallModal">
                            <i class="bi bi-plus"></i> Ajouter devise d'echange
                            </button>
                        <!-- Vertical Form -->
                            <form class="row g-3" method="post" action="{{ route('devise.agence') }}" >
                                @csrf
                                <div class="modal fade" id="smallModal" tabindex="-1">
                                    <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title">Ajouter Devise</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="col-12">
                                                <label for="validationDefault04" class="form-label">Devise par defaut</label>
                                                <select class="form-select" id="validationDefault04" name="devise_id" required>
                                                <option selected disabled value="">Choose...</option>
                                                @foreach ( $devises as $devise )
                                                <option value="{{ $devise->id }}">{{ $devise->devise }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12">

                                                <label for="validationDefault04" class="form-label">Devise d'echange</label>
                                                <select class="form-select" id="validationDefault04" name="devise_id" required>
                                                <option selected disabled value="">Choose...</option>
                                                @foreach ( $devises as $devise )
                                                <option value="{{ $devise->id }}">{{ $devise->devise }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputAddress" class="form-label">Taux</label>
                                                <input type="text" name="taux"  class="form-control" id="inputAddress" placeholder="1234">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                        </div>
                                    </div>
                                    </div>
                                </div><!-- End Small Modal-->
                            </form>
                    </h4>

                      <!-- Small tables -->
                    <table class="table table-sm">
                    <thead>
                        <tr>
                                <th scope="col">devise agence</th>
                                <th scope="col">devise d'échange</th>
                                <th scope="col">taux</th>
                                <th scope="col">taux</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($devise_agences as $devise_agence )

                            <tr>
                                <td scope="row">
                                        {{ $agence->devise_agence->devise }}
                                </td>
                                <td scope="row">
                                    {{ $devise_agence->devise->devise }}
                                </td>
                                <td scope="row">
                                    {{ $devise_agence->taux }}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>

                                </td>

                            </tr>


                        @endforeach

                    </tbody>
                    </table>
                <!-- End small tables -->
                </div>
              </div>


        </div>
      </div>
    </section>

  </main><!-- End #main -->



@endsection
