<div class="row mb-3">
    <div class="col-2">
        <button id="showDrop" type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ $lines[$show] }}
        </button>
        <ul class="dropdown-menu" aria-labelledby="showDrop">
            @for($i = 0; $i < sizeof($lines); $i++)
                <li><a class="dropdown-item {{($i == $show) ? 'active' : ''}}" href="{{route($route,[$argname=>$value,'show'=>$i,'sort'=>$sort,'method'=>$method])}}">{{ $lines[$i] }}</a></li>
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
                    <li><a class="dropdown-item {{($i == $sort) ? 'active' : ''}}" href="{{route($route,[$argname=>$value,'show'=>$show,'sort'=>$i,'method'=>$method])}}">{{ $sortname[$i] }}</a></li>
                @endfor
            </ul>
            <button id="methodDrop" type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                {{ $method }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="methodDrop">

                @foreach(['asc','desc'] as $i)
                    <li><a class="dropdown-item {{($i == $method) ? 'active' : ''}}" href="{{route($route,[$argname=>$value,'show'=>$show,'sort'=>$sort,'method'=>$i])}}">{{ $i }}</a></li>
                @endforeach
            </ul>
        </div>

    </div>
</div>
