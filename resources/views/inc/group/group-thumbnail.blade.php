@if($group->visibility)
    <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-4 col-sm-12 col-xs-12 border mx-2 my-2">
        <a href="{{route('group.info',$group)}}">
            <figure class="figure mt-3">
                @if($group->avatar)
                    <img class="figure img-thumbnail" src={{ Illuminate\Support\Facades\Storage::url($group->patch) }} alt="{{Illuminate\Support\Facades\Storage::url($group->hash_name)}}">
                @else
                    <img class="figure img-thumbnail" src={{ Illuminate\Support\Facades\Storage::url('group-no-avatar.png') }} alt="{{ Illuminate\Support\Facades\Storage::url('group-no-avatar.png') }}">
                @endif
                <figcaption class="figure-caption text-center">
                    <div class="row mt-2">
                        <p>
                            <span class="badge {{$group->public ? 'bg-primary' : 'bg-warning'}}">{{$group->public ? 'public' : 'limited'}}</span>
                            <span class="badge {{$group->open ? 'bg-success' : 'bg-danger'}}">{{$group->open ? 'open' : 'invite'}}</span>
                            <span class="badge {{$group->state ? 'bg-info' : 'bg-secondary'}}">{{$group->state ? 'st:'.$group->state : 'root'}}</span>
                        </p>
                    </div>
                    <div class="row">
                        <h4>{{$group->name}}</h4>
                        <p>{{$group->notes}}</p>
                        <p>{{ $group->follow->count() }} followers</p>
                    </div>
                </figcaption>
            </figure>
        </a>
    </div>
@endif
