de
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Commande produit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .container {
            width: 100%;
            max-width:100%;
            margin: auto;
            padding: 2px;
            border: 1px solid #ddd;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .logo {
            width: 70px;
        }
        .company-info {
            text-align: center;
            vertical-align: top;
        }
        .section-title {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: left;
        }
        .text-end {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: right;
        }
        .text-font{
        /* Text color */
            color: rgba(0, 0, 0, 0.1);

        /* Text styles */
        font-size: 3rem;
        font-weight: bold;
        text-transform: uppercase;

        /* Rotate the text */
        transform: rotate(-45deg);

        /* Disable the selection */
        user-select: none;
        margin-top: -400px;
        text-align: center;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">REGLEMENT FACTURE</div>
        <table>
            <thead>
                <tr>
                    <td style="width:70px;">
                        <img class="logo" src="{{$logo}}" alt="Logo">
                    </td>
                    <th colspan="6" class="company-info">
                        Societe : {{ $societe->raison_sociale }}<br>
                        Tel : {{ $societe->telephone }}<br>
                        Adresse : {{ $societe->adresse }}<br>
                    </th>
                </tr>
            </thead>
            {{-- <tbody>
                <tr>
                    <td colspan="7" class="section-title">Recu n°</td>
                </tr>
            </tbody>
            <tbody>
                <tr class="section-title">
                    <td colspan="2">N° Dossier</td>
                    <td colspan="2">Prenom nom patient</td>
                    <td>Age</td>
                    <td>Telephone</td>
                    <td>Adresse</td>
                </tr>

            </tbody>
            <tbody>
                <tr class="section-title">
                    <td colspan="2">Nom medecin</td>
                    <td colspan="2">Prenom medecin</td>
                    <td>Telephone medecin</td>
                    <td>Categorie</td>
                    <td>Specialité</td>
                </tr>
            </tbody> --}}
        </table>

        <div class="col-lg-12">

            <div class="card">
              <div class="card-body">

                  <h5 class="card-title ">
                  Facture N° {{ $facture->id .'/'.\Carbon\Carbon::parse($facture->created_at )->format('d/m/Y')}}
                  </h5>
                  <!-- Browser Default Validation -->
                  <div class="bg-secondary text-white " style="text-align: center">
                            <hr>Entrepot utilisé<hr>
                            </div>
                    <div class="col mb-3">
                      <table  class="table table-borderless ">
                              <tr>

                                <th>
                                  <div class="">
                                     {{ $facture->entrepot_stock->nom_entrepot  }}
                                  </div>
                                </th>
                                <th>
                                    <div class="">
                                        {{ 'Activite N°  '. $facture->devis->activite_id.' : '.$facture->devis->activite->type_activite->type_activite  }}
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
                                    {{ $facture->client->nom_client }}
                                </th>
                                <th>
                                    {{ $facture->client->telephone  }}
                                </th>
                                <th>
                                    {{ $facture->client->adresse  }}
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
                                      {{ $detail_facture->produit->nom_produit }}
                                  </th>
                                  <th scope="row">
                                      {{ $detail_facture->quantite_vendue }}
                                  </th>
                                  <th scope="row" id="prix_u">
                                      {{ $detail_facture->prix_unitaire_vendu }}
                                  </th>
                                  <th scope="row">
                                      {{ $detail_facture->quantite_vendue*$detail_facture->prix_unitaire_vendu }}
                                  </th>

                              </tr>

                          </tbody>
                          @endforeach
                          <tr>
                            <th colspan="3" style="text-align: right">
                               Montant TTC
                             </th>
                            <td >
                              {{ number_format(($total_ht->total),2,","," ")}}
                            </td>
                          </tr>
                      @if(($facture->montant_total-$reglement_facture->montant_regle)!=0)
                          <tr>
                            <th colspan="3" style="text-align: right">
                              Montant  Avance
                             </th>
                            <td >
                              {{ number_format(($reglement_facture->montant_regle),2,","," ")}}
                            </td>
                          </tr>
                          <tr>
                            <th colspan="3" style="text-align: right">
                              Montant à regler
                             </th>
                            <td >
                            {{ number_format(($facture->montant_total-$facture->montant_regle),2,","," ")}}
                              </td>
                          </tr>
                      @endif
                        </table>

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
                        <th scope="col">Reglmt N°</th>
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

                        <th scope="row">{{'Reglmt n° ' .$operation->id}}</th>
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
              <div>
                Signature
              </div>
              </div>

          </div>

    <br>
    {{-- <div class="text-font">{{ $recu_consultation->societe->raison_sociale }}</div> --}}
</body>
</html>
