@extends('layouts.admin')
@section('title-block')Admin panel @endsection
@section('dashboard-aside')
    @include('admin.inc.aside',['itemid' => 3])
@endsection
@section('dashboard-header')

    <h3>Connections</h3>
@endsection
@section('dashboard-text')
    <div class="row">
        @foreach ($groups as $group)
            @include('admin.group.group-thumbnail',$group)
        @endforeach
    </div>
@endsection
@section('dashboard-info')

@endsection
