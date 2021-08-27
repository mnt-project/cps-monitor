@extends('layouts.admin')
@section('title-block')Admin panel @endsection
@section('dashboard-aside')
    @include('admin.inc.aside',['itemid' => 1])
@endsection
@section('dashboard-header')

    <h3>Connections</h3>

@endsection
@section('dashboard-text')
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
                    <td>{{ $ip->getCountConnections($ip->visitor) }}</td>
                    <td>{{ $ip->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
@section('dashboard-info')

@endsection
