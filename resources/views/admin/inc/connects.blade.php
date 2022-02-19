<div class="row mb-3">
    <div class="col-2">
        <button id="showDrop" type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ $lines[$show] }}
        </button>
        <ul class="dropdown-menu" aria-labelledby="showDrop">
            @for($i = 0; $i < sizeof($lines); $i++)
                <li><a class="dropdown-item {{($i == $show) ? 'active' : ''}}" href="{{route('admin.connects',['ip'=>$ips,'show'=>$i,'sort'=>$sort,'method'=>$method])}}">{{ $lines[$i] }}</a></li>
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
                    <li><a class="dropdown-item {{($i == $sort) ? 'active' : ''}}" href="{{route('admin.connects',['ip'=>$ips,'show'=>$show,'sort'=>$i,'method'=>$method])}}">{{ $sortname[$i] }}</a></li>
                @endfor
            </ul>
            <button id="methodDrop" type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                {{ $method }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="methodDrop">
                @foreach(['asc','desc'] as $i)
                    <li><a class="dropdown-item {{($i == $method) ? 'active' : ''}}" href="{{route('admin.connects',['ip'=>$ips,'show'=>$show,'sort'=>$sort,'method'=>$i])}}">{{ $i }}</a></li>
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
