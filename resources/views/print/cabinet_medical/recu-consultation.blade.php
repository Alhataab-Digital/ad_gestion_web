<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>recu consultation</title>
</head>
<body>
    <div >
        <div >
            <div >
               RECU DE CONSULTATION
            </div>
<br><br>
            <div >
                <table>
                    <thead>
                        <td style="width:70px ">
                            <img style="width:70px "
                                src="{{$logo}}"
                                alt="">
                        </td>
                        <th>Societe : {{ $recu_consultation->societe->raison_sociale }}
                            <br>Tel : {{ $recu_consultation->societe->telephone }}
                            <br>Adresse : {{ $recu_consultation->societe->adresse }}
                            <br>
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td >
                                <table >
                                    <th colspan="6" >Recu n° {{\Carbon\Carbon::parse($recu_consultation->created_at)->format('dmy').''.$recu_consultation->id }}</th>
                                </table>
                            </td>
                        </tr>
                        <td ></td>
                    </tbody>
                    <tbody>
                        <tr>
                            <td >
                                <table >
                                    <th>Nom patient</th>
                                </table>
                            </td>
                            <td>
                                <table>
                                    <th>Prenom patient</th>
                                </table>
                            </td>
                            <td>
                                <table >
                                    <th>Age</th>
                                </table>
                            </td>
                            <td>
                                <table >
                                    <th>Telephone</th>
                                </table>
                            </td>
                            <td>
                                <table >
                                    <th>Adresse</th>
                                </table>
                            </td>
                        </tr>
                        <td > {{ $recu_consultation->patient->nom }}</td>
                        <td> {{ $recu_consultation->patient->prenom }}</td>
                        <td>{{ \Carbon\Carbon::parse($recu_consultation->patient->date_naissance)->age }}</td>
                        <td>{{ $recu_consultation->patient->telephone }}</td>
                        <td>{{ $recu_consultation->patient->adresse }}</td>
                    </tbody>
                    <tbody>
                        <tr>
                            <td >
                                <table >
                                    <th>Nom medecin</th>
                                </table>
                            </td>
                            <td>
                                <table >
                                    <th>Prenom medecin</th>
                                </table>
                            </td>
                            <td>
                                <table >
                                    <th>Telephone medecin</th>
                                </table>
                            </td>
                            <td>
                                <table >
                                    <th>Type consultation</th>
                                </table>
                            </td>
                            <td>
                                <table >
                                    <th>Prix</th>
                                </table>
                            </td>

                        </tr>

                        <td >{{ $recu_consultation->rendez_vous->planification->medecin->nom }}</td>
                        <td>{{ $recu_consultation->rendez_vous->planification->medecin->prenom }}</td>
                        <td>{{ $recu_consultation->rendez_vous->planification->medecin->telephone }}</td>
                        <td>{{ $recu_consultation->rendez_vous->planification->tarif_consultation->type_consultation->type_consultation }}</td>
                        <td>{{ number_format($recu_consultation->montant_paye, 2, ',', ' ') .
                            '
                                                            ' .
                            $recu_consultation->user->agence->devise->unite }}
                        </td>
                    </tbody>
                </table>
            </div>
            <div >
                <div >

                </div>
            </div>
        </div><!-- End Card with header and footer -->
    </div>
</body>
</html>
