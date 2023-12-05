
<li class="nav-item">
    <a class="nav-link " href="{{ route('home') }}">
      <i class="bi bi-shop-window"></i>
      <span>Acceuil</span>
    </a>
  </li><!-- End Dashboard Nav -->
@if(Auth::user()->societe_id!="0")

<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-gear-wide-connected"></i><span>Parametre</span><i class="bi bi-chevron-down ms-auto"></i>
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
        <a href="#">
            <i class="bi bi-circle"></i><span>Maison d'arret</span>
        </a>
      </li>
    </ul>
  </li><!-- End Components Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-journal-text"></i><span>Fiche du detenu</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="forms-nav" class="nav-content collapse bg-white " data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{route('create.detenu') }}">
          <i class="bi bi-circle"></i><span>Nouveau Dossier</span>
        </a>
      </li>
      <li>
        <a href="{{route('index.detenu') }}">
          <i class="bi bi-circle"></i><span>Transferer un detenu</span>
        </a>
      </li>
      <li>
        <a href="forms-editors.html">
          <i class="bi bi-circle"></i><span>Libérer un detenu</span>
        </a>
      </li>
    </ul>
  </li><!-- End Forms Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-bar-chart"></i><span>Rapport</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="charts-nav" class="nav-content collapse bg-white" data-bs-parent="#sidebar-nav">
      <li>
        <a href="charts-chartjs.html">
          <i class="bi bi-circle"></i><span>Liste des detenus sejournée</span>
        </a>
      </li>
      <li>
        <a href="charts-chartjs.html">
          <i class="bi bi-circle"></i><span>Detenu liberer</span>
        </a>
      </li>
      <li>
        <a href="charts-chartjs.html">
          <i class="bi bi-circle"></i><span>Detenu transferer</span>
        </a>
      </li>
      <li>
        <a href="charts-apexcharts.html">
          <i class="bi bi-circle"></i><span>Detenu non transferer</span>
        </a>
      </li>
      <li>
        <a href="charts-apexcharts.html">
          <i class="bi bi-circle"></i><span>Detenu mineur</span>
        </a>
      </li>
    </ul>
  </li><!-- End Charts Nav -->


  

@endif


  <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('logout') }}">
      <i class="bi bi-file-earmark"></i>
      <span>Déconnexion</span>
    </a>
  </li><!-- End Blank Page Nav -->
