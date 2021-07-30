@extends('layouts.app')

@php $auth_user = Auth::user() @endphp
@section('title-block')User profile {{$tabid}} @endsection

@section('content-aside')
    @include('inc.user.title',['user'=>$user])
@endsection

@section('content-header')
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link {{ empty($tabid) || $tabid == 1 ? 'active' : '' }}" id="nav-general-tab" data-toggle="tab" data-target="#nav-general" type="button" role="tab" aria-controls="nav-general" aria-selected="{{ empty($tabid) || $tabid == 1 ? 'true' : 'false' }}">General</button>
            <button class="nav-link {{ $tabid == 2 ? 'active' : '' }}" id="nav-messages-tab" data-toggle="tab" data-target="#nav-messages" type="button" role="tab" aria-controls="nav-messages" aria-selected="{{ $tabid == 2 ? 'true' : 'false' }}">Messages</button>
            <button class="nav-link {{ $tabid == 3 ? 'active' : '' }}" id="nav-wall-tab" data-toggle="tab" data-target="#nav-wall" type="button" role="tab" aria-controls="nav-wall" aria-selected="{{ $tabid == 3 ? 'true' : 'false' }}">Wall</button>
            <button class="nav-link {{ $tabid == 4 ? 'active' : '' }}" id="nav-config-tab" data-toggle="tab" data-target="#nav-config" type="button" role="tab" aria-controls="nav-config" aria-selected="{{ $tabid == 4 ? 'true' : 'false' }}">Config</button>
        </div>
    </nav>
    <div class="tab-content mt-5" id="nav-tabContent">
        <div class="tab-pane {{ empty($tabid) || $tabid == 1 ? 'active' : '' }}" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab">
            {{--Tab #1--}}
            @include('inc.user.info')
        </div>
        <div class="tab-pane {{ $tabid == 2 ? 'active' : '' }}" id="nav-messages" role="tabpanel" aria-labelledby="nav-messages-tab">
            {{--Tab #2--}}
            <p>Messages module</p>
        </div>
        <div class="tab-pane {{ $tabid == 3 ? 'active' : '' }}" id="nav-wall" role="tabpanel" aria-labelledby="nav-wall-tab">
            {{--Tab #3--}}
        </div>
        <div class="tab-pane {{ $tabid == 4 ? 'active' : '' }}" id="nav-config" role="tabpanel" aria-labelledby="nav-config-tab">
            {{--Tab #4--}}
            @include('inc.user.config')
        </div>
    </div>
@endsection

@section('content-info')

@endsection
