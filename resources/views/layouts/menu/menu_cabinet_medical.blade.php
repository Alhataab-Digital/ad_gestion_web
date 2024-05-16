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
        <li>
            <a href="{{route('ad.sante.index.tarif_medical')}}" wire:navigate >
                <i class="bi bi-circle"></i><span>Tarifs</span>
            </a>
        </li>

    </ul>
</li>

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
<!-- End Forms Nav -->
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#donne-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gear-wide-connected"></i><span>Gestion patient</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="donne-nav" class="nav-content collapse bg-white" data-bs-parent="#sidebar-nav">

        <li>
            <a href="{{route('ad.sante.index.patient')}}">
                <i class="bi bi-circle"></i><span>Dossier Patient</span>
            </a>
        </li>
        <li>
            <a href="{{route('ad.sante.index.consultation')}}">
                <i class="bi bi-circle"></i><span>Consultation</span>
            </a>
        </li>
        <li>
            <a href="tables-general.html">
                <i class="bi bi-circle"></i><span>Rendez-vous</span>
            </a>
        </li>

    </ul>
</li>
<!-- End Charts Nav -->
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#plannification-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Gestion medecin </span><i
            class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="plannification-nav" class="nav-content collapse bg-white " data-bs-parent="#sidebar-nav">
        <li>
            <a href="{{route('ad.sante.index.medecin')}}">
                <i class="bi bi-circle"></i><span>Dossier medecin</span>
            </a>
        </li>
        <li>
            <a href="{{route('ad.sante.index.planification.medecin')}}">
                <i class="bi bi-circle"></i><span>Planification</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="bi bi-circle"></i><span> Rendez-vous</span>
            </a>
        </li>



    </ul>
</li>
<!-- End Charts Nav -->
{{-- <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#facturation-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Facturation et paiements</span><i
            class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="facturation-nav" class="nav-content collapse bg-white " data-bs-parent="#sidebar-nav">
        <!-- <li>
    <a href="">
    <i class="bi bi-circle"></i><span>Programmation hebdomadaire</span>
    </a>
    </li> -->
        <li>
            <a href="">
                <i class="bi bi-circle"></i><span>Facturation
                </span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="bi bi-circle"></i><span>Paiements
                </span>
            </a>
        </li>
    </ul>
</li> --}}

{{-- <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#personnel-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Gestion du personnel</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="personnel-nav" class="nav-content collapse bg-white " data-bs-parent="#sidebar-nav">
        <li>
            <a href="{{ route('commande') }}">
                <i class="bi bi-circle"></i><span>Personnel Administratifs</span>
            </a>
        </li>
        <li>
            <a href="{{ route('devis') }}">
                <i class="bi bi-circle"></i><span>Corps medicale</span>
            </a>
        </li>
    </ul>
</li> --}}
<!-- End Charts Nav -->

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
                <i class="bi bi-circle"></i><span>Examen clinique</span>
            </a>
        </li>
        <li>
            <a href="icons-boxicons.html">
                <i class="bi bi-circle"></i><span>Examen biologique</span>
            </a>
        </li>
        <li>
            <a href="icons-boxicons.html">
                <i class="bi bi-circle"></i><span>Examen radiologique</span>
            </a>
        </li>
    </ul>
</li>
<!-- End Icons Nav -->

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
