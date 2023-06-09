
<li class="nav-item">
    <a class="nav-link " href="{{ route('home') }}">
      <i class="bi bi-shop-window"></i>
      <span>Acceuil</span>
    </a>
  </li><!-- End Dashboard Nav -->
@if(Auth::user()->societe_id!="0")

@if(Auth::user()->role_id=="0" || Auth::user()->role_id=="1")
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-gear-wide-connected"></i><span>Parametre</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse bg-white" data-bs-parent="#sidebar-nav">
     <li>
       <a href="{{ route('workspace.show',Auth::user()->societe_id) }}">
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
      <li>
        <a href="{{ route('type_activite_investissement') }}">
          <i class="bi bi-circle"></i><span>Type activités</span>
        </a>
      </li>
      <li>
        <a href="{{ route('secteur_depense') }}">
          <i class="bi bi-circle"></i><span>Secteur depense activite</span>
        </a>
      </li>
      <li>
        <a href="{{ route('nature_operation_charge') }}">
          <i class="bi bi-circle"></i><span>Nature opération charge</span>
        </a>
      </li>
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
</li><!-- End Components Nav -->
@endif

@if(Auth::user()->role_id=="0" || Auth::user()->role_id=="1" || Auth::user()->role_id=="2" || Auth::user()->role_id=="3" || Auth::user()->role_id=="4")

<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#caisse-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-journal-text"></i><span>Gestion Caisse</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="caisse-nav" class="nav-content collapse bg-white " data-bs-parent="#sidebar-nav">

      <li>
        <a href="{{ route('caisse.operation') }}">
          <i class="bi bi-circle"></i><span>Ma caisse</span>
        </a>
      </li>
      <li>
        <a href="{{ route('caisse.rapport') }}">
          <i class="bi bi-circle"></i><span>Rapport operation caisse</span>
        </a>
      </li>
    </ul>
</li><!-- End Forms Nav -->
@endif
@if(Auth::user()->role_id=="0" || Auth::user()->role_id=="1" || Auth::user()->role_id=="2" || Auth::user()->role_id=="3" || Auth::user()->role_id=="4")

<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-journal-text"></i><span>Gestion investisseur</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="forms-nav" class="nav-content collapse bg-white " data-bs-parent="#sidebar-nav">

      <li>
        <a href="{{ route('investisseur.create') }}">
          <i class="bi bi-circle"></i><span>Nouveau investisseur</span>
        </a>
      </li>
      <li>
        <a href="{{ route('investisseur') }}">
          <i class="bi bi-circle"></i><span>Liste des investisseur </span>
        </a>
      </li>
      <li>
        <a href="{{ route('investisseur.code') }}">
          <i class="bi bi-circle"></i><span>Activation/ inactivation </span>
        </a>
      </li>
      <li>
        <a href="{{ route('i_versement') }}">
          <i class="bi bi-circle"></i><span> Versement  </span>
        </a>
      </li>

      <li>
        <a href="{{ route('i_retrait') }}">
          <i class="bi bi-circle"></i><span> Retrait  </span>
        </a>
      </li>
      {{-- <li>
        <a href="{{ route('d_retrait') }}">
          <i class="bi bi-circle"></i><span> Retrait dividende </span>
        </a>
      </li> --}}
      <li>
        <a href="{{ route('investisseur.consultation') }}">
          <i class="bi bi-circle"></i><span> Consulter compte  </span>
        </a>
      </li>
    </ul>
</li><!-- End Forms Nav -->
@endif
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#activite-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-layout-text-window-reverse"></i><span>Activites d'investissement</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="activite-nav" class="nav-content collapse bg-white" data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{route('activite_investissement.create')}}">
          <i class="bi bi-circle"></i><span>Nouvelle Activite</span>
        </a>
      </li>
      <li>
        <a href="{{ route('activite_investissement') }}">
          <i class="bi bi-circle"></i><span>Activites en cours</span>
        </a>
      </li>
      <li>
        <a href="{{ route('activite_investissement.valider') }}">
          <i class="bi bi-circle"></i><span>Activites valider</span>
        </a>
      </li>
      <li>
        <a href="{{ route('activite_investissement.terminer') }}">
          <i class="bi bi-circle"></i><span>Activites terminer</span>
        </a>
      </li>
    </ul>
  </li><!-- End Tables Nav -->
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-layout-text-window-reverse"></i><span>Autres opération</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="tables-nav" class="nav-content collapse bg-white" data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{route('caisse.attribution')}}">
          <i class="bi bi-circle"></i><span>Operation attribution caisse</span>
        </a>
      </li>
      <li>
        <a href="{{route('caisse.encaissement')}}">
          <i class="bi bi-circle"></i><span>Encaissement</span>
        </a>
      </li>
      <li>
        <a href="{{ route('operation') }}">
          <i class="bi bi-circle"></i><span>Operation charge</span>
        </a>
      </li>
      <li>
        <a href="{{ route('d_retrait') }}">
          <i class="bi bi-circle"></i><span> Operation de paiement dividende </span>
        </a>
      </li>
    </ul>
  </li><!-- End Tables Nav -->
  <li class="nav-heading">Tiers</li>
  <!--li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('client') }}">
      <i class="bi bi-people"></i>
      <span>Client</span>
    </a>
  </li--><!-- End client Page Nav -->
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
