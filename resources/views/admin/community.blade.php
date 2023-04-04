@extends('layouts.admin')
@section('title-block')Admin panel @endsection
@section('dashboard-aside')
    @include('admin.inc.aside',['itemid' => 2])
@endsection
@section('dashboard-header')

    <h3>Community</h3>

@endsection
@section('dashboard-text')
    <nav>
        <div class="nav nav-tabs" role="tablist">
            <div class="nav-link {{ empty(session('tabid')) ? 'active' : '' }}" id="nav-tab-default" data-bs-target="#nav-general" type="button" role="tab" aria-controls="nav-general" aria-selected="true">
                <a class="btn" href="{{ route('tab.index',0) }}">
                    Main
                </a>
            </div>

            @if($tabs instanceof \Illuminate\Support\Collection)
                @foreach($tabs as $tab)
                    @if($loop->iteration<5)
                        <div class="nav-link {{ session('tabid') == $tab['tabid'] ? 'active' : '' }}" id="{{ 'nav-tab-'.$tab['tabid'] }}" data-bs-target="{{ 'tab-'.$tab['tabid'] }}" type="button" role="tabpanel" aria-controls="nav-general" aria-selected="{{ session('tabid') == $tab['tabid'] ? 'true' : 'false' }}">
                            <a class="btn" href="{{ route('tab.index',$tab['tabid']) }}">{{ $tab['type'].$tab['tabid'] }}</a>
                            @if(session('tabid') == $tab['tabid'] && session('tabid')>0)
                                <a class="btn" href="{{ route('tab.close',$tab['tabid']) }}" >
                                    <span class="bi bi-x-circle" style="color: black;"></span>
                                </a>
                            @endif
                        </div>
                    @endif

                @endforeach
            @endif

{{--            <a class="nav-link btn" href="{{ route('tab.create',['value'=>0,'titel'=>'List','type'=>'default.index','route'=>'tab.index']) }}" id="nav-general-tab" data-bs-target="#nav-general" type="button" role="tabpanel" aria-controls="nav-general" aria-selected="true">--}}
{{--                <span class="bi bi-plus-circle" style="font-size: 1.5rem; color: black;"></span>--}}
{{--            </a>--}}
{{--            <div class="dropdown dropend">--}}
{{--                <a class="nav-link btn dropdown-toggle" id="nav-general-tab" data-bs-toggle="dropdown" aria-expanded="false" data-bs-target="#nav-general" type="button" role="tabpanel" aria-controls="nav-general" aria-selected="true">--}}
{{--                    <span class="bi bi-plus-circle" style="font-size: 1.5rem; color: black;"></span>--}}
{{--                </a>--}}
{{--                <ul class="dropdown-menu dropend" aria-labelledby="nav-general-tab">--}}
{{--                    <li><a class="dropdown-item"  href="{{ route('tab.create',['value'=>0,'titel'=>'List','type'=>'default.index','route'=>'tab.index']) }}">default.index</a></li>--}}
{{--                    <li><a class="dropdown-item" href="{{ route('tab.create',['value'=>\Illuminate\Support\Facades\Auth::id(),'titel'=>'Info','type'=>'default.info','route'=>'tab.info']) }}">default.info</a></li>--}}
{{--                    <li><a class="dropdown-item" href="{{ route('tab.create',['value'=>\Illuminate\Support\Facades\Auth::id(),'titel'=>'Config','type'=>'default.config','route'=>'tab.config']) }}">default.config</a></li>--}}
{{--                    <li><a class="dropdown-item" href="{{ route('tab.create',['value'=>\Illuminate\Support\Facades\Auth::id(),'titel'=>'Empty','type'=>'default.empty','route'=>'tab.empty']) }}">default.empty</a></li>--}}
{{--                </ul>--}}
{{--            </div>--}}

            <!-- Split dropend button -->
            <div class="btn-group dropend">
                <a class="btn nav-link" href="{{ route('tab.create',['value'=>0,'titel'=>'List','type'=>'default.index','route'=>'tab.index']) }}" id="nav-general-tab" data-bs-target="#nav-general" type="button" role="tabpanel" aria-controls="nav-general" aria-selected="true">
                    <span class="bi bi-plus-circle" style="font-size: 1.5rem; color: black;"></span>
                </a>
                <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="visually-hidden">Toggle Dropright</span>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item"  href="{{ route('tab.create',['value'=>0,'titel'=>'List','type'=>'default.index','route'=>'tab.index']) }}">default.index</a></li>
                    <li><a class="dropdown-item" href="{{ route('tab.create',['value'=>\Illuminate\Support\Facades\Auth::id(),'titel'=>'Info','type'=>'default.info','route'=>'tab.info']) }}">default.info</a></li>
                    <li><a class="dropdown-item" href="{{ route('tab.create',['value'=>\Illuminate\Support\Facades\Auth::id(),'titel'=>'Config','type'=>'default.config','route'=>'tab.config']) }}">default.config</a></li>
                    <li><a class="dropdown-item" href="{{ route('tab.create',['value'=>\Illuminate\Support\Facades\Auth::id(),'titel'=>'Empty','type'=>'default.empty','route'=>'tab.empty']) }}">default.empty</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="tab-content mt-5">
        <div class="tab-pane {{ empty(session('tabid')) ? 'active' : '' }}" id="nav-tab-default" role="tabpanel" aria-labelledby="nav-tab-default">
            {{--Tab #default--}}
            @include('admin.default.index')
        </div>
        @if($tabs instanceof \Illuminate\Support\Collection)
            @foreach($tabs as $tab)
                @if($loop->iteration<5)
                    <div class="tab-pane {{ session('tabid') == $tab['tabid'] ? 'active' : '' }}" id="{{ 'tab-'.$tab['tabid'] }}" role="tabpanel" aria-labelledby="{{ 'nav-tab-'.$tab['tabid'] }}">
                        {{ $tab['type'].$tab['tabid'] }}
                        @include('admin.'.$tab['type'],['user'=>\App\cps\user\Tabs::getUser($tab['value'])])
                    </div>
                @endif
            @endforeach
        @endif
    </div>
@endsection
@section('dashboard-info')
    <h3>IP adress</h3>
@endsection
