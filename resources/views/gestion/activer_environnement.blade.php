
<main id="main" class="main">

    <div class="pagetitle">
      <h1>ACTIVER L'ENVIRONNEMENT DE TRAVAIL</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item">Interface</li>
          <li class="breadcrumb-item active">Activer</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <!-- Special title treatmen -->
          <div class="card text-center">
            <div class="card-header">
                <p>Activer</p>
            </div>
            <div class="card-body">
              <h5 class="card-title">Activer votre environnement de travail</h5>
              <p class="card-text">Merci de commencer en cliquant sur le boutton</p>
              <a href="{{ route('activer.environnement',Auth::user()->id) }}" class="btn btn-primary">Commencer</a>
            </div>
          </div><!-- End Special title treatmen -->

        </div>
      </div>
    </section>

  </main><!-- End #main -->
