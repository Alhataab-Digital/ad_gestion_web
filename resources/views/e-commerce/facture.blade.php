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
                    <h5 class="card-title">facture de produit et service
                        <p class="text-end">
                            
                        </p>

                    </h5>

                  <!-- Pills Tabs -->
                  <ul class="nav nav-pills nav-tabs-bordered" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#cmd-toutes" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                        Tous les facture
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#cmd-encours" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                        facture en cours
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#cmd-livrer" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                        facture valider
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#cmd-annuler" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                        facture annulé
                        </button>
                    </li>
                  </ul>
                  <div class="tab-content pt-2" id="myTabContent">
                    <div class="tab-pane fade show active" id="cmd-toutes" role="tabpanel" aria-labelledby="home-tab">

                        <!-- Table with stripped rows -->
                        <table class="table table-borderless datatable">
                            <thead class="bg-primary text-white ">
                                <tr>
                                    {{-- <th scope="col">client</th> --}}
                                    <!-- <th>N° Cmd</th> -->
                                    <th scope="col">Montant  facture</th>
                                    <th scope="col">Date operation</th>
                                    <th scope="col">Etat</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($factures as $facture)
                                    <tr>
                                        {{-- <th scope="row">{{ $facture->client->nom_client.' '.$facture->client->telephone }}</th> --}}
                                        <!-- <th scope="row">000{{ $facture->id }}</th> -->
                                        <th scope="row" >{{number_format($facture->montant_total,2,","," ")  }}</th>
                                        <th scope="row">{{ $facture->updated_at }}</th>
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
                    <div class="tab-pane fade" id="cmd-encours" role="tabpanel" aria-labelledby="profile-tab">
                         <!-- Table with stripped rows -->
                         <table class="table table-borderless datatable">
                            <thead class="bg-primary text-white ">
                                <tr>
                                    {{-- <th scope="col">client</th> --}}
                                    <th scope="col">Montant facture</th>
                                    <th scope="col">Date operation</th>
                                    <th scope="col">Etat</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($factures_cs as $facture)
                                <tr>
                                    {{-- <th scope="row">{{ $facture->client->nom_client.' '.$facture->client->telephone }}</th> --}}
                                        <th scope="row">{{ $facture->montant_total }}</th>
                                        <th scope="row">{{ $facture->updated_at }}</th>
                                        <th scope="row">{{ $facture->etat }}</th>
                                    <td>
                                        <a href="">
                                            <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                    <div class="tab-pane fade" id="cmd-livrer" role="tabpanel" aria-labelledby="contact-tab">
                        <!-- Table with stripped rows -->
                        <table class="table table-borderless datatable">
                           <thead class="bg-primary text-white ">
                               <tr>
                                   {{-- <th scope="col">#</th>
                                   <th scope="col">client</th> --}}
                                   <th scope="col">Montant facture</th>
                                   <th scope="col">Date operation</th>
                                   <th scope="col">Etat</th>
                                   <th scope="col">Action</th>
                               </tr>
                           </thead>
                           <tbody>
                                @foreach ($factures_lv as $facture)
                                <tr>
                                    {{-- <th scope="row">{{ $facture->client->nom_client.' '.$facture->client->telephone }}</th> --}}
                                    <th scope="row">{{ $facture->montant_total }}</th>
                                    <th scope="row">{{ $facture->updated_at }}</th>
                                    <th scope="row">{{ $facture->etat }}</th>
                                    <td>
                                        <a href="">
                                            <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                           </tbody>
                       </table>
                       <!-- End Table with stripped rows -->
                   </div>
                   <div class="tab-pane fade" id="cmd-annuler" role="tabpanel" aria-labelledby="contact-tab">
                    <!-- Table with stripped rows -->
                    <table class="table table-borderless datatable">
                       <thead class="bg-primary text-white ">
                           <tr>
                            {{-- <th scope="col">client</th> --}}
                            <th scope="col">Montant facture</th>
                            <th scope="col">Date operation</th>
                            <th scope="col">Etat</th>
                               <th scope="col">Action</th>
                           </tr>
                       </thead>
                       <tbody>
                        @foreach ($factures_an as $facture)
                           <tr>
                                {{-- <th scope="row">{{ $facture->client->nom_client.' '.$facture->client->telephone }}</th> --}}
                                <th scope="row">{{ $facture->montant_total }}</th>
                                <th scope="row">{{ $facture->updated_at }}</th>
                                <th scope="row">{{ $facture->etat }}</th>
                               <td>
                                   <a href="">
                                       <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
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
