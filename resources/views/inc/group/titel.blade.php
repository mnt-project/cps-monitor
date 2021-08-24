<div class="container-fluid mt-5">
    @if($group->avatar)
        <a data-target="#imgview" role="button" data-toggle="modal">
            <img class="img-thumbnail" src={{ Illuminate\Support\Facades\Storage::url($group->patch) }} class="img-thumbnail" alt={{ Illuminate\Support\Facades\Storage::url($group->hash_name) }}>
        </a>
        @include('inc.group.modal-imgview')
    @else
        <img class="img-thumbnail" src={{ Illuminate\Support\Facades\Storage::url('group-no-avatar.png') }} class="card-img-top" alt={{ Illuminate\Support\Facades\Storage::url('group-no-avatar.png') }}>
    @endif
    <div class="text-center"><p><h3>{{ $group->name }}</h3>
        @if($group->block)
            <span class="badge bg-warning">Blocked</span>
        @endif
        @if($group->public)
            <span class="badge bg-success">Public</span>
        @endif
        @if($group->open)
            <span class="badge bg-info">Open</span>
        @else
            <span class="badge bg-warning">Close</span>
        @endif
        @if($group->invite)
            <span class="badge bg-primary">invite</span>
        @endif
        {{--            <span class="badge bg-info">{{$group->user->login}}</span>--}}
    </div>
    <div class="row">
        <h5>{{$group->name}}</h5>
        <p>{{$group->notes}}</p>
        <p class="mt-2">{{$group->about}}</p>
        <p class="mt-2">{{ \Carbon\Carbon::parse($group->created_at)->format('d.m.Y H:i')}}</p>
        <p class="mt-2">Creator: <a href="{{ route('user.info',$group->user->id) }}"><span class="bi bi-person-circle">{{$group->user->login}}</span></a></p>
        <p class="mt-2">Followers: {{$group->groupFollowCount()}}</p>
        @auth
            <div class="mt-5 row">
                @if($group->user_id === \Illuminate\Support\Facades\Auth::id())
                    <button data-target="#addGroup" role="button" class="btn btn-primary mt-2" data-toggle="modal">Edit group</button>
                    @include('inc.group.group-form',['action'=>1,'name'=>'Edit','route'=>'group.edit'])
                @endif
            </div>
            @if($group->open and $group->user_id != \Illuminate\Support\Facades\Auth::id())
                <div class="row">
                    @if($followers->count())
                        @foreach($followers as $follower)
                            @if($follower->user_id === \Illuminate\Support\Facades\Auth::id())
                                <a href="{{ route('group.unfollowing',$group->id) }}" class="btn btn-primary mt-2">Unfollow</a>
                                @break
                            @endif
                            @if($loop->last)
                                <a href="{{ route('group.following',$group->id) }}" class="btn btn-primary mt-2">Follow</a>
                            @endif
                        @endforeach
                    @else
                        <a href="{{ route('group.following',$group->id) }}" class="btn btn-primary mt-2">Follow</a>
                    @endif
                </div>
            @endif
        @endauth
        <div class="row">
            <a href="{{ route('group.list') }}" class="btn btn-primary mt-2">Exit</a>
        </div>
    </div>
</div>
