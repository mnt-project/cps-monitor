@extends('layouts.app')
@php $auth_user = Auth::user() @endphp
@section('title-block'){{ $user->name }}@endsection
@section('content-aside')
    @include('inc.user.title',['user'=>$user])
@endsection
@section('content-header')


    <h4>{{ $user->login }}</h4>
    <div class="container ms-4">
        <div class="col-12 text-start">
            <a href={{ route('user.users') }}>Users</a><b> / </b>
            <a href="#">{{ $user->login }}</a>
        </div>
    </div>
@endsection
@section('content-text')

    <p>Логин: {{ $user->login }}</p>
    <p>Email: {{ $user->email }}</p>
    <p>Возраст: {{ $user->age }}</p>
    <p>Подключений: {{ $user->connects }}</p>
    <p>Дата создания: {{ $user->created_at}}</p>
    <p>Дата обновления: {{ $user->updated_at}}</p>
    <p>Заметка: {{ $user->uparametr->notes}}</p>

@endsection
@section('content-info')
    @if($groups->count()>0)
        <div class="list-unstyled text-center mb-4"><h4>Follows</h4></div>
        <div class="list-group">
            @foreach($groups as $group)
                    <a class="list-group-item" href={{ route('group.info',$group->id) }}><span class="bi bi-people"> {{$group->name}}</span></a>
            @endforeach
        </div>
    @endif
@endsection
