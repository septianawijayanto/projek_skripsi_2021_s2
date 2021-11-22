@extends('auth.master')
@section('title', 'Digilib | Login')

@section('konten')
    <form class="form-auth-small" method="POST" action="{{ url('post/login') }}">
        @csrf
        <div class="form-group">
            <label for="signin-email" class="control-label sr-only">Username</label>
            <input type="text" id="username" name="username" class="form-control" required id="signin-email"
                value="{{ old('username') }}" placeholder="Username">

            @if ($errors->has('username'))
                <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="signin-password" class="control-label sr-only">Password</label>
            <input type="password" id="password" name="password" class="form-control" required id="signin-password"
                value="{{ old('password') }}" placeholder="Password">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <select class="form-control" name="masuk_sebagai" id="masuk_sebagai" required>
            <option value="">--Login Sebagai--</option>
            <option value="admin">Admin</option>
            <option value="anggota">Anggota</option>
        </select>
        <div class="form-group clearfix">
            <label class="fancy-checkbox element-left">
                <input type="checkbox">
                <span>Remember me</span>
            </label>
        </div>
        <button type="submit" id="btn-login" class="btn btn-primary btn-lg btn-block">Masuk</button>
        <div class="bottom">
            <span class="helper-text"><i class="fa fa-lock"></i> <a href="#">Forgot
                    password?</a></span>
        </div>
    </form>

@endsection
@section('scripts')
    <script>
        $("#username").keyup(function(e) {
            var username = .$("#username").val();
            if (username.length >= 5) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('post/login/cek-username/json') }}",
                    data: {
                        username: username
                    },
                    dataType: "JSON",
                    success: function(data) {
                        if (data.success) {
                            $("#username").removeClass("is-invalid");
                            $("#username").addClass("is-valid");
                            $("#password").val('');
                            $("#password").removeAttr("disabled", "disabled");
                        } else {
                            $("#username").removeClass("is-invalid");
                            $("#usenmae").addClass("is-invalid");
                            $("#password").val('');
                            $("#password").attr("disabled", "disabled");
                            $("#remember").attr("disabled", "disabled");
                            $("#btn-login").attr("disabled", "disabled");
                        }
                    },
                    error: function() {

                    }
                });
            } else {
                $("#username").removeClass("is-valid");
                $("#username").removeClass("is-invalid");
                $("#password").val('');
                $("#password").attr("disabled", "disabled");
                $("#remember").attr("disabled", "disabled");
                $("#btn-login").attr("disabled", "disabled");
            }
        });
    </script>
@endsection
