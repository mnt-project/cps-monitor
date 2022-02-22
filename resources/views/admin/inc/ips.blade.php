<div class="row">
    <table class="table table-striped table-hover text-center">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">IP:Adress</th>
            <th scope="col">Name</th>
            <th scope="col">User</th>
            <th scope="col">Rights</th>
            <th scope="col">Ban</th>
            <th scope="col">Description</th>
            <th scope="col">Connects</th>
            <th scope="col">Created</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ips as $ip)
            <tr class='clickable-row-table {{ $ip->ban ? 'bg-danger' : '' }}' data-href='{{route('admin.connects',$ip->ip)}}'>
                <th scope="row">{{ $ip->id }}</th>
                <td>{{ $ip->ip }}</td>
                <td>{{ $ip->name }}</td>
                <td>{{ $ip->user ? $ip->user->login : 'Guest'}}</td>
                <td>{{ $ip->rights }}</td>
                <td>{{ $ip->ban ?  date('Y-m-d / H:i:s', strtotime($ip->bandate)) : '-' }}</td>
                <td>{{ $ip->description }}</td>
                <td>
                    <span class="badge bg-secondary">{{ $ip->connect->count() }}</span>
                </td>
                <td>{{ date('Y-m-d / H:i:s', strtotime($ip->created_at)) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {{ $ips->links('vendor.pagination.bootstrap-4') }}
</div>
