<div class="container">
{{--    @if($auth_user->id == $user->id)--}}
{{--    <ul>--}}
{{--        <li>{{$user->login}}</li>--}}
{{--        <li>{{$user->email}}</li>--}}
{{--        <li>{{$user->age}}</li>--}}
{{--    </ul>--}}
{{--    @else--}}
        <div class="row">
            <div class="col-2">
                <p><strong>Login:</strong></p>
            </div>
            <div class="col-10 text-start">
                {{$user->login}} ID:[{{$user->id}}]
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <p><strong>Email:</strong></p>
            </div>
            <div class="col-10 text-start">
                {{$user->email}}
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <p><strong>Connects:</strong></p>
            </div>
            <div class="col-10 text-start">
                @if($user->connects>0)
                    {{strval($user->connects).' more'}}
                @else
                    No connects
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <p><strong>Language:</strong></p>
            </div>
            <div class="col-10 text-start">
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
            <div class="col-2">
                <p><strong>Reputation:</strong></p>
            </div>
            <div class="col-10 text-start">
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
            <div class="col-2">
                <p><strong>Interests:</strong></p>
            </div>
            <div class="col-10 text-start">
                @if($user->uparametr->interests == 'null')
                    <p>Not specified</p>
                @else
                    <p>{{$user->uparametr->interests}}</p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <p><strong>About:</strong></p>
            </div>
            <div class="col-10 text-start">
                @if($user->uparametr->about == 'null')
                    <p>Not specified</p>
                @else
                    <p>{{$user->uparametr->about}}</p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <p><strong>Notes:</strong></p>
            </div>
            <div class="col-10 text-start">
                @if($user->uparametr->notes == 'null')
                    <p>Not specified</p>
                @else
                    <p>{{$user->uparametr->notes}}</p>
                @endif
            </div>
        </div>
</div>
