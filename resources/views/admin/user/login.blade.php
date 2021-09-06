
<div class="d-flex justify-content-center align-items-center">
    <div class="row">

        <form action={{ route('user.login') }} method="post">
            @csrf
            <div class="form-group">
                <label for="login" class=" sr-only">Login:</label>
                <p><input type="email" name="email" id="login" class="form-control" placeholder="Login / Email address" required autofocus></p>
            </div>
            <div class="form-group">
                <label for="password" class="sr-only">Password:</label>
                <p><input type="password" name="password" id="password" class="form-control" placeholder="Password" required></p>
                <div class="checkbox mb-3">
                    <label>
                        <input name="show_password" id="checkbox" type="checkbox" autocomplete="off" onclick="return showPasswordSwitcher(this);"> Show password
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox mb-3">
                    <label>
                        <input name="remember" type="checkbox" value=1> Remember me
                    </label>
                </div>
            </div>
            <div class="form-group row"> <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button></div>
            <div class="form-group">
                <div class="row mt-2"><a href="{{ route('user.registration') }}" class="form-control btn btn-lg btn-secondary btn-block" type="button">Registration</a></div>
            </div>
        </form>
    </div>
</div>
<script>
    function showPasswordSwitcher(target)
    {
        var input = document.getElementById('password');
        var chekbox = document.getElementById('chekbox');
        if (input.getAttribute('type') == 'password')
        {
            target.classList.add('view');
            input.setAttribute('type', 'text');
            chekbox.checked = true;
        } else {
            target.classList.remove('view');
            input.setAttribute('type', 'password');
            chekbox.checked = false;
        }
        return false;
    }
</script>


