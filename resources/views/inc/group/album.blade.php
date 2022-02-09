<div class="container col-8">
    <div class="row">
        @if($albums->count()>0)
            <figure class="figure mt-3">
                @foreach($albums as $album)
                    @if($album)
                        <a data-target="#{{ 'albumview'.$album->id }}" role="button" data-toggle="modal">
                            <img class="img_wrap" src="{{Illuminate\Support\Facades\Storage::url($album->patch)}}"
                                 alt="{{ Illuminate\Support\Facades\Storage::url($album->hash_name) }}">
                        </a>
                        @include('inc.group.modal-albumview')
                    @endif
                    @if ($loop->last)
                        <a data-target="#album" role="button" data-toggle="modal">
                            <span class="bi bi-arrow-down-circle" style="font-size: 3.5rem; color: lightblue;"></span>
                        </a>
                        @include('inc.group.modal-album')
                    @endif
                @endforeach
            </figure>
        @else
            <a data-target="#album" role="button" data-toggle="modal">
                <span class="bi bi-arrow-down-circle" style="font-size: 3.5rem; color: lightblue;"></span>
            </a>
            @include('inc.group.modal-album')
        @endisset

    </div>
</div>

