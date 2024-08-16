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
    <ul id="components-nav" class="bg-white nav-content collapse" data-bs-parent="#sidebar-nav">

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
        @if (Auth::user()->role_id == '0' || Auth::user()->role_id == '1')
        <li>
            <a href="{{ route('users.online') }}">
                <i class="bi bi-circle"></i><span> Utilisateur en ligne</span>
            </a>
        </li>
        <li>
            <a href="{{ route('users.filelog') }}">
                <i class="bi bi-circle"></i><span>Ficher log Utilisateur</span>
            </a>
        </li>
        @endif
        <li>
            <a href="{{ route('devise') }}">
                <i class="bi bi-circle"></i><span>Devise</span>
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
        {{-- <li>
            <a href="{{route('ad.sante.tarif.prestation')}}">
                <i class="bx bxs-institution"></i><span>Tarifs prestation</span>
            </a>
        </li>
        <li>
            <a href="{{route('ad.sante.tarif.consultation')}}" wire:navigate>
                <i class="bi bi-circle"></i><span>Tarifs consultation</span>
            </a>
        </li>
        <li>
            <a href="" wire:navigate>
                <i class="bi bi-circle"></i><span>Tarifs hospitalisation</span>
            </a>
        </li> --}}
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
<!-- End Charts Nav -->
<li class="nav-heading">Configuration medicale</li>
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#config-generale-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gear-wide-connected"></i><span>Config génénale</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="config-generale-nav" class="bg-white nav-content collapse" data-bs-parent="#sidebar-nav">

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
            <a href="{{route('ad.sante.maison.assurance.medicale')}}">
                <i class="bx bxs-institution"></i><span>Structure d'assurance</span>
            </a>
        </li>
        <li>
            <a href="{{route('ad.sante.type.consultation')}}">
                <i class="bx bxs-institution"></i><span>Type consultation</span>
            </a>
        </li>
        <li>
            <a href="{{route('ad.sante.type.prestation')}}">
                <i class="bx bxs-institution"></i><span>Type prestation</span>
            </a>
        </li>
        <li>
            <a href="{{route('ad.sante.type.hospitalisation')}}">
                <i class="bx bxs-institution"></i><span>Type hospitalisation</span>
            </a>
        </li>
        <li>
            <a href="{{route('ad.sante.type.vaccin')}}">
                <i class="bx bxs-institution"></i><span>Type de vaccin</span>
            </a>
        </li>
        <li>
            <a href="{{route('ad.sante.type.addiction')}}">
                <i class="bx bxs-institution"></i><span>Type d'addiction</span>
            </a>
        </li>
        <li>
            <a href="{{route('ad.sante.type.allergie')}}">
                <i class="bx bxs-institution"></i><span>Type d'allergie</span>
            </a>
        </li>
        <li>
            <a href="{{route('ad.sante.type.examen')}}">
                <i class="bx bxs-institution"></i><span>Type d'examen</span>
            </a>
        </li>
         <li>
            <a href="{{route('ad.sante.test.examen.demande')}}">
                <i class="bx bxs-institution"></i><span>Test demande</span>
            </a>
        </li>
        <li>
            <a href="{{route('ad.sante.type.soins')}}">
                <i class="bx bxs-institution"></i><span>Type de soins</span>
            </a>
        </li>
        <li>
            <a href="{{route('ad.sante.medicament')}}">
                <i class="bx bxs-institution"></i><span>Produit pharmaceutique</span>
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
                <i class="bx bxs-institution"></i><span>Départements</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="bx bxs-institution"></i><span>Unités</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="bx bxs-institution"></i><span>Salles</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="bx bxs-institution"></i><span>Lits</span>
            </a>
        </li>
    </ul>
</li>
@endif
@if(Auth::user()->role_id =="1" || Auth::user()->role_id =="0"|| Auth::user()->role_id =="2"||Auth::user()->role_id
=="3"||Auth::user()->role_id =="4"||Auth::user()->role_id =="5")

<li class="nav-heading">Gestion tresorerie</li>

<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#caisse-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Gestion Caisse</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="caisse-nav" class="bg-white nav-content collapse " data-bs-parent="#sidebar-nav">

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
    <ul id="tables-nav" class="bg-white nav-content collapse" data-bs-parent="#sidebar-nav">

        <li>
            <a href="{{ route('operation') }}">
                <i class="bi bi-circle"></i><span> Operation des charges du cabinet</span>
            </a>
        </li>

    </ul>
</li><!-- End Tables Nav -->

@endif
@if(Auth::user()->role_id =="1" || Auth::user()->role_id =="0"|| Auth::user()->role_id =="2"||Auth::user()->role_id
=="3"||Auth::user()->role_id =="4")
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#banque-nav" data-bs-toggle="collapse" href="#">
        <i class="ri ri-building-line"></i><span>Gestion banque</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="banque-nav" class="bg-white nav-content collapse " data-bs-parent="#sidebar-nav">
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
@if(Auth::user()->role_id =="1" || Auth::user()->role_id =="0"|| Auth::user()->role_id =="2"||Auth::user()->role_id
=="3"||Auth::user()->role_id =="4"||Auth::user()->role_id =="5")
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#facturation-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gear-wide-connected"></i><span>Facturations & paiements</span><i
            class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="facturation-nav" class="bg-white nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
            <a href="{{route('ad.sante.facturation.consultation')}}">
                <i class="bi bi-circle"></i><span>Reglement consultation</span>
            </a>
        </li>
        <li>
            <a href="{{route('ad.sante.facturation.hospitalisation')}}">
                <i class="bi bi-circle"></i><span>Reglement hospitalisation</span>
            </a>
        </li>
        <li>
            <a href="{{route('ad.sante.facturation.prestation')}}">
                <i class="bi bi-circle"></i><span>Facturation prestation</span>
            </a>
        </li>

        <li>
            <a href="{{route('ad.sante.vente.medicament')}}">
                <i class="bi bi-circle"></i><span>Vente medicament</span>
            </a>
        </li>
    </ul>
