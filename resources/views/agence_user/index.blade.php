@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>UTILISATEURS ASSOCIERS</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">param</li>
          <li class="breadcrumb-item active">association agence utilisateur</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div  class="col-lg-12">

          <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <!-- Basic Modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                        Nouvelle association utilisateur
                    </button>
                </h5>
              <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content" style="background-color: silver">
                    <div class="modal-header">
                      <h5 class="modal-title">Associer utilisateur </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Vertical Form -->
                    <form class="row g-3" method="post" action="{{ route('agence_user.store') }}" >
                        @csrf
                    <div class="modal-body" >
                        <div class="col-12">
                            <label for="validationDefault04" class="form-label">Agence</label>
                            <select class="form-select" id="agence" name="agence_id" required>
                              <option selected disabled value="">Choose...</option>
                              @foreach ( $agences as $agence )
                              <option value="{{ $agence->id }}">{{ $agence->nom }}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="validationDefault04" class="form-label">Utilisateur</label>
                            <select class="form-select" id="user" name="user_id" required>
                            </select>
                        </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form><!-- Vertical Form -->
                  </div>
                </div>
              </div><!-- End Basic Modal-->

            </div>
            <div>
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
              <table class="table datatable">
                <thead class="bg-primary">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom </th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Adresse</th>
                    <th scope="col">Utilisateur associer</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user )
                  <tr>
                    <th scope="row">{{ $user->id}}</th>
                    <td>{{ $user->nom}}</td>
                    <td>{{ $user->prenom}}</td>
                    <td>{{ $user->adresse}}</td>
                    <td>{{ $user->agence->nom}}</td>

                    <td>
                        <!--a href="">
                            <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
                        </a>
                        <a href="">
                            <button type="button" class="btn btn-success"><i class="bi bi-check-circle"></i></button>
                        </a-->
                        <a href="{{ route('annuler.agence.select',$user->id) }}">
                            <button type="button" class="btn btn-danger"><i class="bi bi-exclamation-octagon"></i></button>
                        </a>
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

  <script src="{{asset('assets/js/jquery.js')}}"></script>
  <script type="text/javascript">

      $(document).ready(function(){
          $('#agence').change(function(event){

              var agence_id=this.value;


              $('#user').html('');
              $.ajax({
                  url:"{{ route('agence_user.select') }}",
                  type:'post',
                  dataType:'json',
                  data: {id:agence_id , _token:"{{ csrf_token() }}"},
                  //alert(data);
                  success:function(response){
                    console.log(response);

                      $("#user").html('<option value="">Choose...</option>');
                      $.each(response.users,function(index,val){
                  // alert(val);
                      $("#user").append('<option value="'+val.id+'">'+val.nom+' '+val.prenom+'</option>');
                     })
                  }
              })

          });

      });

  </script>

@endsection
