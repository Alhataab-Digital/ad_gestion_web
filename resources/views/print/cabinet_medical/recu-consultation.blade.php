<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reçu Consultation</title>
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
            text-align: left;
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
        margin-top: -5em;
        text-align: center;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">RECU DE CONSULTATION</div>
        <table>
            <thead>
                <tr>
                    <td style="width:70px;">
                        <img class="logo" src="{{$logo}}" alt="Logo">
                    </td>
                    <th colspan="6" class="company-info">
                        Societe : {{ $recu_consultation->societe->raison_sociale }}<br>
                        Tel : {{ $recu_consultation->societe->telephone }}<br>
                        Adresse : {{ $recu_consultation->societe->adresse }}<br>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="7" class="section-title">Recu n° {{ \Carbon\Carbon::parse($recu_consultation->created_at)->format('dmy') . $recu_consultation->id }}</td>
                </tr>
            </tbody>
            <tbody>
                <tr class="section-title">
                    <td colspan="2">Nom patient</td>
                    <td colspan="2">Prenom patient</td>
                    <td>Age</td>
                    <td>Telephone</td>
                    <td>Adresse</td>
                </tr>
                <tr>
                    <td colspan="2">{{ $recu_consultation->patient->nom }}</td>
                    <td colspan="2">{{ $recu_consultation->patient->prenom }}</td>
                    <td>{{ \Carbon\Carbon::parse($recu_consultation->patient->date_naissance)->age }}</td>
                    <td>{{ $recu_consultation->patient->telephone }}</td>
                    <td>{{ $recu_consultation->patient->adresse }}</td>
                </tr>
            </tbody>
            @if ($recu_consultation->rendez_vous->contrat_id !=0)
                <tbody>
                    <tr class="section-title">
                        <td colspan="3">Assureur</td>
                        <td colspan="2">Telephone assureur</td>
                        <td colspan="2">Taux pris en charge en %</td>
                    </tr>
                    <tr>
                        <td colspan="3"> {{ $recu_consultation->rendez_vous->contrat_assurance->maison_assurance->maison_assurance }}</td>
                        <td colspan="2"> {{ $recu_consultation->rendez_vous->contrat_assurance->maison_assurance->telephone }}</td>
                        <td colspan="2">{{ $recu_consultation->rendez_vous->contrat_assurance->taux_couverture .' % ' }}</td>
                    </tr>
                </tbody>
             @endif
            <tbody>
                <tr class="section-title">
                    <td colspan="2">Nom medecin</td>
                    <td colspan="2">Prenom medecin</td>
                    <td>Telephone medecin</td>
                    <td>Categorie</td>
                    <td>Specialité</td>
                </tr>
                <tr>
                    <td colspan="2">{{ $recu_consultation->rendez_vous->planification->medecin->nom }}</td>
                    <td colspan="2">{{ $recu_consultation->rendez_vous->planification->medecin->prenom }}</td>
                    <td>{{ $recu_consultation->rendez_vous->planification->medecin->telephone }}</td>
                    <td>{{ $recu_consultation->medecin->categorie->categorie_medecin }}</td>
                    <td>{{ $recu_consultation->medecin->specialite->specialite_medecin }}</td>
                </tr>
            </tbody>
            <tbody>
                <tr class="section-title">
                    <td colspan="2">consultation</td>
                    <td >Motif </td>
                    <td>Montant total</td>
                    <td>Montant assureur</td>
                    <td>Montant payé</td>
                    <td>Mode de reglement</td>
                </tr>
                <td colspan="2"> {{ $recu_consultation->rendez_vous->planification->tarif_consultation->type_consultation->type_consultation }}</td></td>
                <td > {{ $recu_consultation->rendez_vous->motif }}</td></td>
                <td>{{ number_format($recu_consultation->rendez_vous->planification->tarif_consultation->montant, 2, ',', ' ') .
                    ' ' .
                    $recu_consultation->user->agence->devise->unite }}</td>

                <td style="color:green">{{ number_format($recu_consultation->montant_assurer, 2, ',', ' ') .
                    ' ' .
                    $recu_consultation->user->agence->devise->unite }}</td>
               <td>{{ number_format($recu_consultation->montant_paye, 2, ',', ' ') .
                        ' ' .
                        $recu_consultation->user->agence->devise->unite }}
                    </td>
                <td > {{ $paiement->reglement->reglement }}</td>
            </tbody>
        </table>
        <div class="text-end">Caissier(e) : <strong>{{ $recu_consultation->user->prenom.' '.$recu_consultation->user->nom }}</strong></div>
    </div>
    <br> <br>
    <hr>
    <br> <br>
    <div class="container">
        <div class="header">RECU DE CONSULTATION</div>
        <table>
            <thead>
                <tr>
                    <td style="width:70px;">
                        <img class="logo" src="{{$logo}}" alt="Logo">
                    </td>
                    <th colspan="6" class="company-info">
                        Societe : {{ $recu_consultation->societe->raison_sociale }}<br>
                        Tel : {{ $recu_consultation->societe->telephone }}<br>
                        Adresse : {{ $recu_consultation->societe->adresse }}<br>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="7" class="section-title">Recu n° {{ \Carbon\Carbon::parse($recu_consultation->created_at)->format('dmy') . $recu_consultation->id }}</td>
                </tr>
            </tbody>
            <tbody>
                <tr class="section-title">
                    <td colspan="2">Nom patient</td>
                    <td colspan="2">Prenom patient</td>
                    <td>Age</td>
                    <td>Telephone</td>
                    <td>Adresse</td>
                </tr>
                <tr>
                    <td colspan="2">{{ $recu_consultation->patient->nom }}</td>
                    <td colspan="2">{{ $recu_consultation->patient->prenom }}</td>
                    <td>{{ \Carbon\Carbon::parse($recu_consultation->patient->date_naissance)->age }}</td>
                    <td>{{ $recu_consultation->patient->telephone }}</td>
                    <td>{{ $recu_consultation->patient->adresse }}</td>
                </tr>
            </tbody>
            @if ($recu_consultation->rendez_vous->contrat_id !=0)
                <tbody>
                    <tr class="section-title">
                        <td colspan="3">Assureur</td>
                        <td colspan="2">Telephone assureur</td>
                        <td colspan="2">Taux pris en charge en %</td>
                    </tr>
                    <tr>
                        <td colspan="3"> {{ $recu_consultation->rendez_vous->contrat_assurance->maison_assurance->maison_assurance }}</td>
                        <td colspan="2"> {{ $recu_consultation->rendez_vous->contrat_assurance->maison_assurance->telephone }}</td>
                        <td colspan="2">{{ $recu_consultation->rendez_vous->contrat_assurance->taux_couverture .' % ' }}</td>
                    </tr>
                </tbody>
             @endif
            <tbody>
                <tr class="section-title">
                    <td colspan="2">Nom medecin</td>
                    <td colspan="2">Prenom medecin</td>
                    <td>Telephone medecin</td>
                    <td>Categorie</td>
                    <td>Specialité</td>
                </tr>
                <tr>
                    <td colspan="2">{{ $recu_consultation->rendez_vous->planification->medecin->nom }}</td>
                    <td colspan="2">{{ $recu_consultation->rendez_vous->planification->medecin->prenom }}</td>
                    <td>{{ $recu_consultation->rendez_vous->planification->medecin->telephone }}</td>
                    <td>{{ $recu_consultation->medecin->categorie->categorie_medecin }}</td>
                    <td>{{ $recu_consultation->medecin->specialite->specialite_medecin }}</td>
                </tr>
            </tbody>
            <tbody>
                <tr class="section-title">
                    <td colspan="2">consultation</td>
                    <td >Motif </td>
                    <td>Montant total</td>
                    <td>Montant assureur</td>
                    <td>Montant payé</td>
                    <td>Mode de reglement</td>
                </tr>
                <td colspan="2"> {{ $recu_consultation->rendez_vous->planification->tarif_consultation->type_consultation->type_consultation }}</td></td>
                <td > {{ $recu_consultation->rendez_vous->motif }}</td></td>
                <td>{{ number_format($recu_consultation->rendez_vous->planification->tarif_consultation->montant, 2, ',', ' ') .
                    ' ' .
                    $recu_consultation->user->agence->devise->unite }}</td>

                <td style="color:green">{{ number_format($recu_consultation->montant_assurer, 2, ',', ' ') .
                    ' ' .
                    $recu_consultation->user->agence->devise->unite }}</td>
               <td>{{ number_format($recu_consultation->montant_paye, 2, ',', ' ') .
                        ' ' .
                        $recu_consultation->user->agence->devise->unite }}
                    </td>
                <td > {{ $paiement->reglement->reglement }}</td>
            </tbody>
        </table>
        <div class="text-end">Caissier(e) : <strong>{{ $recu_consultation->user->prenom.' '.$recu_consultation->user->nom }}</strong></div>
    </div>
    <div class="text-font">{{ $recu_consultation->societe->raison_sociale }}</div>
</body>
</html>
