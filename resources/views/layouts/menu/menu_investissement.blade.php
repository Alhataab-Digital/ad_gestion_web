
<li class="nav-item">
    <a class="nav-link " href="{{ route('home') }}">
      <i class="bi bi-shop-window"></i>
      <span>Acceuil</span>
    </a>
  </li><!-- End Dashboard Nav -->
@if(Auth::user()->societe_id!="0")

@if(Auth::user()->role_id=="0" || Auth::user()->role_id=="1"||  Auth::user()->role_id=="2"||  Auth::user()->role_id=="4")
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-gear-wide-connected"></i><span>Parametre</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse bg-white" data-bs-parent="#sidebar-nav">
      @if(Auth::user()->role_id=="0" || Auth::user()->role_id=="1"||Auth::user()->role_id=="2") 
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
      @endif
      @if(Auth::user()->role_id=="0" || Auth::user()->role_id=="1")
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
          <i class="bi bi-circle"></i><span>Type devise</span>
        </a>
      </li>
      @if(Auth::user()->role_id=="0" || Auth::user()->role_id=="1"||Auth::user()->role_id=="2"||Auth::user()->role_id=="4") 
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
      @endif
      @if(Auth::user()->role_id=="0" || Auth::user()->role_id=="1"||Auth::user()->role_id=="2")
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
    @endif
    </ul>
</li><!-- End Components Nav -->
@endif
@if(Auth::user()->agence_id!="0")
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
@if(Auth::user()->role_id=="0" || Auth::user()->role_id=="1"|| Auth::user()->role_id=="2"|| Auth::user()->role_id=="5")
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-layout-text-window-reverse"></i><span>Autres opération caisse</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="tables-nav" class="nav-content collapse bg-white" data-bs-parent="#sidebar-nav">
     
      <li>
        <a href="{{ route('operation') }}">
          <i class="bi bi-circle"></i><span> Paiement des charges du bureau</span>
        </a>
      </li>
      <li>
        <a href="{{ route('d_retrait') }}">
          <i class="bi bi-circle"></i><span> Paiement des dividendes </span>
        </a>
      </li>
    </ul>
</li><!-- End Tables Nav -->
@endif
@endif
@if(Auth::user()->role_id=="0" || Auth::user()->role_id=="1" || Auth::user()->role_id=="2")
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
          <i class="bi bi-circle"></i><span>Liste investisseurs </span>
        </a>
      </li>
      <li>
        <a href="{{ route('investisseur.code') }}">
          <i class="bi bi-circle"></i><span>Activater & desactiver compte </span>
        </a>
      </li>
      <li>
        <a href="{{ route('i_versement') }}">
          <i class="bi bi-circle"></i><span> Dépôt sur compte </span>
        </a>
      </li>
      <li>
        <a href="{{ route('i_retrait') }}">
          <i class="bi bi-circle"></i><span> Retrait sur compte</span>
        </a>
      </li>
      <li>
        <a href="{{ route('d_retrait') }}">
          <i class="bi bi-circle"></i><span> Paiement des dividendes</span>
        </a>
      </li>
     <li>
        <a href="{{ route('investisseur.consultation') }}">
          <i class="bi bi-circle"></i><span> Consulter compte </span>
        </a>
      </li>
    </ul>
</li><!-- End Forms Nav -->
@endif
@if(Auth::user()->role_id=="0" || Auth::user()->role_id=="1" ||  Auth::user()->role_id=="2"||  Auth::user()->role_id=="4")
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#activite-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-layout-text-window-reverse"></i><span>Activités d'investissement</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="activite-nav" class="nav-content collapse bg-white" data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{route('activite_investissement.create')}}">
          <i class="bi bi-circle"></i><span>Ouverture Activité</span>
        </a>
      </li>
      <li>
        <a href="{{ route('activite_investissement') }}">
          <i class="bi bi-circle"></i><span>Activités en cours</span>
        </a>
      </li>
      <li>
        <a href="{{ route('activite_investissement.valider') }}">
          <i class="bi bi-circle"></i><span>Cloture activité</span>
        </a>
      </li>
      <li>
        <a href="{{ route('activite_investissement.terminer') }}">
          <i class="bi bi-circle"></i><span>Activités Cloturée</span>
        </a>
      </li>
    </ul>
</li><!-- End Tables Nav -->
@endif
@if(Auth::user()->role_id=="0" ||Auth::user()->role_id=="1" || Auth::user()->role_id=="2"|| Auth::user()->role_id=="3"|| Auth::user()->role_id=="6")
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#vehicule-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-layout-text-window-reverse"></i><span>Activités vehicule</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="vehicule-nav" class="nav-content collapse bg-white" data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{route('activite_vehicule')}}">
          <i class="bi bi-circle"></i><span>Ouverture activité</span>
        </a>
      </li>
      <li>
        <a href="{{ route('achat_vehicule') }}">
          <i class="bi bi-circle"></i><span>Achat de véhicule</span>
        </a>
      </li>
      <li>
        <a href="{{ route('vente_vehicule') }}">
          <i class="bi bi-circle"></i><span>vente de véhicule</span>
        </a>
      </li>
      <li>
        <a href="{{ route('activite_vehicule.fermer') }}">
          <i class="bi bi-circle"></i><span>Fermeture activité</span>
        </a>
      </li>
    </ul>
