@extends('layouts.app')

@section('content')

@if(isset(Auth::user()->gestion->gestion) AND Auth::user()->gestion->gestion=='Gestion Change')

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

@if(isset(Auth::user()->gestion->gestion) AND Auth::user()->gestion->gestion=='Gestion Investissement')

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

@if(isset(Auth::user()->gestion->gestion) AND Auth::user()->gestion->gestion=='Gestion Hotel')

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

@if(isset(Auth::user()->gestion->gestion) AND Auth::user()->gestion->gestion=='Gestion Parc Auto')

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

@if(isset(Auth::user()->gestion->gestion) AND Auth::user()->gestion->gestion=='Gestion Stock')

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

@if(isset(Auth::user()->gestion->gestion) AND Auth::user()->gestion->gestion=='Gestion Scolaire')

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

@endsection
