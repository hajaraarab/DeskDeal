<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeskDeal</title>
</head>
<body>
    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif
    <h1>dit is home</h1>

    @guest
        <a href="{{ route('register') }}" class="">Register</a>
        <a href="{{ route('login') }}" class="">Login</a>
    @endguest
    
    @auth
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="">Logout</button>
        </form> 
    @endauth
</body>
</html>