</li><!-- End Tables Nav -->
@endif
@if(Auth::user()->role_id=="0" || Auth::user()->role_id=="1"|| Auth::user()->role_id=="2"|| Auth::user()->role_id=="4" || Auth::user()->role_id=="7")
<li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#stock-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Gestion stock</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="stock-nav" class="nav-content collapse bg-white " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('livrer') }}">
              <i class="bi bi-circle"></i><span>Approvissionnement stock</span>
            </a>
          </li>
          <li>
            <a href="{{ route('entrepot') }}">
              <i class="bi bi-circle"></i><span>Entrepôt de stock</span>
            </a>
          </li>
          <!-- <li>
            <a href="charts-echarts.html">
              <i class="bi bi-circle"></i><span>Mouvement stock</span>
            </a>
          </li> -->
          <li>
            <a href="{{ route('inventaire_stock') }}">
              <i class="bi bi-circle"></i><span>Inventaire stock</span>
            </a>
          </li>
          <!-- <li>
            <a href="charts-echarts.html">
              <i class="bi bi-circle"></i><span>Transition stock</span>
            </a>
          </li> -->
        </ul>
    </li>

    <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#doc-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-journal-text"></i><span>Documents</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="doc-nav" class="nav-content collapse bg-white " data-bs-parent="#sidebar-nav">
    <li>
        <a href="{{ route('commande') }}">
          <i class="bi bi-circle"></i><span>Commandes</span>
        </a>
      </li>
      <li>
        <a href="{{ route('devis') }}">
          <i class="bi bi-circle"></i><span>Devis</span>
        </a>
      </li>
      <li>
        <a href="{{ route('facture') }}">
          <i class="bi bi-circle"></i><span>Factures</span>
        </a>
      </li>
      <!-- <li>
        <a href="">
          <i class="bi bi-circle"></i><span>Bon de livraisson</span>
        </a>
      </li> -->
    </ul>
  </li><!-- End Charts Nav -->
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-journal-text"></i><span>Reglement & Recouvrement</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="charts-nav" class="nav-content collapse bg-white " data-bs-parent="#sidebar-nav">
    <li>
        <a href="{{route('reglement.comptoir')}}">
          <i class="bi bi-circle"></i><span>Reglement client comptoir</span>
        </a>
      </li>
      <li>
      <a href="{{route('reglement.facture')}}">
          <i class="bi bi-circle"></i><span>Reglement facture</span>
        </a>
      </li>
      <li>
        <a href="">
          <i class="bi bi-circle"></i><span>Recouvrement</span>
        </a>
      </li>
    </ul>
  </li><!-- End Charts Nav -->
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#pro-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-journal-text"></i><span>Articles / Produits</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="pro-nav" class="nav-content collapse bg-white " data-bs-parent="#sidebar-nav">
    <li>
        <a href="{{ route('categorie_produit') }}">
          <i class="bi bi-circle"></i><span>Categorie produits</span>
        </a>
      </li>
      <li>
        <a href="{{ route('produit') }}">
          <i class="bi bi-circle"></i><span>Produits</span>
        </a>
      </li>
      
    </ul>
  </li><!-- End Charts Nav -->
@endif


  <li class="nav-heading">Tiers</li>
  @if(Auth::user()->role_id=="0" || Auth::user()->role_id=="1"|| Auth::user()->role_id=="2"|| Auth::user()->role_id=="4"|| Auth::user()->role_id=="7") 
  <!-- <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('categorie_produit') }}">
      <i class="bx bxs-category-alt"></i>
      <span>Categories produit</span>
    </a>
  </li> -->
  <!-- End Profile Page Nav -->

  <!-- <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('produit') }}">
      <i class="ri ri-equalizer-fill"></i>
      <span>Produits</span>
    </a>
  </li> -->
  <!-- End client Page Nav -->
  @endif
  <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('client') }}">
      <i class="bi bi-people"></i>
      <span>Client</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('fournisseur') }}">
      <i class="bi bi-people"></i>
      <span>Fournisseur</span>
    </a>
  </li>
  <!-- End client Page Nav -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('profile') }}">
      <i class="bi bi-person-square"></i>
      <span>Profile</span>
    </a>
  </li><!-- End Contact Page Nav -->

@endif

<li class="nav-heading"><br></li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('logout') }}">
      <i class="bi bi-file-earmark"></i>
      <span>Déconnexion</span>
    </a>
</li><!-- End Blank Page Nav -->
