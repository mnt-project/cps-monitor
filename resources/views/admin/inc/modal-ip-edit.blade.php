<div class="modal fade" id="ipedit" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('admin.ip.update', $ips) }}">
                @method('PUT')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addGroupModal">{{$ips->ip}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="ipName" class="sr-only">Ip name:</label>
                        <p><input name="ipName" id="ipName" class="form-control" value=""></p>
                        <label for="description" class="sr-only">Ip description:</label>
                        <p><input name="description" id="description" class="form-control" value=""></p>
                    </div>
                </div>
                <div class="modal-footer">
                    @if($ips->ban)
                        <button type="submit" class="btn btn-success" name="unban" value="1">Unban</button>
                    @else
                        <button type="submit" class="btn btn-danger" name="ban" value="1">Ban</button>
                    @endif
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
