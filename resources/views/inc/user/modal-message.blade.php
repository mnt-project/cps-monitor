<div class="modal fade" id="message" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('user.message.send',$user) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addGroupModal">Create message from {{$user->login}} ID:[{{$user->id}}]</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="subject">Subject:</label>
                        <p><input type="text" name="subject" id="subject" class="form-control" value="{{ old('subject') }}" required></p>
                        <label for="message">Message:</label>
                        <p><textarea class="form-control"  rows="3" cols="20" name="message" id="message" maxlength="250" value="{{ old('text') }}" required></textarea></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Send</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
