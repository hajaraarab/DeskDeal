<header class="header">

    @guest
        <a href="{{ route('register.step1') }}" class="">Register</a>
        <a href="{{ route('login') }}" class="">Login</a>
    @endguest
    
    @auth
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="">Logout</button>
        </form> 
        <img src="{{ asset('profile_pictures/' . auth()->user()->profile_picture) }}" alt="Profile picture" width="100" height="100">
    @endauth

</header>