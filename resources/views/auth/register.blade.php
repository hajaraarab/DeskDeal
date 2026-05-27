@include('partials.header')

@if ($errors->any())
    <div class="errors">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<div class="content">

    <h1>Welcome to the Register Page</h1>
   <form method="POST" action="{{ route('register') }}">
        @csrf

        <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required>
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
        <button type="submit">Register</button>
        
    </form>
</div>

@include('partials.footer')