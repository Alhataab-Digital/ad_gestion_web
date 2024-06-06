<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bulletin d'examen médical</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 20px;
        }

        .header img {
            height: 40px;
            vertical-align: middle;
        }

        .header h1 {
            display: inline;
            margin: 0;
            padding: 0 20px;
            vertical-align: middle;
        }

        .company-details {
            text-align: center;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <img src="{{$logo}}" alt="Logo de la clinique">
            <div>
                Société : {{ $consultation->societe->raison_sociale }}<br>
                Tel : {{ $consultation->societe->telephone }}<br>
                Adresse : {{ $consultation->societe->adresse }}<br>
            </div>
        </div>

        <div class="company-details">
            <h4>Information patient</h4>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nom du Patient</th>
                    <th>Age</th>
                    <th>Sexe</th>
                    <th>ID Patient</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$consultation->patient->nom.' '.$consultation->patient->prenom}}</td>
                    <td>{{ \Carbon\Carbon::parse($consultation->patient->date_naissance)->age }}</td>
                    <td> @if($consultation->patient->civilite->civilite=="Mr")
                        Masculin
                        @else
                        Feminin
                        @endif
                    </td>
                    <td>{{$consultation->patient->numero_patient}}</td>
                </tr>
            </tbody>
        </table>
        <div class="company-details">
            <h1>Bulletin d'Examen Médical</h1>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Date prescrit</th>
                    <th>Type Examen</th>
                    <th>Libelle</th>
                    <th>Résultat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($examens as $examen)
                <tr>
                    <td>{{ $examen->created_at }}</td>
                    <td>{{ $examen->type_examen->type_examen }}</td>
                    <td>{{ $examen->libelle }}</td>
                    <td>{{ $examen->resultat ?? 'en attente' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="section-title">Observations du Médecin</div>
        <table>
            <tr>
                <th>Observation</th>
            </tr>
            <tr>
                <td>RAS</td>
            </tr>
        </table>

        <div class="section-title">Recommandations</div>
        <table>
            <tr>
                <th>Recommandation</th>
            </tr>
            <tr>
                <td>RAS</td>
            </tr>
        </table>

        <p>Veuillez consulter votre médecin pour plus de détails sur vos résultats d'examens.</p>
    </div>

</body>

</html>
