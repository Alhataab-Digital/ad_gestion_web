@extends('../layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>DEVIS DE PRODUIT ET SERVICE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">Documents</li>
          <li class="breadcrumb-item active">Devis</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Devis de produit et service
                        <p class="text-end">
                            <a href="{{ route('devis.create') }}" class="text-end">
                            <button type="button" class="btn btn-success"><i class="bi bi-plus-circle"></i> Nouvelle devis</button>
                            </a>
                        </p>

                    </h5>

                  <!-- Pills Tabs -->
                <ul class="nav nav-pills nav-tabs-bordered" id="pills-tab" role="tablist">

                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#cmd-null" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                        devis non sauvegardé
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link " id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#cmd-encours" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                        devis en cours
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#cmd-valider" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                        devis validé
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#cmd-livrer" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                        devis facturé
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#cmd-annuler" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                        devis annulé
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link " id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#cmd-toutes" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                        Tous les devis
                        </button>
                    </li>
                </ul>
                <div class="tab-content pt-2" id="myTabContent">

                    <div class="tab-pane fade show active" id="cmd-null" role="tabpanel" aria-labelledby="profile-tab">
                        <!-- Table with stripped rows -->
                        <table class="table table-borderless datatable">
                           <thead class="bg-primary text-white ">
                               <tr>
                                   {{-- <th scope="col">Fournisseur</th> --}}
                                   <th scope="col">Date operation</th>
                                   <th scope="col" style="text-align:right">Montant devis</th>
                                   <th scope="col">Etat</th>
                                   <th scope="col">Action</th>
                               </tr>
                           </thead>
                           <tbody>
                               @foreach ($deviss_nv as $devis)
                               <tr>
                                        {{-- <th scope="row">{{ $devis->fournisseur->nom_fournisseur.' '.$devis->fournisseur->telephone }}</th> --}}
                                        <th scope="row">{{ $devis->updated_at }}</th>
                                       <th scope="row" style="text-align:right">{{ number_format($devis->montant_total,2,","," ")}}{{ $devis->agence->devise->unite }}</th>
                                       <th scope="row">{{ $devis->etat }}</th>
                                   <td>
                                    @if($devis->etat==Null)
                                    <a href="{{ route('devis.edit',encrypt($devis->id)) }}">
                                     <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                     </a>
                                    @endif
                                    @if($devis->etat!=Null)
                                    <a href="{{ route('detail_devis.show',encrypt($devis->id)) }}">
                                     <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
                                     </a>
                                    @endif
                                    <!-- @if($devis->etat==Null)
                                    <a href="{{ route('detail_devis.edit',$devis->id) }}">
                                     <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                     </a>
                                    @endif -->
                                   </td>
                               </tr>
                               @endforeach
                           </tbody>
                        </table>
                       <!-- End Table with stripped rows -->
                    </div>
                    <div class="tab-pane fade " id="cmd-encours" role="tabpanel" aria-labelledby="profile-tab">
                        <!-- Table with stripped rows -->
                        <table class="table table-borderless datatable">
                           <thead class="bg-primary text-white ">
                               <tr>
                                   {{-- <th scope="col">Fournisseur</th> --}}

                                   <th scope="col">Date operation</th>
                                   <th scope="col" style="text-align:right">Montant devis</th>
                                   <th scope="col">Etat</th>
                                   <th scope="col">Action</th>
                               </tr>
                           </thead>
                           <tbody>
                               @foreach ($deviss_cs as $devis)
                               <tr>
                                        {{-- <th scope="row">{{ $devis->fournisseur->nom_fournisseur.' '.$devis->fournisseur->telephone }}</th> --}}
                                        <th scope="row">{{ $devis->updated_at }}</th>
                                        <th scope="row" style="text-align:right">{{ number_format($devis->montant_total,2,","," ")}}{{ $devis->agence->devise->unite }}</th>
                                        <th scope="row">{{ $devis->etat }}</th>
                                   <td>
                                    @if($devis->etat==Null)
                                    <a href="{{ route('devis.edit',encrypt($devis->id)) }}">
                                     <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                     </a>
                                    @endif
                                    @if($devis->etat!=Null)
                                    <a href="{{ route('detail_devis.show',encrypt($devis->id)) }}">
                                     <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
                                     </a>
                                    @endif
                                    <!-- @if($devis->etat==Null)
                                    <a href="{{ route('detail_devis.edit',$devis->id) }}">
                                     <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                     </a>
                                    @endif -->
                                   </td>
                               </tr>
                               @endforeach
                           </tbody>
                        </table>
                       <!-- End Table with stripped rows -->
                    </div>
                    <div class="tab-pane fade" id="cmd-valider" role="tabpanel" aria-labelledby="profile-tab">
                        <!-- Table with stripped rows -->
                        <table class="table table-borderless datatable">
                            <thead class="bg-primary text-white ">
                                <tr>
                                    {{-- <th scope="col">Fournisseur</th> --}}
                                   <th scope="col">Date operation</th>
                                   <th scope="col" style="text-align:right">Montant devis</th>
                                    <th scope="col">Etat</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($deviss_vd as $devis)
                                <tr>
                                    {{-- <th scope="row">{{ $devis->fournisseur->nom_fournisseur.' '.$devis->fournisseur->telephone }}</th> --}}
                                        <th scope="row">{{ $devis->updated_at }}</th>
                                        <th scope="row" style="text-align:right">{{ number_format($devis->montant_total,2,","," ")}}{{ $devis->agence->devise->unite }}</th>
                                    <th scope="row">{{ $devis->etat }}</th>
                                    <td>
                                        @if($devis->etat==Null)
                                        <a href="{{ route('devis.edit',encrypt($devis->id)) }}">
                                         <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                         </a>
                                        @endif
                                        @if($devis->etat!=Null)
                                        <a href="{{ route('detail_devis.show',encrypt($devis->id)) }}">
                                         <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
                                         </a>
                                        @endif
                                        <!-- @if($devis->etat==Null)
                                        <a href="{{ route('detail_devis.edit',$devis->id) }}">
                                         <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                         </a>
                                        @endif -->
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
                                   <th scope="col">Fournisseur</th> --}}
                                   <th scope="col">Date operation</th>
                                   <th scope="col" style="text-align:right">Montant devis</th>
                                   <th scope="col">Etat</th>
                                   <th scope="col">Action</th>
                               </tr>
                           </thead>
                           <tbody>
                                @foreach ($deviss_lv as $devis)
                                <tr>
                                    {{-- <th scope="row">{{ $devis->fournisseur->nom_fournisseur.' '.$devis->fournisseur->telephone }}</th> --}}
                                        <th scope="row">{{ $devis->updated_at }}</th>
                                        <th scope="row" style="text-align:right">{{ number_format($devis->montant_total,2,","," ")}}{{ $devis->agence->devise->unite }}</th>
                                    <th scope="row">{{ $devis->etat }}</th>
                                    <td>
                                        @if($devis->etat==Null)
                                        <a href="{{ route('devis.edit',encrypt($devis->id)) }}">
                                         <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                         </a>
                                        @endif
                                        @if($devis->etat!=Null)
                                        <a href="{{ route('detail_devis.show',encrypt($devis->id)) }}">
                                         <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
                                         </a>
                                        @endif
                                        <!-- @if($devis->etat==Null)
                                        <a href="{{ route('detail_devis.edit',$devis->id) }}">
                                         <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                         </a>
                                        @endif -->
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
                                    {{-- <th scope="col">Fournisseur</th> --}}
                                   <th scope="col">Date operation</th>
                                   <th scope="col" style="text-align:right">Montant devis</th>
                                    <th scope="col">Etat</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($deviss_an as $devis)
                                <tr>
                                    {{-- <th scope="row">{{ $devis->fournisseur->nom_fournisseur.' '.$devis->fournisseur->telephone }}</th> --}}
                                        <th scope="row">{{ $devis->updated_at }}</th>
                                        <th scope="row" style="text-align:right">{{ number_format($devis->montant_total,2,","," ")}}{{ $devis->agence->devise->unite }}</th>
                                    <th scope="row">{{ $devis->etat }}</th>
                                    <td>
                                        @if($devis->etat==Null)
                                        <a href="{{ route('devis.edit',encrypt($devis->id)) }}">
                                         <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                         </a>
                                        @endif
                                        @if($devis->etat!=Null)
                                        <a href="{{ route('detail_devis.show',encrypt($devis->id)) }}">
                                         <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
                                         </a>
                                        @endif
                                        <!-- @if($devis->etat==Null)
                                        <a href="{{ route('detail_devis.edit',$devis->id) }}">
                                         <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                         </a>
                                        @endif -->
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                    <div class="tab-pane fade " id="cmd-toutes" role="tabpanel" aria-labelledby="home-tab">

                        <!-- Table with stripped rows -->
                        <table class="table table-borderless datatable">
                            <thead class="bg-primary text-white ">
                                <tr>
                                    {{-- <th scope="col">Fournisseur</th> --}}
                                    <th scope="col">N°</th>
                                    <th scope="col">Date operation</th>
                                    <th scope="col" style="text-align:right">Montant devis</th>
                                    <th scope="col">Etat</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deviss as $devis)
                                    <tr>
                                        {{-- <th scope="row">{{ $devis->fournisseur->nom_fournisseur.' '.$devis->fournisseur->telephone }}</th> --}}
                                        <th scope="row">{{ $devis->id }}</th>
                                        <th scope="row">{{ $devis->updated_at }}</th>
                                       <th scope="row style="text-align:right"">{{ number_format($devis->montant_total,2,","," ")}}{{ $devis->agence->devise->unite }}</th>
                                        <th scope="row">{{ $devis->etat }}</th>
                                        <td>
                                           @if($devis->etat==Null)
                                           <a href="{{ route('devis.edit',encrypt($devis->id)) }}">
                                            <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                            </a>
                                           @endif
                                           @if($devis->etat!=Null)
                                           <a href="{{ route('detail_devis.show',encrypt($devis->id)) }}">
                                            <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
                                            </a>
                                           @endif
                                           <!-- @if($devis->etat==Null)
                                           <a href="{{ route('detail_devis.edit',$devis->id) }}">
                                            <button type="button" class="btn btn-info"><i class="ri ri-edit-line"></i></button>
                                            </a>
                                           @endif -->

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
