hello
@extends('../layouts.app')

@section('content')


<main id="main" class="main">

    <div class="pagetitle">
      <h1>OPERATION VERSEMENT </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Accueil</a></li>
          <li class="breadcrumb-item">Gestion operation</li>
          <li class="breadcrumb-item active">Versement operation</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">

        <div class="col-lg-6">

            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title  text-white">Versement N° 000{{ $operation->id }} </h5>
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
                    <form class="row g-3" method="post" action="">
                        @csrf
                       <div class="col-md-6">
                            <input type="text" name="nom" value="{{ $operation->investisseur->nom }}" class="form-control" placeholder="Nom">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="prenom" value="{{ $operation->investisseur->prenom }}" class="form-control" placeholder="Prenom">
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="telephone" value="{{ $operation->investisseur->telephone }}" class="form-control" placeholder="Telephone">
                        </div>
                        <div class="col-md-6">

                            <input type="email" name="email" value="{{ $operation->investisseur->email }}" class="form-control" placeholder="Email">
                        </div>
                        <div class="col-md-6">


                            @if ($operation->sens_operation=="entree")
                                <input type="text"  value="Versement" class="form-control" placeholder="Email">
                            @endif
                            @if ($operation->sens_operation=="sortie")
                            <input type="text"  value="Retrait" class="form-control" placeholder="Email">
                        @endif
                        </div>

                        {{-- <div class="col-12">
                            <input type="text" name="heritier" value="{{ $operation->investisseur->heritier }}" class="form-control" placeholder="Nom heritier">
                        </div> --}}
                        <div class="col-md-6">
                            <input type="text" name="montant" value="{{ number_format($operation->montant_operation,2,","," ").' '.$operation->user->agence->devise->unite}}" class="form-control" placeholder="Montant a verser">
                        </div>
                        <div class="col-md-4">
                            <select id="inputState" class="form-select" name="reglement">

                                <option >{{ $operation->reglement->reglement }}</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="text" value="{{ $operation->created_at }}" class="form-control" placeholder="Zip">
                        </div>
                        <div class="text-center">
                            <a href="{{ route('i_versement.print',encrypt($operation->id)) }}">
                            <div class="btn btn-primary"> Imprimer</div>
                            </a>
                            <a href="{{ route('i_versement') }}">
                                <div class="btn btn-secondary"> Quitter</div>
                                </a>
                          </div>
                    </form><!-- End No Labels Form -->

                </div>
            </div>


        </div>

    </section>

  </main><!-- End #main -->

  @endsection
