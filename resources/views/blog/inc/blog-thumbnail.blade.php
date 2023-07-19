@if(!$blog->hidden)
    <a href="{{route('blog.show',$blog)}}" class="link_text">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-4">
                    <img class="figure img-thumbnail" src={{ Illuminate\Support\Facades\Storage::url($blog->patch) }} alt="{{ Illuminate\Support\Facades\Storage::url($blog->patch) }}">
                </div>
                <div class="col-8">
                    <div class="card-body">
                        <span class="badge {{$blog->hidden ? 'bg-primary' : 'bg-warning'}}">{{$blog->public ? 'public' : 'limited'}}</span>
                        <span class="badge {{$blog->checked ? 'bg-success' : 'bg-danger'}}">{{$blog->checked ? 'checked' : 'lock'}}</span>
                        <span class="badge {{$blog->blocked ? 'bg-danger' : 'bg-success'}}">{{$blog->blocked ? 'blocked' : 'checked'}}</span>

                        <h5 class="card-title">{{$blog->titel}}</h5>
                        <p class="card-text">{{ $blog->text }}</p>
                        <p class="card-text"><small class="text-body-secondary">{{ \Carbon\Carbon::parse($blog->created_at)->format('d.m.Y H:i')}}</small></p>
                    </div>
                </div>
            </div>
        </div>
    </a>

@endif
