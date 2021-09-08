@if($group->post->count()<1)
    <div class="text-center mt-5">
        <h1><i>No posts</i></h1>
    </div>
@endif
@foreach($group->post as $post)
    <div class="container col-md-8 col-lg-10">
        <div class="bg-light border my-2">
            <div class="container">
                <div class="row">
                    <div class="col-2">
                        <a href={{ route('user.info',$post->user->id) }}><span class="bi bi-person-circle">{{$post->user->login}}</span></a>
                    </div>
                    <div class="col-6 text-start">

                    </div>
                    <div class="col-4 text-end">
                        <a class="bi bi-reply-fill" href="{{route('group.info',['group'=>$post->group_id,'text'=>$post->description])}}"></a>
                        <a class="bi bi-x-square-fill text-danger ms-3" href={{route('post.delete',$post->id)}}></a>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col mb-3  ">
                                <p>{{$post->description}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 text-start">
                            <i class="bi bi-calendar"></i> {{\Carbon\Carbon::parse($post->created_at)->format('d.m.Y H:i')}}
                    </div>

                    <div class="col-8 text-end">
                        <p>
                            <a class="bi bi-folder text-black-50" href={{route('group.info',$post->group->id)}}></a><i>{{$post->group->name}}</i>
                            <a class="bi bi-plus-circle ms-3" href={{route('post.reputation', ['post'=>$post->id,'value'=>1])}}></a>{{$post->plus}}
                            / <a class="bi bi-patch-minus" href={{route('post.reputation', ['post'=>$post->id,'value'=>-1])}}></a>{{$post->minus}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

