<main id="main" class="main">

    <div class="pagetitle">
        {{-- <h1>Consultation</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                <li class="breadcrumb-item">param</li>
                <li class="breadcrumb-item active">Consultation</li>
            </ol>
        </nav> --}}
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="m-auto form-signin w-80 col-lg-12 bg-dark">
                <h5 class="text-center text-white card-title">Bulletin examen n° {{ $consultation->numero_ordre }}</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Info patient</h4>
                    </div>
                    <div class="card-body">
                        <!-- Table with stripped rows -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <!-- <th scope="col">#</th> -->
                                    <th scope="col">Dossier patient</th>
                                    <th scope="col">Nom prenom patient</th>
                                    <th scope="col">age</th>
                                    <th scope="col">sexe</th>

                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$consultation->patient->numero_patient}}</td>
                                    <td>{{$consultation->patient->nom.' '.$consultation->patient->prenom}}</td>
                                    <td>{{ \Carbon\Carbon::parse($consultation->patient->date_naissance)->age }}</td>
                                    <td> @if($consultation->patient->civilite->civilite=="Mr")
                                        Masculin
                                        @else
                                        Feminin
                                        @endif
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Examen prescrit</h4>
                        </div>
                        <div class="card-body">
                            <!-- Table with stripped rows -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        {{-- <th>Date prescrit</th> --}}
                                        <th>Type examen</th>
                                        <th>Analyse</th>
                                        <th>Résultat</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach ($examens as $examen)
                                    <tr>
                                        {{-- <td>{{ $examen->created_at }}</td> --}}
                                        <td>{{ $examen->type_examen->type_examen }}</td>
                                        <td>{{ $examen->libelle }}</td>
                                        <td><input type="text"></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>
                </div>
        </div>


    </section>

</main>
<!-- End #main -->
