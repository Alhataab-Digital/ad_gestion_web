@extends('../layouts.app')

@section('content')


<main id="main" class="main">

    <div class="pagetitle">
      <h1>MODIFICATION DE L'AGENCE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">param</li>
          <li class="breadcrumb-item active">agence</li>
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
              <form action="{{ route('agence.update',$agence->id) }}" method="post" class="row g-3" >
                @csrf

                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Nom</label>
                    <input type="text" name="nom" value="{{ $agence->nom }}" class="form-control" id="inputNanme4">
                  </div>
                  <div class="col-12">
                    <label for="inputNanme4" class="form-label">Telephone</label>
                    <input type="text" name="telephone" value="{{ $agence->telephone }}" class="form-control" id="inputNanme4">
                  </div>
                <div class="col-12">
                  <label for="inputEmail4" class="form-label">Email</label>
                  <input type="email" name="email" value="{{ $agence->email }}" class="form-control" id="inputEmail4">
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Address</label>
                    <input type="text" name="adresse" value="{{ $agence->adresse }}" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="col-12">
                    <label for="validationDefault04" class="form-label">Pays / Region </label>
                    <select class="form-select" id="validationDefault04" name="devise_id" required>
                    <option value="{{ $agence->devise->id }}">{{  $agence->region->nom }}</option>
                     </select>
                </div>
                <div class="col-12">
                    <label for="validationDefault04" class="form-label">Devise par defaut</label>
                    <select class="form-select" id="validationDefault04" name="devise_id" required>
                    <option value="{{ $agence->devise->id }}">{{  $agence->devise->devise }}</option>
                     
                    @foreach ( $devises as $devise )
                        @if($agence->devise->id!=$devise->id)
                            <option value="{{ $devise->id }}">{{ $devise->devise }}</option>
                        @endif
                    @endforeach

                    </select>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Modifer</button>
                  <a href="{{ route('agence') }}">
                    <button type="button" class="btn btn-secondary">Retour</button></a>
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title ">
                        <div style="text-transform:uppercase">
                            Devise d'echange : <strong>{{ $agence->nom }}</strong>
                        </div>
                            <br>
                        <!-- Small Modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#smallModal">
                            <i class="bi bi-plus"></i> Ajouter devise d'echange
                            </button>
                        <!-- Vertical Form -->
                            <form class="row g-3" method="post" action="{{ route('agence.devise') }}" >
                                @csrf
                                <div class="modal fade" id="smallModal" tabindex="-1">
                                    <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title">Ajouter Devise</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-12">
                                                {{-- <label for="inputAddress" class="form-label">Devise par defaut</label> --}}
                                                <input type="hidden" name="taux" value="{{ $agence->devise->devise }}" class="form-control" id="inputAddress" placeholder="1234 Main St">
                                            </div>
                                            <div class="col-12">

                                                <input type="hidden" name="agence_id" value="{{ $agence->id }}" id="">

                                                <label for="validationDefault04" class="form-label">Devise</label>
                                                <select class="form-select" id="validationDefault04" name="devise_id" required>
                                                <option selected disabled value="">Choose...</option>
                                                @foreach ( $devises as $devise )
                                                <option value="{{ $devise->id }}">{{ $devise->devise.' : '.$devise->monnaie }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputAddress" class="form-label">Taux</label>
                                                <input type="text" name="taux"  class="form-control" id="inputAddress" placeholder="1234">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                        </div>
                                    </div>
                                    </div>
                                </div><!-- End Small Modal-->
                            </form>
                    </h4>
                    <style>
                        table tr:not(:first-child){
                            cursor: pointer; transition: all .25s ease-in-out;
                        }
                        table tr:not(:first-child):hover {background-color: #ddd;}
                    </style>
                    <table class="table table-sm" >
                        <thead>
                                <tr>
                                    <form class="row g-3" method="post" action="{{ route('edit.devise') }}" >
                                        @csrf
                                        <th>
                                            MODIFIER TAUX
                                        </th>
                                        <th>
                                            <input type="hidden" name="id"  class="form-control" id="id" readonly>
                                        </th>
                                        <th>
                                            <input type="text" name="taux" id="devise_t" class="form-control"  >
                                        </th>
                                        <th><button type="submit" class="btn btn-primary"> <i class="bi bi-pencil"></i></button></th>
                                    </form>
                                </tr>
                        </thead>
                    </table>
                      <!-- Small tables -->
                    <table class="table table-sm" id="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            {{-- <th scope="col">devise agence</th> --}}
                                <th scope="col">devise d'échange</th>
                                <th scope="col">taux</th>
                                <th scope="col"></th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($devise_agences as $devise_agence )
                            <tr>
                                 <td scope="row">
                                    {{ $devise_agence->id }}
                                </td>
                               {{-- <td scope="row">
                                        {{ $agence->devise->devise }}
                                </td> --}}
                                <td scope="row">
                                    {{ $devise_agence->devise->devise }}
                                </td>
                                <td scope="row">
                                    {{ $devise_agence->taux }}
                                </td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>

                <!-- End small tables -->
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
