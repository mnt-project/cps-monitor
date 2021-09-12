<div class="modal fade" id="addAddress" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('admin.addressadd',$ipinfo->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addGroupModal">ID:{{ $ipinfo->id}} IP:[{{ $ipinfo->visitor}}]</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="titel" class="sr-only">Titel:</label>
                        <p><input type="text" name="titel" id="titel" class="form-control" required></p>
                        <label for="note" class="sr-only">Note:</label>
                        <p><input type="text" name="note" id="note" class="form-control" required></p>
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
