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
                <i class="bi bi-circle"></i><span>Nature opération charge </span>
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
            <a href="{{ route('ad.sante.medecin.user') }}">
                <i class="bi bi-circle"></i><span>Association un medecin à un compte Utilisateur</span>
            </a>
        </li>
        <li>
            <a href="{{ route('region') }}">
                <i class="bi bi-circle"></i><span>Region / Pays </span>
            </a>
        </li>
        <li>
            <a href="{{route('role')}}">
                <i class="bx bxs-institution"></i><span>Role utilisateur</span>
            </a>
        </li>
    </ul>
</li>
@endif
@if(Auth::user()->role_id =="1" || Auth::user()->role_id =="0"|| Auth::user()->role_id =="2"||Auth::user()->role_id =="3"||Auth::user()->role_id =="4"||Auth::user()->role_id =="5")

<li class="nav-heading">Gestion tresorerie</li>

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
        <i class="bi bi-layout-text-window-reverse"></i><span>Opération des charges</span><i
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
@endif
@if(Auth::user()->role_id =="1" || Auth::user()->role_id =="0"|| Auth::user()->role_id =="2"||Auth::user()->role_id =="3"||Auth::user()->role_id =="4")
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
<!-- End Forms Nav -->
@endif


<li class="nav-heading">Gestion medicale</li>
@if(Auth::user()->role_id =="1" || Auth::user()->role_id =="0"|| Auth::user()->role_id =="2"||Auth::user()->role_id =="3"||Auth::user()->role_id =="4"|| Auth::user()->role_id =="5"|| Auth::user()->role_id =="6")
@if(Auth::user()->role_id =="1" || Auth::user()->role_id =="0"|| Auth::user()->role_id =="2"||Auth::user()->role_id =="3"|| Auth::user()->role_id =="6")
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#patient-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gear-wide-connected"></i><span>Gestion patient</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="patient-nav" class="nav-content collapse bg-white" data-bs-parent="#sidebar-nav">
        <li>
            <a href="{{route('ad.sante.index.patient')}}">
                <i class="bi bi-circle"></i><span>Dossier Patient</span>
            </a>
        </li>
    </ul>
</li>
@if(Auth::user()->role_id =="6" && Auth::user()->espace_id != 0)

<li class="nav-item">
    <a class="nav-link collapsed" href="{{route('ad.sante.dossier.medecin',encrypt(Auth::user()->espace_id))}}">
        <i class="bi bi-person-square"></i>
        <span>Mon espace </span>
    </a>
</li><!-- End Contact Page Nav -->

@endif
@endif
@if(Auth::user()->role_id =="1" || Auth::user()->role_id =="0"|| Auth::user()->role_id =="2"||Auth::user()->role_id =="3"||Auth::user()->role_id =="5")
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#rendez-vous-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gear-wide-connected"></i><span>Gestion rendez-vous</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="rendez-vous-nav" class="nav-content collapse bg-white" data-bs-parent="#sidebar-nav">
        <li>
            <a href="{{route('ad.sante.rendez-vous.consultation')}}">
                <i class="bi bi-circle"></i><span>Rendez-vous</span>
            </a>
        </li>
    </ul>
</li>
@endif
@if(Auth::user()->role_id =="1" || Auth::user()->role_id =="0"|| Auth::user()->role_id =="2"||Auth::user()->role_id =="3"||Auth::user()->role_id =="4"||Auth::user()->role_id =="5")

<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#facturation-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gear-wide-connected"></i><span>Gestion facturation & paiements</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="facturation-nav" class="nav-content collapse bg-white" data-bs-parent="#sidebar-nav">
        <li>
            <a href="{{route('ad.sante.facturation.consultation')}}">
                <i class="bi bi-circle"></i><span>Reglement consultation</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="bi bi-circle"></i><span>Facture prestation</span>
            </a>
        </li>

        <li>
            <a href="">
                <i class="bi bi-circle"></i><span>Vente produit pharmaceutique</span>
            </a>
        </li>
    </ul>
</li>
@if(Auth::user()->role_id =="1" || Auth::user()->role_id =="0"|| Auth::user()->role_id =="2"||Auth::user()->role_id =="3")

