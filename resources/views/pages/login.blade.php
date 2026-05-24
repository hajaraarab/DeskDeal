@extends('layouts.website')
@section('title', 'Login')

@section('content')

    <h1>Login</h1>

    <div class="login">
        <form action="{{ route('login') }}" method="POST">

            @csrf 
            <input class="" type="email" name="loginemail" placeholder="Email">
            @error('loginemail')
                <p class="error">{{ $message }}</p>
            @enderror
            <input class="" type="password" name="loginpassword" placeholder="Password">
            @error('loginpassword')
                <p class="error">{{ $message }}</p>
            @enderror
            
            <button type="submit" class="">Login</button>
        </form>
    </div>

@endsection