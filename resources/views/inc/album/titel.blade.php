<div class="container-fluid mt-5">
    @if($album->user_id == \Illuminate\Support\Facades\Auth::id())
        <a data-target="#avatar" role="button" data-toggle="modal">
            <img class="img-thumbnail" src={{ Illuminate\Support\Facades\Storage::url($album->patch) }} class="img-thumbnail" alt={{ Illuminate\Support\Facades\Storage::url($album->hash_name) }}>
        </a>
        @include('inc.album.modal-titel')
    @else
        <a data-target="#imgview" role="button" data-toggle="modal">
            <img class="img-thumbnail" src={{ Illuminate\Support\Facades\Storage::url($album->patch) }} class="img-thumbnail" alt={{ Illuminate\Support\Facades\Storage::url($album->hash_name) }}>
        </a>
        @include('inc.group.modal-imgview')
    @endif
    <div class="text-center"><p><h3>{{ $album->name }}</h3>
        @if($album->lock)
            <span class="badge bg-warning">locked</span>
        @endif
        @if($album->public)
            <span class="badge bg-success">Public</span>
        @endif
        @if($album->open)
            <span class="badge bg-info">Open</span>
        @else
            <span class="badge bg-warning">Close</span>
        @endif
        @if($album->visible)
            <span class="badge bg-primary">visible</span>
        @else
            <span class="badge bg-warning">unvisible</span>
        @endif
        {{--            <span class="badge bg-info">{{$group->user->login}}</span>--}}
    </div>
    <div class="row">
        <h5>{{$album->name}}</h5>
        <p>{{$album->description}}</p>
        <p class="mt-2">{{$album->location}}</p>
        <p class="mt-2">{{ \Carbon\Carbon::parse($album->created_at)->format('d.m.Y H:i')}}</p>
        <p class="mt-2">Creator: <a href="{{ route('user.info',$album->user->id) }}"><span class="bi bi-person-circle">{{$album->user->login}}</span></a></p>
        <p class="mt-2">Uploads: {{$albumunits->count()}}</p>
        @auth
            @if($album->open)
                <div class="row mt-2">
                    <a href="{{ route('album.unit.store',$album) }}" class="btn btn-outline-success">Add</a>
                </div>
            @endif
            @if($album->user_id == \Illuminate\Support\Facades\Auth::id() or \Illuminate\Support\Facades\Auth::user()->IsAdmin())
                <div class="row mt-2">
                    <button class="btn btn-outline-warning" data-target="#albumedit" role="button" data-toggle="modal">
                        Edit Album
                    </button>
                    @include('inc.album.modal-edit',['action'=>1,'name'=>'Edit'])
                </div>
            @endif
        @endauth
        <div class="row mt-4">
            <a href="{{ route('group.info',session('groupid')) }}" class="btn btn-primary mt-2">Exit</a>
        </div>
    </div>
</div>
