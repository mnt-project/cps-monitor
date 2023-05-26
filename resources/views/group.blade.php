@extends('layouts.app')
@section('title-block'){{ $group->name }}@endsection
@section('content-aside')
    @include('inc.group.titel')

@endsection
@section('content-header')

    <h4>{{ $group->name }}</h4>
    <x-breadcrumb :links="$links"/>
    @include('inc.album.album-menu',['addflag'=>true,'show'=>'group'])
@endsection
@section('content-text')

    @auth
       @include('inc.group.post-form',['text' => session()->has('quote') ? session('quote') : '' ,'group'=>$group->id])

    @endauth
    @include('inc.group.post')
{{--    <div class="d-flex justify-content-center">--}}
{{--        {{ $posts->links('vendor.pagination.bootstrap-4') }}--}}
{{--    </div>--}}
@endsection
@section('content-info')
    @include('inc.group.info')
@endsection
