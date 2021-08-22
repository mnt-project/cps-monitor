@extends('layouts.app')

@section('title-block')Home @endsection

@section('content-aside')
    <div class="list-unstyled text-center mb-4"><h4>Users online</h4></div>
    <div class="list-group">
        @foreach($usersOnline as $user)
            <a class="list-group-item" href={{ route('user.info',$user->id) }}><span class="bi bi-people"> {{$user->login}}</span></a>
        @endforeach
    </div>
@endsection

@section('content-header')<h4>Home page</h4>@endsection
@section('content-text')


    <p> The gutters between columns in our predefined grid classes can be removed with .no-gutters.
        This removes the negative margins from .row and the horizontal padding from all immediate children
        columns. Here’s the source code for creating these styles. Note that column overrides are scoped to
        only the first children columns and are targeted via attribute selector. While this generates a more
        specific selector, column padding can still be further customized with spacing
    </p>
    <a href="https://laravel.su/docs/5.3/blade">Blade Documentation</a>
@endsection

{{--@section('aside')--}}
{{--    @parent--}}
{{--    <p>Add section</p>--}}
{{--@endsection--}}
@section('content-info')
    <div class="list-unstyled text-center mb-4"><h4>Groups</h4></div>
    <div class="list-group">
        @foreach($groupsPublic as $group)
            <a class="list-group-item" href={{ route('group.info',$group->id) }}><span class="bi bi-people"> {{$group->name}}</span></a>
        @endforeach
    </div>
@endsection
