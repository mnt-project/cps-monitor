@extends('layouts.admin')
@section('title-block')Admin panel @endsection
@section('dashboard-aside')
    @include('admin.inc.aside',['itemid' => 2])
@endsection
@section('dashboard-header')

    <h3>Community</h3>

@endsection
@section('dashboard-text')
    <div class="row">
        <div class="col-2">
            <button id="btnGroupDrop1" type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                {{$names[$sort]}}
            </button>
            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                @for($i = 0; $i < sizeof($names); $i++)
                    @if($i < sizeof($names)-1)
                        <li><a class="dropdown-item {{($i == $sort) ? 'active' : ''}}" href="{{route('admin.community',['sort'=>$i,'view'=>$view])}}">{{ $names[$i] }}</a></li>
                    @else
                        @auth
                            <li><a class="dropdown-item {{($i == $sort) ? 'active' : ''}}" href="{{route('admin.community',['sort'=>$i,'view'=>$view])}}">{{ $names[$i] }}</a></li>
                        @endauth
                    @endif
                @endfor
            </ul>
        </div>
        <div class="col-8">

        </div>
        <div class="col-2">
            <button id="btnGroupDrop1" type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                {{$viewnames[$view]}}
            </button>
            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                @for($i = 0; $i < sizeof($viewnames); $i++)
                    @if($i < sizeof($viewnames)-1)
                        <li><a class="dropdown-item {{($i == $view) ? 'active' : ''}}" href="{{route('admin.community',['sort'=>$sort,'view'=>$i])}}">{{ $viewnames[$i] }}</a></li>
                    @else
                        @auth
                            <li><a class="dropdown-item {{($i == $view) ? 'active' : ''}}" href="{{route('admin.community',['sort'=>$sort,'view'=>$i])}}">{{ $viewnames[$i] }}</a></li>
                        @endauth
                    @endif
                @endfor
            </ul>
        </div>
    </div>
    <div class="row">
        @switch($view)
            @case(0)
                @foreach($users as $user)
                    <div class="container col-lg-2 col-3 mx-2 my-2">
                        <div class="row mt-3 mx-1 my-1">
                            <a href="{{route('user.info',$user)}}">
                                <img class="card-img-top rounded-circle" width="150" height="150" src="{{$user->avatar ? Illuminate\Support\Facades\Storage::url($user->avatar->patch) : Illuminate\Support\Facades\Storage::url('no-avatar.png')}}"
                                     alt="{{ $user->avatar ? Illuminate\Support\Facades\Storage::url($user->avatar->hash_name) : Illuminate\Support\Facades\Storage::url('no-avatar.png') }}">
                            </a>
                            {{--<div class="card-img-overlay"><p class="card-title text-center my-1">{{$el->name}}</p></div>--}}
                        </div>
                        <div class="row text-center mb-2">
                            <strong>{{$user->login}}</strong>
                            <small>{{$user->email}}</small>
                            <small>Connects: {{ $user->connects }}</small>
                            <div class="text-center mt-4">
                            </div>
                        </div>
                    </div>
                @endforeach
                @break
            @case(1)
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
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->connects }}</td>
                                <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d.m.Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @break
            @case(2)
                @foreach($users as $user)
                    <div class="container col-lg-2 col-3 mx-2 my-2">
                        <div class="card" style="width: 12rem;">
                            <div class="card-body">
                                <h5 class="card-title">{{$user->login}}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{$user->email}}</h6>
                                <div class="card-text border-bottom">
                                    <p>Connects: {{ $user->connects }}</p>
                                    @isset($user->parametr->status)
                                        <p>{{ $user->parametr->smessage}}</p>
                                    @endisset
                                    <p>Created:{{ \Carbon\Carbon::parse($user->created_at)->format('d.m.Y H:i')}}</p>
                                    <p>Updated:{{ \Carbon\Carbon::parse($user->updated_at)->format('d.m.Y H:i')}}</p>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="#" class="btn btn-outline-secondary">Action 1</a>
                                <a href="#" class="btn btn-outline-danger">Action 2</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                @break
        @endswitch
    </div>
@endsection
@section('dashboard-info')
    <h3>IP adress</h3>
@endsection
