<div class="modal fade" id="addGroup" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ ($group) ? route($route, $group->id) :  route($route)}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addGroupModal">{{$name}} group</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="groupName" class="sr-only">Group name:</label>
                        @if($action)
                            <p><input name="groupName" id="groupName" class="form-control" value="{{$group->name}}" required></p>
                        @else
                            <p><input name="groupName" id="groupName" class="form-control" placeholder="Group name" required></p>
                        @endif
                        <div class="form-group">
                            <div class="checkbox mb-3">
                                @if($action and $group->public)
                                    <label><input name="public" type="checkbox" value=1 checked>Public</label>
                                @else
                                    <label><input name="public" type="checkbox" value=1>Public</label>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox mb-3">
                                @if($action and $group->open)
                                    <label><input name="open" type="checkbox" value=1 checked>Open</label>
                                @else
                                    <label><input name="open" type="checkbox" value=1>Open</label>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox mb-3">
                                @if($action and $group->invite)
                                    <label><input name="invite" type="checkbox" value=1 checked>Invite</label>
                                @else
                                    <label><input name="invite" type="checkbox" value=1>Invite</label>
                                @endif
                            </div>
                        </div>
                        <label for="groupNotes" class="sr-only">Group notes:</label>
                        @if($action)
                            <p><input name="groupNotes" id="groupNotes" class="form-control" value="{{$group->notes}}" required></p>
                        @else
                            <p><input name="groupNotes" id="groupNotes" class="form-control" placeholder="Group notes" required></p>
                        @endif
                        <label for="groupAbout" class="sr-only">Group about:</label>
                        @if($action)
                            <p><input name="groupAbout" id="groupAbout" class="form-control" value="{{$group->about}}" required></p>
                        @else
                            <p><input name="groupAbout" id="groupAbout" class="form-control" placeholder="Group about" required></p>
                        @endif
                        <label for="avatar" class=" sr-only">Group avatar:</label>
                        <p><input type="file" name="avatar" id="avatar"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{$name}}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
