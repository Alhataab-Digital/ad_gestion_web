<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>recu envoi change</title>
</head>
<style>
    body {
        width: 100%;
        border: 1px solid;
        border-collapse: collapse;
    }

    .destinatair{
        margin-top: -9cm;
        margin-left:50%;
        /* border: 1px solid; */
        width: 50%;
        height: 18em;
        text-transform: uppercase;
    }
    .expediteur{
        /* border: 1px solid; */
        width: 50%;
        height: 18em;
        text-transform: uppercase;
    }
    .entete{
        width: 100%;
        /* border: 1px solid; */
        border-collapse: collapse;
        text-align: center;
    }
     hr{
       border-style: dashed;
       margin-top: 15%;
    }
    .text-font{
        /* Text color */
            color: rgba(0, 0, 0, 0.2);

        /* Text styles */
        font-size: 3rem;
        font-weight: bold;
        text-transform: uppercase;

        /* Rotate the text */
        transform: rotate(-45deg);

        /* Disable the selection */
        user-select: none;
        margin-top: -10em;
    }
</style>
<body>
    {{-- style="margin: 0 auto;display: block;width: 500px;" --}}
    <div class="contenu">
        <div class="entete">
            <h1>
                Recu envoi change
            </h1>
            recu n° {{ $operation->id }}
        </div>
        <div class="expediteur">

            <p>NOM EXPEDITEUR :  {{ $operation->client->nom_client }}</p>
            <p>TELEPHONE EXPEDITEUR :  {{ $operation->client->telephone }}</p>
            <p>PROVENANCE :  {{ $operation->agence->region->nom }}</p>
            <p>MONTANT ENVOYER : {{ number_format($operation->montant,2,","," ").' '.$agence->devise->unite}}</p>
            <p>FRAIS ENVOI : {{ number_format($operation->frais_envoi,2,","," ").' '.$agence->devise->unite}}</p>
            <p>CONDITION ENVOI :
                @if($operation->type_envoi==1)
                frais d'envoi inclus
                @endif
                @if($operation->type_envoi==0)
                 frais d'envoi exclus
                @endif</p>
            <p>MONTANT TOTAL :{{ number_format(round($operation->montant_ttc),2,","," ").' '.$agence->devise->unite}}</p>
        </div>
        <div class="destinatair">
            <p>NOM DESTINATAIRE :  {{ $operation->nom_destinataire }}</p>
            <p>TELEPHONE DESTINATAIRE :  {{ $operation->telephone_destinataire}}</p>
            <P>DESTINATION :  {{ $operation->region->nom }}</P>
            <p>
                @if($operation->type_envoi==1)
                MONTANT A RECEPTIONNE :  {{ number_format(round($operation->montant_ttc/$operation->taux_echange),2,","," ").' '.$agence_destination->devise->unite}}
                @endif
                @if($operation->type_envoi==0)
                MONTANT A RECEPTIONNE :  {{ number_format(round($operation->montant/$operation->taux_echange),2,","," ").' '.$agence_destination->devise->unite}}
                @endif
            </p>
            <p>TAUX DE CHANGE : {{ $operation->taux_echange }}</p>

            <p>CODE ENVOI  : {{ $operation->code_envoi }}</p>
        </div>
        <hr>
        <div class="entete">
            <h1>
                Recu retrait change
            </h1>
            recu n° {{ $operation->id }}
        </div>

        <div class="expediteur">

            <p>NOM EXPEDITEUR :  {{ $operation->client->nom_client }}</p>
            <p>TELEPHONE EXPEDITEUR :  {{ $operation->client->telephone }}</p>
            <p>PROVENANCE :  {{ $operation->agence->region->nom }}</p>
            <p>MONTANT ENVOYER : {{ number_format($operation->montant,2,","," ").' '.$agence->devise->unite}}</p>
            <p>FRAIS ENVOI : {{ number_format($operation->frais_envoi,2,","," ").' '.$agence->devise->unite}}</p>
            <p>CONDITION ENVOI :
                @if($operation->type_envoi==1)
                frais d'envoi inclus
                @endif
                @if($operation->type_envoi==0)
                 frais d'envoi exclus
                @endif</p>
            <p>MONTANT TOTAL :{{ number_format(round($operation->montant_ttc),2,","," ").' '.$agence->devise->unite}}</p>
        </div>
        <div class="destinatair">
            <p>NOM DESTINATAIRE :  {{ $operation->nom_destinataire }}</p>
            <p>TELEPHONE DESTINATAIRE :  {{ $operation->telephone_destinataire}}</p>
            <P>DESTINATION :  {{ $operation->region->nom }}</P>
            <p>
                @if($operation->type_envoi==1)
                MONTANT A RECEPTIONNE :  {{ number_format(round($operation->montant_ttc/$operation->taux_echange),2,","," ").' '.$agence_destination->devise->unite}}
                @endif
                @if($operation->type_envoi==0)
                MONTANT A RECEPTIONNE :  {{ number_format(round($operation->montant/$operation->taux_echange),2,","," ").' '.$agence_destination->devise->unite}}
                @endif
            </p>
            <p>TAUX DE CHANGE : {{ $operation->taux_echange }}</p>

            <p>CODE ENVOI  : {{ $operation->code_envoi }}</p>
        </div>

        <div class="text-font">Envoi change</div>
</div>
</body>
</html>
