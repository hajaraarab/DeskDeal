<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>login</h1>

    <div class="login">
        <form action="{{ route('login') }}" method="POST">

            @csrf 
            <input class="" type="email" name="loginemail" placeholder="Email">
            @error('loginemail')
                <p class="error">{{ $message }}</p>
            @enderror
            <input class="" type="password" name="loginpassword" placeholder="Password">
            @error('loginpassword')
                <p class="error">{{ $message }}</p>
            @enderror
            
            <button type="submit" class="">Login</button>
        </form>
    </div>
</body>
</html>