{{--<ul class="list-group mb-5">--}}

<div class="list-unstyled text-center mb-4"><h4>Accounts</h4></div>
<div class="list-group">
    {{--        <li class="list-unstyled mb-4 text-center">--}}
    {{--            <h3>Regions</h3>--}}
    {{--        </li>--}}
    {{--            {{dd($data)}}--}}
    {{--            @for ($i = 0; $i < count($data); $i++)--}}
    {{--                The current value is {{ $data[$i]->login }}--}}
    {{--            @endfor--}}
    @foreach($data as $el)
        @if($el->id>0)
            @if($el->id === $user->id)
                <a class="list-group-item list-group-item-primary" href={{route('user.profile', $el->id)}}>{{ $el->login }}
                    @if ($el->isOnline())
                        <span class="badge bg-success">Online</span>
                    @endif
                </a>
            @else
                <a class="list-group-item list-group-item-action" href={{route('user.profile', $el->id)}}>{{ $el->login }}
                    @if ($el->isOnline())
                        <span class="badge bg-success">Online</span>
                    @endif
                </a>
            @endif
        @endif
    @endforeach
</div>

