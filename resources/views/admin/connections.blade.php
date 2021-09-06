@extends('layouts.admin')
@section('title-block')Admin panel @endsection
@section('dashboard-aside')
    @include('admin.inc.aside',['itemid' => 1])
@endsection
@section('dashboard-header')

    <h3>Connections</h3>
@endsection
@section('dashboard-text')
    <div class="row mb-3">
        <div class="col-2">
            <button id="btnGroupDrop1" type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                {{ $lines[$show] }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                @for($i = 0; $i < sizeof($lines); $i++)
                    <li><a class="dropdown-item {{($i == $show) ? 'active' : ''}}" href="{{route('admin.connections',['show'=>$i,'sort'=>$sort])}}">{{ $lines[$i] }}</a></li>
                @endfor
            </ul>
        </div>
        <div class="col-8">

        </div>
        <div class="col-2">
            <button id="btnGroupDrop1" type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                {{ $sortname[$sort] }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                @for($i = 0; $i < sizeof($sortname); $i++)
                    <li><a class="dropdown-item {{($i == $sort) ? 'active' : ''}}" href="{{route('admin.connections',['show'=>$show,'sort'=>$i])}}">{{ $sortname[$i] }}</a></li>
                @endfor
            </ul>
        </div>
    </div>
    <div class="row">
        <table class="table table-dark table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">IP:Adress</th>
                <th scope="col">Connects [all:{{$counts}}]</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ips as $ip)
                <tr>
                    <th scope="row">{{ $ip->id }}</th>
                    <td>{{ $ip->visitor }}</td>
                    <td>{{ $ip->counts}}</td>
                    <td>{{ \Carbon\Carbon::parse($ip->created_at)->format('d.m.Y H:i')}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $ips->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection
@section('dashboard-info')

@endsection
