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
                    <li><a class="dropdown-item {{($i == $show) ? 'active' : ''}}" href="{{route('admin.connections',$i)}}">{{ $lines[$i] }}</a></li>
                @endfor
            </ul>
        </div>
        <div class="col-10">

        </div>
    </div>
    <div class="row">
        <table class="table table-dark table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">IP:Adress</th>
                <th scope="col">Connects</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ips as $ip)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $ip->visitor }}</td>
                    <td>{{ $counts[$loop->index] }}</td>
                    <td>{{ $ip->created_at }}</td>
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
