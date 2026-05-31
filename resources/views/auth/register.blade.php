@include('partials.header')

@if ($errors->any())
    <div class="errors">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<div class="content">

    <div class="register-container">
        <div class="background">
            <img src="{{ asset('/images/contact-background.png') }}" alt="Register Background">
        </div>

        <div class="register-form-container">
            <form class="register-form" method="POST" action="{{ route('register') }}">
                @csrf

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
                        <label for="companyname">Bedrijfsnaam</label>
                        <input type="text" name="companyname" placeholder="Bv. DeskDeal B.V." value="{{ old('companyname') }}" required>
                    </div>

                    <div class="form-field required">
                        <label for="companyregisternumber">Ondernemingsnummer</label>
                        <input 
                            type="text"
                            name="companyregisternumber"
                            placeholder="Bv. BE0123456789"
                            value="BE{{ old('companyregisternumber') }}"
                            maxlength="12"
                            inputmode="numeric"
                            oninput="
                                this.value = 'BE' + this.value.replace(/[^0-9]/g, '').slice(0,10);
                            "
                            required
                        >
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

                <button type="submit">Register</button>
                
            </form>
        </div>
</div>

@include('partials.footer')