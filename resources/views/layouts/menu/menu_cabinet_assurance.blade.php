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
        <li>
            <a href="{{ route('region') }}">
                <i class="bi bi-circle"></i><span>Region / Pays </span>
            </a>
        </li>


    </ul>
</li><!-- End Components Nav -->
<li class="nav-item active">
    <a class="nav-link collapsed" data-bs-target="#administration-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gear-wide-connected"></i><span>Configuration assurance</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="administration-nav" class="nav-content collapse bg-white" data-bs-parent="#sidebar-nav">
        <li>
            <a href="{{route('index.usage')}}">
                <i class="bi bi-circle"></i><span>Usage</span>
            </a>
        </li>
        <li>
            <a href="{{route('index.puissance')}}">
                <i class="bi bi-circle"></i><span>Puissance</span>
            </a>
        </li>
        <li>
            <a href="{{route('index.energie')}}">
                <i class="bi bi-circle"></i><span>Energie</span>
            </a>
        </li>
        <li>
            <a href="{{route('index.zone')}}">
                <i class="bi bi-circle"></i><span>Zone</span>
            </a>
        </li>
        <li>
            <a href="{{route('index.groupe')}}">
                <i class="bi bi-circle"></i><span>Groupe</span>
            </a>
        </li>
        <li>
            <a href="{{route('index.classe')}}">
                <i class="bi bi-circle"></i><span>Classe</span>
            </a>
        </li>
        <li>
            <a href="{{route('index.prime_net')}}">
                <i class="bi bi-circle"></i><span>Prime net</span>
            </a>
        </li>
        <hr>

        <li>
            <a href="{{route('index.duree')}}">
                <i class="bi bi-circle"></i><span>Duree</span>
            </a>
        </li>
        <li>
            <a href="{{route('index.categorie')}}">
                <i class="bi bi-circle"></i><span>Categorie</span>
            </a>
        </li>

        <li>
            <a href="{{route('index.genre')}}">
                <i class="bi bi-circle"></i><span>Genre</span>
            </a>
        </li>
        <li>
            <a href="{{route('index.marque')}}">
                <i class="bi bi-circle"></i><span>Marque</span>
            </a>
        </li>


    </ul>
</li><!-- End Components Nav -->
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#caisse-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Gestion Caisse</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="caisse-nav" class="nav-content collapse bg-white " data-bs-parent="#sidebar-nav">

        <li>
            <a href="{{ route('caisse.operation') }}">
                <i class="bi bi-circle"></i><span>Ouverture & fermeture caisse</span>
            </a>
        </li>

        <li>
            <a href="{{ route('caisse.attribution') }}">
                <i class="bi bi-circle"></i><span>Attribution caisse interne</span>
            </a>
        </li>
        <li>
            <a href="{{ route('caisse.attribution_externe') }}">
                <i class="bi bi-circle"></i><span>Attribution caisse externe</span>
            </a>
        </li>
        <li>
            <a href="{{ route('caisse.encaissement') }}">
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
                <i class="bi bi-circle"></i><span> Operation des charges du cabinet</span>
            </a>
        </li>

    </ul>
</li><!-- End Tables Nav -->
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#banque-nav" data-bs-toggle="collapse" href="#">
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
        <i class="bi bi-journal-text"></i><span>Gestion assurance</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="forms-nav" class="nav-content collapse bg-white " data-bs-parent="#sidebar-nav">
        <li>
            <a href="forms-elements.html">
                <i class="bi bi-circle"></i><span>Assurer vehicule</span>
            </a>
        </li>
        <li>
            <a href="forms-layouts.html">
                <i class="bi bi-circle"></i><span>Operation assurance</span>
            </a>
        </li>
    </ul>

<li class="nav-item">
    <a class="nav-link collapsed" href="pages-faq.html">
        <i class="bi bi-people"></i>
        <span>Client</span>
    </a>
</li><!-- End client Page Nav -->

<li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('profile') }}">
        <i class="bi bi-envelope"></i>
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
