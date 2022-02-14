@extends('layouts.app')
@section('title-block'){{ $album->name }}@endsection
@section('content-aside')
    @include('inc.album.titel')

@endsection
@section('content-header')

    <h4>{{ $album->name }}</h4>
    <nav style="--bs-breadcrumb-divider: '<';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('group.list')}}">Groups</a></li>
            <li class="breadcrumb-item"><a href="{{route('group.info', $group->id)}}">{{ $group->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $album->name }}</li>
        </ol>
    </nav>
    @include('inc.group.album',['addflag'=>false])
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
