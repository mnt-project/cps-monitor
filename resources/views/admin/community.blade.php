@extends('layouts.admin')
@section('title-block')Admin panel @endsection
@section('dashboard-aside')
    @include('admin.inc.aside',['itemid' => 2])
@endsection
@section('dashboard-header')

    <h3>Community</h3>

@endsection
@section('dashboard-text')
    <h3>dashboard-text</h3>
@endsection
@section('dashboard-info')
    <h3>IP adress</h3>
@endsection
