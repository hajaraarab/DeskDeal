<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <!-- @if ($errors->any())
        <div class="errors">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif -->

    <h1>Register</h1>

    <div class="register">
        <form action="{{ route('register') }}" method="POST">
            @csrf 
            <input class="" type="text" name="name" placeholder="Name">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
            <input class="" type="email" name="email" placeholder="Email">
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
            <input class="" type="password" name="password" placeholder="Password">
            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
            
            <button type="submit" class="">Register</button>
        </form>
    </div>
</body>
</html>