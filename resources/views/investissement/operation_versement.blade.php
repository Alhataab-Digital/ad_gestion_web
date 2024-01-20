
@extends('../layouts.app')

@section('content')


<main id="main" class="main">

    <div class="pagetitle">
      <h1>VERSEMENT INVESTISSEUR</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Accueil</a></li>
          <li class="breadcrumb-item">Gestion investisseur</li>
          <li class="breadcrumb-item active">Versement investisseur</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">

        <div  class="form-signin w-50 m-auto col-lg-12 ">

            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title  text-white">Versement investisseur</h5>
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
                        <!-- No Labels Form -->
                        <form class="row g-3">
                            
                        <div class="col-md-6">
                                <input type="text"  value="{{ $investisseur->nom }}" class="form-control" placeholder="Nom">
                            </div>
                            <div class="col-md-6">
                                <input type="text"  value="{{ $investisseur->prenom }}" class="form-control" placeholder="Prenom">
                            </div>
                            <div class="col-md-12">
                                <input type="text"  value="{{ $investisseur->telephone }}" class="form-control" placeholder="Telephone">
                            </div>
                            <div class="col-md-6">

                                <label for="">email</label>
                                <input type="email"  value="{{ $investisseur->email }}" class="form-control" placeholder="Email">
                            </div>
                            <div class="col-md-6">

                                <label for="">Compte</label>
                                <input type="text"  value="{{ number_format($investisseur->compte_investisseur,2,","," ").' '.Auth::user()->agence->devise->unite}}" class="form-control" placeholder="Email">
                            </div>

                            <div class="col-12">
                                <label for="">Heritier</label>
                                <input type="text"  value="{{ $investisseur->heritier }}" class="form-control" placeholder="Nom heritier">
                            </div>
                            
                        </form><!-- End No Labels Form -->

                </div>
                </div>
                <div class="card bg-secondary text-white">
                
                <div class="card-body">
                <br><br>
                        <!-- No Labels Form -->
                        <form class="row g-3" method="post" action="{{ route('i_versement.store',encrypt($investisseur->id)) }}">
                            @csrf
                                <input type="hidden" name="nom" value="{{ $investisseur->nom }}" class="form-control" placeholder="Nom">
                            
                                <input type="hidden" name="prenom" value="{{ $investisseur->prenom }}" class="form-control" placeholder="Prenom">
                           
                                <input type="hidden" name="telephone" value="{{ $investisseur->telephone }}" class="form-control" placeholder="Telephone">
                           
                                <input type="hidden" name="email" value="{{ $investisseur->email }}" class="form-control" placeholder="Email">
                            
                               
                                <input type="hidden" name="heritier" value="{{ $investisseur->heritier }}" class="form-control" placeholder="Nom heritier">
                            

                            <div class="col-md-6">
                                <input type="text" name="montant" class="form-control" placeholder="Montant a verser">
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
                                <button type="submit" class="btn btn-primary">Valider</button>
                            </div>
                        </form><!-- End No Labels Form -->

                </div>
            </div>


        </div>


    </section>

  </main><!-- End #main -->

  @endsection
