@extends('layouts.app')
@section('title-block'){{ $album->name }}@endsection
@section('content-aside')

    @include('inc.album.titel')

@endsection
@section('content-header')

    <h4>{{ $album->name }}</h4>
    <x-breadcrumb :links="$links"/>

    @include('inc.album.album-menu',['addflag'=>false,'show'=>$album->group ? 'group' : 'user'])
@endsection
@section('content-text')
    @if($albumunits->count()>0)
        <div class="container">
            <div class="row">
                @foreach($albumunits as $albumunit)
                    @include('inc.album.unit-thumbnail')
                @endforeach
            </div>
        </div>
    @else
        <a data-target="#unitadd" role="button" data-toggle="modal">
            <img class="img_wrap my-5" src="{{Illuminate\Support\Facades\Storage::url('add-picture.png')}}" alt="{{ Illuminate\Support\Facades\Storage::url('add-picture.png') }}">
        </a>
        @include('inc.album.modal-unitadd',['action'=>0,'name'=>'Create'])
    @endisset
@endsection
@section('content-info')

@endsection
