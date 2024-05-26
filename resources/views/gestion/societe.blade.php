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
                    <div class="card-header bg-secondary text-white">
                        Information de votre societe
                    </div>
                    <div class="card-body " >
                        <h5 class="card-title">

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

                        </h5>

                        <!-- Browser Default Validation -->
                        <form class="row g-3" method="post" action="{{ route('workspace.store') }}">
                            @csrf
                            <div class="col-md-12">
                                <label for="validationDefault01" class="form-label">Raison sociale <span
                                        style="color:red">*</span></label>
                                <input type="text" name="raison_sociale" class="form-control" id="validationDefault01"
                                    required>
                            </div>
                            <div class="col-md-12">
                                <label for="validationDefault01" class="form-label">Activité <span
                                        style="color:red">*</span></label>
                                <input type="text" name="activite" class="form-control" id="validationDefault01"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="validationDefault03" class="form-label">Forme juridique <span
                                        style="color:red">*</span></label>
                                <input type="text" name="forme_juridique" class="form-control" id="validationDefault03"
                                    required>
                            </div>
                            <div class="col-3">
                                <label for="validationDefault04" class="form-label">Pays /
                                    Region</label>
                                <select class="form-select" id="region" name="region_id"
                                    required>
                                    <option selected disabled value="">Choose...</option>
                                    @foreach ($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->nom . ' ' .$region->code}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3 " id="telephone" >
                                <label for="inputAddress" class="form-label">Telephone</label>
                                <input type="text" name="telephone" class="form-control"
                                    id="telephone">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">email<span style="color:red">*</span></label>
                                <input type="text" name="email" class="form-control" id="">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Code Postal</label>
                                <input type="text" name="code_postal" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Adresse</label>
                                <input type="text" name="adresse" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Complement</label>
                                <input type="text" name="complement" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">site web</label>
                                <input type="text" name="site_web" class="form-control">
                            </div>

                        <!-- End Browser Default Validation -->

                    </div>
                    <div class="card-footer bg-secondary">
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Valider</button>
                        </div>
                    </form>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
            $('#region').change(function(event) {

                var region_id = this.value;

            //    alert(region_id);

                $('#telephone').html('');
                $.ajax({
                    url: "{{ route('agence_region.code') }}",
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
</main><!-- End #main -->
