<div class="modal fade" id="unitadd" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ ($action) ? route('album.unit.update',['album'=>$album,'unit'=>$albumunit]) :  route('album.unit.store',$album)}}" enctype="multipart/form-data">
                @if($action)@method('PATCH')
                @else @method('POST')
                @endif
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addGroupModal">{{$name}} album unit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="unitName" class="sr-only">Album unit name:</label>
                        @if($action)
                            <p><input name="unitName" id="unitName" class="form-control" value="{{$albumunit->name}}"></p>
                        @else
                            <p><input name="unitName" id="unitName" class="form-control" placeholder="Album unit name"></p>
                        @endif
                        <div class="form-group">
                            <div class="checkbox mb-3">
                                @if($action and $albumunit->public)
                                    <label><input name="public" type="checkbox" value=1 checked>Public</label>
                                @else
                                    <label><input name="public" type="checkbox" value=1 checked>Public</label>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox mb-3">
                                @if($action and $albumunit->open)
                                    <label><input name="open" type="checkbox" value=1 checked>Open</label>
                                @else
                                    <label><input name="open" type="checkbox" value=1 checked>Open</label>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox mb-3">
                                @if($action and $albumunit->visible)
                                    <label><input name="visible" type="checkbox" value=1 checked>Visible</label>
                                @else
                                    <label><input name="visible" type="checkbox" value=1 checked>Visible</label>
                                @endif
                            </div>
                        </div>
                        <label for="description" class="sr-only">Album description:</label>
                        @if($action)
                            <p><input name="description" id="description" class="form-control" value="{{$albumunit->description}}" required></p>
                        @else
                            <p><input name="description" id="description" class="form-control" placeholder="Album unit description" required></p>
                        @endif
                        <label for="avatar" class=" sr-only">Select Image:</label>
                        <p><input type="file" name="image" id="image"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    @if($action)
                        <form id="destroy-form" action="{{ route('album.unit.destroy',$album) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-group btn-danger">Delete</button>
                        </form>
                    @endif
                    <button type="submit" class="btn btn-primary">{{$name}}</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
