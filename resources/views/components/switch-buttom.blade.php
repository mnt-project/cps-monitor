<div class="col-lg-2 col-md-4 col-sm-4">
    <p class="mt-3"><strong>{{$slot}}:</strong></p>
</div>
<div class="col-lg-2 col-md-4 col-sm-4">
    @if($flag)
        <a class="text-dark" href="{{ $route }}" title="{{$labelfalse}}">
            <span class="bi bi-toggle-on" style="font-size: 2.5rem; color: black;"></span>
        </a>
    @else
        <a class="text-dark" href="{{ $route }}" title="{{$labeltrue}}">
            <span class="bi bi-toggle-off" style="font-size: 2.5rem; color: black;"></span>
        </a>
    @endif
</div>
<div class="col-lg-8 col-md-4 col-sm-4">
    @if($flag)
        <p class="text-success mt-3 text-lg-start"><strong>{{$labeltrue}}</strong></p>
    @else
        <p class="text-secondary mt-3 text-lg-start"><strong>{{$labelfalse}}</strong></p>
    @endif
</div>

