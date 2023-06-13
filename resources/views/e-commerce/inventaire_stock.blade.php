@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>INVENTAIRE DE STOCK</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">Gestion stock</li>
          <li class="breadcrumb-item active">Inventaire de stock</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Inventaire de stock</h5>
              <!-- Browser Default Validation -->
              <form class="row g-3" method="post" action="{{ route('inventaire_stock.store') }}" >
                @csrf
                <div class="col-md-6">
                  {{-- <label for="validationDefault04" class="form-label"></label> --}}
                  <select class="form-select" id="validationDefault04" name="entrepot" required>
                    <option selected disabled value="">Choix entrepot de stock</option>
                    @foreach ($entrepots as $entrepot )
                    <option value="{{ $entrepot->id }}">{{ $entrepot->nom_entrepot }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-3">
                  <button class="btn btn-primary" type="submit">Recherche</button>
                </div>
              </form>
              <!-- End Browser Default Validation -->
            <hr>

            <!-- Table with stripped rows -->
            <table class="table table-borderless datatable">
                <thead class="bg-primary ">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Produit</th>
                    <th scope="col">quantite en stock</th>
                    <th scope="col">entrepot</th>
                    <th scope="col">agence</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($inventaire_stocks as $inventaire_stock )
                  <tr>

                    <th scope="row">{{ $inventaire_stock->id}}</th>
                    <td>{{ $inventaire_stock->produit->nom_produit}}</td>
                    <td>{{ $inventaire_stock->quantite_en_stock}}</td>
                    <td>{{ $inventaire_stock->entrepot->nom_entrepot}}</td>
                    <td>{{ $inventaire_stock->agence->nom}}</td>

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
