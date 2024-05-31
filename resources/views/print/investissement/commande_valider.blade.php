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
        <div class="header">COMMANDE VALIDER</div>
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
                Commande N° {{ $commande->id .'/'.\Carbon\Carbon::parse($commande->created_at )->format('d/m/Y')}}

                </h5>
              <form method="post" action="{{ route('livrer.store') }}">
                @csrf
                <!-- Browser Default Validation -->
                <div >
                  {{ 'Activite N° '.$commande->activite->type_activite->id.' : '.$commande->activite->type_activite->type_activite  }}
                </div>

                  <div class="bg-secondary text-white " style="text-align: center">
                      <hr>Produits commandé<hr>
                      </div>
                      <!-- Table with stripped rows -->
                      <table class="table table-borderless " >
                          <thead class="bg-primary text-white ">
                              <tr>
                                  <th class="col-lg-5" scope="col">
                                     Produit
                                  </th>
                                  <th class="col-lg-1" scope="col">
                                      Qte
                                  </th>
                                  <th class="col-lg-3" scope="col">
                                      Prix unitaire
                                  </th>
                                  <th class="col-lg-3" scope="col">
                                      Montant total
                                  </th>
                              </tr>
                          </thead>
                          <tbody class=" text-white" id="show_item" id="tab">
                              @foreach ($detail_commandes as $detail_commande )
                              <tr>
                                  <th class="col-lg-5" scope="row">
                                    {{ $detail_commande->produit->nom_produit }}

                                  </th>
                                  <th class="col-lg-1" scope="row">
                                    {{ $detail_commande->quantite_commandee }}
                                  </th>
                                  <th class="col-lg-3" scope="row" id="prix_u">
                                    {{ $detail_commande->prix_unitaire_commande }}
                                  </th>
                                  <th class="col-lg-3" scope="row">
                                    {{ $detail_commande->quantite_commandee*$detail_commande->prix_unitaire_commande }}
                                  </th>

                              </tr>
                              @endforeach
                          </tbody>
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
                      <div class="bg-secondary text-white " style="text-align: center">
                      <hr>Fournisseur<hr>
                      </div>
                        <table  class="table table-borderless ">
                          <tr>
                            <th>{{ $commande->fournisseur->nom_fournisseur }}
                            </th>
                            <th>
                                {{ $commande->fournisseur->telephone  }}

                            </th>
                            <th>
                                {{ $commande->fournisseur->adresse  }}

                            </th>
                          </tr>
                        </table>
                  </div>
                <!-- End Browser Default Validation -->
              </form>

            </div>

            <div>
                Signature
            </div>
          </div>

    <br>
    {{-- <div class="text-font">{{ $recu_consultation->societe->raison_sociale }}</div> --}}
</body>
</html>
