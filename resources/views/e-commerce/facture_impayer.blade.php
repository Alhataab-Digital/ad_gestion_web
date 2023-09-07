@extends('../layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>REGLEMENT FACTURE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">Documents</li>
          <li class="breadcrumb-item active">facture</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Information du client & facture à payer
                    <br>
                        <hr>
                        <p >
                            Nom client : {{ $client->nom_client }}<br>
                            Telephone : {{ $client->telephone }}<br>
                        </p>
                        <hr>
                    </h5>

                    <!-- Table with stripped rows -->
                    <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date operation</th>
                        <!-- <th scope="col">Date echeance</th> -->
                        <th scope="col">Montant facture</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($factures as $facture)
                      <tr>
                        <th scope="row"><a href="#">{{ $facture->id }}</a></th>
                        <td>{{ $facture->updated_at }}</td>
                        <!-- <td><a href="#" class="text-primary">At praesentium minu</a></td> -->
                        <td>{{number_format($facture->montant_total,2,","," ")  }}</td>
                        <td><span class="badge bg-success">{{ $facture->etat }}</span></td>
                        <td>
                            <a href="{{ route('reglement.paiement',$facture->id) }}">
                                <button type="button" class="btn btn-warning"><i class="bi bi-cart-plus"></i></button>
                            </a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                    <!-- End Table with stripped rows -->
                   
               </div>
                  </div><!-- End Pills Tabs -->

                </div>
              </div>


      </div>
    </section>

</main><!-- End #main -->
@endsection
