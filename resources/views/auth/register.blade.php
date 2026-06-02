@include('partials.header')

<div class="content">

    <div class="auth-container">
        <div class="background">
            <img src="{{ asset('/images/contact-background.png') }}" alt="Register Background">
        </div>

        <div class="form-container">

            <div class="auth-redirect">
                <h6>Al een account ? </h6>
                <a class="back-link" href="{{ route('login') }}"><h6>Login</h6></a>
            </div>
            <div class="section-header">
                <h2>Sign up</h2>
                <p class="body-sm">Maak een account en ontdek hergebruikte kantoormeubilair. </p>
            </div>

            <form class="register-form" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="step-one">
                    <p class="subtitle">Persoonlijke informatie</p>

                    <div class="form-group">
                        <div class="form-field required">
                            <label for="firstname">Voornaam</label>
                            <input type="text" name="firstname" placeholder="Bv. Jan" value="{{ old('firstname') }}" required>
                        </div>

                        <div class="form-field required">
                            <label for="lastname">Achternaam</label>
                            <input type="text" name="lastname" placeholder="Bv. Peeters" value="{{ old('lastname') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-field required">
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="Bv. jan.peeters@deskdeal.be" value="{{ old('email') }}" required>
                        </div>

                        <div class="form-field required">
                            <label for="password">Wachtwoord</label>
                            <input type="password" name="password" placeholder="Minimaal 8 tekens" required>
                        </div>
                    </div>

                    <div class="form-action">
                        <button class="round-btn darkblue body-lg" type="button" id="next-step">
                            Volgende
                        </button>
                    </div>
                </div>

                <div class="step-two">
                    <p class="subtitle">Bedrijfsinformatie</p>

                    <div class="form-field required">
                        <label for="companyname">Bedrijfsnaam</label>
                        <input type="text" name="companyname" placeholder="Bv. DeskDeal B.V." value="{{ old('companyname') }}" required>
                    </div>

                    <div class="form-group">

                        <div class="form-field required">
                            <label for="companyregisternumber">Ondernemingsnummer</label>
                            <input 
                                type="text"
                                name="companyregisternumber"
                                placeholder="Bv. BE0123456789"
                                value="{{ old('companyregisternumber', 'BE') }}"
                                maxlength="12"
                                inputmode="numeric"
                                oninput="
                                    if (!this.value.startsWith('BE')) {
                                        this.value = 'BE' + this.value.replace(/^BE/i, '');
                                    }
                                    this.value = 'BE' + this.value.slice(2).replace(/[^0-9]/g, '').slice(0,10);
                                "
                                required
                            >
                        </div>

                        <div class="form-field required">
                            <label for="city">Stad</label>
                            <input
                                type="text"
                                name="city"
                                placeholder="Bv. Antwerpen"
                                value="{{ old('city') }}"
                                required
                            >
                        </div>
                    </div>


                    <div class="form-actions">
                        <button class="back-link body-lg" type="button" id="prev-step">Vorige</button>

                        <button class="round-btn darkblue body-lg" type="submit">Register</button>
                    </div>
                </div>

            </form>
        </div>
</div>

@include('partials.footer')