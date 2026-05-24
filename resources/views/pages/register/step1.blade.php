@extends('layouts.website')
@section('title', 'Register')

@section('content')

<h1>register step one</h1>

<form action="{{ route('register.step1.store') }}" method="POST" >
    @csrf 

    <input class="" type="text" name="first_name" placeholder="First Name">
    <br>
    @error('first_name')
        <p class="error">{{ $message }}</p>
    @enderror

    <br>

    <input class="" type="text" name="last_name" placeholder="Last Name">
    <br>
    @error('last_name')
        <p class="error">{{ $message }}</p>
    @enderror

    <br>

    <input class="" type="email" name="email" placeholder="Email">
    <br>
    @error('email')
        <p class="error">{{ $message }}</p>
    @enderror

    <br>

    <input class="" type="password" name="password" placeholder="Password">
    <br>
    @error('password')
        <p class="error">{{ $message }}</p>
    @enderror

    <br>

    <button type="submit" class="">Maak een account aan</button>
</form>

@endsection