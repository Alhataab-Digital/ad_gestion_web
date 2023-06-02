<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
                                {{ $operation->client->id }}
                                {{ $operation->client->telephone }}

                                {{ $operation->client->nom_client }}

                                {{ $operation->client->adresse }}

                                {{ $operation->devise->monnaie .' : '.$operation->devise->devise }}
                                {{ $operation->taux }}
                                {{ number_format($operation->montant_operation,2,","," ").' '.$operation->devise->unite }}
                                {{ $operation->reglement->reglement }}
                                {{ number_format($operation->montant_operation*$operation->taux,2,","," ").' '.$agence->devise->unite }}


    </body>
</html>
