@php
    $user = auth()->user();
@endphp

@include('partials.header')

<div class="content create-reservation">

    <a href="{{ route('products.show', $product) }}" class="back-link body-md">
        <img src="{{ asset('images/icons/back.png') }} " alt="Terug naar product">
         Terug naar product
    </a>

    <div class="section-header">
        <h2>Reserveren</h2>
        <p class="body-sm">Vul je gegevens in om dit artikel gratis te reserveren. De verkoper krijgt direct een melding.</p>
    </div>

    <div class="reserve-product">
        <div class="reservation-sidebar">

            <div class="product-overview">
                <img
                    class="product-detail-main-image"
                    src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                    alt="{{ $product->title }}"
                >

                <div class="product-info">
                    <p class="subtitle">{{ $product->category?->name }}</p>
                    <h3>{{ $product->title }}</h3>
                    <h5>€ {{ $product->price }}</h5>

                    <div class="attributes">
                        <div class="single-attribute">
                            <img src="{{ asset('images/icons/location-green.png') }}" alt="Locatie">
                            <p class="body-sm">Locatie: {{ $product->location }}</p>
                        </div>
                        <div class="single-attribute">
                            <img src="{{ asset('images/icons/clock.png') }}" alt="Gepost op">
                            <p class="body-sm">Geplaatst {{ $product->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>

             <div class="user-info">
                <p class="subtitle">Verkoper</p>

                <h5>
                    {{ $product->user->firstname }}
                    {{ $product->user->lastname }}
                </h5>

                <div class="attributes">
                    <div class="single-attribute">
                        <img src="{{ asset('images/icons/location-green.png') }}" alt="Locatie">
                        <p class="body-sm">
                            {{ $product->location }}
                        </p>
                    </div>

                    <div class="single-attribute">
                        <img src="{{ asset('images/icons/user.png') }}" alt="Verkoper">
                        <p class="body-sm">
                            Actief sinds {{ $product->user->created_at->format('Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="reserve-form-container">

            @if(!$hasReservation)
            <form class="reserve-form" action="{{ route('reservations.store', $product) }}" method="POST">
                @csrf 

                <div class="form-field required">
                    <label for="firstname">Voornaam</label>
                    <input 
                        type="text" 
                        name="firstname" 
                        placeholder="Bv. Jan" 
                        value="{{ old('firstname', $user->firstname) }}"
                    >
                </div>

                <div class="form-field required">
                    <label for="lastname">Achternaam</label>
                    <input 
                        type="text" 
                        name="lastname" 
                        placeholder="Bv. Peeters" 
                        value="{{ old('lastname', $user->lastname) }}"
                    >
                </div>

                <div class="form-field required">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Bv. jan.peeters@deskdeal.be" 
                        value="{{ old('email', $user->email) }}"
                    >
                </div>

                <div class="form-field">
                    <label for="message">Bericht:</label>
                    <textarea 
                        name="message" 
                        placeholder="Voeg eventueel een bericht toe voor de verkoper..."
                        value="{{ old('message') }}"
                    > 
                    </textarea>
                </div>

                <button class="round-btn darkblue body-lg" type="submit">Reservering bevestigen</button>
            </form>

            @else

                <div class="reservation-confirmed">
                    <div class="icon-container">
                        <img src="{{ asset('images/icons/check-mark.png') }} " alt="Checkmark icon">
                    </div>

                    <h4>Reservering bevestigd !</h4>
                    <p class="body-sm">
                        Thomas de Vries is op de hoogte gesteld. Je ontvangt binnen 24 uur een reactie met een ophaaltijdvoorstel.
                    </p>

                    <a class="round-btn darkblue body-lg" href="{{ route('products.show', $product) }}">
                        Terug naar product
                    </a>
                </div>
            
            @endif
        </div>
    </div>

</div>


@include('partials.footer')