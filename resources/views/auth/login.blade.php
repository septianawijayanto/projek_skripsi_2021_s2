@extends('auth.master')

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
            <option value="admin">Kepsek</option>
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
@endsection
