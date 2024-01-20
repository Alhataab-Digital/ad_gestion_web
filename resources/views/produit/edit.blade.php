@extends('../layouts.app')

@section('content')


<main id="main" class="main">

    <div class="pagetitle">
      <h1>MODIFICATION DU PRODUIT</h1>
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
              <h5 class="card-title">
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

            </h5>

              <!-- Vertical Form -->
              <form action="{{ route('produit.update',encrypt($produit->id)) }}" method="post" class="row g-3" >
                @csrf

                <div class="col-12">
                              <label for="inputNanme4" class="form-label">Nom produit</label>
                              <input type="text" name="nom"  value="{{ $produit->nom_produit }}" class="form-control" id="inputNanme4">
                          </div>

                          <div class="col-12">
                              <label for="inputAddress" class="form-label">Prix achat</label>
                              <input type="text" name="prix_a" value="{{ $produit->prix_unitaire_achat }}" class="form-control" id="inputAddress" >
                          </div>
                          <div class="col-12">
                              <label for="inputAddress" class="form-label">Prix de revient</label>
                              <input type="text" name="prix_r" value="{{ $produit->prix_unitaire_revient }}" class="form-control" id="inputAddress" >
                          </div>
                            <div class="col-12">
                              <label for="inputAddress" class="form-label">Prix vente</label>
                              <input type="text" name="prix_v" value="{{ $produit->prix_unitaire_vente }}" class="form-control" id="inputAddress" >
                          </div>

                          <div class="col-12">
                              <label for="inputAddress" class="form-label">Stock minimum</label>
                              <input type="text" name="stock_min" value="{{ $produit->stock_min }}" class="form-control" id="inputAddress" >
                          </div>

                          <div class="col-12">
                              <label for="inputNanme4" class="form-label">Description produit</label>
                              <textarea name="description"   class="form-control" style="height: 100px">{{ $produit->description_produit }}</textarea>
                          </div>
                          <div class="col-12">
                            <label class="form-label"> produit produit</label>
                              <select class="form-select" aria-label="Default select example" name="categorie">
                                    <option value="{{ $produit->categorie_produit_id }}">{{ $produit->categorie->nom_categorie_produit }}</option>
                                @foreach ( $categorie_produits as $categorie_produit )
                                    <option value="{{ $categorie_produit->id }}">{{ $categorie_produit->nom_categorie_produit }}</option>
                                @endforeach
                              </select>
                            </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Modifer</button>
                  <a href="{{ route('produit') }}">
                    <button type="button" class="btn btn-secondary">Retour</button></a>
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>
        </div>

      </div>
    </section>

  </main><!-- End #main -->



@endsection
