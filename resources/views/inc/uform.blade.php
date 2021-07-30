<form action={{ route('user.save',$user->id) }} method="post">
    @csrf
    <div class="form-group">
        <label for="login" class=" sr-only">login:</label>
        <p><input name="login" id="login" class="form-control" value={{$user->login}} required></p>
    </div>
    <div class="form-group">
        <label for="email" class=" sr-only">Email:</label>
        <p><input type="email" name="email" id="email" class="form-control" value={{$user->email}} required></p>
    </div>
    <div class="form-group">
        <label for="age" class=" sr-only">Age:</label>
        <p><input type="number" name="age" id="age" class="form-control" value={{$user->age}}></p>
    </div>
    <div class="form-group">
        <label for="role" class=" sr-only">Role rights:</label>
        <p><select size="2" multiple name="role">
                @if($user->role)
                    <option selected value=1>Admin</option>
                    <option value=0>Default User</option>
                @else
                    <option value=1>Admin</option>
                    <option selected value=0>Default User</option>
                @endif
            </select>
        </p>
    </div>
    <div class="form-group">
        <label for="role" class=" sr-only">User group:</label>
        <p><select size="5" multiple name="group">
                @foreach($group as $el)
                    @if($el->id == $user->group)
                        <option selected value={{$el->id}}>{{ $el->name }}</option>
                    @else
                        <option value={{$el->id}}>{{ $el->name }}</option>
                    @endif
                @endforeach
            </select>
        </p>
    </div>
    <div class="form-group">
        <label for="password" class="sr-only">Password:</label>
        <p><input type="password" name="password" id="password" class="form-control" placeholder="Enter new password"></p>
        <div class="checkbox mb-3">
            <label>
                <input name="show_password" id="checkbox" type="checkbox" autocomplete="off" onclick="return showPasswordSwitcher(this);"> Show password
            </label>
        </div>
    </div>
    <div class="form-group">
        <div class="checkbox mb-3">
            <label>
                <input name="muted" type="checkbox" value=1> Muted status
            </label>
        </div>
    </div>
    <div class="form-group">
        <div class="checkbox mb-3">
            <label>
                <input name="admin" type="checkbox" value=1> Admin role
            </label>
        </div>
    </div>
    <div class="form-group"> <button class="btn btn-lg btn-primary btn-block" type="submit">Save</button></div>
</form>
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
