hello
@extends('../layouts.app')

@section('content')


<main id="main" class="main">

    <div class="pagetitle">
      <h1>RETRAIT INVESTISSEUR</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Accueil</a></li>
          <li class="breadcrumb-item">Gestion investisseur</li>
          <li class="breadcrumb-item active">Retrait investisseur</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">

        <div class="col-lg-6">

            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5 class="card-title  text-white">Retrait investisseur</h5>
                        <p>
                            @if ($message=Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            @if ($message=Session::get('danger'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-octagon me-1"></i>
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                        </p>
                    </p>
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

                    <!-- No Labels Form -->
                    <form class="row g-3" method="post" action="{{ route('d_retrait.store',$investisseur->id) }}">
                        @csrf
                       <div class="col-md-6">
                            <input type="text" name="nom" value="{{ $investisseur->nom }}" class="form-control" placeholder="Nom">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="prenom" value="{{ $investisseur->prenom }}" class="form-control" placeholder="Prenom">
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="telephone" value="{{ $investisseur->telephone }}" class="form-control" placeholder="Telephone">
                        </div>
                        <div class="col-md-6">

                            <label for="">email</label>
                            <input type="email" name="email" value="{{ $investisseur->email }}" class="form-control" placeholder="Email">
                        </div>
                        <div class="col-md-6">

                            <label for="">Dividende</label>
                            <input type="text"  value="{{ number_format($investisseur->compte_dividende,2,","," ").' '.Auth::user()->agence->devise->unite}}" class="form-control" placeholder="Email">
                        </div>

                        <div class="col-12">
                            <label for="">Heritier</label>
                            <input type="text" name="heritier" value="{{ $investisseur->heritier }}" class="form-control" placeholder="Nom heritier">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="montant" class="form-control" placeholder="Montant a retirer">
                        </div>
                        <div class="col-md-4">
                            <select id="inputState" class="form-select" name="reglement">
                                <option value="0">Mode de paiement...</option>
                                @foreach ($reglements as $reglement )

                                <option value="{{ $reglement->id }}">{{ $reglement->reglement }}</option>

                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="col-md-2">
                            <input type="text" class="form-control" placeholder="Zip">
                        </div> --}}
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form><!-- End No Labels Form -->
                    @endif
                </div>
            </div>


        </div>


    </section>

  </main><!-- End #main -->

  @endsection
