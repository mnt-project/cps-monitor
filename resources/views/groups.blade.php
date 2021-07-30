@extends('layouts.app')
@php $auth_user = Auth::user() @endphp

@section('title-block')Groups @endsection

@section('content-aside')

@endsection

@section('content-header')<h4>Groups page</h4>@endsection
@section('content-text')
    <div class="container">
        <div class="row">
            <div class="col-10">
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        {{$names[$sort]}}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        @for($i = 0; $i < sizeof($names); $i++)
                            <li>
                                @if($i < sizeof($names)-1)
                                    <a class="dropdown-item {{($i == $sort) ? 'active' : ''}}" href="{{route('group.list',$i)}}">{{ $names[$i] }}</a></li>
                                @else
                                    @auth
                                        <a class="dropdown-item {{($i == $sort) ? 'active' : ''}}" href="{{route('group.list',$i)}}">{{ $names[$i] }}</a></li>
                                    @endauth
                                @endif
                        @endfor
                    </ul>
                </div>
            </div>
            <div class="col-2">
                @if($auth_user)
                    <button data-target="#addGroup" role="button" class="btn btn-secondary" data-toggle="modal">{{ __('group.new_group') }}</button>
                    @include('inc.group-form',['action'=>0,'name'=>'Create','route'=>'group.add','group'=>0])
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        @foreach ($groups as $group)
            @include('inc.group-thumbnail',$group)
        @endforeach
    </div>
@endsection
@section('content-info')

@endsection

