@extends('../layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>COMMANDE DE PRODUIT ET SERVICE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">Documents</li>
          <li class="breadcrumb-item active">Commande</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Commande de produit et service
                        <p class="text-end">
                            <a href="{{ route('commande.create') }}" class="text-end">
                            <button type="button" class="btn btn-success"><i class="bi bi-plus-circle"></i> Nouvelle commande</button>
                            </a>
                        </p>

                    </h5>

                  <!-- Pills Tabs -->
                  <ul class="nav nav-pills nav-tabs-bordered" id="pills-tab" role="tablist">

                    <li class="nav-item " role="presentation">
                        <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#cmd-encours" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                        Commandes en cours
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#cmd-livrer" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                        Commandes receptionnées
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#cmd-annuler" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                        Commandes annulées
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link " id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#cmd-toutes" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                        Toutes les commandes
                        </button>
                    </li>
                  </ul>
                  <div class="tab-content pt-2" id="myTabContent">

                    <div class="tab-pane fade show active" id="cmd-encours" role="tabpanel" aria-labelledby="profile-tab">
                         <!-- Table with stripped rows -->
                         <table class="table table-borderless datatable">
                            <thead class="bg-primary text-white ">
                                <tr>
                                    <th scope="col">Date operation</th>
                                    <th scope="col">Fournisseur</th>
                                    <th scope="col" style="text-align:right">Montant commmande</th>
                                    <th scope="col">Etat</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($commandes_cs as $commande)
                                <tr>
                                    <th scope="row">{{ $commande->updated_at }}</th>
                                    <th scope="row">{{ $commande->fournisseur->nom_fournisseur.' '.$commande->fournisseur->telephone }}</th>
                                    <th scope="row" style="text-align: right">{{number_format($commande->montant_total,2,","," ")  }}{{ $commande->agence->devise->unite }}</th>
                                        <th scope="row">{{ $commande->etat }}</th>
                                        <td>
                                            @if($commande->etat==Null)
                                            <a href="{{ route('commande.edit',encrypt($commande->id)) }}">
                                            <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                             </a>
                                            @endif

                                            @if($commande->etat!=Null)
                                            <a href="{{ route('detail_commande.show',encrypt($commande->id)) }}">
                                             <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
                                             </a>
                                            @endif
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
                                    <th scope="col">Date operation</th>
                                    <th scope="col">Fournisseur</th>
                                    <th scope="col" style="text-align:right">Montant commmande</th>
                                   <th scope="col">Etat</th>
                                   <th scope="col">Action</th>
                               </tr>
                           </thead>
                           <tbody>
                                @foreach ($commandes_lv as $commande)
                                <tr>
                                    <th scope="row">{{ $commande->updated_at }}</th>
                                    <th scope="row">{{ $commande->fournisseur->nom_fournisseur.' '.$commande->fournisseur->telephone }}</th>
                                    <th scope="row" style="text-align: right">{{number_format($commande->montant_total,2,","," ")  }}{{ $commande->agence->devise->unite }}</th>
                                    <th scope="row">{{ $commande->etat }}</th>
                                    <td>
                                        @if($commande->etat==Null)
                                        <a href="{{ route('commande.edit',encrypt($commande->id)) }}">
                                        <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                         </a>
                                        @endif

                                        @if($commande->etat!=Null)
                                        <a href="{{ route('detail_commande.show',encrypt($commande->id)) }}">
                                         <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
                                         </a>
                                        @endif
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
                            <th scope="col">Date operation</th>
                            <th scope="col">Fournisseur</th>
                            <th scope="col" style="text-align:right">Montant commmande</th>
                            <th scope="col">Etat</th>
                               <th scope="col">Action</th>
                           </tr>
                       </thead>
                       <tbody>
                        @foreach ($commandes_an as $commande)
                           <tr>
                                    <th scope="row">{{ $commande->updated_at }}</th>
                                    <th scope="row">{{ $commande->fournisseur->nom_fournisseur.' '.$commande->fournisseur->telephone }}</th>
                                    <th scope="row" style="text-align: right">{{number_format($commande->montant_total,2,","," ")  }}{{ $commande->agence->devise->unite }}</th>
                                <th scope="row">{{ $commande->etat }}</th>
                                <td>
                                    @if($commande->etat==Null)
                                    <a href="{{ route('commande.edit',encrypt($commande->id)) }}">
                                    <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                     </a>
                                    @endif

                                    @if($commande->etat!=Null)
                                    <a href="{{ route('detail_commande.show',encrypt($commande->id)) }}">
                                     <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
                                     </a>
                                    @endif
                                 </td>
                           </tr>
                        @endforeach
                       </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                    </div>
                  </div>
                  <div class="tab-pane fade " id="cmd-toutes" role="tabpanel" aria-labelledby="home-tab">

                    <!-- Table with stripped rows -->
                    <table class="table table-borderless datatable">
                        <thead class="bg-primary text-white ">
                            <tr>
                                {{-- <th scope="col">Fournisseur</th> --}}
                                <th>N° Cmd</th>
                                <th scope="col">Date operation</th>
                                <th scope="col" style="text-align:right">Montant commmande</th>
                                <th scope="col">Etat</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($commandes as $commande)
                                <tr>
                                    {{-- <th scope="row">{{ $commande->fournisseur->nom_fournisseur.' '.$commande->fournisseur->telephone }}</th> --}}
                                    <th scope="row">{{ $commande->id }}</th>
                                    <th scope="row">{{ $commande->updated_at }}</th>
                                    <th scope="row" style="text-align: right">{{number_format($commande->montant_total,2,","," ")  }}{{ $commande->agence->devise->unite }}</th>
                                    <th scope="row">{{ $commande->etat }}</th>
                                    <td>
                                       @if($commande->etat==Null)
                                       <a href="{{ route('commande.edit',encrypt($commande->id)) }}">
                                       <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                        </a>
                                       @endif

                                       @if($commande->etat!=Null)
                                       <a href="{{ route('detail_commande.show',encrypt($commande->id)) }}">
                                        <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
                                        </a>
                                       @endif
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
                  <!-- End Pills Tabs -->

                </div>
              </div>


      </div>
    </section>

</main><!-- End #main -->
@endsection
