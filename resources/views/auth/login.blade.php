@extends('layouts.app')
@section('content')
    <h1>Login</h1>
    @if ($errors->any())
        <p class="error">{{ $errors->first() }}</p>
    @endif
    <form method="POST" action="/login">
        @csrf
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit" class="btn">Login</button>
    </form>
@endsection