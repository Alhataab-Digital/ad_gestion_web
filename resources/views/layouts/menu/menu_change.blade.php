<li class="nav-item">
    <a class="nav-link " href="{{ route('home') }}">
        <i class="bi bi-shop-window"></i>
        <span>Acceuil</span>
    </a>
</li><!-- End Dashboard Nav -->
@if(Auth::user()->societe_id!="0")
@if(Auth::user()->role_id =="1" || Auth::user()->role_id =="0")

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
            <a href="{{ route('devise') }}">
                <i class="bi bi-circle"></i><span>Type devise</span>
            </a>
        </li>
        <li>
            <a href="{{ route('nature_operation_charge') }}">
                <i class="bi bi-circle"></i><span>Nature opération chargé </span>
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
            <a href="{{ route('banque') }}">
                <i class="bi bi-circle"></i><span>Banques </span>
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
@endif

@if(Auth::user()->role_id =="1" || Auth::user()->role_id =="2" || Auth::user()->role_id =="3"|| Auth::user()->role_id =="6" || Auth::user()->role_id
=="0")
@if(Auth::user()->agence_id!="0")
<!-- End Components Nav -->
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#caisse-nav" data-bs-toggle="collapse" href="#">
        <i class="bx bx-calculator"></i><span>Gestion Caisse</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="caisse-nav" class="nav-content collapse bg-white " data-bs-parent="#sidebar-nav">

        <li>
            <a href="{{ route('caisse.operation') }}">
                <i class="bi bi-circle"></i><span>Ouverture & fermeture caisse</span>
            </a>
        </li>

        <li>
            <a href="{{route('caisse.attribution')}}">
                <i class="bi bi-circle"></i><span>Attribution caisse interne</span>
            </a>
        </li>
        <li>
            <a href="{{route('caisse.attribution_externe')}}">
                <i class="bi bi-circle"></i><span>Attribution caisse externe</span>
            </a>
        </li>
        <li>
            <a href="{{route('caisse.encaissement')}}">
                <i class="bi bi-circle"></i><span>Approvisionnement caisse</span>
            </a>
        </li>
        <li>
            <a href="{{ route('caisse.rapport') }}">
                <i class="bi bi-circle"></i><span>Journal caisse</span>
            </a>
        </li>
    </ul>
</li><!-- End Forms Nav -->
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Autres opération caisse</span><i
            class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="tables-nav" class="nav-content collapse bg-white" data-bs-parent="#sidebar-nav">

        <li>
            <a href="{{ route('operation') }}">
                <i class="bi bi-circle"></i><span> Operation des charges </span>
            </a>
        </li>

    </ul>
</li><!-- End Tables Nav -->
<li class="nav-item">
    <a class="nav-link collapse" data-bs-target="#banque-nav" data-bs-toggle="collapse" href="#">
        <i class="ri ri-building-line"></i><span>Gestion banque</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="banque-nav" class="nav-content collapse bg-white " data-bs-parent="#sidebar-nav">
        <li>
            <a href="{{ route('banque.depot') }}">
                <i class="bi bi-circle"></i><span>Depot banque</span>
            </a>
        </li>
        <li>
            <a href="{{ route('banque.retrait') }}">
                <i class="bi bi-circle"></i><span>Retrait banque</span>
            </a>
        </li>
        <!-- <li>
    <a href="{{ route('banque.virement') }}">
      <i class="bi bi-circle"></i><span>Virement bancaire</span>
    </a>
  </li> -->
        <li>
            <a href="{{ route('banque.rapprochement') }}">
                <i class="bi bi-circle"></i><span>Rapprochement bancaire</span>
            </a>
        </li>

    </ul>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="ri ri-exchange-line"></i><span>Operation change</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="forms-nav" class="nav-content collapse bg-white " data-bs-parent="#sidebar-nav">

        <li>
            <a href="{{ route('achat_devise') }}">
                <i class="bi bi-circle"></i><span>Achat change</span>
            </a>
        </li>
        <li>
            <a href="{{ route('vente_devise') }}">
                <i class="bi bi-circle"></i><span>Vente change</span>
            </a>
        </li>
        <li>
            <a href="{{ route('envoi') }}">
                <i class="bi bi-circle"></i><span>Envoi change </span>
            </a>
        </li>
        <li>
            <a href="{{ route('retrait') }}">
                <i class="bi bi-circle"></i><span>Retait change</span>
            </a>
        </li>
    </ul>
</li><!-- End Forms Nav -->
@endif
@endif
@if(Auth::user()->role_id =="1" || Auth::user()->role_id =="2" || Auth::user()->role_id =="0")

<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
        <i class="ri ri-arrow-left-right-fill"></i><span>Autres opération</span><i
            class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="tables-nav" class="nav-content collapse bg-white" data-bs-parent="#sidebar-nav">
        <li>
            <a href="{{route('operation')}}">
                <i class="bi bi-circle"></i><span>Autres opération</span>
            </a>
        </li>
        <li>
            <a href="tables-data.html">
                <i class="bi bi-circle"></i><span>Rapprochement Bancaire</span>
            </a>
        </li>
    </ul>
</li><!-- End Tables Nav -->

<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-bar-chart"></i><span>Rapport</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="charts-nav" class="nav-content collapse bg-white" data-bs-parent="#sidebar-nav">

        <li>
            <a href="charts-apexcharts.html">
                <i class="bi bi-circle"></i><span>Situation stock</span>
            </a>
        </li>
        <li>
            <a href="charts-echarts.html">
                <i class="bi bi-circle"></i><span>Situation compte depot</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="bi bi-circle"></i><span>Rapport vente</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="bi bi-circle"></i><span>Rapport achat</span>
            </a>
        </li>
        <li>
            <a href="icons-boxicons.html">
                <i class="bi bi-circle"></i><span>Rapport caisse</span>
            </a>
        </li>
        <li>
            <a href="{{ route('client') }}">
                <i class="bi bi-circle"></i><span>Rapport client</span>
            </a>
        </li>
    </ul>
</li><!-- End Charts Nav -->


<li class="nav-heading">Tiers</li>

<!--li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('client') }}">
        <i class="bi bi-people"></i>
        <span>Client</span>
        </a>
    </li-->
<!-- End client Page Nav -->

<li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('profile') }}">
        <i class="bi bi-person-square"></i>
        <span>Profile</span>
    </a>
</li><!-- End Contact Page Nav -->


@endif
@endif

<li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('logout') }}">
        <i class="bx bx-log-out"></i>
        <span>Déconnexion</span>
    </a>
</li><!-- End Blank Page Nav -->
