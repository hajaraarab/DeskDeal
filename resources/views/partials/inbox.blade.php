@php
$notifications = $reservations->filter(function ($reservation) {
    return

        ($reservation->seller_id === auth()->id()
            && $reservation->status === 'pending')

        ||

        ($reservation->seller_id === auth()->id()
            && $reservation->status === 'accepted'
            && $reservation->appointment_status === 'pending')

        ||

        ($reservation->buyer_id === auth()->id()
            && in_array($reservation->status, ['accepted', 'rejected']));

})->take(4);
@endphp

@forelse($notifications as $reservation)
@if($notifications->isEmpty())

    <div class="empty-state">
        <div class="profile-picture">
            <img src="{{ asset('/images/icons/box-darkblue.png') }}" alt="Geen meldingen">
        </div>

        <div class="empty-state-text">
            <h5>U heeft geen nieuwe meldingen</h5>
            <p class="body-sm">Wanneer er iets belangrijks gebeurt — zoals een nieuwe reservering of bericht — zie je het hier.</p>
        </div>
    </div>


@elseif($reservation->seller_id === auth()->id() && $reservation->status === 'pending')

        <div class="reserve-message">

            <div class="reservation-info">

             <div class="reservation-content">

                @if($reservation->product->images->isNotEmpty())
                    <img
                        src="{{ asset('storage/' . $reservation->product->images->first()->image_path) }}"
                        alt="{{ $reservation->product->title }}"
                        class="product-reserved-image"
                    >
                @endif

                <div class="reserve-message-info">

                    <p class="body-sm time">{{ $reservation->created_at->diffForHumans() }}</p>

                    <h5>
                        {{ $reservation->buyer->firstname }}
                        {{ $reservation->buyer->lastname }}
                    </h5>

                    <p class="body-sm">
                        Wilt
                        <strong>{{ $reservation->product->title }}</strong>
                        reserveren
                    </p>

                    @if($reservation->message)
                        <p class="reservation-message">
                            "{{ $reservation->message }}"
                        </p>
                    @endif
                </div>

            </div>
            </div>

            <div class="reservation-action">

                <form action="{{ route('reservations.accept', $reservation) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <button class="button-with-icon success body-lg" type="submit">
                        <img src="{{ asset('images/icons/check-mark-white.png') }}" alt="Accepteren">
                        Accepteren
                    </button>
                </form>

                <form action="{{ route('reservations.reject', $reservation) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <button class="button-with-icon border body-lg" type="submit">
                        <img src="{{ asset('/images/icons/close.png') }}" alt="Weigeren">
                        Weigeren
                    </button>
                </form>

            </div>

        </div>

    @elseif($reservation->buyer_id === auth()->id() && $reservation->status === 'accepted' && !$reservation->appointment_status)

        <div class="reserve-message">

            <div class="reservation-content">

                @if($reservation->product->images->isNotEmpty())
                    <img
                        src="{{ asset('storage/' . $reservation->product->images->first()->image_path) }}"
                        alt="{{ $reservation->product->title }}"
                        class="product-reserved-image"
                    >
                @endif

                <div class="reserve-message-info">
                    <h5>Reservatie geaccepteerd 🎉</h5>

                    <p class="body-sm">
                        Jouw reservatie voor
                        <strong>{{ $reservation->product->title }}</strong>
                        werd geaccepteerd door de verkoper.
                    </p>
                </div>

            </div>

            <div class="reservation-action">

                <a
                    href="{{ route('reservations.checkout', $reservation) }}"
                    class="round-btn darkblue body-lg"
                >
                    Aankopen
                </a>

            </div>

        </div>

    @elseif($reservation->buyer_id === auth()->id() && $reservation->status === 'rejected')

        <div class="reserve-message">

            <div class="reservation-info">
                <div class="reservation-content">
                    @if($reservation->product->images->isNotEmpty())
                        <img
                            src="{{ asset('storage/' . $reservation->product->images->first()->image_path) }}"
                            alt="{{ $reservation->product->title }}"
                            class="product-reserved-image"
                        >
                    @endif
            
                <div class="reserve-message-info">
                    <h5>Reservatie geweigerd</h5>

                    <p class="body-sm">
                        Jouw reservatie voor
                        <strong>{{ $reservation->product->title }}</strong>
                        werd geweigerd.
                    </p>
                </div>

                </div>

            </div>

            <div class="reservation-action">
                <p class="notification-btn rejected">Geweigerd</p>
            </div>

        </div>

@elseif(
$reservation->seller_id === auth()->id()
&& $reservation->status === 'accepted'
&& $reservation->appointment_status === 'pending'
)

<div class="reserve-message">

    <div class="reservation-info">

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
                    <img src="{{ asset('/images/icons/location-green.png') }}" alt="Locatie">
                    <h5>
                        Onze bezorgservice zal het product ophalen op
                        <strong>
                            {{ \Carbon\Carbon::parse($reservation->pickup_date)->format('d/m/Y') }}
                            om
                            {{ \Carbon\Carbon::parse($reservation->pickup_time)->format('H:i') }}
                        </strong>
                        voor levering naar de aankoper.
                    </h5>
                </div>

                @if($reservation->delivery_method === 'pickup')

                    <p class="body-sm">
                        Ophalen op
                        {{ \Carbon\Carbon::parse($reservation->pickup_date)->format('d/m/Y') }}
                        om
                        {{ \Carbon\Carbon::parse($reservation->pickup_time)->format('H:i') }}
                    </p>

                @elseif($reservation->delivery_method === 'delivery')

                    <p class="body-sm">
                        Leveringsadres:
                        {{ $reservation->delivery_address }}
                    </p>

                @endif

            </div>

        </div>

    </div>

    <div class="reservation-action">

        <form
            action=""
            method="POST"
        >
            @csrf
            @method('PATCH')

            <button
                class="button-with-icon success body-lg"
                type="submit"
            >
                Afspraak accepteren
            </button>

        </form>

    </div>

</div>
@endif
@empty 
    <div class="empty-state">
        <div class="profile-picture">
            <img src="{{ asset('/images/icons/box-darkblue.png') }}" alt="Geen meldingen">
        </div>

        <div class="empty-state-text">
            <h5>U heeft geen nieuwe meldingen</h5>
            <p class="body-sm">Wanneer er iets belangrijks gebeurt — zoals een nieuwe reservering of bericht — zie je het hier.</p>
        </div>
    </div>
@endforelse

