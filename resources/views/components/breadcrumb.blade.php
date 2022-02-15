<nav style="--bs-breadcrumb-divider: '<';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach($links as $link)
            <li class="{{ $loop->last ? 'breadcrumb-item active' : 'breadcrumb-item'}}" aria-current="{{ $loop->last ? 'page' : ''}}">
                @if($loop->last)
                    {{$link['name']}}
                @else
                    <a class="link_text" href="{{route($link['route'],$link['id'])}}">{{$link['name']}}</a>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
