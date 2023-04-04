<div class="modal fade" id="changepass" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('user.password',$user)}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addGroupModal">{{$user->login}} ID:[{{$user->id}}]</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="old_password" class="sr-only">Current password:</label>
                        <p><input type="password" name="old_password" id="old_password" class="form-control" placeholder="Password" required></p>
                        <label for="new_password" class="sr-only">New password:</label>
                        <p><input type="password" name="new_password" id="new_password" class="form-control" placeholder="Password" required></p>
                        <label for="confirm_password" class="sr-only">Confirm new password:</label>
                        <p><input type="password"  name="confirm_password" id="confirm_password" class="form-control" placeholder="Password" required></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Change</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
