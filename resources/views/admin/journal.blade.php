@extends('layouts.admin')
@section('title-block')Admin panel @endsection
@section('dashboard-aside')
    @include('admin.inc.aside',['itemid' => 4])
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
                    <li><a class="dropdown-item {{($i == $show) ? 'active' : ''}}" href="{{route('admin.journal',['sort'=>$sort,'method'=>$method,'show'=>$i])}}">{{ $lines[$i] }}</a></li>
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
                        <li><a class="dropdown-item {{($i == $sort) ? 'active' : ''}}" href="{{route('admin.journal',['sort'=>$i,'method'=>$method,'show'=>$show])}}">{{ $sortname[$i] }}</a></li>
                    @endfor
                </ul>
                <button id="methodDrop" type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    {{ $method }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="methodDrop">

                    @foreach(['asc','desc'] as $i)
                        <li><a class="dropdown-item {{($i == $method) ? 'active' : ''}}" href="{{route('admin.journal',['sort'=>$sort,'method'=>$i,'show'=>$show])}}">{{ $i }}</a></li>
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
                <th scope="col">Dir</th>
                <th scope="col">Agent</th>
                <th scope="col">Date</th>
                <th scope="col">Add</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ips as $ip)
                @if($ip->status)
                    <tr class='clickable-row-table' data-href="#">
                        <th scope="row">{{ $ip->id }}</th>
                        <td>{{ $ip->visitor }}</td>
                        <td>{{ $ip->dirname}}</td>
                        <td>{{$ip->agent}}</td>
                        <td>{{ date('Y-m-d / H:i:s', strtotime($ip->created_at)) }}</td>
                        <td>
                            <span class="bi @if(is_null($ip->address)) bi-plus-square @else bi-check-square @endisset"></span>
                        </td>
                    </tr>
                @endif
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
