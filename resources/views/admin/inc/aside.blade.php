<div class="list-unstyled text-center mb-4"><h4>Main menu</h4></div>
<div class="list-group">
    @foreach($items as $item)
        <a class="list-group-item {{$loop->iteration == $itemid ? 'list-group-item-dark' : ''}}" href={{route('admin.'.mb_strtolower($item))}}>{{$item}}</a>
    @endforeach
</div>
