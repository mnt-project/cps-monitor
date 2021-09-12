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
            <button id="showDrop" type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                {{ $lines[$show] }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="showDrop">
                @for($i = 0; $i < sizeof($lines); $i++)
                    <li><a class="dropdown-item {{($i == $show) ? 'active' : ''}}" href="{{route('admin.connections',['sort'=>$sort,'method'=>$method,'show'=>$i,'connect'=>$connect])}}">{{ $lines[$i] }}</a></li>
                @endfor
            </ul>
        </div>
        <div class="col-8">

        </div>
        <div class="col-2">
            <div class="btn-group" role="group">
                <button id="sortDrop" type="button" class="btn btn-outline-dark dropdown-toggle me-1" data-toggle="dropdown" aria-expanded="false">
                    {{ $sortname[$sort] }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="sortDrop">

                    @for($i = 0; $i < sizeof($sortname); $i++)
                        <li><a class="dropdown-item {{($i == $sort) ? 'active' : ''}}" href="{{route('admin.connections',['sort'=>$i,'method'=>$method,'show'=>$show,'connect'=>$connect])}}">{{ $sortname[$i] }}</a></li>
                    @endfor
                </ul>
                <button id="methodDrop" type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    {{ $method }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="methodDrop">

                    @foreach(['asc','desc'] as $i)
                        <li><a class="dropdown-item {{($i == $method) ? 'active' : ''}}" href="{{route('admin.connections',['sort'=>$sort,'method'=>$i,'show'=>$show,'connect'=>$connect])}}">{{ $i }}</a></li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
    <div class="row">
        <table class="table table-dark table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">IP:Adress</th>
                <th scope="col">Connects [all:{{App\cps\admin\Connect::getConnectionsCount()}}] [{{App\cps\admin\Connect::getAllConnectionsCount()}}]</th>
                <th scope="col">Date</th>
                <th scope="col">Add</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ips as $ip)
                <tr class='clickable-row-table' data-href='{{ route('admin.connections',['sort'=>$sort,'method'=>$method,'show'=>$show,'connect'=>$ip->id]) }}'>
                    <th scope="row">{{ $ip->id }}</th>
                    <td>{{ $ip->visitor }}</td>
                    <td>{{ $ip->visits}}</td>
                    <td>{{ date('Y-m-d / H:i:s', strtotime($ip->created_at)) }}</td>
                    <td>
                        <span class="bi @if(is_null($ip->address)) bi-plus-square @else bi-check-square @endisset"></span>
                    </td>
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
    <div class="container-fluid">
        <div class="list-unstyled text-center mb-4"><h4>Info</h4></div>
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title border-bottom">ID:{{ $ipinfo->id }} [{{ $ipinfo->visitor }}]</h5>
                <div class="card-text">
                    <label for="created" class="sr-only">Created:</label>
                    <p id="created">{{ date('Y-m-d / H:i:s', strtotime($ipinfo->created_at)) }}</p>
                    <label for="updated" class="sr-only">Updated:</label>
                    <p id="updated">{{ date('Y-m-d / H:i:s', strtotime($ipinfo->updated_at)) }}</p>
                </div>
                <div class="card-footer">
                    @empty($ipinfo->address)
                        <button data-target="#addAddress" role="button" class="btn btn-outline-dark" data-toggle="modal">Add</button>
                        @include('admin.inc.modal-addaddress')
                    @else
                        <h3>{{ $ipinfo->address->titel }}</h3>
                        <p>{{ $ipinfo->address->note }}</p>
                    @endempty
                </div>

            </div>
        </div>
    </div>
@endsection
