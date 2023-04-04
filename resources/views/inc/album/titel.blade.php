<div class="container-fluid">
    @if($album->user_id == \Illuminate\Support\Facades\Auth::id())
        <a data-bs-target="#avatar" role="button" data-bs-toggle="modal">
            <img class="img-thumbnail" src={{ Illuminate\Support\Facades\Storage::url($album->patch) }} class="img-thumbnail" alt={{ Illuminate\Support\Facades\Storage::url($album->hash_name) }}>
        </a>
        @include('inc.album.modal-titel')
    @else
        <a data-bs-target="#album" role="button" data-bs-toggle="modal">
            <img class="img-thumbnail" src={{ Illuminate\Support\Facades\Storage::url($album->patch) }} class="img-thumbnail" alt={{ Illuminate\Support\Facades\Storage::url($album->hash_name) }}>
        </a>
        @include('inc.album.modal-albumavatar')
    @endif
    <h4 class="text-center">{{ $album->name }}</h4>
    <div class="text-center">

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
    </div>
    <div class="row text-center">
        <strong>{{$album->dir}}</strong>
        <p><small>{{$album->description}}</small></p>
        <p>{{ \Carbon\Carbon::parse($album->created_at)->format('d.m.Y H:i')}}</p>
        <p>Creator: <a href="{{ route('user.info',$album->user->id) }}"><span class="bi bi-person-circle">{{$album->user->login}}</span></a></p>
        <p>Uploads: {{$albumunits->count()}}</p>
        @auth
            @if($album->open)
                <div class="row mt-2">
                    {{--<a href="{{ route('album.unit.store',$album) }}" class="btn btn-outline-success">Add</a>--}}
                    <button class="btn btn-outline-warning" data-bs-target="#unitadd" role="button" data-bs-toggle="modal">
                        Add
                    </button>
                </div>
                @include('inc.album.modal-unitadd',['action'=>0,'name'=>'Create'])
            @endif
            @if($album->user_id == \Illuminate\Support\Facades\Auth::id() or \Illuminate\Support\Facades\Auth::user()->IsAdmin())
                <div class="row mt-2">
                    <button class="btn btn-outline-warning" data-bs-target="#albumedit" role="button" data-bs-toggle="modal">
                        Edit Album
                    </button>
                </div>
                @include('inc.album.modal-edit',['action'=>1,'name'=>'Edit'])
            @endif
        @endauth
        <div class="row mt-4">
            @if($album->group)
                <a href="{{ route('group.info',$album->group) }}" class="btn btn-primary mt-2">Exit</a>
            @else
                <a href="{{ route('user.info',$album->user) }}" class="btn btn-primary mt-2">Exit</a>
            @endif
        </div>
    </div>
</div>
