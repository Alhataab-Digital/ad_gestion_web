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
        <div class="col-lg-12">

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
                    <div class="col-md-12">
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

      </div>
    </section>

  </main><!-- End #main -->

@endsection
