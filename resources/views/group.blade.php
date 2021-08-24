@extends('layouts.app')
@section('title-block'){{ $group->name }}@endsection
@section('content-aside')
    @include('inc.group.titel')

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

    @auth
        @include('inc.group.post-form',['text' => $text,'group'=>$group->id])
    @endauth
    @include('inc.group.post')

@endsection
@section('content-info')
    @include('inc.group.info')
@endsection
