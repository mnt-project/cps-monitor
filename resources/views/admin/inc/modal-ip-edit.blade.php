<div class="modal fade" id="ipedit" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('admin.ip.update', $ips) }}">
                @method('PUT')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addGroupModal">{{$ips->ip}}</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="ipName" class="sr-only">Ip name:</label>
                        <p><input name="ipName" id="ipName" class="form-control" value=""></p>
                        <div class="form-group">
                            <div class="checkbox mb-3">
                                @if($ips->ban)
                                    <label><input name="unban" type="checkbox" value=1>Unban</label>
                                @else
                                    <label><input name="ban" type="checkbox" value=1>Ban</label>
                                @endif
                            </div>
                        </div>
                        <label for="description" class="sr-only">Ip description:</label>
                        <p><input name="description" id="description" class="form-control" value=""></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
