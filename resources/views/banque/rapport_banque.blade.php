@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>RAPPROCHEMENT BANCAIRE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">Gestion banque</li>
          <li class="breadcrumb-item active">Rapprochement bancaire</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Rapprochement bancaire</h5>
              <!-- Browser Default Validation -->
              <form class="row g-3" method="post" action="{{ route('banque.rapport') }}" >
                @csrf
                <div class="col-md-6">
                  {{-- <label for="validationDefault04" class="form-label"></label> --}}
                  <select class="form-select" id="validationDefault04" name="banque" required>
                    <option selected disabled value="">Choix banque</option>
                    @foreach ($banques as $banque )
                    <option value="{{ $banque->id }}">{{ $banque->libelle .' - '.$banque->numero_compte_banque }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-3">
                  <button class="btn btn-primary" type="submit">Recherche</button>
                </div>
              </form>
              <!-- End Browser Default Validation -->
            <hr>

            <!-- Table with stripped rows -->
            <table class="table table-borderless datatable">
                <thead class="bg-primary ">
                  <tr>
                    <th scope="col">Date operation</th>
                    <th scope="col">Banque</th>
                    <th scope="col">Description</th>
                    <th scope="col"> Entree</th>
                    <th scope="col">Sortie</th>
                    <th scope="col">Solde</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($rapprochement_bancaires as $rapprochement_bancaire )
                  <tr>
                    <th scope="row">{{ $rapprochement_bancaire->date_comptable}}</th>
                    <td>{{ $rapprochement_bancaire->banque->libelle.' - '.$rapprochement_bancaire->banque->numero_compte_banque}}</td>
                    <td>{{ $rapprochement_bancaire->description}}</td>
                    @if ($rapprochement_bancaire->entree==NULL)
                    <td></td>
                    @else
                    <td style="text-align:right">{{number_format($rapprochement_bancaire->entree ,2,","," ").' '.$agence->devise->unite }}</td>
                    @endif
                    @if ($rapprochement_bancaire->sortie==NULL)
                    <td></td>
                    @else
                    <td style="text-align:right">{{number_format($rapprochement_bancaire->sortie ,2,","," ").' '.$agence->devise->unite }}</td>
                    @endif
                    <td style="text-align:right">{{number_format($rapprochement_bancaire->solde ,2,","," ").' '.$agence->devise->unite }}</td>
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

  </main><!-- End #main -->
@endsection
