@if($albumunit->visible)
    <div class="col-xxl-2 col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 border mx-2 my-2">
        <a data-target="#{{'unit_'.$loop->iteration}}" role="button" data-toggle="modal">
            <figure class="figure mt-2">
                <img class="figure img-thumbnail" src={{ Illuminate\Support\Facades\Storage::url($albumunit->patch) }} alt="{{ Illuminate\Support\Facades\Storage::url($albumunit->patch) }}">
                <figcaption class="figure-caption text-center">
                    <div class="row mt-1">
                        <p>
                            <span class="badge {{$albumunit->public ? 'bg-primary' : 'bg-warning'}}">{{$albumunit->public ? 'public' : 'limited'}}</span>
                            <span class="badge {{$albumunit->open ? 'bg-success' : 'bg-danger'}}">{{$albumunit->open ? 'open' : 'lock'}}</span>
                            <span class="badge {{$albumunit->blocked ? 'bg-danger' : 'bg-success'}}">{{$albumunit->blocked ? 'blocked' : 'checked'}}</span>
                        </p>
                    </div>
                    <div class="row">
                        <div class="d-block d-sm-block d-md-none d-lg-none d-xl-none d-xxl-block">
                            <p>{{$albumunit->name}}</p>
                            <p>{{$albumunit->discription}}</p>
                        </div>
                    </div>
                </figcaption>
            </figure>
        </a>
        @include('inc.album.modal-unit')
    </div>
@endif
@if($loop->last)
    <div class="col-xxl-2 col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 border mx-2 my-2">
        <a data-target="#unitadd" role="button" data-toggle="modal">
            <img class="img-fluid my-5" src="{{Illuminate\Support\Facades\Storage::url('add-picture.png')}}" alt="{{ Illuminate\Support\Facades\Storage::url('add-picture.png') }}">
        </a>
        @include('inc.album.modal-unitadd',['action'=>0,'name'=>'Create'])
    </div>
@endif
