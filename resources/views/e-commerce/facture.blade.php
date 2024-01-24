@extends('../layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>FACTURE DE PRODUIT ET SERVICE</h1>
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
                    <h5 class="card-title">Facture de produit et service
                        <p class="text-end">

                        </p>

                    </h5>

                  <!-- Pills Tabs -->
                  <ul class="nav nav-pills nav-tabs-bordered" id="pills-tab" role="tablist">

                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#facture-non-valider" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                        facture non validée
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#facture-impayee" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                        facture impayée
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#facture-echeance" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                        facture à écheance
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#facture-payee" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                        facture payer
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#facture-annulee" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                        facture annulé
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link " id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#facture-toutes" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                        Tous les facture
                        </button>
                    </li>
                  </ul>
                  <div class="tab-content pt-2" id="myTabContent">

                    <div class="tab-pane fade show active" id="facture-non-valider" role="tabpanel" aria-labelledby="profile-tab">
                         <!-- Table with stripped rows -->
                         <table class="table table-borderless datatable">
                            <thead class="bg-primary text-white ">
                                <tr>
                                    <th scope="col">Date operation</th>
                                    <th scope="col" style="text-align:right">Montant facturé</th>
                                    <th scope="col" style="text-align:right">Montant payé</th>
                                    <th scope="col" style="text-align:right">Montant à payer</th>
                                    <th scope="col">Etat</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($factures_nvs as $facture)
                                <tr>
                                        <th scope="row">{{ $facture->updated_at }}</th>
                                        <th scope="row" style="text-align:right">{{ number_format($facture->montant_total,2,","," ")}}{{ $facture->agence->devise->unite }}</th>
                                        <th scope="row" style="text-align:right">{{ number_format($facture->montant_regle,2,","," ")}}{{ $facture->agence->devise->unite }}</th>
                                        <th scope="row" style="text-align:right">{{ number_format(($facture->montant_total-$facture->montant_regle),2,","," ")}}{{ $facture->agence->devise->unite }}</th>
                                        <th scope="row">{{ $facture->etat }}</th>
                                        <td>
                                           @if($facture->etat==Null)
                                           <a href="{{ route('facture.edit',encrypt($facture->id)) }}">
                                            <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                            </a>
                                           @endif
                                           @if($facture->etat!=Null)
                                           <a href="{{ route('detail_facture.show',encrypt($facture->id)) }}">
                                            <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
                                            </a>
                                           @endif
                                           <!-- <a href="{{ route('detail_facture.edit',$facture->id) }}">
                                            <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                            </a> -->
                                        </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                    <div class="tab-pane fade" id="facture-impayee" role="tabpanel" aria-labelledby="contact-tab">
                        <!-- Table with stripped rows -->
                        <table class="table table-borderless datatable">
                           <thead class="bg-primary text-white ">
                               <tr>
                                   <th scope="col">Date operation</th>
                                   <th scope="col">client</th>
                                   <th scope="col" style="text-align:right">Montant facturé</th>
                                   <th scope="col" style="text-align:right">Montant payé</th>
                                   <th scope="col" style="text-align:right">Montant à payer</th>
                                   <th scope="col">Etat</th>
                                   <th scope="col">Action</th>
                               </tr>
                           </thead>
                           <tbody>
                                @foreach ($factures_imps as $facture)
                                <tr>
                                    <th scope="row">{{ $facture->updated_at }}</th>
                                    <th scope="row">{{ $facture->client->nom_client.' '.$facture->client->telephone }}</th>
                                    <th scope="row" style="text-align:right">{{ number_format($facture->montant_total,2,","," ")}}{{ $facture->agence->devise->unite }}</th>
                                    <th scope="row" style="text-align:right">{{ number_format($facture->montant_regle,2,","," ")}}{{ $facture->agence->devise->unite }}</th>
                                    <th scope="row" style="text-align:right">{{ number_format(($facture->montant_total-$facture->montant_regle),2,","," ")}}{{ $facture->agence->devise->unite }}</th>
                                    <th scope="row">{{ $facture->etat }}</th>
                                    <td>
                                           @if($facture->etat==Null)
                                           <a href="{{ route('facture.edit',encrypt($facture->id)) }}">
                                            <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                            </a>
                                           @endif
                                           @if($facture->etat!=Null)
                                           <a href="{{ route('detail_facture.show',encrypt($facture->id)) }}">
                                            <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
                                            </a>
                                           @endif
                                           <!-- <a href="{{ route('detail_facture.edit',$facture->id) }}">
                                            <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                            </a> -->
                                        </td>
                                </tr>
                                @endforeach
                           </tbody>
                       </table>
                       <!-- End Table with stripped rows -->
                    </div>
                    <div class="tab-pane fade" id="facture-echeance" role="tabpanel" aria-labelledby="contact-tab">
                        <!-- Table with stripped rows -->
                        <table class="table table-borderless datatable">
                           <thead class="bg-primary text-white ">
                               <tr>
                                   <th scope="col">Date operation</th>
                                   <th scope="col">client</th>
                                   <th scope="col" style="text-align:right">Montant facturé</th>
                                   <th scope="col" style="text-align:right">Montant payé</th>
                                   <th scope="col" style="text-align:right">Montant à payer</th>
                                   <th scope="col">Etat</th>
                                   <th scope="col">Action</th>
                               </tr>
                           </thead>
                           <tbody>
                                @foreach ($factures_ech as $facture)
                                <tr>
                                    <th scope="row">{{ $facture->updated_at }}</th>
                                    <th scope="row">{{ $facture->client->nom_client.' '.$facture->client->telephone }}</th>
                                    <th scope="row" style="text-align:right">{{ number_format($facture->montant_total,2,","," ")}}{{ $facture->agence->devise->unite }}</th>
                                    <th scope="row" style="text-align:right">{{ number_format($facture->montant_regle,2,","," ")}}{{ $facture->agence->devise->unite }}</th>
                                    <th scope="row" style="text-align:right">{{ number_format(($facture->montant_total-$facture->montant_regle),2,","," ")}}{{ $facture->agence->devise->unite }}</th>

                                    <th scope="row">{{ $facture->etat }}</th>
                                    < <td>
                                           @if($facture->etat==Null)
                                           <a href="{{ route('facture.edit',encrypt($facture->id)) }}">
                                            <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                            </a>
                                           @endif
                                           @if($facture->etat!=Null)
                                           <a href="{{ route('detail_facture.show',encrypt($facture->id)) }}">
                                            <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
                                            </a>
                                           @endif
                                           <!-- <a href="{{ route('detail_facture.edit',$facture->id) }}">
                                            <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                            </a> -->
                                        </td>
                                </tr>
                                @endforeach
                           </tbody>
                       </table>
                       <!-- End Table with stripped rows -->
                    </div>
                    <div class="tab-pane fade" id="facture-payee" role="tabpanel" aria-labelledby="contact-tab">
                        <!-- Table with stripped rows -->
                        <table class="table table-borderless datatable">
                           <thead class="bg-primary text-white ">
                               <tr>
                                   <th scope="col">Date operation</th>
                                   <th scope="col">client</th>
                                   <th scope="col" style="text-align:right">Montant facturé</th>
                                   <th scope="col" style="text-align:right">Montant payé</th>
                                   <th scope="col" style="text-align:right">Montant à payer</th>
                                   <th scope="col">Etat</th>
                                   <th scope="col">Action</th>
                               </tr>
                           </thead>
                           <tbody>
                                @foreach ($factures_pays as $facture)
                                <tr>
                                    <th scope="row">{{ $facture->updated_at }}</th>
                                    <th scope="row">{{ $facture->client->nom_client.' '.$facture->client->telephone }}</th>
                                    <th scope="row" style="text-align:right">{{ number_format($facture->montant_total,2,","," ")}}{{ $facture->agence->devise->unite }}</th>
                                    <th scope="row" style="text-align:right">{{ number_format($facture->montant_regle,2,","," ")}}{{ $facture->agence->devise->unite }}</th>
                                    <th scope="row" style="text-align:right">{{ number_format(($facture->montant_total-$facture->montant_regle),2,","," ")}}{{ $facture->agence->devise->unite }}</th>
                                    <th scope="row">{{ $facture->etat }}</th>
                                    <td>
                                           @if($facture->etat==Null)
                                           <a href="{{ route('facture.edit',encrypt($facture->id)) }}">
                                            <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                            </a>
                                           @endif
                                           @if($facture->etat!=Null)
                                           <a href="{{ route('detail_facture.show',encrypt($facture->id)) }}">
                                            <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
                                            </a>
                                           @endif
                                           <!-- <a href="{{ route('detail_facture.edit',$facture->id) }}">
                                            <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                            </a> -->
                                        </td>
                                </tr>
                                @endforeach
                           </tbody>
                       </table>
                       <!-- End Table with stripped rows -->
                    </div>
                    <div class="tab-pane fade" id="facture-annulee" role="tabpanel" aria-labelledby="contact-tab">
                        <!-- Table with stripped rows -->
                        <table class="table table-borderless datatable">
                        <thead class="bg-primary text-white ">
                            <tr>
                                <th scope="col">Date operation</th>
                                <th scope="col">client</th>
                                <th scope="col" style="text-align:right">Montant facturé</th>
                                <th scope="col" style="text-align:right">Montant payé</th>
                                <th scope="col" style="text-align:right">Montant à payer</th>
                                <th scope="col">Etat</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($factures_anns as $facture)
                            <tr>
                                    <th scope="row">{{ $facture->updated_at }}</th>
                                    <th scope="row">{{ $facture->client->nom_client.' '.$facture->client->telephone }}</th>
                                    <th scope="row" style="text-align:right">{{ number_format($facture->montant_total,2,","," ")}}{{ $facture->agence->devise->unite }}</th>
                                    <th scope="row" style="text-align:right">{{ number_format($facture->montant_regle,2,","," ")}}{{ $facture->agence->devise->unite }}</th>
                                    <th scope="row" style="text-align:right">{{ number_format(($facture->montant_total-$facture->montant_regle),2,","," ")}}{{ $facture->agence->devise->unite }}</th>
                                    <th scope="row">{{ $facture->etat }}</th>
                                    <td>
                                           @if($facture->etat==Null)
                                           <a href="{{ route('facture.edit',encrypt($facture->id)) }}">
                                            <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                            </a>
                                           @endif
                                           @if($facture->etat!=Null)
                                           <a href="{{ route('detail_facture.show',encrypt($facture->id)) }}">
                                            <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
                                            </a>
                                           @endif
                                           <!-- <a href="{{ route('detail_facture.edit',$facture->id) }}">
                                            <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                            </a> -->
                                        </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                    <div class="tab-pane fade " id="facture-toutes" role="tabpanel" aria-labelledby="home-tab">

                        <!-- Table with stripped rows -->
                        <table class="table table-borderless datatable">
                            <thead class="bg-primary text-white ">
                                <tr>
                                    {{-- <th scope="col">client</th> --}}
                                    <!-- <th>N° Cmd</th> -->
                                    <th scope="col">Date operation</th>
                                    <th scope="col" style="text-align:right">Montant facturé</th>
                                    <th scope="col" style="text-align:right">Montant payé</th>
                                    <th scope="col" style="text-align:right">Montant à payer</th>
                                    <th scope="col">Etat</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($factures as $facture)
                                    <tr>
                                        <th scope="row">{{ $facture->updated_at }}</th>
                                        <th scope="row" style="text-align:right">{{ number_format($facture->montant_total,2,","," ")}}{{ $facture->agence->devise->unite }}</th>
                                        <th scope="row" style="text-align:right">{{ number_format($facture->montant_regle,2,","," ")}}{{ $facture->agence->devise->unite }}</th>
                                        <th scope="row" style="text-align:right">{{ number_format(($facture->montant_total-$facture->montant_regle),2,","," ")}}{{ $facture->agence->devise->unite }}</th>
                                        <th scope="row">{{ $facture->etat }}</th>
                                        <td>
                                           @if($facture->etat==Null)
                                           <a href="{{ route('facture.edit',encrypt($facture->id)) }}">
                                            <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                            </a>
                                           @endif
                                           @if($facture->etat!=Null)
                                           <a href="{{ route('detail_facture.show',encrypt($facture->id)) }}">
                                            <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
                                            </a>
                                           @endif
                                           <!-- <a href="{{ route('detail_facture.edit',$facture->id) }}">
                                            <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                            </a> -->
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
