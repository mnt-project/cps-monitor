@if(!$blog->hidden)
   {{-- <a href="{{route('blog.show',$blog)}}" class="link_text">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-2">
                    <img class="img_wrap" src={{ Illuminate\Support\Facades\Storage::url($blog->patch) }} alt="{{ Illuminate\Support\Facades\Storage::url($blog->patch) }}">

                </div>
                <div class="col-8">
                    <h5 class="card-title">{{$blog->titel}}</h5>
                    <p class="card-text">{{ $blog->text }}</p>
                    <p class="card-text"><small class="text-body-secondary">{{ \Carbon\Carbon::parse($blog->created_at)->format('d.m.Y H:i')}}</small></p>
                </div>
                @auth
                    @isadmin(Illuminate\Support\Facades\Auth::user())
                    <div class="col-2">
                        <span class="badge {{$blog->hidden ? 'bg-primary' : 'bg-warning'}}">{{$blog->public ? 'public' : 'limited'}}</span>
                        <span class="badge {{$blog->checked ? 'bg-success' : 'bg-danger'}}">{{$blog->checked ? 'checked' : 'lock'}}</span>
                        <span class="badge {{$blog->blocked ? 'bg-danger' : 'bg-success'}}">{{$blog->blocked ? 'blocked' : 'checked'}}</span>
                    </div>
                    @endisadmin
                @endauth
            </div>
        </div>
    </a>--}}
   {{--<div class="container">
       <div class="half-post-entry d-block d-lg-flex bg-light">
           <div class="img-bg" style="background-image: {{ Illuminate\Support\Facades\Storage::url('no-pic.jpg') }}"></div>
           <div class="contents">
               <span class="caption">Editor's Pick</span>
               <h2><a href="{{route('blog.show',$blog)}}">{{$blog->titel}}</a></h2>
               <p class="mb-3">{{ $blog->text }}</p>
               <div class="post-meta">
                   <span class="d-block"><a href="#">{{$blog->user->login}}</a> in <a href="#">Food</a></span>
                   <span class="date-read"> {{ \Carbon\Carbon::parse($blog->created_at)->format('d.m.Y H:i')}} <span class="icon-star2"></span></span>
               </div>
           </div>
       </div>
   </div>
--}}

   <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
       <div class="col p-4 d-flex flex-column position-static">
           <strong class="d-inline-block mb-2 text-secondary">
               <p>{{$blog->user->login}}</p>
           </strong>
           <h3 class="mb-0">{{$blog->titel}}</h3>
           <div class="mb-1 text-muted">{{ \Carbon\Carbon::parse($blog->created_at)->format('d.m.Y H:i')}}</div>
           <p class="card-text mb-auto">{{ $blog->text }}</p>
           <p><span class="badge {{$blog->hidden ? 'bg-primary' : 'bg-warning'}}">{{$blog->public ? 'public' : 'limited'}}</span>
               <span class="badge {{$blog->checked ? 'bg-success' : 'bg-danger'}}">{{$blog->checked ? 'checked' : 'lock'}}</span>
               <span class="badge {{$blog->blocked ? 'bg-danger' : 'bg-success'}}">{{$blog->blocked ? 'blocked' : 'checked'}}</span></p>
           <p><a href="{{route('blog.show',$blog)}}" class="stretched-link">Continue reading</a></p>
       </div>
       <img class="img-fluid img-thumbnail" style="max-width:20%;" src={{ Illuminate\Support\Facades\Storage::url($blog->patch) }} alt="{{ Illuminate\Support\Facades\Storage::url($blog->patch) }}">
   </div>
@endif

