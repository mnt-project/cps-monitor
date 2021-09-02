<div class="modal fade" id="changeabout" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('user.about',$user) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addGroupModal">{{$user->login}} ID:[{{$user->id}}]</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="interests" class="sr-only">Interests:</label>
                        <p><input type="text" name="interests" id="interests" class="form-control" value="{{$user->parametr->interests}}" required></p>
                        <label for="about" class="sr-only">About:</label>
                        <p><input type="text" name="about" id="about" class="form-control" value="{{$user->parametr->about}}" required></p>
                        <label for="notes" class="sr-only">Notes:</label>
                        <p><input type="text"  name="notes" id="confirm_password" class="form-control" value="{{$user->parametr->notes}}" required></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Change</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
