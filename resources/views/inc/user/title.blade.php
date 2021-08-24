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
        @if($user->uparametr->admin)
            <span class="badge bg-info">Admin</span>
        @endif
    </div>
    <ul class="list-group list-group-flush">
        @if($user->uparametr->status)
            <li class="list-group-item text-center">
                @if($user->id == Illuminate\Support\Facades\Auth::id() or \App\Models\User::userIsAdmin(Illuminate\Support\Facades\Auth::id()))
                    <a class="text-secondary" data-target="#status" role="button" data-toggle="modal">
                        {{ $user->uparametr->smessage }}
                    </a>
                    @include('inc.user.modal-status',['message'=>$user->uparametr->smessage])
                @else
                    <p class="text-secondary">{{ $user->uparametr->smessage }}</p>
                @endif
            </li>
        @elseif($user->id == Illuminate\Support\Facades\Auth::id() or App\Models\User::find(\Illuminate\Support\Facades\Auth::id())->uparametr->admin)
            <li class="list-group-item text-center">

                <a class="text-secondary" data-target="#status" role="button" data-toggle="modal">
                    Set status
                </a>
                @include('inc.user.modal-status',['message'=>$user->uparametr->smessage])
            </li>
        @endif
        <li class="list-group-item">last seen: {{ \Carbon\Carbon::parse($user->uparametr->connected_at)->format('d.m.Y H:i') }}</li>
        <li class="list-group-item">Created: {{ \Carbon\Carbon::parse($user->created_at)->format('d.m.Y H:i')}}</li>
        <li class="list-group-item text-center">
            Rate user:
            <a class="text-success" href="{{ route('user.reputationup',$user) }}"><span class="bi bi-hand-thumbs-up"></span></a>
            @if($user->uparametr->reputation>=0)
                <b class="text-success">{{$user->uparametr->reputation}}</b>
            @else
                <b class="text-danger">{{$user->uparametr->reputation}}</b>
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
    </ul>
</div>
