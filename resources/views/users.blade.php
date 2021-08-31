@extends('layouts.app')
@section('title-block')Users @endsection
@section('content-aside')

@endsection
@section('content-header')
    <h4>Users list</h4>
    <div class="container ms-4">
        <div class="col-12 text-start">
            <a href="#">Users</a><b> / </b>
        </div>
    </div>
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
                    <td><span class="bi bi-person-circle">{{ $user->login }}</span></td>
                    @if(Illuminate\Support\Facades\Auth::user()->uparametr->admin > 0)
                        <td>{{ $user->email }}</td>
                    @else
                        <td>hidden</td>
                    @endif
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
