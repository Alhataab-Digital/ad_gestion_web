hello
@extends('../layouts.app')

@section('content')


<main id="main" class="main">

    <div class="pagetitle">
      <h1>OPERATION PAIEMENT FACTURE </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Accueil</a></li>
          <li class="breadcrumb-item">Reglement & recouvrement</li>
          <li class="breadcrumb-item active">operation paiement facture</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">

        <div class="col-lg-8">

            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title  text-white">Facture N°{{ $facture->id}}</h5>
                        <p>
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
                        </p>

                      <!-- No Labels Form -->
                      <form class="row g-3" method="post" action="{{ route('reglement.store') }}">
                            @csrf
                        <div class="col-md-6">
                            
                            <label for="">Nom prenom client</label>
                                <input type="text" name="" value="{{ $client->nom_client }}" class="form-control" readonly>
                            </div>
                            <div class="col-md-6">
                            <label for="">Montant facturé</label>
                                <input type="text" name="" value='{{ number_format(($facture->montant_total),2,","," ")}}' class="form-control" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="">Montant payer</label>
                                <input type="text" name="" value='{{ number_format(($reglement_facture->montant_regle),2,","," ")}}' class="form-control" readonly>
                            </div>
                            <div class="col-md-6">

                                <label for="">Montant à regler</label>
                                <input type="text"  value='{{ number_format(($facture->montant_total-$reglement_facture->montant_regle),2,","," ")}}' class="form-control" readonly>
                            </div>
                            <hr>
                            <div class="col-md-6">
                            <input type="hidden" name="facture_id" value="{{$facture->id}}" class="form-control" placeholder="Paiement">
                            <label for="">Reglement</label>
                                <input type="text" name="montant" class="form-control" placeholder="Paiement">
                            </div>
                            <div class="col-md-4">
                            <label for="">Type de reglement</label>
                                <select id="inputState" class="form-select" name="reglement">
                                    <option value="0">Mode de paiement...</option>
                                    @foreach ($reglements as $reglement )

                                    <option value="{{ $reglement->id }}">{{ $reglement->reglement }}</option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- End No Labels Form -->
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
                <table class="table table-borderless ">
                <thead class="bg-primary ">
                    <tr>
                    {{-- <th scope="col">#</th> --}}
                    <th scope="col">reglement </th>
                    <th scope="col">Montant operation</th>
                    <th scope="col">date operation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($operations as $operation )
                    <tr>

                    {{-- <th scope="row">{{ $operation->id}}</th> --}}
                    <td>{{ $operation->reglement->reglement}}</td>
                    <td >{{ number_format($operation->montant_operation,2,","," ")}}</td>

                    <td>{{ $operation->created_at}}</td>
                    
                    </tr>
                    @endforeach
                </tbody>
                </table>
                <!-- End Table with stripped rows -->

            </div>
            </div>

        </div>
    </section>

  </main><!-- End #main -->

  @endsection
