<div class="row mb-3">
    <div class="col-2">
        <button id="showDrop" type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ $lines[$show] }}
        </button>
        <ul class="dropdown-menu" aria-labelledby="showDrop">
            @for($i = 0; $i < sizeof($lines); $i++)
                <li><a class="dropdown-item {{($i == $show) ? 'active' : ''}}" href="{{route('admin.connects',['ip'=>'all','show'=>$i,'sort'=>$sort,'method'=>$method])}}">{{ $lines[$i] }}</a></li>
            @endfor
        </ul>
    </div>
    <div class="col-8">

    </div>
    <div class="col-2">
        <div class="btn-group" role="group">
            <button id="sortDrop" type="button" class="btn btn-outline-dark dropdown-toggle me-1" data-toggle="dropdown" aria-expanded="false">
                {{ $sortname[$sort] }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="sortDrop">

                @for($i = 0; $i < sizeof($sortname); $i++)
                    <li><a class="dropdown-item {{($i == $sort) ? 'active' : ''}}" href="{{route('admin.connects',['ip'=>'all','show'=>$show,'sort'=>$i,'method'=>$method])}}">{{ $sortname[$i] }}</a></li>
                @endfor
            </ul>
            <button id="methodDrop" type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                {{ $method }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="methodDrop">

                @foreach(['asc','desc'] as $i)
                    <li><a class="dropdown-item {{($i == $method) ? 'active' : ''}}" href="{{route('admin.connects',['ip'=>'all','show'=>$show,'sort'=>$sort,'method'=>$i])}}">{{ $i }}</a></li>
                @endforeach
            </ul>
        </div>

    </div>
</div>
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
            <tr class='clickable-row-table' data-href='{{route('admin.connects',$ip->ip)}}'>
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
