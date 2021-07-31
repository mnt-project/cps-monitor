<div class="container">
    <div class="row border-bottom">
        <div class="col-lg-2 col-sm-4">
            <p class="mt-3"><strong>Notifications:</strong></p>
        </div>
        <div class="col-lg-1 col-sm-4">
            @if($user->uparametr->notifications)
                <a class="text-dark" href="{{ route('user.notifications',$user) }}" data-placement="top" title="OFF">
                    <span class="bi bi-toggle-on" style="font-size: 2.5rem; color: black;"></span>
                </a>
            @else
                <a class="text-dark" href="{{ route('user.notifications',$user) }}" data-placement="top" title="ON">
                    <span class="bi bi-toggle-off" style="font-size: 2.5rem; color: black;"></span>
                </a>
            @endif
        </div>
        <div class="col-lg-9  col-sm-4">
            @if($user->uparametr->notifications)
                <p class="text-success mt-3 text-lg-start"><strong>ON</strong></p>
            @else
                <p class="text-danger mt-3 text-lg-start"><strong>OFF</strong></p>
            @endif
        </div>
    </div>
    <div class="row border-bottom">
        <div class="col-lg-4 col-md-12 col-sm-12">
            <form action={{ route('user.nickname',$user) }} method="post">
                @csrf
                <div class="input-group my-5">
                    <label class="newnickname"><span class="input-group-text" id="nickname">{{ $user->login }}</span></label>
                    <input type="text" class="form-control" id="newnickname" name="newnickname" aria-describedby="nickname" placeholder="Enter new nickname...">
                    <button class="btn btn-outline-secondary" type="submit" id="change">Change</button>
                </div>
            </form>
        </div>
        <div class="col-lg-4">

        </div>
        <div class="col-lg-4">

        </div>
    </div>
    <div class="row border-bottom">
        <div class="col-lg-2 col-md-6 col-sm-6 my-5">
            <p><strong>Password:</strong></p>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 text-lg-start my-5">
            <button data-target="#changepass" role="button" class="btn btn-outline-secondary" data-toggle="modal">{{ __('user.change_pass') }}</button>
            @include('inc.user.modal-pass')
        </div>
        <div class="col-lg-8">

        </div>
    </div>
    <div class="row border-bottom">
        <div class="col-lg-2 col-md-6 col-sm-6 my-5">
            <p><strong>About you:</strong></p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 text-lg-start my-5">
            <button data-target="#changeabout" role="button" class="btn btn-outline-secondary" data-toggle="modal">{{ __('user.change_about') }}</button>
            @include('inc.user.modal-about')
        </div>
        <div class="col-lg-4">

        </div>
    </div>

</div>
