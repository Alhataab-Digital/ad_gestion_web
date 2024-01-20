@extends('../layouts.app')

@section('content')


<main id="main" class="main">

    <div class="pagetitle">
      <h1>MODIFICATION DE LA CAISSE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">param</li>
          <li class="breadcrumb-item active">caisse</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">


        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
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

              <!-- Vertical Form -->
              <form action="{{ route('caisse.update',encrypt($caisse->id)) }}" method="post" class="row g-3" >
                @csrf
                <div class="col-12">
                            <label for="validationDefault04" class="form-label">State</label>
                            <select class="form-select" id="validationDefault04" name="agence_id" required>
                            <option value="{{ $caisse->agence->id }}"  >{{ $caisse->agence->nom }}</option>
                              @foreach ( $agences as $agence )
                              <option value="{{ $agence->id }}"  >{{ $agence->nom }}</option>
                              @endforeach
                            </select>
                        </div>
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Libelle</label>
                    <input type="text" name="libelle" value="{{ $caisse->libelle }}" class="form-control" id="inputNanme4">
                  </div>
                  <div class="col-12">
                    <label for="inputNanme4" class="form-label">Montant minimum</label>
                    <input type="text" name="montant_min" value="{{ $caisse->montant_min }}" class="form-control" id="inputNanme4">
                  </div>
                <div class="col-12">
                  <label for="inputEmail4" class="form-label">Montant maximum</label>
                  <input type="text" name="montant_max" value="{{ $caisse->montant_max }}" class="form-control" id="inputEmail4">
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Modifer</button>
                  <a href="{{ route('caisse') }}">
                    <button type="button" class="btn btn-secondary">Retour</button></a>
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->
  <script src="{{asset('assets/js/jquery.js')}}"></script>
  <script type="text/javascript">

    var table=document.getElementById("table"),rIndex;

    for(var i= 1 ; i<table.rows.length; i++)
    {
        table.rows[i].onclick= function()
        {
            rIndex=this.rowIndex;

            // console.log(rIndex);

            // document.getElementById("devise_a").value=this.cells[0].innerHtml;
            document.getElementById("id").value=this.cells[0].innerHTML;
            document.getElementById("devise_t").value=this.cells[2].innerHTML;

        }

    }

    function editRow()
    {
        table.rows[rIndex].cells[0].innerHtml=document.getElementById("id").value;
        table.rows[rIndex].cells[2].innerHtml=document.getElementById("devise_t").value;


        var id=document.getElementById("id").value;

        alert(id);

    }
</script>


@endsection
