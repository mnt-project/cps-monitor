@extends('layouts.app')
@section('title-block'){{ $album->name }}@endsection
@section('content-aside')
    @include('inc.album.titel')

@endsection
@section('content-header')

    <h4>{{ $album->name }}</h4>
    <div class="container ms-4">
        <div class="col-12 text-start">
            <a href="{{route('group.list')}}">Groups</a><b> / </b>
            <a href="{{route('group.info', $group->id)}}">{{ $group->name }}</a><b> / </b>
            <a href="{{route('group.album', $album)}}">{{ $album->name }}</a>
        </div>
    </div>
@endsection
@section('content-text')

    @auth
        @include('inc.group.album')
    @endauth
@endsection
@section('content-info')

@endsection
