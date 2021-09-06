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
            @switch($user->settings->language)
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
            @if($user->settings->reputation > 0)
                <p class="text-success"><strong>{{'+'.$user->settings->reputation}}</strong></p>
            @elseif($user->settings->reputation < 0)
                <p class="text-danger"><strong>{{'-'.$user->settings->reputation}}</strong></p>
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
            @if($user->settings->interests == 'null')
                <p>Not specified</p>
            @else
                <p>{{$user->settings->interests}}</p>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <p><strong>About:</strong></p>
        </div>
        <div class="col-8 text-start">
            @if($user->settings->about == 'null')
                <p>Not specified</p>
            @else
                <p>{{$user->settings->about}}</p>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <p><strong>Notes:</strong></p>
        </div>
        <div class="col-8 text-start">
            @if($user->settings->notes == 'null')
                <p>Not specified</p>
            @else
                <p>{{$user->settings->notes}}</p>
            @endif
        </div>
    </div>
</div>
