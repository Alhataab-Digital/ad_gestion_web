<main id="main" class="main">

    <div class="pagetitle">
        {{-- <h1>Cards</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Components</li>
                <li class="breadcrumb-item active">Cards</li>
            </ol>
        </nav> --}}
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row align-items-top">
            <div class="col-lg-12">
                <div class="text-white card-header bg-secondary">
                    <li class="text-white list-group-item d-flex justify-content-between align-items-center">
                        <h5>Consultation N° {{ $consultation->id }} du {{$consultation->rendez_vous->date_rdv}} du patient :
                            {{$consultation->patient->civilite->civilite.' '.$consultation->patient->prenom.'
                            '.$consultation->patient->nom.'
                            '.(\Carbon\Carbon::parse($consultation->patient->date_naissance)->age.' ans' )}} pour :
                            {{$consultation->rendez_vous->motif}}</h5>
                        <span class=" bg-secondary rounded-pill">
                            {{-- <button class="btn btn-warning btn-sm"
                                wire:click='terminerConsultation({{$consultation->id}})'>Terminer la
                                consultation</button> --}}
                            @if(Auth::user()->role->id==6)
                            <a wire:navigate
                                href="{{route('ad.sante.dossier.patient',encrypt($consultation->patient->id))}}">
                                <button class="btn btn-dark btn-sm"><i class="bx bxs-share"></i> Retour</button>
                            </a>
                            @else
                            <a wire:navigate
                            href="{{route('ad.sante.index.consultation')}}">
                            <button class="btn btn-dark btn-sm"><i class="bx bxs-share"></i> Retour</button>
                        </a>
                            @endif
                        </span>
                    </li>
                </div>
            </div>
            <div class="col-lg-6">
                <!-- Default Card -->
                <div class="card">
                    <div class="card-body">
                        {{-- <h5 class="card-title">Informations</h5> --}}
                        <!-- Quill Editor Bubble -->
                        {{-- <p>Diagnostique</p> --}}
                        <hr>
                        <h5 class="card-title">Dignostique</h5>
                        <div class="">
                            <p> {{$consultation->rendez_vous->motif}}</p>
                            <p> {{$traitement->diagnostique}}</p>
                        </div>
                        <!-- End Quill Editor Bubble -->
                        <hr>
                        <!-- Quill Editor Bubble -->
                        {{-- <p>Conclution / conseil</p> --}}
                        <h5 class="card-title">Conclusion</h5>
                        <div class="">
                            <p> {{$traitement->conclusion}}</p>
                        </div>
                        <!-- End Quill Editor Bubble -->

                    </div>
                </div><!-- End Default Card -->

                <!-- Card with header and footer -->
                <div class="card">
                    <div class="card-body">
                        <div class="card-body">
                            <h5 class="card-title">
                                <li class="list-group-item d-flex justify-content-between align-items-center ">
                                    Signes vitaux
                                    <span class=" bg-secondary rounded-pill">
                                        <button type="button" class="btn btn-secondary btn-sm">
                                            imprimer
                                        </button>
                                    </span>
                                </li>
                            </h5>
                            <form class="row g-3" wire:submit.prevent='saveSigne'>
                           @foreach ( $signe_vitaux as $signe_vitau )



                           <div class="text-center text-white card-header bg-secondary">
                            Constantes Physiques
                        </div>
                        <div class="col-md-3">
                            <label for="inputName5" class="form-label"><strong> Taille</strong></label>
                            <p>{{$signe_vitau->taille}}</p>
                        </div>
                        <div class="col-md-3">
                            <label for="inputEmail5" class="form-label"><strong>Poid</strong> </label>
                            <p>{{$signe_vitau->poid}}</p>
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword5" class="form-label"><strong>IMC (Indice de Masse Corporelle) </strong> </label>
                            <p>
                                    @php
                                       if($signe_vitau->taille!=null && $signe_vitau->poid!=null){
                                            $imc=round( ($signe_vitau->poid)/($signe_vitau->taille*$signe_vitau->taille));
                                                if($imc<16.5){
                                                 echo  $imc." (Maigreur extrême – dénutrition)";
                                                }else
                                                if(16.5<$imc && $imc<18.5){
                                                    echo    $imc.' (Maigreur)';
                                                }else
                                                if(18.5<$imc && $imc<25){
                                                    echo  $imc.' (Corpulence normale)';
                                                }else
                                                if(25<$imc && $imc<30){
                                                    echo $imc.' (Surpoids ou pré-obésité)';
                                                }else
                                                if(30<$imc && $imc<35){
                                                    echo $imc.' (Obésité modérée (classe I))';
                                                }else
                                                if(35<$imc && $imc<40){
                                                    echo  $imc.' (Obésité sévère (classe II))';
                                                }else
                                                if(40<$imc){
                                                    echo  $imc.' (Obésité morbide (classe III))';
                                                }
                                            }
                                       @endphp
                            </p>
                        </div>

                        <div class="text-center text-white card-header bg-secondary">
                            Signe vitaux
                        </div>
                        <div class="col-md-4">
                            <label for="inputName5" class="form-label"><strong>Température corporelle</strong></label>
                            <p>{{$signe_vitau->temperature_corporelle}}</p>
                        </div>
                        <div class="col-md-4">
                            <label for="inputEmail5" class="form-label"><strong>Fréquence cardiaque</strong></label>
                            <p>{{$signe_vitau->frequence_cardiaque}}</p>
                        </div>
                        <div class="col-md-4">
                            <label for="inputPassword5" class="form-label"><strong>Fréquence respiratoire</strong> </label>
                            <p>{{$signe_vitau->frequence_respiratoire}}</p>
                        </div>
                        <div class="col-4">
                            <label for="inputAddress5" class="form-label"><strong>Pression artérielle</strong></label>
                            <p>{{$signe_vitau->pression_arterielle}}</p>
                        </div>
                        <div class="col-4">
                            <label for="inputAddress2" class="form-label"><strong>Saturation en oxygène (SpO2)</strong></label>
                            <p>{{$signe_vitau->saturation_oxygene}}</p>
                        </div>
                        <div class="col-md-4">
                            <label for="inputCity" class="form-label"><strong>Douleur</strong> </label>
                            <p>{{$signe_vitau->douleur}}</p>
                        </div>
                           @endforeach
                        </form>
                        </div>
                    </div>
                </div><!-- End Card with header and footer -->



            </div>

            <div class="col-lg-6">
                <!-- Card with an image on left -->
                <div class="mb-3 card">
                    <div class="row g-0">
                        {{-- <div class="col-md-4">
                            <img src="assets/img/card.jpg" class="img-fluid rounded-start" alt="...">
                        </div> --}}
                        <div class="col-md-12">
                            <div class="card-body">
                                <h5 class="card-title">

                                    <li class="list-group-item d-flex justify-content-between align-items-center ">
                                        Soins medicaux
                                        <span class=" bg-secondary rounded-pill">
                                            <button type="button" class="btn btn-secondary btn-sm">
                                                imprimer
                                            </button>
                                        </span>
                                    </li>
                                </h5>
                                <p class="card-text">
                                    <!-- Small tables -->
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">prescrit par</th>
                                            <th scope="col">Type soins </th>
                                            <th scope="col">libelle </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                                <!-- End small tables -->
                                </p>
                            </div>
                        </div>
                    </div>
                </div><!-- End Card with an image on left -->
                <!-- Card with an image on top -->
                <div class="card">
                    {{-- <img src="assets/img/card.jpg" class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                        <h5 class="card-title">

                            <li class="list-group-item d-flex justify-content-between align-items-center ">
                                Examen prescrit
                                <span class=" bg-secondary rounded-pill">
                                    <button type="button" class="btn btn-secondary btn-sm"
                                    wire:click='ExamenPrint({{$consultation->id}})'>
                                        imprimer
                                    </button>
                                </span>
                            </li>
                        </h5>
                        <p class="card-text">
                            <!-- Small tables -->
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">prescrit par</th>
                                    <th scope="col">Type examen </th>
                                    <th scope="col">Libelle </th>
                                    <th scope="col">Resultat </th>
                                    {{-- <th scope="col">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($examens as $examen )
                                <tr>
                                    <td> {{$examen->created_at}} </td>
                                    <td> {{$examen->medecin->nom.'
                                        '.$examen->medecin->prenom}} </td>
                                    <td> {{$examen->type_examen->type_examen}} </td>
                                    <td> {{$examen->libelle}} </td>
                                    <td> {{$examen->resultat}} </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End small tables -->
                        </p>
                    </div>
                </div><!-- End Card with an image on top -->

                <!-- Card with an image on bottom -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">

                            <li class="list-group-item d-flex justify-content-between align-items-center ">
                                Medicaments prescrit
                                <span class=" bg-secondary rounded-pill">
                                    <button type="button" class="btn btn-secondary btn-sm"
                                        wire:click='recuPrint({{$consultation->id}})'>
                                        imprimer
                                    </button>
                                </span>
                            </li>
                        </h5>
                        <p class="card-text">
                            <!-- Small tables -->
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">prescrit par</th>
                                    <th scope="col">Denomination </th>
                                    <th scope="col">voix </th>
                                    <th scope="col">qte </th>
                                    <th scope="col">posologie </th>
                                    <th scope="col">duree </th>
                                    {{-- <th scope="col">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prescriptions as $prescription )
                                <tr>
                                    <td> {{$prescription->created_at}} </td>
                                    <td> {{$prescription->medecin->nom.'
                                        '.$prescription->medecin->prenom}} </td>
                                    <td> {{$prescription->medicament->denomination}} </td>
                                    <td> {{$prescription->medicament->voies_administrative}} </td>
                                    <td> {{$prescription->quantite}} </td>
                                    <td> {{$prescription->posologie}} </td>
                                    <td> {{$prescription->duree}} </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End small tables -->
                        </p>
                    </div>
                    {{-- <img src="assets/img/card.jpg" class="card-img-bottom" alt="..."> --}}
                </div><!-- End Card with an image on bottom -->

            </div>

        </div>
    </section>

</main><!-- End #main -->
