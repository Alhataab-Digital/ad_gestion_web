<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>AD GESTION</title>
        <meta content="" name="description">
        <meta content="" name="keywords">
        <!-- Favicons -->

            <link href="{{ asset('assets/img/logo_ad.jpeg') }}" rel="icon">
            <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
            rel="stylesheet">
        <!-- Vendor CSS Files -->
        <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
        <!-- Template Main CSS File -->
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
        @livewireStyles
        <!-- =======================================================
                    * Template Name: NiceAdmin - v2.5.0
                    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
                    * Author: BootstrapMade.com
                    * License: https://bootstrapmade.com/license/
                    ======================================================== -->
    </head>

    <body>
        <main>
            <div class="container">

                <section
                    class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">

                                <div class="d-flex justify-content-center py-4">
                                    <a href="" class="logo d-flex align-items-center w-auto">
                                        <img src="assets/img/logo_ad.jpeg" alt="">
                                        <span class="d-none d-lg-block">AD GESTION</span>
                                    </a>
                                </div><!-- End Logo -->

                                <div class="card mb-3">

                                    <div class="card-body">

                                        <div class="pt-4 pb-2">
                                            @if ($message = Session::get('success'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <i class="bi bi-check-circle me-1"></i>
                                                {{ $message }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                            @endif
                                            @if ($message = Session::get('danger'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <i class="bi bi-exclamation-octagon me-1"></i>
                                                {{ $message }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                            @endif
                                        </div>

                                        <form method="post" action="{{ route('registre.store',encrypt($gestion->id)) }}"
                                            class="row g-3 needs-validation" novalidate>
                                            @csrf
                                            <div class="col-12">
                                                <label for="yourName" class="form-label">Type de Gestion</label>
                                                <select name="gestion" class="form-control" id="">
                                                    <option value="{{ $gestion->id }}">{{ $gestion->gestion }}</option>
                                                   
                                                </select>
                                                <div class="invalid-feedback">S'il vous plait entrez votre gestion!</div>
                                            </div>
                                            <div class="col-12">
                                                <label for="yourName" class="form-label">Votre nom</label>
                                                <input type="text" name="nom" class="form-control" id="yourName" required>
                                                <div class="invalid-feedback">S'il vous plait entrez votre nom!</div>
                                            </div>

                                            <div class="col-12">
                                                <label for="yourName" class="form-label">Votre prenom</label>
                                                <input type="text" name="prenom" class="form-control" id="yourName"
                                                    required>
                                                @error('prenom')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror

                                            </div>
                                            <div class="col-12">
                                                <label for="yourUsername" class="form-label">Votre Adresse</label>
                                                <input type="text" name="adresse" class="form-control" id="yourUsername"
                                                    required>
                                                <div class="invalid-feedback">S'il vous plait entrez votre adresse.</div>
                                            </div>
                                            <div class="col-12">
                                                <label for="yourEmail" class="form-label">Votre email</label>
                                                <input type="email" name="email" class="form-control" id="yourEmail"
                                                    required>
                                                <div class="invalid-feedback">S'il vous plait entrez votre email!</div>
                                            </div>
                                            <div class="col-12">
                                                <label for="yourPassword" class="form-label">Mot de passe</label>
                                                <input type="password" name="password" class="form-control"
                                                    id="yourPassword" required>
                                                <div class="invalid-feedback">S'il vous plait entrez votre mot de pass!
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="yourPassword" class="form-label">comfimer mot de passe</label>
                                                <input type="password" name="passwordconfirme" class="form-control"
                                                    id="yourPassword" required>
                                                <div class="invalid-feedback">S'il vous plait confirmez votre mot de pass!
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="terms" type="checkbox" value="1"
                                                        id="acceptTerms" required>
                                                    <label class="form-check-label" for="acceptTerms">Je suis d'accord et
                                                        j'accepte les <a href="#">termes et conditions</a></label>
                                                    <div class="invalid-feedback">Vous devez accepter avant de soumettre.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button class="btn btn-primary w-100" type="submit">Creer</button>
                                            </div>
                                            <div class="col-12">
                                                <p class="small mb-0">Avez vous déjà un compte ? <a
                                                        href="{{ route('login') }}">Connexion</a></p>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                                <div class="copyright">
                                    &copy; 2023 <strong><span>AD GESTION V4.0</span></strong>.
                                </div>
                                <div class="credits">
                                    <!-- All the links in the footer should remain intact. -->
                                    <!-- You can delete the links only if you purchased the pro version. -->
                                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                                    conçus par <a href="https://www.alhataab.com/">Alhataab Digital</a>
                                </div>

                            </div>
                        </div>
                    </div>

                </section>

            </div>
        </main><!-- End #main -->


        {{-- <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a> --}}
        @livewireScripts
        <script src="{{ asset('assets/js/jquery.js') }}"></script>
        <!-- Vendor JS Files -->
        <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
        <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
        <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

        <!-- Template Main JS File -->
        <script src="{{ asset('assets/js/main.js') }}"></script>

    </body>

    </html>

