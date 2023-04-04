<div class="modal fade" id="{{ 'albumview'.$album->id }}" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <strong class="modal-title">{{ $album->discription }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <img id="viewerimg" src="{{Illuminate\Support\Facades\Storage::url($album->patch)}}"
                 alt="{{Illuminate\Support\Facades\Storage::url($album->hash_name)}}">
            <div class="modal-footer">
                @if($album->user_id == \Illuminate\Support\Facades\Auth::id())
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-4">
                                <form id="destroy-form" action="{{ route('album.destroy',$album) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                            <div class="col-8">
                                <small>{{ $album->name.'.'.$album->format }}</small>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
