<div class="modal fade" id="{{'unit_'.$loop->iteration}}" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                @if($albumunit->format == 'webp')
                    <span class="bi bi-exclamation-triangle-fill me-4" style="font-size: 1.5rem; color: black;"></span>
                @else
                    <span class="bi {{ 'bi-filetype-'.$albumunit->format }} me-4" style="font-size: 1.5rem; color: black;"></span>
                @endif
                <small><strong class="modal-title"> {{ $albumunit->name }}</strong></small>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <img id="unitimg" class="card-img-top img-responsive" src="{{Illuminate\Support\Facades\Storage::url($albumunit->patch)}}"
                 alt="{{ Illuminate\Support\Facades\Storage::url($albumunit->patch)}}">
            <div class="modal-footer">
                @if($albumunit->user_id == \Illuminate\Support\Facades\Auth::id())
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-4">
                                <form id="destroy-form" action="{{ route('album.unit.destroy',['album'=>$album,'unit'=>$albumunit]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                            <div class="col-8">
                                <small>{{ $albumunit->name.'.'.$albumunit->format }}</small>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
