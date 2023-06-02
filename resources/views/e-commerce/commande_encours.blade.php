@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Commande</h1>
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

                <h5 class="card-title ">
                    Commande N° 000{{ $commande->id }}
                    <div class="text-end">
                        <a  href="{{route('commande')}}">
                            <button class=" btn btn-secondary "><i class="bi bi-box-arrow-right"></i></button>
                        </a>
                    </div>

                </h5>

              <form method="post" action="{{ route('detail_livrer.store',$commande->id) }}">
                @csrf
                <!-- Browser Default Validation -->
                <div class="col-md-3">
                    <input class="form-control"  type="hidden" name="commande_id" value="{{ $commande->id }}"  >
                    <label for="" class="form-label">Fournisseur</label>
                    <select class="form-select" id="" name="fournisseur" required>
                        <option value="{{ $commande->fournisseur->id }}">{{ $commande->fournisseur->nom_fournisseur }}</option>

                    </select>

                  </div>
                  <div class="col mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Telephone</label>
                    <div class="col-sm-3">
                        <input class="form-control"  type="text" name="montant_decaisser" value="{{ $commande->fournisseur->telephone  }}" class="form-control">
                    </div>
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
                                  <th scope="col">

                                  </th>
                              </tr>
                          </thead>

                        {{-- {{ $total=0 }} --}}
                        @foreach ($detail_commandes as $detail_commande )
                          {{-- {{ $total=$total+($detail_commande->quantite_commandee*$detail_commande->prix_unitaire_commande) }} --}}
                        <tbody class=" text-white" id="show_item" id="tab">
                            <tr>
                                <th scope="row">
                                    <select class="form-select" name="produit[]" id="produit"   >
                                        <option data-prix="{{ $detail_commande->produit->prix_unitaire_achat }}" value="{{ $detail_commande->produit->id }}">{{ $detail_commande->produit->nom_produit }}</option>
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
                                <td>
                                    <button type="button" class="btn btn-danger remove_item_btn" ><i class="bi bi-trash"></i></button>
                                </td>
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
                      <div class="text-end">
                        <button  class="btn btn-primary"><i class="bi bi-share"></i> Livrer</button>
                        <a href="">
                        <button  class="btn btn-info"><i class="bi bi-print"></i> Imprimer</button>
                        </a>
                        <a href="">
                            <button  class="btn btn-danger"><i class="bi bi-x-lg"></i> Annuler</button>
                        </a>
                       </div>
                  </div>
                <!-- End Browser Default Validation -->

              </form>

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
