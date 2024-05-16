@extends('../layouts.app')

@section('content')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>ACHAT CHANGE</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
        <li class="breadcrumb-item">operation change</li>
        <li class="breadcrumb-item active">achat change</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-danger text-white ">
                <h5 class="card-title text-white">Achat change</h5>
            </div>
          <div class="card-body ">
            <h5 class="card-title "></h5>
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
            <!-- Multi Columns Form -->
            <form class="row g-3" method="POST" action="{{ route('achat_devise.client') }}">
                @csrf
                <div class="col-12">
                    <label for="validationDefault04" class="form-label">Pays /
                        Region</label>
                    <select class="form-select" id="region" name="region_id"
                        required>
                        <option value="{{ $agence->region->id }}">{{ $agence->region->nom . ' ' .$agence->region->code}}</option>
                        @foreach ($regions as $region)
                        <option value="{{ $region->id }}">{{ $region->nom . ' ' .$region->code}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 " id="telephone" >
                    <label for="inputAddress" class="form-label">Telephone</label>
                    <input type="text" name="telephone" value="{{$agence->region->indicatif}}" class="form-control"
                        id="telephone">
                </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary">Suivant</button>
              </div>
            </form><!-- End Multi Columns Form -->
        @endif


          </div>
          <div class="card-footer bg-danger text-white">
            ...
        </div>
        </div>

      </div>
      <div class="col-lg-8">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">
                Achat change
            </h5>

            <P>

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

            </P>

            <!-- Table with stripped rows -->
            <table class="table table-borderless datatable">
              <thead class="bg-danger text-white ">
                <tr>
                  {{-- <th scope="col">#</th> --}}
                  <th scope="col">client</th>
                  <th scope="col">Tel client</th>
                  <th scope="col">agent caisse</th>
                  {{-- <th scope="col">Devise </th> --}}
                  <th scope="col">Devise achetée</th>
                  <th scope="col">taux achat</th>
                  <th scope="col">Montant d'achat</th>
                  <th scope="col">date operation</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($operations as $operation )
                <tr>

                  {{-- <th scope="row">{{ $operation->id}}</th> --}}
                  <td>{{ $operation->client->nom_client}}</td>
                  <td>{{ $operation->client->telephone}}</td>
                  <td>{{ $operation->user->nom.' '.$operation->prenom}}</td>
                  {{-- <td>{{ $operation->devise->devise}}</td> --}}
                  <td style="text-align:right">{{ number_format($operation->montant_operation/$operation->taux,2,","," ").' '.$operation->devise->unite}}</td>
                  <td style="text-align:center">{{ $operation->taux}}</td>
                  <td style="text-align:right">{{ number_format($operation->montant_operation,2,","," ").' '.$agence->devise->unite}}</td>

                  <td>{{ $operation->date_comptable}}</td>
                  <td>
                      <a href="{{ route('achat_devise.show',$operation->id) }}">
                          <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
                      </a>
                      {{-- <a href="">
                          <button type="button" class="btn btn-success"><i class="bi bi-check-circle"></i></button>
                      </a>
                      <a href="">
                          <button type="button" class="btn btn-danger"><i class="bi bi-exclamation-octagon"></i></button>
                      </a> --}}
                  </td>
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

<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
            $('#region').change(function(event) {

                var region_id = this.value;

            //    alert(region_id);

                $('#telephone').html('');
                $.ajax({
                    url: "{{ route('achat_devise.code') }}",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        id: region_id,
                        _token: "{{ csrf_token() }}"
                    },
                    //alert(data);
                    success: function(response) {
                        console.log(response);
                        $.each(response.code, function(index, val) {
                            // alert(val);
                            $("#telephone").append('<label for="inputAddress" class="form-label">Telephone</label><input type="text" name="telephone" value='+val.indicatif+' class="form-control" id="telephone">');
                        })
                    }
                })

            });

        });
</script>
  @endsection
