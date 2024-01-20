
<li class="nav-item">
    <a class="nav-link " href="{{ route('home') }}">
      <i class="bi bi-shop-window"></i>
      <span>Acceuil</span>
    </a>
  </li><!-- End Dashboard Nav -->
@if(Auth::user()->societe_id!="0")

<li class="nav-item">
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gear-wide-connected"></i><span>Parametre</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse bg-white" data-bs-parent="#sidebar-nav">

         <li>
           <a href="{{ route('workspace.show',encrypt(Auth::user()->societe_id)) }}">
             <i class="bx bxs-institution"></i><span>Institution</span>
           </a>
         </li>

    <li>
            <a href="{{ route('users.index') }}">
                <i class="bi bi-circle"></i><span>Utilisateur</span>
            </a>
          </li>
    <li>
            <a href="{{ route('devise') }}">
              <i class="bi bi-circle"></i><span>Type devise</span>
            </a>
          </li>
          {{-- <li>
            <a href="{{ route('devise.taux') }}">
              <i class="bi bi-circle"></i><span>Taux d'échange devise</span>
            </a>
          </li> --}}
          <li>
            <a href="{{ route('agence') }}">
              <i class="bi bi-circle"></i><span>Agences</span>
            </a>
          </li>
          <li>
            <a href="{{ route('caisse') }}">
              <i class="bi bi-circle"></i><span>Caisses </span>
            </a>
          </li>

          <li>
            <a href="{{ route('agence_user') }}">
                <i class="bi bi-circle"></i><span>Association Agence Utilisateur</span>
            </a>
          </li>
          <li>
            <a href="{{ route('caisse_user') }}">
              <i class="bi bi-circle"></i><span>Association Caisse Utilisateur</span>
            </a>
          </li>
          <li>
        <a href="tables-general.html">
          <i class="bi bi-circle"></i><span>Tarifs</span>
        </a>
      </li>
      <li>
        <a href="tables-general.html">
          <i class="bi bi-circle"></i><span>Maladies</span>
        </a>
      </li>
      <li>
        <a href="tables-general.html">
          <i class="bi bi-circle"></i><span>Modèles d'analyse</span>
        </a>
      </li>
      <li>
        <a href="tables-general.html">
          <i class="bi bi-circle"></i><span>Modèles de radio</span>
        </a>
      </li>
      <li>
        <a href="tables-general.html">
          <i class="bi bi-circle"></i><span>Modèles de certificat</span>
        </a>
      </li>
      <li>
        <a href="tables-general.html">
          <i class="bi bi-circle"></i><span>Modèles d' ordonnance</span>
        </a>
      </li>
      <li>
        <a href="tables-general.html">
          <i class="bi bi-circle"></i><span>Analyses</span>
        </a>
      </li>
      <li>
        <a href="tables-general.html">
          <i class="bi bi-circle"></i><span>Vaccins</span>
        </a>
      </li>
      <li>
        <a href="tables-general.html">
          <i class="bi bi-circle"></i><span>Médicaments</span>
        </a>
      </li>
        </ul>
    </li>
   
    <!-- End Components Nav -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#caisse-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-cash-stack"></i><span>Gestion Caisse</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="caisse-nav" class="nav-content collapse bg-white " data-bs-parent="#sidebar-nav">

        <li>
            <a href="{{ route('caisse.operation') }}">
            <i class="bi bi-circle"></i><span>Situation caisse</span>
            </a>
        </li>
        <li>
            <a href="{{ route('caisse.rapport') }}">
            <i class="bi bi-circle"></i><span>Attribution caisse</span>
            </a>
        </li>

        <li>
            <a href="{{ route('caisse.rapport') }}">
            <i class="bi bi-circle"></i><span>Depot caisse</span>
            </a>
        </li>
        <li>
            <a href="{{ route('caisse.rapport') }}">
            <i class="bi bi-circle"></i><span>Retrait caisse</span>
            </a>
        </li>

        <li>
            <a href="{{ route('caisse.rapport') }}">
            <i class="bi bi-circle"></i><span>Rapport operation caisse</span>
            </a>
        </li>
        <li>
            <a href="{{ route('caisse.rapport') }}">
            <i class="bi bi-circle"></i><span>Mouvement caisse</span>
            </a>
        </li>
        </ul>
    </li> -->
    <!-- End Forms Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
      <i class="ri ri-building-line"></i><span>Consultations</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="tables-nav" class="nav-content collapse bg-white " data-bs-parent="#sidebar-nav">
      <li>
        <a href="tables-general.html">
          <i class="bi bi-circle"></i><span>Nouvelle consultation</span>
        </a>
      </li>
      <li>
        <a href="tables-general.html">
          <i class="bi bi-circle"></i><span>Liste des consultations</span>
        </a>
      </li>
    </ul>
  </li><!-- End Tables Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-journal-text"></i><span>Patients</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="charts-nav" class="nav-content collapse bg-white " data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{ route('commande') }}">
          <i class="bi bi-circle"></i><span>Nouveau patient</span>
        </a>
      </li>
      <li>
        <a href="{{ route('devis') }}">
          <i class="bi bi-circle"></i><span>Liste des patients</span>
        </a>
      </li>
    </ul>
  </li><!-- End Charts Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
      <i class="ri ri-list-check"></i><span>Rapport</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="icons-nav" class="nav-content collapse bg-white " data-bs-parent="#sidebar-nav">
      <li>
        <a href="icons-bootstrap.html">
          <i class="bi bi-circle"></i><span>Consultations</span>
        </a>
      </li>
      <li>
        <a href="icons-remix.html">
          <i class="bi bi-circle"></i><span>Vaccination</span>
        </a>
      </li>
      <li>
        <a href="icons-boxicons.html">
          <i class="bi bi-circle"></i><span>Certification</span>
        </a>
      </li>
      <li>
        <a href="icons-boxicons.html">
          <i class="bi bi-circle"></i><span>Analyse</span>
        </a>
      </li>
    </ul>
  </li><!-- End Icons Nav -->

  <li class="nav-heading">perso</li>

  
  <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('profile') }}">
      <i class="bi bi-person-square"></i>
      <span>Profile</span>
    </a>
  </li><!-- End Contact Page Nav -->

@endif

  <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('logout') }}">
      <i class="bi bi-file-earmark"></i>
      <span>Déconnexion</span>
    </a>
  </li><!-- End Blank Page Nav -->
