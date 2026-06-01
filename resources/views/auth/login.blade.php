@include('partials.header')

<div class="content">
    <div class="auth-container">
        
        <div class="background">
            <img src="{{ asset('/images/contact-background.png') }}" alt="Login Background">    
        </div>

        <div class="form-container">
            <form class="login-form" method="POST" action="{{ route('login') }}" >
                @csrf
                <div class="form-field required">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Bv. jan.peeters@deskdeal.be" value="{{ old('email') }}" required>
                </div>

                <div class="form-field required">
                    <label for="password">Wachtwoord</label>
                    <input type="password" name="password" placeholder="Minimaal 8 tekens" required>
                </div>
                
                <button class="round-btn darkblue body-lg"type="submit">Login</button>
            </form>
        </div>
    </div>
</div>

@include('partials.footer')