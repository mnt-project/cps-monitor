<div class="container">
    <div class="row">
        <div class="col-4">
            <p><strong>Login:</strong></p>
        </div>
        <div class="col-8 text-start">
            {{$user->login}} ID:[{{$user->id}}]
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <p><strong>Email:</strong></p>
        </div>
        <div class="col-8 text-start">
            @auth
                {{$user->email}}
            @else
                {{__('user.email_hidden')}}
            @endauth
        </div>
    </div>
    <div class="row">
        @auth
            <div class="col-4">
                <p><strong>Connects:</strong></p>
            </div>
            <div class="col-8 text-start">
                @if($user->connects>0)
                    {{strval($user->connects).' more'}}
                @else
                    No connects
                @endif
            </div>
        @endauth
    </div>
    <div class="row">
        <div class="col-4">
            <p><strong>Language:</strong></p>
        </div>
        <div class="col-8 text-start">
            @switch($user->uparametr->language)
                @case(1)
                English
                @break

                @case(2)
                Russian
                @break

                @default
                Default
            @endswitch
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <p><strong>Reputation:</strong></p>
        </div>
        <div class="col-8 text-start">
            @if($user->uparametr->reputation > 0)
                <p class="text-success"><strong>{{'+'.$user->uparametr->reputation}}</strong></p>
            @elseif($user->uparametr->reputation < 0)
                <p class="text-danger"><strong>{{'-'.$user->uparametr->reputation}}</strong></p>
            @else
                <p>No ratings</p>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <p><strong>Interests:</strong></p>
        </div>
        <div class="col-8 text-start">
            @if($user->uparametr->interests == 'null')
                <p>Not specified</p>
            @else
                <p>{{$user->uparametr->interests}}</p>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <p><strong>About:</strong></p>
        </div>
        <div class="col-8 text-start">
            @if($user->uparametr->about == 'null')
                <p>Not specified</p>
            @else
                <p>{{$user->uparametr->about}}</p>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <p><strong>Notes:</strong></p>
        </div>
        <div class="col-8 text-start">
            @if($user->uparametr->notes == 'null')
                <p>Not specified</p>
            @else
                <p>{{$user->uparametr->notes}}</p>
            @endif
        </div>
    </div>
</div>
