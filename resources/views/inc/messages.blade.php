@guest
    @if(session('guest'))
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast bg-warning" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Warning</strong>
                    <small class="text-muted">{{\Carbon\Carbon::now()}}</small>
                    <button type="button" class="btn-close" data-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('warning') }}
                </div>
            </div>
        </div>
    @endif
@endguest
@if(session('notifications'))
    @if(session('success'))
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast hide bg-success" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Success</strong>
                    <small class="text-muted">{{\Carbon\Carbon::now()}}</small>
                    <button type="button" class="btn-close" data-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif
    @if(session('info'))
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast hide bg-info" role="status" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Info</strong>
                    <small class="text-muted">{{\Carbon\Carbon::now()}}</small>
                    <button type="button" class="btn-close" data-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('info') }}
                </div>
            </div>
        </div>
    @endif
    @if(session('warning'))
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast bg-warning" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Warning</strong>
                    <small class="text-muted">{{\Carbon\Carbon::now()}}</small>
                    <button type="button" class="btn-close" data-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('warning') }}
                </div>
            </div>
        </div>
    @endif
@endif
@if($errors->any())
    @foreach($errors->all() as $error)
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Error!</strong>
                    <small class="text-muted">{{\Carbon\Carbon::now()}}</small>
                    <button type="button" class="btn-close" data-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ $error }}
                </div>
            </div>
        </div>
    @endforeach
@endif
