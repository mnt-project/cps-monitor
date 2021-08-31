@extends('layouts.admin')
@section('title-block')Admin panel @endsection
@section('dashboard-aside')
    @include('admin.inc.aside',['itemid' => 2])
@endsection
@section('dashboard-header')

    <h3>Community</h3>

@endsection
@section('dashboard-text')
    <div class="row">
        @foreach($users as $user)
        <div class="container col-lg-2 col-3 mx-2 my-2">
            <div class="row mt-3 mx-1 my-1">
                <a href="{{route('user.info',$user)}}">
                    <img class="rounded-circle" width="150" height="150" src="{{$user->avatar ? Illuminate\Support\Facades\Storage::url($user->avatar->patch) : Illuminate\Support\Facades\Storage::url('no-avatar.png')}}"
                         alt="{{ $user->avatar ? Illuminate\Support\Facades\Storage::url($user->avatar->hash_name) : Illuminate\Support\Facades\Storage::url('no-avatar.png') }}">
                </a>
                {{--<div class="card-img-overlay"><p class="card-title text-center my-1">{{$el->name}}</p></div>--}}
            </div>
            <div class="row text-center mb-2">
                <strong>{{$user->login}}</strong>
                <small>{{$user->email}}</small>
                <small>Connects: {{ $user->connects }}</small>
                <div class="text-center mt-4">
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
@section('dashboard-info')
    <h3>IP adress</h3>
@endsection
