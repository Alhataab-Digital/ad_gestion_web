

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar bg-primary">
    <ul class="sidebar-nav" id="sidebar-nav">

        @if(Auth::user()->gestion->gestion=='Change')

        @include('layouts.menu.menu_change')

        @endif

        @if(Auth::user()->gestion->gestion=='Hotel')

        @include('layouts.menu.menu_hotel')

        @endif

        @if(Auth::user()->gestion->gestion=='Stock')

            @include('layouts.menu.menu_stock')

        @endif

        @if(Auth::user()->gestion->gestion=='Parc Auto')

            @include('layouts.menu.menu_parc_auto')

        @endif

        @if(Auth::user()->gestion->gestion=='Investissement')

            @include('layouts.menu.menu_investissement')

        @endif

        @if(Auth::user()->gestion->gestion=='Scolaire')

            @include('layouts.menu.menu_scolaire')

        @endif


    </ul>
  </aside><!-- End Sidebar-->
