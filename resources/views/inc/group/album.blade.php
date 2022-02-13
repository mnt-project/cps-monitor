<div class="container col-8">
    <div class="row">
        @if($albums->count()>0)
            <figure class="figure mt-3">
                @foreach($albums as $album)
                    @if($album instanceof \App\Models\Album)
                        @if($album)
                            <a href="{{ route('group.album',$album) }}"><img class="img_wrap" src="{{Illuminate\Support\Facades\Storage::url($album->patch)}}" alt="{{ Illuminate\Support\Facades\Storage::url($album->hash_name) }}"></a>
                        @endif
                    @endif
                    @if($loop->last)
                        <a data-target="#albumedit" role="button" data-toggle="modal">
                            <span class="bi bi-arrow-down-circle" style="font-size: 3.5rem; color: lightblue;"></span>
                        </a>
                        @include('inc.album.modal-edit',['action'=>0,'name'=>'Create'])
                    @endif
                @endforeach
            </figure>
        @else
            <a data-target="#albumedit" role="button" data-toggle="modal">
                <span class="bi bi-arrow-down-circle" style="font-size: 3.5rem; color: lightblue;"></span>
            </a>
            @include('inc.album.modal-edit',['action'=>0,'name'=>'Create'])
        @endisset

    </div>
</div>

