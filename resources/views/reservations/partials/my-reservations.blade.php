@if($reservations->isEmpty())

<div class="empty-state">
    <div class="profile-picture">
        <img src="{{ asset('/images/icons/box-darkblue.png') }}" alt="Geen actieve reservaties">
    </div>

    <div class="empty-state-text">
        <h5>Je hebt momenteel geen actieve reservaties</h5>

        <p class="body-sm">
            Zodra je een product reserveert, verschijnt het hier samen met de actuele status van je reservatie.
            Wanneer de verkoper je aanvraag accepteert, kun je verdergaan met de aankoop.
        </p>
    </div>
</div>

@else

<div class="reserve-messages">

    @foreach($reservations as $reservation)

        <p>
        ID: {{ $reservation->id }}
        |
        Status: {{ $reservation->status }}
        |
        Appointment: {{ $reservation->appointment_status ?? 'NULL' }}
    </p>

    <div class="reserve-message">
        <a
            href="{{ route('products.show', $reservation->product) }}"
            class="reserve-message-link"
        >

            {{-- RESERVATIE VERZONDEN --}}
        @if($reservation->status === 'pending')

            <div class="reserve-info">

                <div class="reservation-content">

                    @if($reservation->product->images->isNotEmpty())
                        <img
                            src="{{ asset('storage/' . $reservation->product->images->first()->image_path) }}"
                            alt="{{ $reservation->product->title }}"
                            class="product-reserved-image"
                        >
                    @endif

                    <div class="reserve-message-info">

                        <div class="icon-and-title">
                            <img src="{{ asset('/images/icons/hourglass.png') }}" alt="In behandeling">
                            <h5>Reservatie in behandeling...</h5>
                        </div>

                        <p class="body-sm">
                            Je reservatie voor
                            <strong>{{ $reservation->product->title }}</strong>
                            werd verzonden naar de verkoper.
                            Zodra deze reageert, ontvang je hier een update.
                        </p>

                    </div>

                </div>

            </div>

            <div class="reservation-action">
                <p class="notification-btn border">
                    In behandeling
                </p>
            </div>

        {{-- VERKOPER HEEFT GEACCEPTEERD --}}
        @elseif(
            $reservation->status === 'accepted'
            && !$reservation->appointment_status
        )

            <div class="reserve-info accepted-reservation">

                <div class="reservation-content">

                    @if($reservation->product->images->isNotEmpty())
                        <img
                            src="{{ asset('storage/' . $reservation->product->images->first()->image_path) }}"
                            alt="{{ $reservation->product->title }}"
                            class="product-reserved-image"
                        >
                    @endif

                    <div class="reserve-message-info">

                        <h5>
                            Goed nieuws! jouw reservatie werd geaccepteerd
                        </h5>

                        <p class="body-sm">
                            Jouw reservatie voor
                            <strong>{{ $reservation->product->title }}</strong>
                            werd geaccepteerd.
                            Kies nu hoe je het product wil ontvangen.
                        </p>

                    </div>

                </div>
            </div>

        {{-- LEVERINGSGEGEVENS DOORGESTUURD --}}
        @elseif(
            $reservation->status === 'accepted'
            && $reservation->appointment_status === 'accepted'
        )

            <div class="reserve-info accepted-reservation">

                <div class="reservation-content">

                    @if($reservation->product->images->isNotEmpty())
                        <img
                            src="{{ asset('storage/' . $reservation->product->images->first()->image_path) }}"
                            alt="{{ $reservation->product->title }}"
                            class="product-reserved-image"
                        >
                    @endif

                    <div class="reserve-message-info">

                        <div class="icon-and-title">
                            <img src="{{ asset('/images/icons/check-mark-green.png') }}" alt="Geverifieerd">
                            <h5>Leveringsgegevens doorgestuurd</h5>
                        </div>

                        <p class="body-sm">

                            @if($reservation->delivery_method === 'pickup')

                                Je hebt een afspraak voorgesteld op

                                <strong>
                                    {{ \Carbon\Carbon::parse($reservation->pickup_date)->format('d/m/Y') }}
                                    om
                                    {{ \Carbon\Carbon::parse($reservation->pickup_time)->format('H:i') }}
                                </strong>.

                            @else

                                Je bezorgaanvraag werd doorgestuurd naar de verkoper.

                            @endif

                        </p>

                    </div>

                </div>

            </div>

            <div class="reservation-action">

                <p class="notification-btn success">
                    Verzonden
                </p>

            </div>

        {{-- GEWEIGERD --}}
        @elseif($reservation->status === 'rejected')

            <div class="reserve-info rejected-reservation">

                <div class="reservation-content">

                    @if($reservation->product->images->isNotEmpty())
                        <img
                            src="{{ asset('storage/' . $reservation->product->images->first()->image_path) }}"
                            alt="{{ $reservation->product->title }}"
                            class="product-reserved-image"
                        >
                    @endif

                    <div class="reserve-message-info">

                        <h5>
                            Jouw reservatie werd niet geaccepteerd
                        </h5>

                        <p class="body-sm">
                            Jouw reservatie voor
                            <strong>{{ $reservation->product->title }}</strong>
                            werd niet geaccepteerd.
                        </p>

                    </div>

                </div>

            </div>

            <div class="reservation-action">

                <p class="notification-btn rejected">
                    Geweigerd
                </p>

            </div>

        @endif

        </a>

        @if(
            $reservation->status === 'accepted'
            && !$reservation->appointment_status
        )
            <div class="reservation-action">
                <a
                    href="{{ route('reservations.checkout', $reservation) }}"
                    class="round-btn darkblue body-lg"
                >
                    Aankopen
                </a>
            </div>
        @endif

    </div>

    @endforeach

</div>

@endif