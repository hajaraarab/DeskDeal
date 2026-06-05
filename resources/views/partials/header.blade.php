@php
    $user = auth()->user();
@endphp

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

<nav class="nav">
    <div class="logo">
        <img class="logo-img" src="{{ asset('/images/logo.png') }}" alt="DeskDeal Logo">
        <h4><a href="{{ route('home') }}">DeskDeal</a></h4>
    </div>

    <div class="desktop-menu">
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
        <div class="user-menu">
            <a class="header-actions" href="">
                <img src="{{ asset('/images/icons/notifications.png') }}" alt="">
            </a>

            <a class="header-actions" href="{{ route('profile.show') }}">
                <img src="{{ asset('/images/icons/people.png') }}" alt="">
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="logout-btn" type="submit">
                    <img src="{{ asset('/images/icons/logout.png') }}" alt="">
                </button>
            </form> 
        </div>
        @endauth
    </div>

    @auth
    <div class="user-menu">

        <a class="header-actions mobile" href="{{ route('profile.show') }}">
            <img src="{{ asset('/images/icons/people.png') }}" alt="">
        </a>

    </div>
    @endauth

    <button id="hamburger-btn" class="hamburger-btn">
        <img src="{{ asset('/images/icons/hamburger.png') }}" alt="">
    </button>
</nav>

<div id="user-menu-side" class="user-menu-side">

    <div class="user-menu-header">
        <div class="logo">
            <img class="logo-img" src="{{ asset('/images/logo.png') }}" alt="DeskDeal Logo">
            <h5><a href="{{ route('home') }}">DeskDeal</a></h5>
        </div>
        
        <button id="user-menu-close-btn" class="hamburger-btn">
            <img src="{{ asset('/images/icons/close.png') }}" alt="Close menu">
        </button>
    </div>

    @auth
    <div class="user-info">
        <div class="profile-picture">
            <h4>{{ strtoupper(substr($user->firstname, 0, 1)) }}{{ strtoupper(substr($user->lastname, 0, 1)) }}</h4>
        </div>

        <div class="user-info-text">
            <p class="body-sm">{{ $user->firstname }} {{ $user->lastname }} </p>
            <p class="">Bekijk je profiel</p>
        </div>
    </div>
    @endauth

    <div class="link-to-page" data-href=" {{ route('home')}} ">
        <div class="icon-wrapper">
            <img src="{{ asset('/images/icons/home.png') }}" alt="">
        </div>

        <a href="{{ route('home') }}" class="h6 {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
    </div>

    <div class="link-to-page" data-href=" {{ route('about') }}">
        <div class="icon-wrapper">
            <img src="{{ asset('/images/icons/about.png') }}" alt="">
        </div>

        <a href="{{ route('about') }}" class="h6 {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
    </div>

    <div class="link-to-page" data-href=" {{ route('marketplace') }}">
        <div class="icon-wrapper">
            <img src="{{ asset('/images/icons/marketplace.png') }}" alt="">
        </div>

        <a href="{{ route('marketplace') }}" class="h6 {{ request()->routeIs('marketplace') ? 'active' : '' }}">Marketplace</a>

    </div>

    <div class="link-to-page" data-href=" {{ route('contact') }}">
        <div class="icon-wrapper">
            <img src="{{ asset('/images/icons/mail.png') }}" alt="">
        </div>

        <a href="{{ route('contact') }}" class="h6 {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>

    </div>


    @guest
    <div class="user-menu-side-content">
        <a class="round-btn darkblue body-md" href="{{ route('register') }}">Register</a>
        <a class="round-btn border body-md" href="{{ route('login') }}">Login</a>
    </div>
    @endguest

    @auth
    <div class="user-menu-side-content">        

        <form action="{{ route('logout') }}" method="POST" class="user-menu-link">
            @csrf
            <button type="submit" class="round-btn logout body-md">Logout</button>
        </form>
    </div>

    @endauth
</div>

<div class="content">
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
</div>