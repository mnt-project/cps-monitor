@extends('layouts.app')
@section('title-block')Users @endsection
@section('content-aside')

@endsection
@section('content-header')
    <h4>Users list</h4>
    <x-breadcrumb :links="$links"/>
@endsection
@section('content-text')
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Login</th>
                <th scope="col">Mail</th>
                <th scope="col">Connects</th>
                <th scope="col">Created</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class='clickable-row-table' data-href='{{ route('user.info',$user->id) }}'>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>
                        @if(optional($user->settings)->banned)
                            <span class="bi bi-person-circle" style="color: red;">{{ $user->login }}</span>
                        @else
                            <span class="bi bi-person-circle" style="color: black;">{{ $user->login }}</span>
                        @endif
                    </td>
                    <td>{{ optional($user->settings)->hidden ? 'hidden' : $user->email }}</td>
                    <td>{{ $user->connects }}</td>
                    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d.m.Y H:i') }}</td>
                </tr>

            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $users->links('vendor.pagination.bootstrap-4') }}
    </div>

@endsection
@section('content-info')

@endsection
