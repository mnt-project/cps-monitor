<form action={{ route('post.create',$group) }} method="post">
    @csrf
    <div class="container col-8">
        <div class="row">
            <label for="post" class="form-label">Create new post!</label>
            <textarea class="form-control" name="post" id="post" rows="2" required>{{$text}}</textarea>
        </div>
        <div class="text-end">
            <input class="btn btn-primary mt-2" type="submit" value="Post" id="postbtn">
        </div>
    </div>

</form>

