@extends('../layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>CAISSES ASSOCIERS</h1>
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
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <!-- Basic Modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#basicModal">
                                Nouvelle association caisse
                            </button>
                        </h5>
                        <!-- Vertical Form -->
                        <form class="row g-3" method="post" action="{{ route('caisse_user.store') }}">
                            @csrf
                            <div class="modal fade" id="basicModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: silver">
                                            <h5 class="modal-title">Associer caisse</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-12">
                                                <label for="validationDefault04" class="form-label">Agence</label>
                                                <select class="form-select" id="agence" name="agence" required>
                                                    <option selected disabled value="">Choose...</option>
                                                    @foreach ( $agences as $agence )
                                                    <option value="{{ $agence->id }}">{{ $agence->nom }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="validationDefault04" class="form-label">Utilisateur</label>
                                                <select class="form-select" id="user" name="user" required>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="validationDefault04" class="form-label">Caisse</label>
                                                <select class="form-select" id="caisse" name="caisse" required>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer" style="background-color: silver">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div><!-- End Basic Modal-->
                            </div>
                        </form><!-- Vertical Form -->
                            <P>
                                @if ($message=Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-1"></i>
                                {{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif
                            @if ($message=Session::get('danger'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-octagon me-1"></i>
                                {{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif

                            </P>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead class="bg-primary">
                                    <tr>
                                        <!-- <th scope="col">#</th> -->
                                        <th scope="col">Libelle </th>
                                        <th scope="col">montant min</th>
                                        <th scope="col">montant max</th>
                                        <th scope="col">Agence</th>
                                        <th scope="col">Utilisateur associer</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($caisses as $caisse )
                                    @foreach ($agences as $agence )


                                    @if($caisse->agence_id==$agence->id)
                                    <tr>

                                        <!-- <th scope="row">{{ $caisse->id}}</th> -->
                                        <td>{{ $caisse->libelle}}</td>
                                        <td>{{ $caisse->montant_min}}</td>
                                        <td>{{ $caisse->montant_max}}</td>
                                        <td>{{ $caisse->agence->nom}}</td>
                                        <td>{{ $caisse->user->nom}}</td>

                                        <td>
                                            <!--a href="{{ route('caisse.edit',$caisse->id) }}">
                            <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i></button>
                        </a>
                        <a href="">
                            <button type="button" class="btn btn-success"><i class="bi bi-check-circle"></i></button>
                        </a-->
                                            <a href="{{ route('annuler.caisse.select',encrypt($caisse->id)) }}">
                                                <button type="button" class="btn btn-danger"><i
                                                        class="bi bi-exclamation-octagon"></i></button>
                                            </a>

                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
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
                                url:"{{route('user.select') }}",
                                type:'post',
                                dataType:'json',
                                data: {id:agence_id , _token:"{{ csrf_token() }}"},
                                //alert(data);
                                success:function(response){
                                //console.log(response.utilisateurs);
                                    $("#user").html('<option value="">Choose...</option>');
                                    $.each(response.users,function(index,val){
                                // alert(val);
                                    $("#user").append('<option value="'+val.id+'">'+val.prenom+' '+val.nom+'</option>');
                                   })
                                }
                            })

                        });

                        $('#agence').change(function(event){
                            var agence_id=this.value;
                            $('#caisse').html('');
                            $.ajax({
                                url:"{{ route('caisse.select') }}",
                                type:'post',
                                dataType:'json',
                                data: {id:agence_id , _token:"{{ csrf_token() }}"},
                                //alert(data);
                                success:function(response){
                                //console.log(response.utilisateurs);
                                    $("#caisse").html('<option value="">Choose...</option>');
                                    $.each(response.caisses,function(index,val){
                                // alert(val);
                                    $("#caisse").append('<option value="'+val.id+'">'+val.libelle+'</option>');
                                   })
                                }
                            })

                        });
                    });

</script>
@endsection
