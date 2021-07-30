<div class="container {{ $group->public ? 'border' : 'border border-danger'}} col-lg-2 col-3 mx-2 my-2">
    <div class="row mt-3 mx-1 my-1">
        @if($group->avatar)
            <img src={{ Storage::url($group->patch) }} class="img-thumbnail" alt={{ Storage::url($group->hash_name) }}>
        @else
            <img src={{ Storage::url('group-no-avatar.png') }} class="img-thumbnail" alt={{ Storage::url('group-no-avatar.png') }}>
        @endif
        {{--<div class="card-img-overlay"><p class="card-title text-center my-1">{{$el->name}}</p></div>--}}
    </div>
    <div class="row text-center mb-2">
        <strong>{{$group->name}}</strong>
        <small>{{$group->notes}}</small>
        <small>Followers: {{ $group->follow->count() }}</small>
        <div class="text-center mt-4">
            @if($group->open or $group->user_id === $user->id)
                <a href="{{route('group.info',$group)}}" class="btn btn-primary">Open</a>
            @else
                <a href="{{route('group.info',$group)}}" class="btn btn-secondary">Info</a>
            @endif
        </div>
    </div>
</div>
