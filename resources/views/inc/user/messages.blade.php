<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Sender</th>
        <th scope="col">Subject</th>
        <th scope="col">Create</th>
        <th scope="col">Delete</th>
    </tr>
    </thead>
    <tbody>
    @foreach($user->messages as $message)
        <tr class="clickable-row-table @if(!$message->readed) table-success @endif data-href="{{ route('user.info',$message->sender_id) }}">
            <th scope="row">{{$loop->iteration}}</th>
            <td><span class="bi bi-person-circle">{{ $message->user->login }}</span></td>
            <td><b>{{ $message->subject }}</b></td>
            <td>{{ $message->created_at->format('d.m.Y H:i') }}</td>
            <td><a class="text-dark" href="{{ route('user.message.delete',$message->id) }}"><span class="bi bi-trash"></span></a></td>
        </tr>

    @endforeach
    </tbody>
</table>
