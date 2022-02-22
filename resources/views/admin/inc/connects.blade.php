<div class="row">
    <table class="table table-striped table-hover text-center">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">IP:Adress</th>
            <th scope="col">User</th>
            <th scope="col">Agent</th>
            <th scope="col">route</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($connects as $connect)
            <tr class='clickable-row-table' data-href="#">
                <th scope="row">{{ $connect->id }}</th>
                <td>{{ $connect->visitor }}</td>
                <td>{{ $connect->user ? $connect->user->login : 'Guest'}}</td>
                <td>{{ $connect->agent}}</td>
                <td>{{ $connect->route }}</td>
                <td>{{ date('Y-m-d / H:i:s', strtotime($connect->created_at)) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {{ $connects->links('vendor.pagination.bootstrap-4') }}
</div>
