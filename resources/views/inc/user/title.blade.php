<div class="container-fluid mt-5">
    @if(Illuminate\Support\Facades\Auth::id() == $user->id)
        <a data-target="#avatar" role="button" data-toggle="modal">
            <img class="card-img-top img-responsive" src="{{$user->avatar ? Illuminate\Support\Facades\Storage::url($user->avatar->patch) : Illuminate\Support\Facades\Storage::url('no-avatar.png')}}"
                 alt="{{ $user->avatar ? Illuminate\Support\Facades\Storage::url($user->avatar->hash_name) : Illuminate\Support\Facades\Storage::url('no-avatar.png') }}">
        </a>
        @include('inc.user.modal-avatar')
    @else
        <a data-target="#imgview" role="button" data-toggle="modal">
        <img class="card-img-top img-responsive" src="{{$user->avatar ? Illuminate\Support\Facades\Storage::url($user->avatar->patch) : Illuminate\Support\Facades\Storage::url('no-avatar.png')}}"
             alt="{{ $user->avatar ? Illuminate\Support\Facades\Storage::url($user->avatar->hash_name) : Illuminate\Support\Facades\Storage::url('no-avatar.png') }}">
        </a>
        @include('inc.user.modal-imgview')
    @endif

    <div class="container text-center"><h3>{{ $user->login }}</h3>
        @if($user->isOnline())
            <span class="badge bg-success">Online</span>
        @endif
        @ishidden($user)
            <span class="badge bg-warning">Hidden</span>
        @endishidden
        @isadmin($user)
            <span class="badge bg-info">Admin</span>
        @endisadmin
    </div>
    <ul class="list-group list-group-flush">
        @isset($user->settings)
            @if($user->settings->status)
                <li class="list-group-item text-center">
                    @auth
                        @if($user->id == Illuminate\Support\Facades\Auth::id())
                            <a class="text-secondary" data-target="#status" role="button" data-toggle="modal">
                                {{ $user->settings->smessage }}
                            </a>
                            @include('inc.user.modal-status',['message'=>$user->settings->smessage])
                        @else
                            <p class="text-secondary">{{ $user->settings->smessage }}</p>
                        @endif
                    @endauth
                </li>
            @elseif($user->id == Illuminate\Support\Facades\Auth::id())
                <li class="list-group-item text-center">

                    <a class="text-secondary" data-target="#status" role="button" data-toggle="modal">
                        Set status
                    </a>
                    @include('inc.user.modal-status',['message'=>$user->settings->smessage])
                </li>
            @endif
            <li class="list-group-item">last seen: {{ \Carbon\Carbon::parse($user->settings->connected_at)->format('d.m.Y H:i') }}</li>
            <li class="list-group-item">Created: {{ \Carbon\Carbon::parse($user->created_at)->format('d.m.Y H:i')}}</li>
            <li class="list-group-item text-center">
                Rate user:
                <a class="text-success" href="{{ route('user.reputationup',$user) }}"><span class="bi bi-hand-thumbs-up"></span></a>
                @if($user->settings->reputation>=0)
                    <b class="text-success">{{$user->settings->reputation}}</b>
                @else
                    <b class="text-danger">{{$user->settings->reputation}}</b>
                @endif
                <a class="text-danger" href="{{ route('user.reputationdown',$user) }}"><span class="bi bi-hand-thumbs-down"></span></a>
            </li>
            @auth
                @if($user->id != Illuminate\Support\Facades\Auth::id())
                    <li class="list-group-item">
                        <p class="text-center"><button data-target="#message" role="button" class="btn btn-outline-secondary" data-toggle="modal">{{ __('user.send_message') }}</button></p>
                        @include('inc.user.modal-message')
                    </li>
                @endif
            @endauth
        @endisset
    </ul>
</div>
