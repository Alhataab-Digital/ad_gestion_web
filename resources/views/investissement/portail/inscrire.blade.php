<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>AD GESTION</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
  <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
  @livewireStyles
  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<header>
    <div class="px-3 py-2 text-bg-dark border-bottom">
      <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
          <a href="/" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
          </a>

          <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
            {{-- <li>
              <a href="#" class="nav-link text-secondary">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#home"/></svg>
                Home
              </a>
            </li>
            <li>
              <a href="#" class="nav-link text-white">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#speedometer2"/></svg>
                Tableau de
              </a>
            </li> --}}
            {{-- <li>
              <a href="#" class="nav-link text-white">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#table"/></svg>
                Orders
              </a>
            </li>
            <li>
              <a href="#" class="nav-link text-white">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#grid"/></svg>
                Products
              </a>
            </li>
            <li>
              <a href="#" class="nav-link text-white">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#people-circle"/></svg>
                Customers
              </a>
            </li> --}}
          </ul>
        </div>
      </div>
    </div>
    <div class="px-3 py-2 border-bottom mb-3">
      <div class="container d-flex flex-wrap justify-content-center">
        <!-- <form class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto" role="search">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
        </form> -->

        <div class="text-end">
            <a href="{{ route('portail') }}">
                <button type="button" class="btn btn-light text-dark me-2">Connexion</button>
            </a>
            <!-- <a href="{{ route('inscrire') }}">
                <button type="button" class="btn btn-primary">S'inscrire</button>
            </a> -->


        </div>
      </div>
    </div>
  </header>


  <main class="form-signin w-50 m-auto">
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
    <form method="post" action="{{ route('portail.store') }}">
        @csrf
      <h1 class="h3 mb-3 fw-normal">Inscription</h1>
      <div class="form-floating">
        <input type="text" name="code" class="form-control" id="code" placeholder="code compte investissement">
        <label for="floatingInput">Code </label>
      </div>
      <br>
      <div class="form-floating" id="nom"></div>
      <div class="form-floating" id="email"></div>
      <br>
      <div class="form-floating" id="password">
      </div>
      <br>
      <button class="btn btn-primary w-100 py-2" type="submit">Inscrire</button>
      {{-- <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p> --}}
    </form>
  </main>

  <script src="{{asset('assets/js/jquery.js')}}"></script>
  <script type="text/javascript">

      $(document).ready(function(){
          $('#code').change(function(event){

              var code=this.value;

              $('#taux').html('');
              $.ajax({
                  url:"{{ route('portail.recuperation') }}",
                  type:'post',
                  dataType:'json',
                  data: {code:code , _token:"{{ csrf_token() }}"},
                  //alert(data);
                  success:function(response){
                    // console.log(response);

                      //$("#taux").html(' <input type="text" name="taux" class="form-control" >');
                    $.each(response.inscription,function(inscrire,val){
                        // alert(val);
                        $("#nom").append('<input type="text"   class="form-control" id="nom" value="'+val.nom+' '+val.prenom+'"  ><label for="floatingInput">Nom Prenom </label><br/>');
                        $("#email").append('<input type="text" name="email" class="form-control" id="email" value="'+val.email+'"  ><label for="floatingInput">Email </label><br/>');
                        $("#password").append('<input type="password" name="password" class="form-control" id="password"   require ><label for="floatingInput">Password </label><br/>');

                    })

                    // if(response.erreur){
                    //         var data = (response.erreur);
                    //         $("#message").append('<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i>'+data+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    // }
                  }
              })

          });

      });
    </script>



  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{asset('assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('assets/vendor/quill/quill.min.js')}}"></script>
  <script src="{{asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>
  @livewireScripts
</body>

</html>
