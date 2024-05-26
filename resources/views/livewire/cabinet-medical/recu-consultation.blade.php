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
                    @if($recu_consultations->etat=="instance")
                    <div class="card-header bg-dark text-white ">
                       REGLEMENT CONSULTATION CLINIQUE
                    </div>
                    @endif
                    @if($recu_consultations->etat!="instance")
                    <div class="card-header bg-dark text-white ">
                       RECU DE CONSULTATION
                       {{-- <div class="text-end"><button wire:click='recuPrint({{$recu_consultations->id}})'  class="btn btn-secondary"><i class="bx bx-printer"></i></button></div> --}}
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
                                        src="{{ asset('/images/logo/' . $recu_consultations->societe->logo) }}"
                                        alt="">
                                </td>
                                <th colspan="4">Societe : {{ $recu_consultations->societe->raison_sociale }}
                                    <br>Tel : {{ $recu_consultations->societe->telephone }}
                                    <br>Adresse : {{ $recu_consultations->societe->adresse }}
                                    <br>
                                </th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <table class="table mb-0">
                                            <th>Recu n° {{ \Carbon\Carbon::parse($recu_consultations->created_at)->format('dmy').''.$recu_consultations->id }}</th>
                                        </table>
                                    </td>
                                </tr>
                                <td colspan="6"></td>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <table class="table mb-0">
                                            <th>Nom patient</th>
                                        </table>
                                    </td>
                                    <td>
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
                                <td> {{ $recu_consultations->patient->prenom }}</td>

                                <td>{{\Carbon\Carbon::parse($recu_consultations->patient->date_naissance)->age }}</td>
                                <td>{{ $recu_consultations->patient->telephone }}</td>
                                <td>{{ $recu_consultations->patient->adresse }}</td>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <table class="table mb-0">
                                            <th>Nom medecin</th>
                                        </table>
                                    </td>
                                    <td>
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
                                            <th>Type consultation</th>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table mb-0">
                                            <th>Prix</th>
                                        </table>
                                    </td>

                                </tr>

                                <td colspan="2">{{ $recu_consultations->medecin->nom }}</td>
                                <td>{{ $recu_consultations->medecin->prenom }}</td>
                                <td>{{ $recu_consultations->medecin->telephone }}</td>
                                <td>{{ $recu_consultations->rendez_vous->planification->tarif_consultation->type_consultation->type_consultation }}</td>
                                @if($recu_consultations->etat==0)
                                <td>{{ number_format($recu_consultations->reste_a_payer, 2, ',', ' ') .
                                    ' ' .
                                    $recu_consultations->user->agence->devise->unite }}
                                </td>
                                @endif
                                @if($recu_consultations->etat==1)
                                <td>{{ number_format($recu_consultations->montant_paye, 2, ',', ' ') .
                                    ' ' .
                                    $recu_consultations->user->agence->devise->unite }}
                                </td>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    @if($recu_consultations->etat==0)
                    <div class="card-body">
                        <form wire:submit.prevent='paiement'>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Type de Reglement<span
                                        style="color: red">*</span></label>
                                <select id="inputState" class="form-select" wire:model='reglement'>
                                    <option selected>Type de Reglement</option>
                                    @foreach ($reglements as $reglement)
                                        <option value="{{ $reglement->id }}">{{ $reglement->reglement }}</option>
                                    @endforeach
                                </select>
                                @error('reglement')
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

                            {{-- <button type="reset" class="btn btn-secondary">Reset</button> --}}
                            @endif
                            @if($recu_consultations->etat!=0)

                                <button wire:click='recuPrint({{$recu_consultations->id}})'  class="btn btn-secondary"><i class="bx bx-printer"></i></button>

                            @endif
                        </div>
                    </div>
                    @endif
                </div><!-- End Card with header and footer -->
                <!-- Card with header and footer -->
                </form>


            </div>

        </div>
    </section>

</main><!-- End #main -->
