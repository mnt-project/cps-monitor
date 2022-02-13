<div class="modal fade" id="album" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action={{ route('album.unit.store',$group->id) }} enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add new image</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input class="form-control" type="file" name="album">
                    </div>
                    <div class="row mt-3">
                        <label for="discription" class="form-label">Enter discription:</label>
                        <input type="text" maxlength="64" class="form-control" name="discription" id="discription" placeholder="Enter discription">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
