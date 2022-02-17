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
                    <li><a class="dropdown-item {{($i == $show) ? 'active' : ''}}" href="{{route('admin.connections',['show'=>$i,'sort'=>$sort,'method'=>$method])}}">{{ $lines[$i] }}</a></li>
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
                        <li><a class="dropdown-item {{($i == $sort) ? 'active' : ''}}" href="{{route('admin.connections',['show'=>$show,'sort'=>$i,'method'=>$method])}}">{{ $sortname[$i] }}</a></li>
                    @endfor
                </ul>
                <button id="methodDrop" type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    {{ $method }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="methodDrop">

                    @foreach(['asc','desc'] as $i)
                        <li><a class="dropdown-item {{($i == $method) ? 'active' : ''}}" href="{{route('admin.connections',['show'=>$show,'sort'=>$sort,'method'=>$i])}}">{{ $i }}</a></li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
    <div class="row">
        <table class="table table-striped table-hover text-center">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">IP:Adress</th>
                <th scope="col">Name</th>
                <th scope="col">User</th>
                <th scope="col">Rights</th>
                <th scope="col">Ban</th>
                <th scope="col">Description</th>
                <th scope="col">Connects</th>
                <th scope="col">Created</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ips as $ip)
                <tr class='clickable-row-table' data-href='#'>
                    <th scope="row">{{ $ip->id }}</th>
                    <td>{{ $ip->ip }}</td>
                    <td>{{ $ip->name }}</td>
                    <td>{{ $ip->user ? $ip->user->login : 'Guest'}}</td>
                    <td>{{ $ip->rights }}</td>
                    <td>{{ $ip->ban ?  date('Y-m-d / H:i:s', strtotime($ip->bandate)) : '-' }}</td>
                    <td>{{ $ip->description }}</td>
                    <td>
                        <span class="badge bg-secondary">{{ $ip->connect->count() }}</span>
                    </td>
                    <td>{{ date('Y-m-d / H:i:s', strtotime($ip->created_at)) }}</td>
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
{{--    <div class="container-fluid">--}}
{{--        <div class="list-unstyled text-center mb-4"><h4>Info</h4></div>--}}
{{--        <div class="card text-center">--}}
{{--            <div class="card-body">--}}
{{--                <h5 class="card-title border-bottom">ID:{{ $ipinfo->id }} [{{ $ipinfo->visitor }}]</h5>--}}
{{--                <div class="card-text">--}}
{{--                    <label for="created" class="sr-only">Created:</label>--}}
{{--                    <p id="created">{{ date('Y-m-d / H:i:s', strtotime($ipinfo->created_at)) }}</p>--}}
{{--                    <label for="updated" class="sr-only">Updated:</label>--}}
{{--                    <p id="updated">{{ date('Y-m-d / H:i:s', strtotime($ipinfo->updated_at)) }}</p>--}}
{{--                </div>--}}
{{--                <div class="card-footer">--}}
{{--                    @empty($ipinfo->address)--}}
{{--                        <button data-target="#addAddress" role="button" class="btn btn-outline-dark" data-toggle="modal">Add</button>--}}
{{--                        @include('admin.inc.modal-addaddress')--}}
{{--                    @else--}}
{{--                        <h3>{{ $ipinfo->address->titel }}</h3>--}}
{{--                        <p>{{ $ipinfo->address->note }}</p>--}}
{{--                    @endempty--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
