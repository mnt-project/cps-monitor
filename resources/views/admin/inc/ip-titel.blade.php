<div class="card {{ $ips->ban ? 'border-danger' : 'border-dark' }} mt-5">
    <div class="card-body ">
        <div class="card-header mt-2">
            <p>{{ $ips->ip }}</p>
            <p>{{ $ips->name }}</p>
        </div>
        <div class="card-title text-center mt-4">
            @isset($ips->user)
                <a class="link_text" href="{{ route('user.info',$ips->user->id) }}"><span class="bi bi-person-circle">{{ $ips->user->login }}</span></a>
            @else
                <a class="link_text" href="#"><span class="bi bi-person-circle">Guest</span></a>
            @endisset
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
        @if(\Carbon\Carbon::now()->diffInHours($ips->updated_at)>0)

            <small class="text-muted">Last update
                {{ \Carbon\Carbon::now()->diffInHours($ips->updated_at)>1000 ? \Carbon\Carbon::now()->diffInYears($ips->updated_at) : \Carbon\Carbon::now()->diffInHours($ips->updated_at)}}
                {{ \Carbon\Carbon::now()->diffInHours($ips->updated_at)>1000 ? ' years' : ' hours' }} ago...
            </small>
        @else
            @if(\Carbon\Carbon::now()->diffInMinutes($ips->updated_at)>0)
                <small class="text-muted">Last update
                    {{ \Carbon\Carbon::now()->diffInMinutes($ips->updated_at)}}
                    minutes ago...
                </small>
            @else
                <small class="text-muted">Last update
                    {{ \Carbon\Carbon::now()->diffInSeconds($ips->updated_at)}}
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
                    <a class="btn btn-danger btn-sm mt-1" data-target="#clearlog" role="button" data-toggle="modal">Clear</a>
                    @include('admin.inc.modal-clearlog')
                </div>
            </div>
        </div>
    </div>
</div>

