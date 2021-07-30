@extends('layouts.app')


@section('title-block')Login @endsection

@section('content-header')
    <div class="container-fluid text-center"><i class="bi-key" style="font-size: 2rem; color: goldenrod; alignment: center"></i>
    <p>Sign in</p>
    </div>

@endsection
@section('content-text')
    {{----}}
    <x-login-form pStatus=0 />

@endsection
