
<li class="nav-item">
    <a class="nav-link " href="{{ route('home') }}">
      <i class="bi bi-shop-window"></i>
      <span>Acceuil</span>
    </a>
  </li><!-- End Dashboard Nav -->
@if(Auth::user()->societe_id!="0")

<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
      <i class="bx bx-cog"></i><span>Parametre</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse bg-white" data-bs-parent="#sidebar-nav">

     <li>
       <a href="{{ route('workspace.show',encrypt(Auth::user()->societe_id)) }}">
         <i class="bi bi-circle"></i><span>Institution</span>
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


    </ul>
</li>
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
      <i class="bx bx-book-reader"></i><span>Demandes</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="tables-nav" class="nav-content collapse bg-white " data-bs-parent="#sidebar-nav">
        <li>
            <a href="tables-general.html">
              <i class="bi bi-circle"></i><span>Expression de besoin  </span>
            </a>
        </li>
        <li>
        <a href="tables-general.html">
          <i class="bi bi-circle"></i><span>Demande en cours</span>
        </a>
      </li>
      <li>
        <a href="tables-data.html">
          <i class="bi bi-circle"></i><span>Demandes traitées</span>
        </a>
      </li>
    </ul>
  </li><!-- End Tables Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
      <i class="bx bx-calendar"></i><span>Commandes</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="charts-nav" class="nav-content collapse bg-white " data-bs-parent="#sidebar-nav">
      <li>
        <a href="charts-chartjs.html">
          <i class="bi bi-circle"></i><span>Expression de besoin</span>
        </a>
      </li>
      <li>
        <a href="charts-apexcharts.html">
          <i class="bi bi-circle"></i><span>Commande en cours</span>
        </a>
      </li>
      <li>
        <a href="charts-echarts.html">
          <i class="bi bi-circle"></i><span>Commande traitées</span>
        </a>
      </li>
    </ul>
  </li><!-- End Charts Nav -->


  <li class="nav-heading">Pages</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('profile') }}">
      <i class="bi bi-person-square"></i>
      <span>Profile</span>
    </a>
  </li><!-- End Contact Page Nav -->

@endif


  <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('logout') }}">
      <i class="bx bx-log-out"></i>
      <span>Déconnexion</span>
    </a>
  </li><!-- End Blank Page Nav -->
