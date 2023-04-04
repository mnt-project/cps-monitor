<div class="modal fade" id="albumedit" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ ($action) ? route('album.update', $album) :  route('album.store')}}" enctype="multipart/form-data">
                @if($action)@method('PATCH')
                @else @method('POST')
                @endif
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addGroupModal">{{$name}} album</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="groupName" class="sr-only">Album name:</label>
                        @if($action)
                            <p><input name="AlbumName" id="groupName" class="form-control" value="{{$album->name}}" required></p>
                        @else
                            <p><input name="AlbumName" id="groupName" class="form-control" placeholder="Album name" required></p>
                        @endif
                        <div class="form-group">
                            <div class="checkbox mb-3">
                                @if($action and $album->public)
                                    <label><input name="public" type="checkbox" value=1 checked>Public</label>
                                @else
                                    <label><input name="public" type="checkbox" value=1 checked>Public</label>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox mb-3">
                                @if($action and $album->open)
                                    <label><input name="open" type="checkbox" value=1 checked>Open</label>
                                @else
                                    <label><input name="open" type="checkbox" value=1 checked>Open</label>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox mb-3">
                                @if($action and $album->visible)
                                    <label><input name="visible" type="checkbox" value=1 checked>Visible</label>
                                @else
                                    <label><input name="visible" type="checkbox" value=1 checked>Visible</label>
                                @endif
                            </div>
                        </div>
                        <label for="description" class="sr-only">Album description:</label>
                        @if($action)
                            <p><input name="description" id="description" class="form-control" value="{{$album->description}}" required></p>
                        @else
                            <p><input name="description" id="description" class="form-control" placeholder="Album description" required></p>
                        @endif
                        <label for="avatar" class=" sr-only">Album avatar:</label>
                        <p><input type="file" name="avatar" id="avatar"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    @if($action)
                        @if($albums->count() > 1)
                            <form id="destroy-form" action="{{ route('album.destroy',$album) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-group btn-danger">Delete</button>
                            </form>
                        @endif
                    @endif
                    <button type="submit" class="btn btn-primary">{{$name}}</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
