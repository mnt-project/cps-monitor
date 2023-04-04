<div class="modal fade" id="{{'connects_'.$loop->iteration}}" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGroupModal">ID:{{ $ip->id}} IP:[{{ $ip->ip}}]</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="table" class="table table-striped table-hover text-center" aria-hidden="true">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">IP:Adress</th>
                            <th scope="col">UserId</th>
                            <th scope="col">route</th>
                            <th scope="col">Agent</th>
                            <th scope="col">Created</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ip->connect as $connect)
                            <tr class='text-center' data-bs-target="#{{'connects_'.$loop->iteration }}" role="button" data-bs-toggle="modal">
                                <th scope="row">{{ $connect->ip_id }}</th>
                                <td>{{ $connect->visitor }}</td>
                                <td>{{ $connect->user_id }}</td>
                                <td>{{ $connect->route}}</td>
                                <td>{{ $connect->agent }}</td>
                                <td>{{ date('Y-m-d / H:i:s', strtotime($ip->created_at)) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>
