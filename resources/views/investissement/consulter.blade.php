hello
@extends('../layouts.app')

@section('content')


<main id="main" class="main">

    <div class="pagetitle">
      <h1>CONSULTATION COMPTE INVESTISSEUR</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Accueil</a></li>
          <li class="breadcrumb-item">Gestion investisseur</li>
          <li class="breadcrumb-item active">Consultation compte investisseur</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">

        <div class="form-signin w-50 m-auto col-lg-6">

            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title  text-white">Consultation compte investisseur</h5>
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
                    <form class="row g-3" method="post" action="{{ route('i_retrait.store',$investisseur->id) }}">
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

                        @if(Auth::user()->role_id=="0" || Auth::user()->role_id=="1"|| Auth::user()->role_id=="2")
                        <div class="col-md-4">
                        <label for="">code</label>
                            <input type="email" name="email" value="{{ $investisseur->code }}" class="form-control" placeholder="Email">
                        </div>
                        @endif

                        <div class="col-12">
                            <label for="">Heritier</label>
                            <input type="text" name="heritier" value="{{ $investisseur->heritier }}" class="form-control" placeholder="Nom heritier">
                        </div>

                        <div class="col-md-6">
                            <label for="">Compte investissement</label>
                            @if(Auth::user()->agence_id=="0")
                            <input type="text"  value="{{ number_format($investisseur->compte_investisseur,2,","," ")}}" class="form-control" placeholder="Email">
                            @endif
                            @if(Auth::user()->agence_id!="0")
                            <input type="text"  value="{{ number_format($investisseur->compte_investisseur,2,","," ").' '.Auth::user()->agence->devise->unite}}" class="form-control" placeholder="Email">
                            @endif
                         </div>

                         <div class="col-md-6">
                            <label for="">Compte dividende</label>
                            @if(Auth::user()->agence_id=="0")
                            <input type="text"  value="{{ number_format($investisseur->compte_dividende,2,","," ")}}" class="form-control" placeholder="Email">
                            @endif
                            @if(Auth::user()->agence_id!="0")
                            <input type="text"  value="{{ number_format($investisseur->compte_dividende,2,","," ").' '.Auth::user()->agence->devise->unite}}" class="form-control" placeholder="Email">
                            @endif
                         </div>

                        <!-- <div class="col-md-4">
                            <label for="">Etat</label>
                            @if($investisseur->etat==0)
                            <input type="text" value="Compte desactiver" class="form-control" placeholder="Zip">
                            @endif
                            @if($investisseur->etat==1)
                            <input type="text" value="Compte activer" class="form-control" placeholder="Zip">
                            @endif
                        </div> -->
                        <div class="text-center">
                            <a href="{{ route('investisseur.consultation') }}">
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
