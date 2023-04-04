<div class="container col-8">
    <div class="row">
        @if($albums->count()>0)
            <figure class="figure mt-3">
                @foreach($albums as $album)
                    @if($album instanceof \App\Models\Album)
                        @if($album)
                            @if($show == 'group' && $album->group)
                                <a href="{{ route('album.show',$album) }}"><img class="img_wrap" src="{{Illuminate\Support\Facades\Storage::url($album->patch)}}" alt="{{ Illuminate\Support\Facades\Storage::url($album->hash_name) }}"></a>
                            @endif
                            @if($show == 'user' && $album->group_id == 0)
                                <a href="{{ route('album.show',$album) }}"><img class="img_wrap" src="{{Illuminate\Support\Facades\Storage::url($album->patch)}}" alt="{{ Illuminate\Support\Facades\Storage::url($album->hash_name) }}"></a>
                            @endif
                        @endif
                    @endif
                    @if($addflag)
                        @if($loop->last)
                            <a class="mx-3" data-bs-target="#albumedit" role="button" data-bs-toggle="modal">
                                <span class="bi bi-plus-circle" style="font-size: 3.5rem; color: black; position: absolute"></span>
                            </a>
                            @include('inc.album.modal-edit',['action'=>0,'name'=>'Create'])
                        @endif
                    @endif
                @endforeach
            </figure>
        @else
            <a data-bs-target="#albumedit" role="button" data-bs-toggle="modal">
                <span class="bi bi-plus-circle" style="font-size: 3.5rem; color: black; position: absolute"></span>
            </a>
            @include('inc.album.modal-edit',['action'=>0,'name'=>'Create'])
        @endisset
    </div>
</div>


