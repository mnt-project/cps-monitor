<div class="card" style="width: 20rem;">
        @if($auth_user->avatar)
            <img class="card-img-top img-responsive" src="{{ Storage::url($auth_user->avatar->patch) }}" alt="{{ Storage::url($auth_user->avatar->hash_name) }}">
        @else
            <img class="card-img-top img-responsive" src="{{ Storage::url('no-avatar.png') }}" alt="{{ Storage::url('no-avatar.png') }}">
        @endif
        <div class="card-title text-center"><p><h3>{{ $auth_user->login }}</h3>
            @if($auth_user->group)
                <span class="badge bg-primary">{{ $auth_user->groups->name}}</span>
            @endif
            @if($auth_user->isOnline())
                <span class="badge bg-success">Online</span>
            @endif
            @if($auth_user->role)
            <span class="badge bg-info">Admin</span>
            @endif
            </p>
        </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item text-center">Email: {{ $auth_user->email }}</li>
        <li class="list-group-item text-center">Age: {{ $auth_user->age }}</li>
        <li class="list-group-item text-center">Last connect {{$auth_user->connects}}: {{ \Carbon\Carbon::parse($auth_user->updated_at)->format('d.m.Y H:i') }} </li>
        <li class="list-group-item text-center">Created: {{ \Carbon\Carbon::parse($auth_user->created_at)->format('d.m.Y H:i')}}</li>
        <li class="list-group-item text-center">
            <p class="text-center">Change avatar</p>
            <form method="post" action={{ route('user.avatar',$auth_user->id) }} enctype="multipart/form-data">
                @csrf
                <div class="row form-group">
                    <input type="file" name="avatar">
                    <button class="btn btn-success" type="submit">Load</button>
                </div>
            </form>
        </li>
        @if($auth_user->uparametr->admin)
            <li class="list-group-item text-success text-center">Администратор</li>
        @else
            <li class="list-group-item text-info text-center">Пользователь</li>
        @endif
{{--        <span class="badge badge-info">{{$auth_user->connects}}</span>--}}
    </ul>

    <div class="card-body">
        <h5 class="card-title">Notes:</h5>
        @if($auth_user->uparametr->notes != 'null')
            <p class="card-text">{{ $auth_user->uparametr->notes }} </p>
        @else
            <p class="card-text">Not created!</p>
        @endif
    </div>
</div>
