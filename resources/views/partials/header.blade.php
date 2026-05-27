<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Afacad:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">

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
        <a href="{{ route('login') }}" class="">Login</a>
        <a href="{{ route('register') }}" class="">Register</a>
    </div>
    @endguest

    @auth
    @endauth
</nav>