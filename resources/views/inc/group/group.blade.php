<button data-target="#addGroup" role="button" class="btn btn-secondary" data-toggle="modal">New group</button>
<!-- Modal -->
<div class="modal fade" id="addGroup" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('group.add',isset($user) ? $user->id : 1) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addGroupModal">Create new group</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="groupName" class="sr-only">Group name:</label>
                        <p><input name="groupName" id="groupName" class="form-control" placeholder="Group name" required></p>
                        <div class="form-group">
                            <div class="checkbox mb-3">
                                <label><input name="public" type="checkbox" value=1> Public</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox mb-3">
                                <label><input name="open" type="checkbox" value=1> Open</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox mb-3">
                                <label><input name="invite" type="checkbox" value=1> Invite</label>
                            </div>
                        </div>
                        <label for="groupNotes" class="sr-only">Group notes:</label>
                        <p><input name="groupNotes" id="groupNotes" class="form-control" placeholder="Group notes" required></p>
                        <label for="groupAbout" class="sr-only">Group notes:</label>
                        <p><input name="groupAbout" id="groupAbout" class="form-control" placeholder="Group about" required></p>
                        <label for="avatar" class=" sr-only">Group avatar:</label>
                        <p><input type="file" name="avatar" id="avatar"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
