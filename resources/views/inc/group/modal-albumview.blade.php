<div class="modal fade" id="{{ 'albumview'.$album->id }}" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <strong class="modal-title">{{ $album->discription }}</strong>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <img id="viewerimg" class="card-img-top img-responsive" src="{{Illuminate\Support\Facades\Storage::url($album->patch)}}"
                 alt="{{Illuminate\Support\Facades\Storage::url($album->hash_name)}}">
        </div>
    </div>
</div>
