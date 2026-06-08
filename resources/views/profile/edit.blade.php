@include('partials.header')

<div class="content create-product">

    <a href="{{ route('profile.show') }}" class="back-link body-md">
        <img src="{{ asset('images/icons/back.png') }}" alt="Terug naar profiel">
        Terug naar profiel
    </a>

    <div class="section-header">
        <p class="subtitle">Profiel bewerken</p>
        <h2>Werk je accountgegevens bij</h2>
        <p class="body-sm">Pas je naam, e-mail en bedrijfsgegevens aan.</p>
    </div>

    @if ($errors->any())
        <div class="form-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="create-product-form" action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <div class="form-field">
                <label for="firstname">Voornaam</label>
                <input
                    type="text"
                    name="firstname"
                    value="{{ old('firstname', $user->firstname) }}"
                    required
                >
            </div>

            <div class="form-field">
                <label for="lastname">Achternaam</label>
                <input
                    type="text"
                    name="lastname"
                    value="{{ old('lastname', $user->lastname) }}"
                    required
                >
            </div>
        </div>

        <div class="form-group">
            <div class="form-field">
                <label for="email">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    required
                >
            </div>

            <div class="form-field">
                <label for="companyname">Bedrijfsnaam</label>
                <input
                    type="text"
                    name="companyname"
                    value="{{ old('companyname', $user->companyname) }}"
                    required
                >
            </div>
        </div>

        <div class="form-group">
            <div class="form-field">
                <label for="companyregisternumber">Ondernemingsnummer</label>
                <input
                    type="text"
                    name="companyregisternumber"
                    value="{{ old('companyregisternumber', $user->companyregisternumber) }}"
                    maxlength="12"
                    required
                >
            </div>

            <div class="form-field">
                <label for="city">Stad</label>
                <input
                    type="text"
                    name="city"
                    value="{{ old('city', $user->city) }}"
                    required
                >
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('profile.show') }}" class="back-link body-lg">Annuleren</a>
            <button class="round-btn darkblue body-lg" type="submit">Opslaan</button>
        </div>
    </form>
</div>

@include('partials.footer')