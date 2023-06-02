@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>PRODUITS</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">param</li>
          <li class="breadcrumb-item active">produit</li>
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
                  Ajouter produit
                </button>
              </h5>
              <!-- Vertical Form -->
              <form class="row g-3" method="post" action="{{ route('produit.store') }}" >
                  @csrf
                <div class="modal fade" id="basicModal" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Ajouter produit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>

                      <div class="modal-body" >
                        <div class="col-12">
                            <label class="form-label"> Categorie produit</label>

                              <select class="form-select" aria-label="Default select example" name="categorie">
                                    <option selected>choisir ...</option>
                                @foreach ( $categories as $categorie )
                                    <option value="{{ $categorie->id }}">{{ $categorie->nom_categorie_produit }}</option>
                                @endforeach
                              </select>
                            </div>
                          <div class="col-12">
                              <label for="inputNanme4" class="form-label">Nom produit</label>
                              <input type="text" name="nom" class="form-control" id="inputNanme4">
                          </div>

                          <div class="col-12">
                              <label for="inputAddress" class="form-label">Prix achat</label>
                              <input type="text" name="prix_a" class="form-control" id="inputAddress" >
                          </div>
                          <div class="col-12">
                            <label for="inputAddress" class="form-label">Prix vente</label>
                            <input type="text" name="prix_v" class="form-control" id="inputAddress" >
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Stock minimum</label>
                            <input type="text" name="stock_min" class="form-control" id="inputAddress" >
                        </div>

                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Stock maximum</label>
                            <input type="text" name="stock_max" class="form-control" id="inputAddress" >
                        </div>

                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Description produit</label>
                            <textarea name="description"  class="form-control" style="height: 100px"></textarea>
                            {{-- <input type="text" name="prenom" class="form-control" id="inputNanme4"> --}}
                        </div>

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
                      <th scope="col">Nom </th>
                      <th scope="col">Prix achat </th>
                      <th scope="col">Prix vente </th>
                      <th scope="col">stock minimum</th>
                      <th scope="col">stock maximum</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($produits as $produit )
                    <tr>

                      <th scope="row">{{ $produit->id}}</th>
                      <td>{{ $produit->nom_produit}}</td>
                      <td>{{ $produit->prix_unitaire_achat}}</td>
                      <td>{{ $produit->prix_unitaire_vente}}</td>
                      <td>{{ $produit->stock_max}}</td>
                      <td>{{ $produit->stock_min}}</td>
                      <td>
                          <a href="{{ route('produit.edit',$produit->id) }}">
                              <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
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
