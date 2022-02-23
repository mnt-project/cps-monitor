@extends('layouts.app')
@section('title-block'){{ $user->login }}@endsection
@section('content-aside')
    @include('inc.user.title',['user'=>$user])
@endsection
@section('content-header')


    <h4>{{ $user->login }}</h4>
    <x-breadcrumb :links="$links"/>
@endsection
@section('content-text')

    @include('inc.album.album-menu',['addflag'=>true,'show'=>'user'])
    @include('inc.user.info')

@endsection
@section('content-info')
    @if($follows->count()>0)
        <div class="list-unstyled text-center mb-4"><h4>Follows</h4></div>
        <div class="list-group">
            @foreach($follows as $follow)
                    <a class="list-group-item" href="{{ route('group.info',$follow->group->id) }}"><span class="bi bi-people">{{$follow->group->name}}</span></a>
            @endforeach
        </div>
    @endif
@endsection
