@extends('layouts.website')
@section('title', 'Register')

@section('content')

<h1>register step two</h1>

<form action="{{ route('register.step2.store') }}" method="POST" enctype="multipart/form-data">
    @csrf 

    <input type="text" name="company_name" placeholder="Company Name">
    @error('company_name')
        <p class="error">{{ $message }}</p>
    @enderror

    <input type="text" name="vat_number" placeholder="BTW Nummer">
    @error('vat_number')
        <p class="error">{{ $message }}</p>
    @enderror

    <input type="text" name="address" placeholder="Straat & Huisnummer">
    @error('address')
        <p class="error">{{ $message }}</p>
    @enderror
    
    <input type="number" name="postal_code" placeholder="Postcode">
    @error('postal_code')
        <p class="error">{{ $message }}</p>
    @enderror

    <input type="text" name="city" placeholder="Gemeente">
    @error('city')
        <p class="error">{{ $message }}</p>
    @enderror

    <button type="submit" class="">Volgende stap</button>

</form>
@endsection