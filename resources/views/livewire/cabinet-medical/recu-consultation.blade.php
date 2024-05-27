<main id="main" class="main">

    {{-- <div class=" pagetitle">
        <h1>Form Elements</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active">Elements</li>
            </ol>
        </nav>
    </div> --}}
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="form-signin w-80 m-auto col-lg-8">

                <!-- Card with header and footer -->
                <div class="card">
                    @if($recu_consultations->etat==0)
                        <div class="card-header bg-dark text-white ">
                            REGLEMENT CONSULTATION CLINIQUE
                        </div>
                    @endif
                    @if($recu_consultations->etat!=0)
                        <div class="card-header bg-dark text-white ">
                            RECU DE CONSULTATION
                            {{-- <div class="text-end"><button wire:click='recuPrint({{$recu_consultations->id}})'
                                    class="btn btn-secondary"><i class="bx bx-printer"></i></button></div> --}}
                        </div>
                    @endif
                    @if ($caisse->etat==1 && $caisse->date_comptable!= date("Y-m-d") )
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-octagon me-1"></i>
                            La date operation n'est pas a jour
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if ($caisse->etat==0 )
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-octagon me-1"></i>
                            Caisse fermer
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if ($caisse->etat==1 && $caisse->date_comptable == date("Y-m-d"))
                        <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <td style="width:70px ">
                                    <img style="width:70px "
                                        src="{{ asset('/images/logo/' . $recu_consultations->societe->logo) }}" alt="">
                                </td>
                                <th colspan="8">Societe : {{ $recu_consultations->societe->raison_sociale }}
                                    <br>Tel : {{ $recu_consultations->societe->telephone }}
                                    <br>Adresse : {{ $recu_consultations->societe->adresse }}
                                    <br>
                                </th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="8">
                                        <table class="table mb-0">
                                            <th>Recu n° {{
                                                \Carbon\Carbon::parse($recu_consultations->created_at)->format('dmy').''.$recu_consultations->id
                                                }}</th>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <table class="table mb-0">
                                            <th>Nom patient</th>
                                        </table>
                                    </td>
                                    <td colspan="2">
                                        <table class="table mb-0">
                                            <th>Prenom patient</th>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table mb-0">
                                            <th>Age</th>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table mb-0">
                                            <th>Telephone</th>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table mb-0">
                                            <th>Adresse</th>
                                        </table>
                                    </td>
                                </tr>
                                <td colspan="2"> {{ $recu_consultations->patient->nom }}</td>
                                <td colspan="2"> {{ $recu_consultations->patient->prenom }}</td>

                                <td>{{\Carbon\Carbon::parse($recu_consultations->patient->date_naissance)->age }}</td>
                                <td>{{ $recu_consultations->patient->telephone }}</td>
                                <td>{{ $recu_consultations->patient->adresse }}</td>
                            </tbody>
                            @if ($recu_consultations->rendez_vous->contrat_id !=0)
                            <tbody>
                                <tr>
                                    <td colspan="3">
                                        <table class="table mb-0">
                                            <th>Assureur</th>
                                        </table>
                                    </td>

                                    <td colspan="2">
                                        <table class="table mb-0">
                                            <th>Telephone assureur</th>
                                        </table>
                                    </td>
                                    <td colspan="2">
                                        <table class="table mb-0">
                                            <th>Taux pris en charge en % </th>
                                        </table>
                                    </td>
                                </tr>
                                <td colspan="3"> {{
                                    $recu_consultations->rendez_vous->contrat_assurance->maison_assurance->maison_assurance
                                    }}</td>
                                <td colspan="2"> {{
                                    $recu_consultations->rendez_vous->contrat_assurance->maison_assurance->telephone }}
                                </td>

                                <td colspan="2">{{ $recu_consultations->rendez_vous->contrat_assurance->taux_couverture
                                    .' % ' }}</td>
                            </tbody>
                            @endif

                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <table class="table mb-0">
                                            <th>Nom medecin</th>
                                        </table>
                                    </td>
                                    <td colspan="2">
                                        <table class="table mb-0">
                                            <th>Prenom medecin</th>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table mb-0">
                                            <th>Telephone medecin</th>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table mb-0">
                                            <th>Categorie</th>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table mb-0">
                                            <th>Specialité</th>
                                        </table>
                                    </td>

                                </tr>

                                <td colspan="2">{{ $recu_consultations->medecin->nom }}</td>
                                <td colspan="2">{{ $recu_consultations->medecin->prenom }}</td>
                                <td>{{ $recu_consultations->medecin->telephone }}</td>
                                <td>{{ $recu_consultations->medecin->categorie->categorie_medecin }}</td>
                                <td>{{ $recu_consultations->medecin->specialite->specialite_medecin }}</td>

                            </tbody>
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <table class="table mb-0">
                                            <th>consultation</th>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table mb-0">
                                            <th>Motif </th>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table mb-0">
                                            <th>Montant total</th>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table mb-0">
                                            <th>Montant assureur</th>
                                        </table>
                                    </td>
                                    @if($recu_consultations->etat==0)
                                    <td colspan="2">
                                        <table class="table mb-0">
                                            <th>Montant à payé</th>
                                        </table>
                                    </td>
                                    @endif
                                    @if($recu_consultations->etat==1)
                                    <td>
                                        <table class="table mb-0">
                                            <th>Montant payé</th>
                                        </table>
                                    </td>
                                    @endif
                                    @if($recu_consultations->etat==1)
                                    <td>
                                        <table class="table mb-0">
                                            <th>Mode de reglement</th>
                                        </table>
                                    </td>
                                    @endif
                                </tr>
                                <td colspan="2"> {{
                                    $recu_consultations->rendez_vous->planification->tarif_consultation->type_consultation->type_consultation
                                    }}</td>
                                </td>
                                <td colspan=> {{ $recu_consultations->rendez_vous->motif }}</td>
                                </td>
                                <td>{{
                                    number_format($recu_consultations->rendez_vous->planification->tarif_consultation->montant,
                                    2, ',', ' ') .
                                    ' ' .
                                    $recu_consultations->user->agence->devise->unite }}</td>

                                <td style=" color:green">{{ number_format($recu_consultations->montant_assurer, 2, ',',
                                    ' ') .
                                    ' ' .
                                    $recu_consultations->user->agence->devise->unite }}</td>
                                @if($recu_consultations->etat==0)
                                <td colspan="2">{{ number_format($recu_consultations->reste_a_payer, 2, ',', ' ') .
                                    ' ' .
                                    $recu_consultations->user->agence->devise->unite }}
                                </td>
                                @endif
                                @if($recu_consultations->etat==1)
                                <td>{{ number_format($recu_consultations->montant_paye, 2, ',', ' ') .
                                    ' ' .
                                    $recu_consultations->user->agence->devise->unite }}
                                </td>
                                <td> {{ $paiement->reglement->reglement }}</td>
                                @endif

                            </tbody>
                        </table>
                        <br>
                        <div class="text-end">Caissier(e) : <strong>{{ $recu_consultations->user->prenom.'
                                '.$recu_consultations->user->nom }}</strong></div>
                        </div>
                        @if($recu_consultations->etat==0)
                            <form wire:submit.prevent='paiementConsultation'>
                                @csrf
                                <div class="card-body">
                                    <div class="col-md-6">
                                        <label for="inputState" class="form-label">Type de Reglement<span
                                            style="color: red">*</span></label>
                                        <select id="inputState" class="form-select" wire:model='reglement_id'>
                                                <option selected>Type de Reglement</option>
                                            @foreach ($reglements as $reglement)
                                                <option value="{{ $reglement->id }}">{{ $reglement->reglement }}</option>
                                            @endforeach
                                        </select>
                                        @error('reglement_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <input type="hidden" class="form-control" wire:model='recu' id="inputName5">
                                        @error('recu')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <input type="hidden" class="form-control" wire:model='montant' id="inputName5">
                                        @error('montant')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                @endif
                                <div class="card-footer bg-dark text-white">
                                    <div class="text-end">
                                        @if($recu_consultations->etat==0)
                                            <button type="submit" class="btn btn-success">Valider</button>
                                        @endif
                                        @if($recu_consultations->etat==1)
                                            <a href="{{route('ad.sante.facturation.consultation')}}">
                                            <button class="btn btn-secondary"><i class="ri ri-arrow-go-back-line
                                            "></i></button>
                                            </a>
                                            <button wire:click='recuPrint({{$recu_consultations->id}})' class="btn btn-light"><i
                                                class="bi bi-file-earmark-pdf"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </form>
                    @endif
                </div><!-- End Card with header and footer -->
            </div>
        </div>
    </section>

</main><!-- End #main -->
