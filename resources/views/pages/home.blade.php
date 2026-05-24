@extends('layouts.website')
@section('title', 'Home')

@section('content')
    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <h1>Home</h1>
    
@endsection