<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#consultation-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gear-wide-connected"></i><span>Gestion consultation</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="consultation-nav" class="nav-content collapse bg-white" data-bs-parent="#sidebar-nav">

        <li>
            <a href="{{route('ad.sante.index.consultation')}}">
                <i class="bi bi-circle"></i><span>Consultation</span>
            </a>
        </li>

    </ul>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#hospitalisation-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gear-wide-connected"></i><span>Gestion hospitalisation</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="hospitalisation-nav" class="nav-content collapse bg-white" data-bs-parent="#sidebar-nav">

        <li>
            <a href="">
                <i class="bi bi-circle"></i><span>Hospitalisation</span>
            </a>
        </li>

    </ul>
</li>
@endif
@endif
@endif
@if(Auth::user()->role_id =="1" || Auth::user()->role_id =="0"|| Auth::user()->role_id =="2"|| Auth::user()->role_id =="3")
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

        {{-- <li>
            <a href="">
                <i class="bi bi-circle"></i><span> Rendez-vous</span>
            </a>
        </li>

        <li>
            <a href="">
                <i class="bi bi-circle"></i><span> Consultation</span>
            </a>
        </li> --}}



    </ul>
</li>
@endif
@if(Auth::user()->role_id =="1" || Auth::user()->role_id =="0"|| Auth::user()->role_id =="2"|| Auth::user()->role_id =="3")

<!-- End Charts Nav -->
<li class="nav-heading">Configuration medicale</li>
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#config-generale-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gear-wide-connected"></i><span>Config génénale</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="config-generale-nav" class="nav-content collapse bg-white" data-bs-parent="#sidebar-nav">
        <li>
            <a href="">
                <i class="bx bxs-institution"></i><span>Approvisionnement produit pharmaceutique</span>
            </a>
        </li>
        <li>
            <a href="{{route('ad.sante.specialite.medicale')}}">
                <i class="bx bxs-institution"></i><span>Specialite medecin</span>
            </a>
        </li>
        <li>
            <a href="{{route('ad.sante.categorie.medicale')}}">
                <i class="bx bxs-institution"></i><span>Categorie medecin</span>
            </a>
        </li>
        <li>
            <a href="{{route('ad.sante.index.planification.medecin')}}">
                <i class="bi bi-circle"></i><span>Agenda medecin</span>
            </a>
        </li>
        <li>
            <a href="{{route('ad.sante.maison.assurance.medicale')}}">
                <i class="bx bxs-institution"></i><span>Assureur</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="bx bxs-institution"></i><span>Affection</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="bx bxs-institution"></i><span>Type de prestation</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="bx bxs-institution"></i><span>Vaccin</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="bx bxs-institution"></i><span>Allergie</span>
            </a>
        </li>
        <li>
            <a href="{{route('ad.sante.type.examen')}}">
                <i class="bx bxs-institution"></i><span>Type examen</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="bx bxs-institution"></i><span>Type soins</span>
            </a>
        </li>
        <li>
            <a href="{{route('ad.sante.medicament')}}">
                <i class="bx bxs-institution"></i><span>Medicaments</span>
            </a>
        </li>

    </ul>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#config-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gear-wide-connected"></i><span>Config consultation</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="config-nav" class="nav-content collapse bg-white" data-bs-parent="#sidebar-nav">


        <li>
            <a href="{{route('ad.sante.type.consultation')}}">
                <i class="bx bxs-institution"></i><span>Type consultation</span>
            </a>
        </li>
        <li>
            <a href="{{route('ad.sante.tarif.consultation')}}" wire:navigate >
                <i class="bi bi-circle"></i><span>Tarifs consultation</span>
            </a>
        </li>



    </ul>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#config-h-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gear-wide-connected"></i><span>Config hospitalisation</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="config-h-nav" class="nav-content collapse bg-white" data-bs-parent="#sidebar-nav">


        <li>
            <a href="" wire:navigate >
                <i class="bi bi-circle"></i><span>Tarifs hospitalisation</span>
            </a>
        </li>

        <li>
            <a href="">
                <i class="bx bxs-institution"></i><span>Lit</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="bx bxs-institution"></i><span>Type de lit</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="bx bxs-institution"></i><span>Salles</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="bx bxs-institution"></i><span>Commodités</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="bx bxs-institution"></i><span>Batiments</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="bx bxs-institution"></i><span>Unités</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="bx bxs-institution"></i><span>Départements</span>
            </a>
        </li>
    </ul>
</li>
@endif
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
