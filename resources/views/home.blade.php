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

    @foreach ($blogs as $blog)
        @include('blog.inc.blog-thumbnail')
    @endforeach

    <a data-bs-target="#blogadd" role="button" data-bs-toggle="modal">
        <span class="bi-pencil-square"></span>
    </a>
    @include('blog.inc.modal-create',['action'=>0,'name'=>'Create'])
    <br>
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
