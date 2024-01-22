@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>IDENTIFICATION DE VOTRE SOCIETE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Acceuil</a></li>
          <li class="breadcrumb-item">interface</li>
          <li class="breadcrumb-item active">societé</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
          <div class="col-lg-9">
            <div class="card">
              <div class="card-body " style="background-color: silver">
                <h5 class="card-title">

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

                </h5>

                <!-- Browser Default Validation -->
                <form class="row g-3" method="post" action="{{route('workspace.update',encrypt($societe->id))}}">
                    @csrf
                    <div class="col-md-10">
                        <label for="validationDefault01" class="form-label">Raison sociale <span style="color:red">*</span></label>
                        <input type="text" name="raison_sociale" value="{{$societe->raison_sociale }}" class="form-control">
                    </div>
                    <!-- <div class="col-md-2">
                        <img src="{{asset('assets//img/logo.png')}}" alt="" style="width:35mm; height:30mm; border: 1px solid black;" >
                    </div> -->
                  <div class="col-md-12">
                        <label for="validationDefault01" class="form-label">Activité <span style="color:red">*</span></label>
                        <input type="text" name="activite" value="{{$societe->activite }}" class="form-control" >
                  </div>
                  <div class="col-md-6">
                    <label for="validationDefault03" class="form-label">Forme juridique <span style="color:red">*</span></label>
                    <input type="text" name="forme_juridique" value="{{$societe->forme_juridique }}" class="form-control" >
                  </div>
                  <div class="col-md-3">
                    <label for="validationDefault03" class="form-label">Region <span style="color:red">*</span></label>
                    <input type="text" name="region" value="{{$societe->region }}" class="form-control" >
                  </div>
                  <div class="col-md-3">
                    <label for="validationDefault03" class="form-label">Pays <span style="color:red">*</span></label>
                    <input type="text" name="pays" value="{{$societe->pays }}" class="form-control" >
                  </div>

                  <div class="col-md-3">
                    <label for="validationDefault05" class="form-label">Téléphone<span style="color:red">*</span></label>
                    <input type="text" name="telephone" value="{{old('telephone')?? $societe->telephone }}" class="form-control" >
                  </div>

                  <div class="col-md-6">
                    <label  class="form-label">email<span style="color:red">*</span></label>
                    <input type="text" name="email" value="{{$societe->email }}" class="form-control" id="" >
                  </div>
                  <div class="col-md-3">
                    <label  class="form-label">Code Postal</label>
                    <input type="text" name="code_postal" value="{{$societe->code_postal }}" class="form-control"  >
                  </div>
                  <div class="col-md-3">
                    <label  class="form-label">Adresse</label>
                    <input type="text" name="adresse" value="{{$societe->adresse }}" class="form-control"  >
                  </div>
                  <div class="col-md-3">
                    <label  class="form-label">Complement</label>
                    <input type="text" name="complement" value="{{$societe->complement }}" class="form-control"  >
                  </div>
                  <div class="col-md-6">
                    <label  class="form-label">site web</label>
                    <input type="text" name="site_web" value="{{$societe->site_web }}" class="form-control"  >
                  </div>
                  <div class="col-12">
                    <button class="btn btn-info" type="submit">Modifier</button>
                  </div>
                </form>
                <!-- End Browser Default Validation -->

              </div>
            </div>
          </div>

          <div class="col-lg-3">
              <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">LOGO SOCIETE</h5>
                    <p>
                    @if($societe->logo==NULL)
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    @else
                    <img src="{{ asset('/images/logo/'.$societe->logo) }}" alt="modal"  width="200" height="200">
                    @endif
                    </p>
                    <!-- Small Modal -->
                    @if($societe->logo==NULL)
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeModal">
                      Ajouter un logo
                    </button>
                    @else
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#largeModal">
                      Modifier le logo
                    </button>
                    @endif
                    <div class="modal fade" id="largeModal" tabindex="-1">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Logo</h5>
                              @if($societe->logo==NULL)
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              @else
                              <img src="{{ asset('/images/logo/'.$societe->logo) }}" alt="modal"  width="80" height="80">
                              @endif
                          </div>
                        <form action="{{ route('logo.update',encrypt($societe->id)) }}" method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="modal-body">
                          @if($societe->logo==NULL)
                          <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                      <div class="form-group">
                                          <label>Ajouter un logo</label>

                                          <input type="file" name="logo" class="form-control">
                                        </div>
                                    </div>
                                  </div>
                          @else
                          <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                      <div class="form-group">
                                          <label>Changer le logo</label>
                                          <input type="file" name="logo" value="{{old('logo')?? $societe->logo }}" class="form-control">
                                        </div>
                                    </div>
                            </div>
                          @endif
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Valider</button>
                          </div>
                        </form>
                        </div>
                      </div>
                    </div><!-- End Small Modal-->
                  </div>
                </div>
                @if(Auth::user()->gestion->gestion=='Investissement')
                @if (isset($agence->devise->unite))
                <div class="card">
                    <div class="card-body " style="background-color: silver">
                      <div class="col-md-12">
                            <label for="validationDefault01" class="form-label">Montant compte societe <span style="color:red">*</span></label>
                            <input type="text"  value="{{number_format($societe->compte_societe ,2,","," ").' '.$agence->devise->unite }}" class="form-control" readonly>
                      </div>
                      <div class="col-md-12">
                        <label for="validationDefault03" class="form-label">Montant compte de securite <span style="color:red">*</span></label>
                        <input type="text"  value="{{number_format($societe->compte_securite ,2,","," ").' '.$agence->devise->unite }}" class="form-control" readonly>
                      </div>
                      <!-- End Browser Default Validation -->
                    </div>
                  </div>
                @endif
                @endif

              </div>

        </div>
    </section>

  </main><!-- End #main -->

@endsection
