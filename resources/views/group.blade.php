@extends('layouts.app')
@php $auth_user = Auth::user() @endphp
@section('title-block'){{ $group->name }}@endsection
@section('content-aside')
    <div class="container-fluid mt-5">
        @if($group->avatar)
            <img class="img-thumbnail" src={{ Storage::url($group->patch) }} class="img-thumbnail" alt={{ Storage::url($group->hash_name) }}>
        @else
            <img class="img-thumbnail" src={{ Storage::url('group-no-avatar.png') }} class="card-img-top" alt={{ Storage::url('group-no-avatar.png') }}>
        @endif
        <div class="text-center"><p><h3>{{ $group->name }}</h3>
            @if($group->block)
                <span class="badge bg-warning">Blocked</span>
            @endif
            @if($group->public)
                <span class="badge bg-success">Public</span>
            @endif
            @if($group->open)
                <span class="badge bg-info">Open</span>
            @else
                <span class="badge bg-warning">Close</span>
            @endif
            @if($group->invite)
                <span class="badge bg-primary">invite</span>
            @endif
            {{--            <span class="badge bg-info">{{$group->user->login}}</span>--}}
        </div>
        <div class="row">
            <h5>{{$group->name}}</h5>
            <p>{{$group->notes}}</p>
            <p class="mt-2">{{$group->about}}</p>
            <p class="mt-2">{{ \Carbon\Carbon::parse($group->created_at)->format('d.m.Y H:i')}}</p>
            <p class="mt-2">Creator: <a href={{ route('user.info',$group->user->id) }}><span class="bi bi-person-circle">{{$group->user->login}}</span></a></p>
            <p class="mt-2">Followers: {{$group->groupFollowCount()}}</p>
            @if($auth_user)
                <div class="mt-5 row">
                    @if($group->user_id === $auth_user->id)
                        <button data-target="#addGroup" role="button" class="btn btn-primary mt-2" data-toggle="modal">Edit group</button>
                        @include('inc.group-form',['action'=>1,'name'=>'Edit','route'=>'group.edit'])
                    @endif
                </div>
                @if($group->open and $group->user_id != $auth_user->id)
                    <div class="row">
                        @if($followers->count())
                            @foreach($followers as $follower)
                                @if($follower->user_id === $auth_user->id)
                                    <a href={{ route('group.unfollowing',$group->id) }} class="btn btn-primary mt-2">Unfollow</a>
                                    @break
                                @endif
                                @if($loop->last)
                                    <a href={{ route('group.following',$group->id) }} class="btn btn-primary mt-2">Follow</a>
                                @endif
                            @endforeach
                        @else
                            <a href={{ route('group.following',$group->id) }} class="btn btn-primary mt-2">Follow</a>
                        @endif
                    </div>
                @endif
            @endif
            <div class="row">
                <a href={{ route('group.list') }} class="btn btn-primary mt-2">Exit</a>
            </div>

        </div>
    </div>

@endsection
@section('content-header')


    <h4>{{ $group->name }}</h4>
    <div class="container ms-4">
        <div class="col-12 text-start">
            <a href="{{route('group.list')}}">Groups</a><b> / </b>
            <a href="{{route('group.info', $group->id)}}">{{ $group->name }}</a>
        </div>
    </div>
@endsection
@section('content-text')

    @if($auth_user)@include('inc.post-form',['text' => $text,'group'=>$group->id]) @endif
    @include('inc.post')

@endsection
@section('content-info')
    <h3 class="text-center text-info">Members</h3>
    <ul class="list-group">
        @foreach($followers as $follower)
            <a class="list-group-item list-group-item-action" href={{ route('user.info',$follower->user->id) }}>
                <span class="bi bi-person-circle">{{ $follower->user->login }}</span>
                @if($follower->user->id === $group->user_id)
                    <span class="badge bg-danger">creator</span>
                @else
                    <span class="badge primary">subscriber</span>
                @endif
            </a>
        @endforeach
        {{--        @if($group->user_id != $user->id)--}}
        {{--            <li class="list-group-item">{{ $group->user->login }} <span class="badge bg-danger">creator</span></li>--}}
        {{--            <li class="list-group-item">{{$user->login}} <span class="badge bg-primary">visitor</span></li>--}}
        {{--        @else--}}
        {{--            <li class="list-group-item">{{ $group->user->login }} <span class="badge bg-danger">creator</span> <span class="badge bg-primary">visitor</span></li>--}}
        {{--        @endif--}}
    </ul>

@endsection
