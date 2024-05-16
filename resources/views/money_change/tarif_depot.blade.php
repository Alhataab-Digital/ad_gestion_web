@extends('../layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Tarif des tranches</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">Param</li>
          <li class="breadcrumb-item active">Tarif</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tranche de dépôt</h5>

              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">de</th>
                    <th scope="col">a</th>
                    <th scope="col">tarif</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>5000</td>
                    <td>10000</td>
                    <td>28</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>10001</td>
                    <td>15000</td>
                    <td>35</td>
                  </tr>

                </tbody>
              </table>
              <!-- End Default Table Example -->
            </div>
          </div>
        </div>
        <div class="col-lg-6">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Tranche des commissions</h5>

                <!-- Default Table -->
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">de</th>
                      <th scope="col">à</th>
                      <th scope="col">commission</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>5000</td>
                      <td>10000</td>
                      <td>28</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>10001</td>
                      <td>15000</td>
                      <td>35</td>
                    </tr>

                  </tbody>
                </table>
                <!-- End Default Table Example -->
              </div>
            </div>
          </div>
      </div>
    </section>

  </main><!-- End #main -->
  @endsection
