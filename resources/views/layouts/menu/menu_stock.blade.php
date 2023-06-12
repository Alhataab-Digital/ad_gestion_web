
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
           <a href="{{ route('workspace.show',Auth::user()->societe_id) }}">
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


        </ul>
    </li>
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
          <li>
            <a href="charts-echarts.html">
              <i class="bi bi-circle"></i><span>Mouvement stock</span>
            </a>
          </li>
          <li>
            <a href="charts-echarts.html">
              <i class="bi bi-circle"></i><span>Inventaire stock</span>
            </a>
          </li>
          <li>
            <a href="charts-echarts.html">
              <i class="bi bi-circle"></i><span>Transition stock</span>
            </a>
          </li>
        </ul>
      </li><!-- End Charts Nav -->

    <!-- End Components Nav -->
    <li class="nav-item">
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
    </li><!-- End Forms Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
      <i class="ri ri-building-line"></i><span>Gestion banque</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="tables-nav" class="nav-content collapse bg-white " data-bs-parent="#sidebar-nav">
      <li>
        <a href="tables-general.html">
          <i class="bi bi-circle"></i><span>Compte bancaire</span>
        </a>
      </li>
      <li>
        <a href="tables-general.html">
          <i class="bi bi-circle"></i><span>Depot banque</span>
        </a>
      </li>
      <li>
        <a href="tables-general.html">
          <i class="bi bi-circle"></i><span>Retrait banque</span>
        </a>
      </li>
      <li>
        <a href="tables-data.html">
          <i class="bi bi-circle"></i><span>Rapprochement bancaire</span>
        </a>
      </li>
    </ul>
  </li><!-- End Tables Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-journal-text"></i><span>Documents</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="charts-nav" class="nav-content collapse bg-white " data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{ route('commande') }}">
          <i class="bi bi-circle"></i><span>Commande</span>
        </a>
      </li>
      <li>
        <a href="{{ route('devis') }}">
          <i class="bi bi-circle"></i><span>Devis</span>
        </a>
      </li>
      <li>
        <a href="{{ route('facture') }}">
          <i class="bi bi-circle"></i><span>Facture</span>
        </a>
      </li>
      <li>
        <a href="">
          <i class="bi bi-circle"></i><span>Bon de livraisson</span>
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
          <i class="bi bi-circle"></i><span>Recu de Vente</span>
        </a>
      </li>
      <li>
        <a href="icons-remix.html">
          <i class="bi bi-circle"></i><span>Facture de vente</span>
        </a>
      </li>
      <li>
        <a href="icons-boxicons.html">
          <i class="bi bi-circle"></i><span>Reçu annuler</span>
        </a>
      </li>
      <li>
        <a href="icons-boxicons.html">
          <i class="bi bi-circle"></i><span>Facture annuler</span>
        </a>
      </li>
    </ul>
  </li><!-- End Icons Nav -->

  <li class="nav-heading">Tiers</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('fournisseur') }}">
      <i class="bi bi-person"></i>
      <span>Fournisseurs</span>
    </a>
  </li><!-- End Profile Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('client') }}">
      <i class="bi bi-person"></i>
      <span>Clients</span>
    </a>
  </li><!-- End Profile Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('categorie_produit') }}">
      <i class="bx bxs-category-alt"></i>
      <span>Categories produit</span>
    </a>
  </li><!-- End Profile Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('produit') }}">
      <i class="ri ri-equalizer-fill"></i>
      <span>Produits</span>
    </a>
  </li><!-- End client Page Nav -->

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
