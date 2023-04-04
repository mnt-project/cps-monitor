@extends('layouts.admin')
@section('title-block')Admin panel @endsection
@section('dashboard-aside')
    @empty($connects)
        @include('admin.inc.aside',['itemid' => 1])
    @else
        @include('admin.inc.ip-titel')
    @endempty

@endsection
@section('dashboard-header')
    @empty($connects)
        <h3>Ips</h3>
    @else
        <h3>Connects</h3>
    @endempty
@endsection
@section('dashboard-text')
    @empty($connects)
        <x-sort-bar route="admin.connects" argname="ip" value="all" :sort="$sort" :show="$show" :method="$method" :sortname="$sortname" :lines="$lines"/>
        @include('admin.inc.ips')
    @else
        <x-sort-bar route="admin.connects" argname="ip" :value="$ips->ip" :sort="$sort" :show="$show" :method="$method" :sortname="$sortname" :lines="$lines"/>
        @include('admin.inc.connects')
    @endempty
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
{{--                        <button data-bs-target="#addAddress" role="button" class="btn btn-outline-dark" data-bs-toggle="modal">Add</button>--}}
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
