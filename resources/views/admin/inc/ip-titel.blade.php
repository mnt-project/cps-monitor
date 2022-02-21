<div class="card {{ $ips->ban ? 'border-danger' : 'border-dark' }} mt-5">
    <div class="card-body ">
        <div class="card-header mt-2">
            <p>{{ $ips->ip }}</p>
            <p>{{ $ips->name }}</p>
        </div>
        <div class="card-title text-center mt-4">
            <a class="link_text" href="{{ route('user.info',$ips->user->id) }}"><span class="bi bi-person-circle">{{ $ips->user->login }}</span></a>
        </div>
        <div class="card-text">
            <p class="text-center">{{ $ips->description }}</p>
            <p>Created at: {{ $ips->created_at->format('d.m.Y H:i')}}</p>
        </div>
        <div class="card-text">

            @if($ips->ban && $ips->bandate->gt(\Carbon\Carbon::now()))
                <p class="bg-warning">Unbane date: {{ $ips->bandate->format('d.m.Y H:i') }}</p>
            @endif
        </div>
        <div class="card-text mt-4">
        @if(\Carbon\Carbon::now()->diffInHours($ips->updated_at,false)>0))
            <small class="text-muted">Last update
                {{ \Carbon\Carbon::now()->diffInHours($ips->updated_at,false)*-1>1000 ? \Carbon\Carbon::now()->diffInYears($ips->updated_at,false)*-1 : \Carbon\Carbon::now()->diffInHours($ips->updated_at,false)*-1}}
                {{ \Carbon\Carbon::now()->diffInHours($ips->updated_at,false)*-1>1000 ? ' years' : ' hours' }} ago...
            </small>
        @else
            @if(\Carbon\Carbon::now()->diffInMinutes($ips->updated_at,false)*-1>0)
                <small class="text-muted">Last update
                    {{ \Carbon\Carbon::now()->diffInMinutes($ips->updated_at,false)*-1}}
                    minutes ago...
                </small>
            @else
                <small class="text-muted">Last update
                    {{ \Carbon\Carbon::now()->diffInSeconds($ips->updated_at,false)*-1}}
                    seconds ago...
                </small>
            @endif
        @endif
        </div>
        <div class="card-footer border-dark mt-1">
            <div class="row">
                <div class="col">
                    <a class="btn btn-secondary btn-sm mt-1" href={{route('admin.connects','all')}}>Back</a>
                </div>
                <div class="col">
                    <a class="btn btn-primary btn-sm mt-1" data-target="#ipedit" role="button" data-toggle="modal">Edit</a>
                    @include('admin.inc.modal-ip-edit')
                </div>
                <div class="col">
                    <form action="{{ route('admin.ip.destroy',$ips) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm text-center mt-1">Clear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

