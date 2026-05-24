@extends('layouts.website')
@section('title', 'Register')

@section('content')

<h1>register step three</h1>

<form action="{{ route('register.step3.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="file" name="profile_picture">
    @error('profile_picture')
        <p class="error">{{ $message }}</p>
    @enderror

    <button type="submit" class="">Voltooien</button>
</form>

@endsection