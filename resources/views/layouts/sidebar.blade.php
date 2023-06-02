

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar bg-primary">
    <ul class="sidebar-nav" id="sidebar-nav">

        @if(Auth::user()->gestion->gestion=='Gestion Change')

        @include('layouts.menu.menu_change')

        @endif

        @if(Auth::user()->gestion->gestion=='Gestion Hotel')

        @include('layouts.menu.menu_hotel')

        @endif

        @if(Auth::user()->gestion->gestion=='Gestion Stock')

            @include('layouts.menu.menu_stock')

        @endif

        @if(Auth::user()->gestion->gestion=='Gestion Parc Auto')

            @include('layouts.menu.menu_parc_auto')

        @endif

        @if(Auth::user()->gestion->gestion=='Gestion Investissement')

            @include('layouts.menu.menu_investissement')

        @endif

        @if(Auth::user()->gestion->gestion=='Gestion Scolaire')

            @include('layouts.menu.menu_scolaire')

        @endif


    </ul>
  </aside><!-- End Sidebar-->
