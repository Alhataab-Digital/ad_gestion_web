@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>devis</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">Documents</li>
          <li class="breadcrumb-item active">devis</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">

                <h5 class="card-title ">
                    devis N° 000{{ $devis->id }}
                    <div class="text-end">
                        <a  href="{{route('devis')}}">
                            <button class=" btn btn-secondary "><i class="bi bi-box-arrow-right"></i></button>
                        </a>
                    </div>

                </h5>

              <form method="post" action="{{ route('facture.store') }}">
                @csrf
                <!-- Browser Default Validation -->
                <div class="col-md-3">
                    <input class="form-control"  type="hidden" name="devis_id" value="{{ $devis->id }}"  >
                    <label for="" class="form-label">client</label>
                    <select class="form-select" id="" name="client" required>
                        <option value="{{ $devis->client->id }}">{{ $devis->client->nom_client }}</option>

                    </select>

                  </div>
                  <div class="col mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Telephone</label>
                    <div class="col-sm-3">
                        <input class="form-control"  type="text" name="montant_decaisser" value="{{ $devis->client->telephone  }}" class="form-control">
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
                              </tr>
                          </thead>

                        {{-- {{ $total=0 }} --}}
                        @foreach ($detail_deviss as $detail_devis )
                          {{-- {{ $total=$total+($detail_devis->quantite_devise*$detail_devis->prix_unitaire_devis) }} --}}
                        <tbody class=" text-white" id="show_item" id="tab">
                            <tr>
                                <th scope="row">
                                    <select class="form-select" name="produit[]" id="produit"   >
                                        <option data-prix="{{ $detail_devis->produit->prix_unitaire_achat }}" value="{{ $detail_devis->produit->id }}">{{ $detail_devis->produit->nom_produit }}</option>
                                    </select>
                                </th>
                                <th scope="row">
                                    <input class="form-control" type="text" name="qte[]" value="{{ $detail_devis->quantite_demandee }}" id="qte_v" readonly>
                                </th>
                                <th scope="row" id="prix_u">
                                    <input class="form-control" type="text" name="prix[]" value="{{ $detail_devis->prix_unitaire_demande }}" id="prix_v" readonly>
                                </th>
                                <th scope="row">
                                    <input class="form-control"  type="text" name="total[]" value="{{ $detail_devis->quantite_demandee*$detail_devis->prix_unitaire_demande}}" id="total" readonly>
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
                      <div >
                        @if ($devis->etat=='en cours')
                        <button  class="btn btn-success"><i class="bi bi-share"></i> facturé</button>
                        @endif

                       </div>
                  </div>
                <!-- End Browser Default Validation -->

              </form>
              <div class="text-end" >
                @if ($devis->etat!='annuler')
                <a href="{{ route('livrer.print',$devis->id) }}">
                    <button  class="btn btn-info"><i class="bi bi-print"></i> Imprimer</button>
                </a>
                @endif
                @if ($devis->etat=='en cours')
                <a href="{{ route('devis.delete',$devis->id) }}">
                    <button  class="btn btn-danger"><i class="bi bi-x-lg"></i> Annuler</button>
                </a>
                @endif
              </div>

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
