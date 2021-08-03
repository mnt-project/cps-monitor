<div class="modal fade" id="imgview" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <img class="card-img-top img-responsive" src="{{$user->avatar ? Storage::url($user->avatar->patch) : Storage::url('no-avatar.png')}}"
                 alt="{{ $user->avatar ? Storage::url($user->avatar->hash_name) : Storage::url('no-avatar.png') }}">
        </div>
    </div>
</div>
