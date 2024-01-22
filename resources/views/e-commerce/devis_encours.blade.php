@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>DEVIS DE PRODUIT ET SERVICE</h1>
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
                Devis N° {{ $devis->id .'/'.\Carbon\Carbon::parse($devis->created_at )->format('d/m/Y')}}
                    <div class="text-end">
                        <a  href="{{route('devis')}}">
                            <button class=" btn btn-secondary "><i class="bi bi-box-arrow-right"></i></button>
                        </a>
                    </div>
              <form method="post" action="{{ route('facture.store') }}">
              @csrf
                <!-- Browser Default Validation -->
                    @if($devis->activite_id==0)
                          <div class="col-md-6">
                          <label for="" class="form-label">Selectionner l'activité</label>
                            <select class="form-select" id="" name="activite" required>
                              <option selected disabled value="">Choose...</option>
                                @foreach ($activite_investissements as $activite )
                                <option value="{{ $activite->id }}">
                                    {{ 'Activite N° '.$activite->id.' : '.$activite->type_activite->type_activite }}
                                </option>
                                @endforeach
                            </select>
                          </div>
                    @else
                    <div class="col-md-6">
                        <label for="" class="form-label">Selectionner l'activité</label>
                          <select class="form-select" id="" name="activite" required>
                              @foreach ($activite_investissements as $activite )
                              <option value="{{ $activite->id }}">
                                  {{ 'Activite N° '.$activite->id.' : '.$activite->type_activite->type_activite }}
                              </option>
                              @endforeach
                          </select>
                        </div>
                    @endif
                <div class="bg-secondary text-white " style="text-align: center">
                  <hr>Devis produit<hr>
                </div>
                </h5>
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

                       @foreach ($detail_deviss as $detail_devis )
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
                      <div class="bg-secondary text-white " style="text-align: center">
                          <hr>Info client<hr>
                          </div>

                          <table  class="table table-borderless ">
                            <tr>
                            <input class="form-control"  type="hidden" name="devis_id" value="{{ $devis->id }}"  >
                            <input class="form-control"  type="hidden" name="client_id" value="{{ $devis->client->id }}"  >

                              <th>
                                  <label for="inputText" class="col-sm-6 col-form-label">Client</label>
                                  <input class="form-control"  type="text"  value="{{ $devis->client->nom_client }}" class="form-control">
                              </th>
                              <th>
                                  <label for="inputText" class="col-sm-6 col-form-label">Telephone</label>
                                  <input class="form-control"  type="text"  value="{{ $devis->client->telephone  }}" class="form-control">
                              </th>
                              <th>
                                  <label for="inputText" class="col-sm-6 col-form-label">Adresse</label>
                                  <input class="form-control"  type="text"  value="{{ $devis->client->adresse  }}" class="form-control">
                              </th>
                            </tr>
                          </table>
                      <div >
                        <hr>
                        <div class="text-left" >
                          @if ($devis->etat=='en cours')
                          <button  class="btn btn-success"><i class="bi bi-check-square-fill"></i> Confirmer le devis</button>
                          @endif
                        </div>

                        <hr>
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
