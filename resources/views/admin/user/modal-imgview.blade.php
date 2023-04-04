<div class="modal fade" id="imgview" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <span class="text-end"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></span>
            <img id="viewerimg" class="card-img-top img-responsive" src="{{$user->avatar ? Illuminate\Support\Facades\Storage::url($user->avatar->patch) : Illuminate\Support\Facades\Storage::url('no-avatar.png')}}"
                 alt="{{ $user->avatar ? Illuminate\Support\Facades\Storage::url($user->avatar->hash_name) : Illuminate\Support\Facades\Storage::url('no-avatar.png') }}">
        </div>
    </div>
</div>
