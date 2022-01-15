@extends('layouts.admin')
@section('title-block'){{ $user->login }}@endsection
@section('dashboard-aside')
    @include('admin.inc.aside',['itemid' => 2])

@endsection
@section('dashboard-header')


    <h4>{{ $user->login }}</h4>
    <div class="container ms-4">
        <div class="col-12 text-start">
            <a href={{ route('user.users') }}>Users</a><b> / </b>
            <a href="#">{{ $user->login }}</a>
        </div>
    </div>
@endsection
@section('dashboard-text')

    @include('admin.user.info')

@endsection
@section('dashboard-info')
    @include('admin.user.title',['user'=>$user])
    <div class="container">
        @if($groups->count()>0)
            <div class="list-unstyled text-center mb-4"><h4>Follows</h4></div>
            <div class="list-group">
                @foreach($groups as $group)
                    <a class="list-group-item" href={{ route('group.info',$group->id) }}><span class="bi bi-people"> {{$group->name}}</span></a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
