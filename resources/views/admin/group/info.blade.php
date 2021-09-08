<h3 class="text-center text-info">Members</h3>
<ul class="list-group">
    @foreach($group->follow as $follower)
        <a class="list-group-item list-group-item-action" href={{ route('user.info',$follower->user->id) }}>
            <span class="bi bi-person-circle">{{ $follower->user->login }}</span>
            @if($follower->user->id === $group->user_id)
                <span class="badge bg-danger">creator</span>
            @else
                <span class="badge primary">subscriber</span>
            @endif
        </a>
    @endforeach
</ul>
