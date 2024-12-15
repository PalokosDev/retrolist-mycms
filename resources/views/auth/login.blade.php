@extends('layouts.app')

@section('content')
<style>
.login-container {
    max-width: 400px;
    margin: 60px auto;
    padding: 30px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
body.dark-mode .login-container {
    background: #1e1e1e;
    color: #ddd;
}
.login-container h4 {
    text-align: center;
    margin-bottom: 30px;
    font-weight: 700;
}
.login-container .input-field input {
    color:#333;
}
body.dark-mode .login-container .input-field input {
    color: #ccc;
    background: #333;
}
</style>

<div class="login-container">
    <h4>Login</h4>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="input-field">
            <input id="email" type="email" name="email" required autofocus value="{{ old('email') }}">
            <label for="email" class="active">E-Mail</label>
            @error('email')
               <span class="red-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="input-field">
            <input id="password" type="password" name="password" required>
            <label for="password" class="active">Passwort</label>
            @error('password')
               <span class="red-text">{{ $message }}</span>
            @enderror
        </div>

        <p>
            <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} />
                <span>Angemeldet bleiben</span>
            </label>
        </p>

        <button type="submit" class="btn blue w-100" style="width:100%;margin-top:20px;">
            Login
        </button>
    </form>
</div>
@endsection
