{{--<i class="{{ $icon_type($status) }}" style="font-size: 1.5rem; color: grey;"></i>--}}
{{--<a class="nav-link d-inline" href={{ route($get_route($status)) }} >{{ $get_button_name($status) }}</a>--}}

<a type="button" class="btn btn-outline-light" style="color: grey;" href={{ route($get_route($status)) }}><i class="{{ $icon_type($status)}} {{ $get_button_name($status) }} me-2" ></i>{{ $get_button_name($status) }}</a>

