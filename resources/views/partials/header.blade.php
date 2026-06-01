<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Afacad:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

    @vite(['resources/scss/index.scss', 'resources/js/app.js'])

    <title>DeskDeal</title>
</head>
<body>

<nav>
    <div class="logo">
        <img class="logo-img" src="{{ asset('/images/logo.png') }}" alt="DeskDeal Logo">
        <h4><a href="{{ route('home') }}">DeskDeal</a></h4>
    </div>
    <ul>
        <li><a href="{{ route('home') }}" class="h6 {{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
        <li><a href="{{ route('about') }}" class="h6 {{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
        <li><a href="{{ route('marketplace') }}" class="h6 {{ request()->routeIs('marketplace') ? 'active' : '' }}">Marketplace</a></li>
        <li><a href="{{ route('contact') }}" class="h6 {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
    </ul>

    @guest
    <div class="user-menu">
        <a class="primary-btn darkblue body-md" href="{{ route('register') }}" class="">Register</a>
        <a class="primary-btn border body-md" href="{{ route('login') }}" class="">Login</a>
    </div>
    @endguest

    @auth
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" >Logout</button>
    </form> 
    @endauth
</nav>

@if(session('success'))
    <div class="alert success body-sm">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert error body-sm">
        {{ session('error') }}
    </div>
@endif