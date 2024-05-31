de
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Achat produit</title>
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
        <div class="header">FACTURE ACHAT</div>
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

        <div class="card">
            <div class="card-body">

                <h5 class="card-title ">
                Facture N° {{ $facture->id .'/'.\Carbon\Carbon::parse($facture->created_at )->format('d/m/Y')}}


                </h5>

              <form method="post" action="">
                @csrf
                <!-- Browser Default Validation -->
                <div class="bg-secondary text-white " style="text-align: center">
                          <hr>Entrepot & activité utilisé<hr>
                </div>
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
                             Montant HT
                           </th>
                          <td >
                              {{ $total_ht->total }}
                          </td>
                        </tr>

                      </table>
                      <!-- End Table with stripped rows -->
                      <br>
                      {{-- <div >
                        <button  class="btn btn-success"><i class="bi bi-share"></i> Livrer</button>

                       </div> --}}
                  </div>
                <!-- End Browser Default Validation -->

              </form>
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
              <div class="text-end" >

                Signature

              </div>

            </div>
          </div>

    <br>
    {{-- <div class="text-font">{{ $recu_consultation->societe->raison_sociale }}</div> --}}
</body>
</html>
