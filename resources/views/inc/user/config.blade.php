<div class="container">
    <div class="row border-bottom">
        <x-switch-button :flag="$user->uparametr->notifications" :route="route('user.notifications',$user)">Notifications</x-switch-button>
    </div>
    <div class="row border-bottom">
        <x-switch-button :flag="$user->uparametr->hidden" :route="route('user.hidden',$user)" labeltrue="Hidden" labelfalse="Public">Profile type</x-switch-button>
    </div>
    <div class="row border-bottom">
        <div class="col-lg-2 col-md-4 col-sm-6 my-5">
            <p><strong>Nickname:</strong></p>
        </div>
        <div class="col-lg-6 col-md-8 col-sm-6">
            <form action={{ route('user.nickname',$user) }} method="post">
                @csrf
                <div class="input-group my-5">
                    <span class="input-group-text" id="nickname">{{ $user->login }}</span>
                    <input type="text" class="form-control" id="newnickname" name="newnickname" aria-describedby="nickname" placeholder="Enter new nickname...">
                    <button class="btn btn-outline-secondary" type="submit" id="change">Change</button>
                </div>
            </form>
        </div>
        <div class="col-lg-4">

        </div>
    </div>
    <div class="row border-bottom">
        <div class="col-lg-2 col-md-4 col-sm-6 my-5">
            <p><strong>Password:</strong></p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 my-5">
            <button data-target="#changepass" role="button" class="btn btn-outline-secondary" data-toggle="modal">{{ __('user.change_pass') }}</button>
            @include('inc.user.modal-pass')
        </div>
        <div class="col-lg-8">

        </div>
    </div>
    <div class="row border-bottom">
        <div class="col-lg-2 col-md-4 col-sm-6 my-5">
            <p><strong>About you:</strong></p>
        </div>
        <div class="col-lg-4 col-md-8 col-sm-6 my-5">
            <button data-target="#changeabout" role="button" class="btn btn-outline-secondary" data-toggle="modal">{{ __('user.change_about') }}</button>
            @include('inc.user.modal-about')
        </div>
        <div class="col-lg-8">

        </div>
    </div>
    <div class="row border-bottom">
        <div class="col-lg-2 col-md-4 col-sm-6 my-5">
            <p><strong>Change avatar:</strong></p>
        </div>
        <div class="col-lg-6 col-md-8 col-sm-6 text-lg-start my-5">
            <form method="post" action={{ route('user.avatar',$auth_user->id) }} enctype="multipart/form-data">
                @csrf
                <div class="input-group">
                    <input class="form-control" type="file" name="avatar">
                    <button class="btn btn-success" type="submit">Load</button>
                </div>
            </form>
        </div>
        <div class="col-lg-4">

        </div>
    </div>
</div>
