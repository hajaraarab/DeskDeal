@include('partials.header')

<div class="content login">
    <div class="auth-container">
        
        <div class="background">
            <img src="{{ asset('/images/contact-background.png') }}" alt="Login Background">    
        </div>

        <div class="form-container">

            <div class="auth-redirect">
                <h6>Nog geen account ? </h6>
                <a class="back-link" href="{{ route('register') }}"><h6>Registreer</h6></a>
            </div>
            <div class="section-header">
                <h2>Log in</h2>
                <p class="body-sm">Welkom terug. Log in om verder te gaan met het ontdekken van hergebruikte kantoormeubilair. </p>
            </div>

            <form class="login-form" method="POST" action="{{ route('login') }}" >
                @csrf
                <div class="form-field required">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Bv. hajar@deskdeal.be" value="{{ old('email') }}" required>
                </div>

                <div class="form-field required">
                    <label for="password">Wachtwoord</label>
                    <input type="password" name="password" placeholder="*********" required>
                </div>
                
                <button class="round-btn darkblue body-lg"type="submit">Login</button>
            </form>
        </div>
    </div>
</div>

@include('partials.footer')