</li>
@endif

@if(Auth::user()->role_id =="1" || Auth::user()->role_id =="0"|| Auth::user()->role_id =="2"||Auth::user()->role_id
=="3"||Auth::user()->role_id =="4"|| Auth::user()->role_id =="5"|| Auth::user()->role_id =="6")

@if(Auth::user()->role_id =="1" || Auth::user()->role_id =="0"|| Auth::user()->role_id =="2"||Auth::user()->role_id
=="3"|| Auth::user()->role_id =="6")
<li class="nav-heading">Gestion medicale</li>
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#patient-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gear-wide-connected"></i><span>Gestion patient</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="patient-nav" class="bg-white nav-content collapse" data-bs-parent="#sidebar-nav">
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
@if(Auth::user()->role_id =="1" || Auth::user()->role_id =="0"|| Auth::user()->role_id =="2"|| Auth::user()->role_id
=="3")
<!-- End Charts Nav -->
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#plannification-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Gestion medecin </span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="plannification-nav" class="bg-white nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
            <a href="{{route('ad.sante.index.medecin')}}">
                <i class="bi bi-circle"></i><span>Dossier medecin</span>
            </a>
        </li>
        <li>
            <a href="{{route('ad.sante.index.planification.medecin')}}">
                <i class="bi bi-circle"></i><span>Agenda medecin</span>
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
@if(Auth::user()->role_id =="1" || Auth::user()->role_id =="0"|| Auth::user()->role_id =="2"||Auth::user()->role_id
=="3"||Auth::user()->role_id =="5")
{{-- <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#rendez-vous-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gear-wide-connected"></i><span>Gestion rendez-vous</span><i
            class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="rendez-vous-nav" class="bg-white nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
            <a href="{{route('ad.sante.rendez-vous.consultation')}}">
                <i class="bi bi-circle"></i><span>Rendez-vous</span>
            </a>
        </li>
    </ul>
</li> --}}
@endif
@if(Auth::user()->role_id =="1" || Auth::user()->role_id =="0"|| Auth::user()->role_id =="2"||Auth::user()->role_id
=="3"||Auth::user()->role_id =="4"||Auth::user()->role_id =="5")

@if(Auth::user()->role_id =="1" || Auth::user()->role_id =="0"|| Auth::user()->role_id =="2"||Auth::user()->role_id
=="3"||Auth::user()->role_id
=="5")

<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#consultation-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gear-wide-connected"></i><span>Gestion consultation</span><i
            class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="consultation-nav" class="bg-white nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
            <a href="{{route('ad.sante.rendez-vous.consultation')}}">
                <i class="bi bi-circle"></i><span>Rendez-vous</span>
            </a>
        </li>
        <li>
            <a href="{{route('ad.sante.index.consultation')}}">
                <i class="bi bi-circle"></i><span>Consultation</span>
            </a>
        </li>

    </ul>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#hospitalisation-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gear-wide-connected"></i><span>Gestion hospitalisation</span><i
            class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="hospitalisation-nav" class="bg-white nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
            <a href="">
                <i class="bi bi-circle"></i><span>Admission</span>
            </a>
        </li>
        <li>
            <a href="{{ route('ad.sante.hospitalisation') }}">
                <i class="bi bi-circle"></i><span>Hospitalisation</span>
            </a>
        </li>

    </ul>
</li>
@endif
@endif
@endif

@if(Auth::user()->role_id =="1" || Auth::user()->role_id =="0"|| Auth::user()->role_id =="2"||Auth::user()->role_id
=="3"||Auth::user()->role_id =="4"||Auth::user()->role_id =="5")
@if(Auth::user()->role_id =="1" || Auth::user()->role_id =="0"|| Auth::user()->role_id =="2"|| Auth::user()->role_id
=="3")
<li class="nav-heading">Gestion d'analyse medicale</li>

<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#labo-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Gestion Laboratoire</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="labo-nav" class="bg-white nav-content collapse " data-bs-parent="#sidebar-nav">

        <li>
            <a href="{{ route('ad.sante.bulletin.examen.medical') }}">
                <i class="bi bi-circle"></i><span>Analyse medicale</span>
            </a>
        </li>

        <li>
            <a href="{{ route('ad.sante.resultat.examen.medical') }}">
                <i class="bi bi-circle"></i><span>Resultat analyse medicale</span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-heading">Gestion pharmaceutique</li>
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#pharma-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Gestion pharmacie</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="pharma-nav" class="bg-white nav-content collapse " data-bs-parent="#sidebar-nav">

        <li>
            <a href="">
                <i class="bi bi-circle"></i><span>Approvisionnement</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="bi bi-circle"></i><span>Operation de vente</span>
            </a>
        </li>
    </ul>
</li>
@endif


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
