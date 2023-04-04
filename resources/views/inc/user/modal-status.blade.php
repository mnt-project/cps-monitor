<div class="modal fade" id="status" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('user.smessage',$user) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="status">Change status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="statusMessage" class="form-label">Enter status message:</label>
                    @if($message == 'null')
                        <input type="text" maxlength="64" class="form-control" name="statusMessage" id="statusMessage" placeholder="Enter new message">
                    @else
                        <input type="text" maxlength="64" class="form-control" name="statusMessage" id="statusMessage" placeholder="{{ $message }}">
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
