@extends('layouts.app')

@section('content')


@if(isset(Auth::user()->gestion->gestion) AND Auth::user()->gestion->gestion=='Magasin')

        @if(Auth::user()->societe_id=="0")

        @if(isset($societe->admin_id) AND $societe->admin_id==Auth::user()->id)
            @include('gestion.activer_environnement')
            @else
                @include('gestion.societe')
            @endif
        @else
            @include('dashbord.gestion.magasin')
        @endif

@endif

@if(isset(Auth::user()->gestion->gestion) AND Auth::user()->gestion->gestion=="Echange d'argent")

        @if(Auth::user()->societe_id=="0")

        @if(isset($societe->admin_id) AND $societe->admin_id==Auth::user()->id)
            @include('gestion.activer_environnement')
            @else
                @include('gestion.societe')
            @endif
        @else
            @include('dashbord.gestion.change')
        @endif

@endif

@if(isset(Auth::user()->gestion->gestion) AND Auth::user()->gestion->gestion=='Investissement')

        @if(Auth::user()->societe_id=="0")
            @if(isset($societe->admin_id) AND $societe->admin_id==Auth::user()->id)
                @include('gestion.activer_environnement')
            @else
                @include('gestion.societe')
            @endif
        @else
            @include('dashbord.gestion.investissement')
        @endif
@endif

@if(isset(Auth::user()->gestion->gestion) AND Auth::user()->gestion->gestion=='Hotel')

        @if(Auth::user()->societe_id=="0")
            @if(isset($societe->admin_id) AND $societe->admin_id==Auth::user()->id)
                @include('gestion.activer_environnement')
            @else
                @include('gestion.societe')
            @endif
        @else
            @include('dashbord.gestion.hotel')
        @endif

@endif

@if(isset(Auth::user()->gestion->gestion) AND Auth::user()->gestion->gestion=='Parc Auto')

        @if(Auth::user()->societe_id=="0")
            @if(isset($societe->admin_id) AND $societe->admin_id==Auth::user()->id)
                @include('gestion.activer_environnement')
            @else
                @include('gestion.societe')
            @endif
        @else
            @include('dashbord.gestion.parc_auto')
        @endif

@endif

@if(isset(Auth::user()->gestion->gestion) AND Auth::user()->gestion->gestion=='Stock')

        @if(Auth::user()->societe_id=="0")

        @if(isset($societe->admin_id) AND $societe->admin_id==Auth::user()->id)
            @include('gestion.activer_environnement')
            @else
                @include('gestion.societe')
            @endif
        @else
            @include('dashbord.gestion.stock')
        @endif

@endif

@if(isset(Auth::user()->gestion->gestion) AND Auth::user()->gestion->gestion=='Scolaire')

        @if(Auth::user()->societe_id=="0")

        @if(isset($societe->admin_id) AND $societe->admin_id==Auth::user()->id)
            @include('gestion.activer_environnement')
            @else
                @include('gestion.societe')
            @endif
        @else
            @include('dashbord.gestion.scolaire')
        @endif

@endif

@if(isset(Auth::user()->gestion->gestion) AND Auth::user()->gestion->gestion=='Cabinet Medical')

        @if(Auth::user()->societe_id=="0")

        @if(isset($societe->admin_id) AND $societe->admin_id==Auth::user()->id)
            @include('gestion.activer_environnement')
            @else
                @include('gestion.societe')
            @endif
        @else
            @include('dashbord.gestion.cabinet_medical')
        @endif

@endif

@if(isset(Auth::user()->gestion->gestion) AND Auth::user()->gestion->gestion=='Gestion Detenu')

        @if(Auth::user()->societe_id=="0")

        @if(isset($societe->admin_id) AND $societe->admin_id==Auth::user()->id)
            @include('gestion.activer_environnement')
            @else
                @include('gestion.societe')
            @endif
        @else
            @include('dashbord.gestion.detenu')
        @endif

@endif

@if(isset(Auth::user()->gestion->gestion) AND Auth::user()->gestion->gestion=='Cabinet Assurance')

        @if(Auth::user()->societe_id=="0")

        @if(isset($societe->admin_id) AND $societe->admin_id==Auth::user()->id)
            @include('gestion.activer_environnement')
            @else
                @include('gestion.societe')
            @endif
        @else
            @include('dashbord.gestion.detenu')
        @endif

@endif

@endsection
