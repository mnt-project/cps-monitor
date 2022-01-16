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
            <div class="nav-link {{ empty($tabid) ? 'active' : '' }}" id="nav-tab-default" data-target="#nav-general" type="button" role="tab" aria-controls="nav-general" aria-selected="true">
                <a class="btn" href="{{ route('admin.community') }}">
                    Main
                </a>
            </div>

            @if($tabs instanceof \Illuminate\Database\Eloquent\Collection)
                @foreach($tabs as $tab)
                    @if($loop->iteration<5)
                        <div class="nav-link {{ $tabid == $tab->tabid ? 'active' : '' }}" id="{{ 'nav-tab-'.$tab->tabid }}" data-target="{{ 'tab-'.$tab->tabid }}" type="button" role="tabpanel" aria-controls="nav-general" aria-selected="{{ $tabid == $tab->tabid ? 'true' : 'false' }}">
                            <a class="btn" href="{{ route('admin.community',$tab->tabid) }}">{{ $tab->type.$tab->tabid }}</a>
                            @if($tabid == $tab->tabid && $tabid>0)
                                <a class="btn" href="{{ route('tab.close',$tab) }}" >
                                    <span class="bi bi-x-circle" style="color: black;"></span>
                                </a>
                            @endif
                        </div>
                    @endif

                @endforeach
            @endif
            <a class="nav-link btn" href="{{ route('tab.create',['value'=>0,'titel'=>'List','type'=>'default.index','route'=>'tab.index']) }}" id="nav-general-tab" data-target="#nav-general" type="button" role="tabpanel" aria-controls="nav-general" aria-selected="true">
                <span class="bi bi-plus-circle" style="font-size: 1.5rem; color: black;"></span>
            </a>
        </div>
    </nav>
    <div class="tab-content mt-5">
        @if($tabs instanceof \Illuminate\Database\Eloquent\Collection)
            @foreach($tabs as $tab)
                @if($loop->iteration<5)
                    <div class="tab-pane {{ $tabid == $tab->tabid ? 'active' : '' }}" id="{{ 'tab-'.$tab->tabid }}" role="tabpanel" aria-labelledby="{{ 'nav-tab-'.$tab->tabid }}">
                        {{ $tab->type.$tab->tabid }}
                        @include('admin.'.$tab->type)
                    </div>
                @endif
            @endforeach
        @else
            <div class="tab-pane active" id="nav-tab-default" role="tabpanel" aria-labelledby="nav-tab-default">
                {{--Tab #default--}}
                @include('admin.'.$tabs->type)
            </div>
        @endif
    </div>
@endsection
@section('dashboard-info')
    <h3>IP adress</h3>
@endsection
