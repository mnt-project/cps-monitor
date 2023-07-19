<div class="modal fade" id="blogadd" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ ($action) ? route('blog.update',$blog) :  route('blog.store')}}" enctype="multipart/form-data">
                @if($action)@method('PATCH')
                @else @method('POST')
                @endif
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addGroupModal">{{$name}} blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="titel" class="sr-only">Blog titel:</label>
                        @if($action)
                            <p><input name="titel" id="titel" class="form-control" value="{{$blog->titel}}"></p>
                        @else
                            <p><input name="titel" id="titel" class="form-control" placeholder="Blog titel"></p>
                        @endif
                        <div class="form-group">
                            <div class="checkbox mb-3">
                                @if($action and $blog->hidden)
                                    <label><input name="hidden" type="checkbox" value=1 checked>Hidden</label>
                                @else
                                    <label><input name="hidden" type="checkbox" value=1 >Hidden</label>
                                @endif
                            </div>
                        </div>
                        <label for="text" class="sr-only">Blog text:</label>
                        @if($action)
                            <p><input name="text" id="text" class="form-control" value="{{$blog->text}}" required></p>
                        @else
                            <p><input name="text" id="text" class="form-control" placeholder="Write text ..." required></p>
                        @endif
                        <label for="pic" class=" sr-only">Select Image:</label>
                        <p><input type="file" name="pic" id="pic"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    @if($action)
                        <form id="destroy-form" action="{{ route('blog.destroy',$blog) }}" method="POST">
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
