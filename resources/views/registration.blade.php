@extends('layouts.app')


@section('title-block')Registration @endsection

@section('content-header')
    <div class="container-fluid text-center"><i class="bi-key" style="font-size: 2rem; color: goldenrod; alignment: center"></i>
        <p>Registration</p>
    </div>

@endsection
@section('content-text')
    {{--<x-login-form pStatus=0 />--}}

    <div class="d-flex justify-content-center align-items-center container">
        <div class="row">
            <form action={{ route('user.registration') }} method="post">
                @csrf
                <div class="form-group">
                    <label for="login" class=" sr-only">Login:</label>
                    <p><input type="login" name="login" id="login" class="form-control" placeholder="Login" required autofocus></p>
                </div>
                <div class="form-group">
                    <label for="email" class=" sr-only">Email:</label>
                    <p><input type="email" name="email" id="email" class="form-control" placeholder="Email address" required autofocus></p>
                </div>
                <div class="form-group">
                    <label for="age" class=" sr-only">Age:</label>
                    <p><input type="number" name="age" id="age" class="form-control"></p>
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
                <div class="form-group row"> <button class="btn btn-lg btn-primary btn-block" type="submit">Registration</button></div>
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
@endsection
