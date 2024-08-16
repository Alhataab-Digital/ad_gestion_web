<main id="main" class="main">

    <section class="section">
        <div class="row">
            <div class="card-header bg-secondary text-white">
                <li class="list-group-item d-flex justify-content-between align-items-center ">
                    Facture et Reglement hospitalisation
                    <span class=" bg-secondary rounded-pill">
                        <button type="button" class="btn btn-dark ">
                            Retour
                        </button>
                        {{-- <button type="button" class="btn btn-primary ">
                            Nouvelle vente medicament
                        </button> --}}
                    </span>
                </li>
            </div>
            <div class="card">
                <div class="card-body">

                    <!-- Default Tabs -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                        <li class="nav-item" role="facturation">
                            <button class="nav-link active" id="npaye-tab" data-bs-toggle="tab"
                                data-bs-target="#npaye" type="button" role="tab" aria-controls="npaye"
                                aria-selected="false">
                                Facture hospitalisation non payé</button>
                        </li>
                        <li class="nav-item" role="facturation">
                            <button class="nav-link " id="payer-tab" data-bs-toggle="tab"
                                data-bs-target="#paye" type="button" role="tab" aria-controls="paye"
                                aria-selected="false">
                                Facture hospitalisation payé</button>
                        </li>
                        <li class="nav-item" role="caisse">
                            <button class="nav-link" id="caisse-tab" data-bs-toggle="tab" data-bs-target="#caisse"
                                type="button" role="tab" aria-controls="caisse" aria-selected="false">
                                Reglement percus</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2" id="myTabContent">

                        <div class="tab-pane fade show active" id="npaye" role="tabpanel"
                            aria-labelledby="facturation-tab">
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th scope="col">N° FAC</th>
                                        <th scope="col">Patient</th>
                                        <th scope="col">date </th>
                                        <th scope="col">type hospitalisation</th>
                                        {{-- <th scope="col">Medecin</th> --}}
                                        <th scope="col">montant</th>
                                        <th scope="col">part assurer</th>
                                        <th scope="col">part patient</th>
                                        <th scope="col">montant payé</th>
                                        <th scope="col">reste à payer</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        </div>
                        <div class="tab-pane fade show " id="paye" role="tabpanel"
                            aria-labelledby="facturation-tab">
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th scope="col">N° FAC</th>
                                        <th scope="col">Patient</th>
                                        <th scope="col">date </th>
                                        <th scope="col">type hospitalisation</th>
                                        {{-- <th scope="col">Medecin</th> --}}
                                        <th scope="col">montant</th>
                                        <th scope="col">part assurer</th>
                                        <th scope="col">part patient</th>
                                        <th scope="col">montant payé</th>
                                        <th scope="col">reste à payer</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        </div>
                        <div class="tab-pane fade" id="caisse" role="tabpanel" aria-labelledby="caisse-tab">
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <!-- <th scope="col">#</th> -->
                                        <th scope="col">patient</th>
                                        <th scope="col">Telephone patient</th>
                                        <th scope="col">Date operation</th>
                                        <th scope="col">agent caisse</th>
                                        <th scope="col">motif reglement</th>
                                        <th scope="col">type reglement</th>
                                        <th scope="col">Montant reglé</th>
                                        <th scope="col">Status</th>
                                        {{-- <th scope="col">Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        </div>

                    </div><!-- End Default Tabs -->

                </div>
            </div>
        </div>
    </section>

</main>
<!-- End #main -->
