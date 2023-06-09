<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>recu retrait change</title>
</head>
<style>
    body {
        width: 100%;
        border: 2px solid;
        border-collapse: collapse;
    }

    .destinatair{
        margin-top: -7cm;
        margin-left:50%;
        border: 1px solid;
        width: 50%;
        height: 10em;
    }
    .INVESTISSEUR{
        border: 1px solid;
        width: 50%;
        height: 10em;
    }
    .entete{
        width: 100%;
        /* border: 1px solid; */
        border-collapse: collapse;
        text-align: center;
    }
     hr{
       border-style: dashed;
       margin-top: 30%;
    }
    .vertical-line{
        border-left: 2px solid #000;
        display: inline-block;
        height: 130px;
        margin: 0 20px;
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
        margin-bottom: 1em;
    }
</style>
<body>
    {{-- style="margin: 0 auto;display: block;width: 500px;" --}}
    <div class="contenu">
        <div class="entete">
            <h1>
                Recu retrait
            </h1>
            recu n° 000{{ $operation->id }}
        </div>
        <div class="INVESTISSEUR">

            <p>NOM PRENOM : {{ $operation->investisseur->nom }}   {{ $operation->investisseur->nom  }}</p>
            <p>TELEPHONE INVESTISSEUR :  {{ $operation->investisseur->telephone }} </p>
            <p>EMAIL :   {{ $operation->investisseur->email }} </p>


         </div>
         <div class="destinatair">
             <p>MONTANT OPERATION :  {{ number_format($operation->montant_operation,2,","," ").' '.$operation->user->agence->devise->unite}}</p>
             <p>MODE DE REGLEMENT :  {{ $operation->reglement->reglement}}</p>
             <p>
                DATE OPERATION :  {{ $operation->created_at }}

             </p>
         </div>
        <hr>
        <div class="entete">
            <h1>
                Recu retrait
            </h1>
            recu n° 000{{ $operation->id }}
        </div>

        <div class="INVESTISSEUR">

            <p>NOM PRENOM : {{ $operation->investisseur->nom }}  {{ $operation->investisseur->nom }} </p>
            <p>TELEPHONE INVESTISSEUR :  {{  $operation->investisseur->telephone  }}</p>
            <p>EMAIL :  {{  $operation->investisseur->email  }}</p>


         </div>
         <div class="destinatair">
             <p>MONTANT OPERATION :  {{ number_format($operation->montant_operation,2,","," ").' '.$operation->user->agence->devise->unite}}</p>
             <p>MODE DE REGLEMENT :  {{ $operation->reglement->reglement}}</p>
             <p>
                DATE OPERATION :  {{ $operation->created_at }}

             </p>
         </div>

        <div class="text-font">Operation de retrait </div>
</div>
</body>
</html>
