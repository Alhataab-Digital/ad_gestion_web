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
            <li>
              <a href="#" class="nav-link text-white">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#table"/></svg>

              </a>
            </li>
            <li>
              <a href="#" class="nav-link text-white">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#grid"/></svg>
                <!-- {{ $investisseur->nom }} {{ $investisseur->prenom }} -->
                <!-- Montant investis : {{ number_format($investisseur->montant_investis,2,","," ") }} -->
              </a>
            </li>
            <li>
            <a href="{{ route('portail') }}">
                <button type="button" class="btn btn-primary">Deconnexion</button>
            </a>
            </li>
            <li>
              <a href="#" class="nav-link text-white">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#people-circle"/></svg>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <br><br>
    <div class="px-3 py-12 border-bottom mb-12">
      <div class="container d-flex flex-wrap justify-content-center">
        {{-- <form class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto" role="search">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
        </form> --}}
        <br>
       
      </div>
    </div>
  </header>

  <main class="form-signin w-90 m-auto">
    
                    <div class="col-lg-12">
                      <div class="card">
                        
                        <div class="card-body">
                          
                          <h5 class="card-title"> 
                              <button type="button" class="btn btn-light text-dark me-2">{{ $investisseur->nom.' '.$investisseur->prenom.' : ' }}</button>
                              {{ $investisseur->email }}

                              <p class="text-end">
                              <div class="" >
                              <br>
                                <strong class="text-center">
                                <button type="button" class="btn btn-light text-dark me-2">Montant investis :</button>
                                   {{ number_format($investisseur->montant_investis,2,","," ")." ".$agence->devise->unite  }}
                                </strong> 
                                <br><br>
                                <strong class="text-center">
                                <button type="button" class="btn btn-light text-dark me-2">  Montant dividende : </button>
                                {{ number_format($investisseur->compte_dividende,2,","," ")." ".$agence->devise->unite }} 
                                 
                                </strong>
                              </div>  
                              </p>

                    </h5>

                  <!-- Pills Tabs -->
                  <ul class="nav nav-pills nav-tabs-bordered" id="pills-tab" role="tablist">
                    
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#valider" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                        Operation à valider
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#compte-dividende" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                        Historique compte dividende
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#compte-investissement" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                        Historique compte investissement
                        </button>
                    </li>
                   
                  </ul>
                  <div class="tab-content pt-2" id="myTabContent">
                  <div class="tab-pane fade show active" id="valider" role="tabpanel" aria-labelledby="profile-tab">
                         <!-- Table with stripped rows -->
                         <table class="table table-borderless datatable">
                            <thead class="bg-primary text-white ">
                                <tr>
                                    <th scope="col">Date operation</th>
                                    <th scope="col">Sens operation</th>
                                    <th scope="col">Montant operation</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($operation_div_invalid as $operation)
                                <tr>
                                @if($operation->sens_operation=="sortie")
                                
                                <th scope="row"> <small> {{ $operation->updated_at }}</small></th>
                                <th scope="row" style="color: red">Retrait dividende</th>
                                <th scope="row" style="color: red">{{ number_format($operation->montant_operation,2,","," ")." ".$agence->devise->unite}}</th>
                                @if($operation->valider=="non")
                                <th scope="row" style="color: red"><a href="{{route('valider.operation_div',encrypt($operation->id))}}"><button class="btn btn-success">valider</button></a></th>
                               @endif
                                @endif
                              </tr>
                                @endforeach

                                @foreach ($operation_inv_invalid as $operation)
                                <tr>
                                @if($operation->sens_operation=="sortie")
                                <th scope="row"> <small> {{ $operation->updated_at }}</small></th>
                                <th scope="row" style="color: red">Retrait investissement</th>
                                <th scope="row" style="color: red">{{ number_format($operation->montant_operation,2,","," ")." ".$agence->devise->unite}}</th>
                                @if($operation->valider=="non")
                                <th scope="row" style="color: red"><a href="{{route('valider.operation_inv',encrypt($operation->id))}}"><button class="btn btn-success">valider</button></a></th>
                                @endif
                                @endif
                              </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                    <div class="tab-pane fade show" id="compte-dividende" role="tabpanel" aria-labelledby="profile-tab">
                         <!-- Table with stripped rows -->
                         <table class="table table-borderless datatable">
                            <thead class="bg-primary text-white ">
                                <tr>
                                    <th scope="col">Date operation</th>
                                    <th scope="col">Sens operation</th>
                                    <th scope="col">Montant operation</th>
                                    <th scope="col">Solde</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($operation_div as $operation)
                                <tr>
                                @if($operation->sens_operation=="entree")
                                <th scope="row"> <small> {{ $operation->updated_at }}</small></th>
                                <th scope="row" style="color: green" >Dépôt</th>
                                <th scope="row" style="color: green">{{ number_format($operation->montant_operation,2,","," ")." ".$agence->devise->unite}}</th>
                                <th scope="row" style="color: green">{{ number_format($operation->solde,2,","," ")." ".$agence->devise->unite}}</th>
        
                                @else
                                <th scope="row"> <small> {{ $operation->updated_at }}</small></th>
                                <th scope="row" style="color: red">Retrait</th>
                                <th scope="row" style="color: red">{{ number_format($operation->montant_operation,2,","," ")." ".$agence->devise->unite}}</th>
                                <th scope="row" style="color: red">{{ number_format($operation->solde,2,","," ")." ".$agence->devise->unite}}</th>
                              
                                @endif
                              </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                    <div class="tab-pane fade" id="compte-investissement" role="tabpanel" aria-labelledby="contact-tab">
                        <!-- Table with stripped rows -->
                        <table class="table table-borderless datatable">
                           <thead class="bg-primary text-white ">
                               <tr>
                                  <th scope="col">Date operation</th>
                                    <th scope="col">Sens operation</th>
                                    <th scope="col">Montant operation</th>
                                    <th scope="col">Solde</th>
                               </tr>
                           </thead>
                           <tbody>
                                @foreach ($operation_inv as $operation)
                                <tr>
                                @if($operation->sens_operation=="entree")
                                <th scope="row"> <small> {{ $operation->updated_at }}</small></th>
                                <th scope="row" style="color: green" >Dépôt</th>
                                <th scope="row" style="color: green">{{ number_format($operation->montant_operation,2,","," ")." ".$agence->devise->unite}}</th>
                                <th scope="row" style="color: green">{{ number_format($operation->solde,2,","," ")." ".$agence->devise->unite}}</th>
        
                                @else
                                <th scope="row"> <small> {{ $operation->updated_at }}</small></th>
                                <th scope="row" style="color: red">Retrait</th>
                                <th scope="row" style="color: red">{{ number_format($operation->montant_operation,2,","," ")." ".$agence->devise->unite}}</th>
                                <th scope="row" style="color: red">{{ number_format($operation->solde,2,","," ")." ".$agence->devise->unite}}</th>
                               
                                @endif
                                </tr>
                                @endforeach
                           </tbody>
                       </table>
                       <!-- End Table with stripped rows -->
                    </div>
                    
                  </div><!-- End Pills Tabs -->

                </div>
              </div>

  </main>



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
