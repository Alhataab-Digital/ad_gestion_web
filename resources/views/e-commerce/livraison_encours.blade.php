@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Livraison</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">Documents</li>
          <li class="breadcrumb-item active">Livraison</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
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
              
                @if($livraison->etat=='valider')
                <h5 class="card-title ">
                    <div class="text-end">
                        <a  href="{{route('commande')}}">
                            <button class=" btn btn-secondary "><i class="bi bi-box-arrow-right"></i></button>
                        </a>
                    </div>
                </h5>
                @endif
                @if($livraison->etat!='valider')
                <h5 class="card-title ">
                    Livraison N° 000{{ $livraison->id }}
                    <div class="text-end">
                        <a  href="{{route('commande')}}">
                            <button class=" btn btn-secondary "><i class="bi bi-box-arrow-right"></i></button>
                        </a>
                    </div>
                    
                </h5>
              <form method="post" action="{{ route('detail_livrer.store') }}">
                @csrf
                <!-- Browser Default Validation -->

                <div class="col-md-3">
                    <input class="form-control"  type="hidden" name="livraison_id" value="{{ $livraison->id }}"  >
                    <input class="form-control"  type="hidden" name="commande_id" value="{{ $commande->id }}"  >
                    <input class="form-control"  type="hidden" name="fournisseur" value="{{ $commande->fournisseur_id }}"  >
                    <label for="" class="form-label">Entrepot</label>
                    <select class="form-select" id="" name="entrepot" required>
                      <option selected disabled value="">Choose...</option>
                        @foreach ($entrepots as $entrepot )
                        <option value="{{ $entrepot->id }}">
                            {{ $entrepot->nom_entrepot }}
                        </option>

                        @endforeach
                    </select>
                    <label for="" class="form-label">Activite</label>
                    <select class="form-select" id="" name="activite" required>
                      <option selected disabled value="">Choose...</option>
                        @foreach ($activite_investissements as $activite )
                        <option value="{{ $activite->id }}">
                            {{ $activite->type_activite->type_activite }}
                        </option>

                        @endforeach
                    </select>

                  </div>

                  <br>
                  <hr>
                  <div >
                      <!-- Table with stripped rows -->
                      <table class="table table-borderless " >
                          <thead class="bg-primary text-white ">
                              <tr>
                                  <th scope="col">
                                     Produit
                                  </th>
                                  <th scope="col">
                                      Qte
                                  </th>
                                  <th scope="col">
                                      Prix unitaire
                                  </th>
                                  <th scope="col">
                                      Montant total
                                  </th>
                              </tr>
                          </thead>

                        {{-- {{ $total=0 }} --}}
                        @foreach ($detail_commandes as $detail_commande )
                        {{-- {{ $total=$total+($detail_commande->quantite_commandee*$detail_commande->prix_unitaire_commande) }} --}}
                      <tbody class=" text-white" id="show_item" id="tab">
                          <tr>
                              <th scope="row">
                                  <select class="form-select" name="produit_id[]" id="produit"   >
                                      <option value="{{ $detail_commande->produit->id }}">{{ $detail_commande->produit->nom_produit }}</option>
                                  </select>
                              </th>
                              <th scope="row">
                                  <input class="form-control" type="text" name="qte[]" value="{{ $detail_commande->quantite_commandee }}" id="qte_a" readonly>
                              </th>
                              <th scope="row" id="prix_u">
                                  <input class="form-control" type="text" name="prix[]" value="{{ $detail_commande->prix_unitaire_commande }}" id="prix_a" readonly>
                              </th>
                              <th scope="row">
                                  <input class="form-control"  type="text" name="total[]" value="{{ $detail_commande->quantite_commandee*$detail_commande->prix_unitaire_commande }}" id="total" readonly>
                              </th>

                          </tr>

                      </tbody>
                      @endforeach
                      <tr>
                        <td></td>
                        <td></td>
                        <th style="text-align: right">
                           Montant HT
                         </th>
                        <td >
                            <input class="form-control"  type="text" name="montant_ht" value="{{ $total_ht->total }}" id="montant_ht">
                        </td>
                        <td></td>
                      </tr>

                    </table>
                    <!-- End Table with stripped rows -->
                    <br>
                    <div class="text-left">
                        <button type="submit" class="btn btn-success"><i class="bx bxs-save" ></i> </button>
                    </div>
                </div>
              <!-- End Browser Default Validation -->
              </form>
              @endif
            </div>
          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->
    <script src="{{asset('assets/js/jquery.js')}}"></script>
    <script type="text/javascript">



        function prixU(){
                    var ht=0;
                        var totaux=document.getElementsByName('total[]');
                        for(let index=0;index<totaux.length; index++){
                            var total=totaux[index].value;
                            ht=+(ht)+ +(total);
                        }
                        document.getElementById('montant_ht').value= ht;

        }
    </script>

@endsection
