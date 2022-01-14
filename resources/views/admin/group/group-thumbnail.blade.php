<div class="container {{ $group->public ? 'border' : 'border border-danger'}} col-lg-2 col-3 mx-2 my-2">
    <div class="row mt-3 mx-1 my-1">
        <a href="{{route('group.info',$group)}}">
            @if($group->avatar)
                <img src={{ Illuminate\Support\Facades\Storage::url($group->patch) }} class="img-thumbnail" alt={{ Illuminate\Support\Facades\Storage::url($group->hash_name) }}>
            @else
                <img src={{ Illuminate\Support\Facades\Storage::url('group-no-avatar.png') }} class="img-thumbnail" alt={{ Illuminate\Support\Facades\Storage::url('group-no-avatar.png') }}>
            @endif
        </a>
        {{--<div class="card-img-overlay"><p class="card-title text-center my-1">{{$el->name}}</p></div>--}}
    </div>
    <div class="row text-center mb-2">
        <strong>{{$group->name}}</strong>
        <small>{{$group->notes}}</small>
        <small>Followers: {{ $group->follow->count() }}</small>
        <div class="container mt-4">
            <div class="row">
                <div class="col-lg-3 col-sm-2">
                    @if($group->visibility)
                        <a class="text-dark" href="{{ route('admin.visibility',$group->id)}}" title="hide">
                            <span class="bi bi-eye" style="font-size: 1.5rem; color: black;"></span>
                        </a>
                    @else
                        <a class="text-dark" href="{{ route('admin.visibility',$group->id)}}" title="show">
                            <span class="bi bi-eye-slash" style="font-size: 1.5rem; color: black;"></span>
                        </a>
                    @endif
                </div>
                <div class="col-lg-3 col-sm-2">
                    @if($group->open)
                        <a class="text-dark" href="{{ route('admin.open',$group->id)}}" title="lock">
                            <span class="bi bi-lock" style="font-size: 1.5rem; color: black;"></span>
                        </a>
                    @else
                        <a class="text-dark" href="{{ route('admin.open',$group->id)}}" title="unlock">
                            <span class="bi bi-lock-fill" style="font-size: 1.5rem; color: black;"></span>
                        </a>
                    @endif
                </div>
                <div class="col-lg-3 col-sm-2">
                    @if($group->warnings)
                        <a class="text-dark" href="{{ route('admin.visibility',$group->id)}}" title="hide">
                            <span class="bi bi-exclamation-triangle-fill" style="font-size: 1.5rem; color: red;"></span>
                        </a><b>{{ $group->warnings }}</b>
                    @else
                        <a class="text-dark" href="{{ route('admin.visibility',$group->id)}}" title="show">
                            <span class="bi bi-exclamation-triangle" style="font-size: 1.5rem; color: green;"></span>
                        </a>
                    @endif
                </div>
                <div class="col-lg-3 col-sm-2">
                    <span class="bi bi-globe" style="font-size: 1.5rem; color: blue;"></span><b>{{ $group->visits }}</b>
                </div>
            </div>
        </div>
{{--            <div class="btn-group-vertical">--}}
{{--                --}}
{{--                <a href="{{route('group.info',$group)}}" class="btn btn-primary">Open</a>--}}
{{--                <a href="{{route('group.info',$group)}}" class="btn btn-secondary">Info</a>--}}

{{--            </div>--}}


    </div>
</div>
