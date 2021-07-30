<div class="container-fluid mt-5">
    @if($user->avatar)
        <img class="card-img-top img-responsive" src="{{ Storage::url($user->avatar->patch) }}" alt="{{ Storage::url($user->avatar->hash_name) }}">
    @else
        <img class="card-img-top img-responsive" src="{{ Storage::url('no-avatar.png') }}" alt="{{ Storage::url('no-avatar.png') }}">
    @endif
    <div class="container text-center"><h3>{{ $user->login }}</h3>
        @if($user->isOnline())
            <span class="badge bg-success">Online</span>
        @endif
        @if($user->uparametr->admin)
            <span class="badge bg-info">Admin</span>
        @endif
    </div>
    <ul class="list-group list-group-flush">
        @if($user->uparametr->status)
            <li class="list-group-item text-center">
                @if($user->id == $auth_user->id)
                    <a class="text-secondary" data-target="#message" role="button" data-toggle="modal">
                        {{ $user->uparametr->smessage }}
                    </a>
                    @include('inc.user.status-form',['message'=>$user->uparametr->smessage])
                @else
                    <p class="text-secondary">{{ $user->uparametr->smessage }}</p>
                @endif
            </li>
        @elseif($user->id == $auth_user->id)
            <li class="list-group-item text-center">

                <a class="text-secondary" data-target="#message" role="button" data-toggle="modal">
                    Set status
                </a>
                @include('inc.user.status-form',['message'=>$user->uparametr->smessage])
            </li>
        @endif
        <li class="list-group-item">last seen: {{ \Carbon\Carbon::parse($user->uparametr->connected_at)->format('d.m.Y H:i') }}</li>
        <li class="list-group-item">Created: {{ \Carbon\Carbon::parse($user->created_at)->format('d.m.Y H:i')}}</li>

        {{--        <span class="badge badge-info">{{$auth_user->connects}}</span>--}}
    </ul>
</div>
