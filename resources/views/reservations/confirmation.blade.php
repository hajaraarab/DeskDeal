@php
    $appointment = session('checkout_appointment');
@endphp

@include('partials.header')

<div class="content checkout">

@include('partials.checkout-header')

    <!-- STEPS -->
    <div class="checkout-steps">
        <div class="step" id="step-appointment">
            <span><p class="body-lg">1</p></span>
            <p class="subtitle">Afspraak</p>
        </div>

        <div class="step-line"></div>

        <div class="step active" id="step-confirmation">
            <span><p class="body-lg">2</p></span>
            <p class="subtitle">Bevestiging</p>
        </div>
    </div>
    <!-- END STEPS -->


    <div class="confirmation-step">

        <h5>Controleer en bevestig</h5>
        <p class="body-md grey">
            Alles juist? Bevestig dan je bestelling.
        </p>

        <div class="delivery-confirmation">

            <div class="delivery-confirmation-info">
                <p class="body-md">Product</p>
                <p class="body-lg">{{ $product->title }}</p>
            </div>

            <div class="delivery-confirmation-info">
                <p class="body-md">Verkoper</p>
                <p class="body-lg">
                    {{ $product->user->firstname }}
                    {{ $product->user->lastname }}
                </p>
            </div>

            <div class="delivery-confirmation-info">
                <p class="body-md">Afspraak</p>

                <p class="body-lg">

                        {{ \Carbon\Carbon::parse($appointment['pickup_date'])->format('d/m/Y') }}
                        om
                        {{ \Carbon\Carbon::parse($appointment['pickup_time'])->format('H:i') }}
                </p>
            </div>

            <div class="delivery-confirmation-info">
                <p class="body-md">Levering</p>

                <p class="body-lg">
                    @if($appointment['delivery_method'] === 'delivery')

                        {{ $appointment['delivery_address'] }}

                    @else

                        Zelf afhalen

                    @endif
                </p>
            </div>

        </div>

        <div class="confirm-reservation-action">

            <a
                href="{{ route('reservations.checkout', $reservation) }}"
                class="round-btn border body-lg"
            >
                Vorige stap
            </a>

            <form
                method="POST"
                action="{{ route('reservation.make', $reservation) }}"
            >
                @csrf

                <button
                    class="round-btn darkblue body-lg"
                    type="submit"
                >
                    Bestelling bevestigen
                </button>
            </form>

        </div>

    </div>
</div>

@include('partials.footer')