<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordonnance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }
        .container {
            width: 60%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .header img {
            height: 40px;
            margin-right: 20px;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
            margin-bottom: 10px;
            text-align: center;
        }
        .info {
            margin-bottom: 20px;
        }
        .info h2 {
            font-size: 20px;
            margin: 0;
        }
        .info p {
            margin: 5px 0;
        }
        .prescription {
            margin-bottom: 20px;
        }
        .prescription h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .prescription ul {
            list-style-type: none;
            padding: 0;
        }
        .prescription ul li {
            margin-bottom: 10px;
            font-size: 16px;
        }
        .signature {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .signature .doctor {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{$logo}}" alt="Logo de la clinique">

            <div>
                Societe : {{ $consultation->societe->raison_sociale }}<br>
                Tel : {{ $consultation->societe->telephone }}<br>
                Adresse : {{ $consultation->societe->adresse }}<br>
            </div>

            <h1>Ordonnance Médicale</h1>
        </div>
        <div class="info">
            <h2>Informations du patient</h2>
            <p>Nom: {{$consultation->patient->nom.' '.$consultation->patient->prenom}}</p>
            <p>Âge: {{ \Carbon\Carbon::parse($consultation->patient->date_naissance)->age }}</p>
            @if($consultation->patient->civilite->civilite=="Mr")
            <p>Sexe: Masculin</p>
            @else
            <p>Sexe: Feminin</p>
            @endif
        </div>
        <div class="prescription">
            <h3>Prescription</h3>
            <ul>
                @foreach ($prescriptions as $prescription )
                <li>{{$prescription->medicament->denomination.' - '.$prescription->quantite.' - '.$prescription->posologie.' sur '.$prescription->duree}}
                    </li>
                @endforeach

            </ul>
        </div>
        <div class="signature">
            <div class="doctor">
                <p>{{$consultation->medecin->titre.' '.$consultation->medecin->nom.' '.$consultation->medecin->prenom}}</p>
                <p>Signature: _____________________</p>
            </div>
        </div>
    </div>
</body>
</html>
