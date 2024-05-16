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
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">

                <h5 class="card-title ">
                Facture N° {{ $facture->id .'/'.\Carbon\Carbon::parse($facture->created_at )->format('d/m/Y')}}
                    <div class="text-end">
                        <a  href="{{route('reglement.facture')}}">
                            <button class=" btn btn-secondary "><i class="bi bi-box-arrow-right"></i></button>
                        </a>
                    </div>

                </h5>
                <!-- Browser Default Validation -->
                <div class="bg-secondary text-white " style="text-align: center">
                          <hr>Entrepot utilisé<hr>
                          </div>
                  <div class="col mb-3">
                    <table  class="table table-borderless ">
                            <tr>

                              <th>
                                <label for="inputText" class="col-sm-2 col-form-label">Entrepot </label>
                                <div class="">
                                    <input class="form-control"  type="text" name="montant_decaisser" value="{{ $facture->entrepot_stock->nom_entrepot  }}" class="form-control">
                                </div>
                              </th>
                              <th>
                                  <label for="inputText" class="col-sm-2 col-form-label">Activite</label>
                                  <div class="">
                                      <input class="form-control"  type="text" name="" value="{{ 'Activite N°  '. $facture->devis->activite_id.' : '.$facture->devis->activite->type_activite->type_activite  }}" class="form-control">
                                  </div>
                              </th>
                            </tr>
                      </table>
                    </div>
                    <div class="bg-secondary text-white " style="text-align: center">
                          <hr>Info client<hr>
               </div>

                          <table  class="table table-borderless ">
                            <tr>

                              <th>
                                  <label for="inputText" class="col-sm-6 col-form-label">Client</label>
                                  <input class="form-control"  type="text"  value="{{ $facture->client->nom_client }}" class="form-control">
                              </th>
                              <th>
                                  <label for="inputText" class="col-sm-6 col-form-label">Telephone</label>
                                  <input class="form-control"  type="text"  value="{{ $facture->client->telephone  }}" class="form-control">
                              </th>
                              <th>
                                  <label for="inputText" class="col-sm-6 col-form-label">Adresse</label>
                                  <input class="form-control"  type="text"  value="{{ $facture->client->adresse  }}" class="form-control">
                              </th>
                            </tr>
                          </table>
                    <div class="bg-secondary text-white " style="text-align: center">
                          <hr>Produit facturé<hr>
                          </div>
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

                         @foreach ($detail_factures as $detail_facture )
                        <tbody class=" text-white" id="show_item" id="tab">
                            <tr>
                                <th scope="row">
                                    <select class="form-select" name="produit_id[]" id="produit"   >
                                        <option  value="{{ $detail_facture->produit->id }}">{{ $detail_facture->produit->nom_produit }}</option>
                                    </select>
                                </th>
                                <th scope="row">
                                    <input class="form-control" type="text" name="qte[]" value="{{ $detail_facture->quantite_vendue }}" id="qte_a" readonly>
                                </th>
                                <th scope="row" id="prix_u">
                                    <input class="form-control" type="text" name="prix[]" value="{{ $detail_facture->prix_unitaire_vendu }}" id="prix_a" readonly>
                                </th>
                                <th scope="row">
                                    <input class="form-control"  type="text" name="total[]" value="{{ $detail_facture->quantite_vendue*$detail_facture->prix_unitaire_vendu }}" id="total" readonly>
                                </th>

                            </tr>

                        </tbody>
                        @endforeach
                        <tr>
                          <td></td>
                          <td></td>
                          <th style="text-align: right">
                             Montant TTC
                           </th>
                          <td >
                              <input type="text" name="" value='{{ number_format(($total_ht->total),2,","," ")}}' class="form-control" readonly>
                          </td>
                          <td></td>
                        </tr>
                    @if(($facture->montant_total-$reglement_facture->montant_regle)!=0)
                        <tr>
                          <td></td>
                          <td></td>
                          <th style="text-align: right">
                            Montant  Avance
                           </th>
                          <td >
                            <input type="text" name="" value='{{ number_format(($reglement_facture->montant_regle),2,","," ")}}' class="form-control" readonly>
                          </td>
                          <td></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td></td>
                          <th style="text-align: right">
                            Montant à regler
                           </th>
                          <td >
                          <input type="text"  value='{{ number_format(($facture->montant_total-$facture->montant_regle),2,","," ")}}' class="form-control" readonly>
                            </td>
                          <td></td>
                        </tr>
                    @endif
                      </table>
                      <!-- End Table with stripped rows -->
                    @if(($facture->montant_total-$reglement_facture->montant_regle)!=0)
                      <div class="bg-success text-white " style="text-align: center">
                          <hr>Reglement / recouvrement facture<hr>
                    </div>
                    <form class="row g-3" method="post" action="{{ route('reglement.store') }}">
                            @csrf
                          <table  class="table table-borderless ">
                            <tr>
                            <th>
                            <input type="hidden" name="facture_id" value="{{$facture->id}}" class="form-control" placeholder="Paiement">
                            <input type="hidden" name="activite" class="form-control" value="{{$facture->devis->activite_id}}" >

                             </th>
                             <th>

                             </th>
                             <th>

                             </th>
                             <th>

                             </th>
                             <th>

                             </th>
                            <th>
                             <label for="inputText" >Saisie le montant </label>
                                  <input type="text" name="montant" class="form-control" placeholder="Montant versé" required>
                              </th>
                              <th>
                                    <label for="">Type de reglement</label>
                                    <select id="inputState" class="form-select" name="reglement" required>
                                        <option value="0">Mode de paiement...</option>
                                        @foreach ($reglements as $reglement )

                                        <option value="{{ $reglement->id }}">{{ $reglement->reglement }}</option>

                                        @endforeach
                                    </select>
                              </th>
                            </tr>
                          </table>
                      <br>
                      <div >
                             <div class="text-end">
                                <button type="submit" class="btn btn-success">Valider</button>
                                <!-- <button type="reset" class="btn btn-secondary">Reinitialiser</button> -->
                            </div>

                       </div>
                    </form>
                    @endif
                  </div>
                <!-- End Browser Default Validation -->

              <div class="text-end" >

              </div>

            </div>
          </div>

        </div>

      </div>
      <div class="row">

        <!--  -->
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
                    <th scope="col">Facture N°</th>
                    <th scope="col">Activite Investissement</th>
                    <th scope="col">reglement </th>
                    <th scope="col">Montant operation</th>
                    <th scope="col">date operation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($operations as $operation )
                    <tr>

                    <th scope="row">{{'Facture n° ' .$operation->facture->id}}</th>
                    <td>{{'Activite N° '.$operation->activite_investissement->id.' '.$operation->activite_investissement->type_activite->type_activite}}</td>
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
