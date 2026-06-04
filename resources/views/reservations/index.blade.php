@include('partials.header')

<div class="content reservations-index">

    <a href="{{ route('marketplace') }}" class="back-link body-md">
        <img src="{{ asset('images/icons/back.png') }} " alt="">
         Terug naar Marketplace
    </a>

    <div class="section-header">
        <p class="subtitle">Plaats je product</p>
        <h2>Vind je volgende kantoorvonst</h2>
        <p class="body-sm">Vul de gegevens hieronder in. Hoe completer je advertentie, hoe sneller je item een nieuwe eigenaar vindt.</p>
    </div>

    <div class="reservation-filters">

        <a
            href="{{ route('reservations.index', ['tab' => 'requests']) }}"
            class="body-lg round-btn {{ $tab === 'requests' ? 'darkblue' : 'border' }}"
        >
            Verzoeken
        </a>

        <a
            href="{{ route('reservations.index', ['tab' => 'my-reservations']) }}"
            class="body-lg round-btn {{ $tab === 'my-reservations' ? 'darkblue' : 'border' }}"
        >
            Mijn reservaties
        </a>

    </div>

    @if($tab === 'requests')

        @if($reservations->isEmpty())
            <div class="empty-state">
                <h4>Geen verzoeken</h4>
                <p class="body-sm">
                    Je hebt momenteel geen verzoeken ontvangen.
                </p>
            </div>
        @else

            @foreach($reservations as $reservation)

                <div class="reserve-message">

                    <h5>
                        {{ $reservation->buyer->firstname }}
                        {{ $reservation->buyer->lastname }}
                    </h5>

                    <p>
                        Wil
                        <strong>{{ $reservation->product->title }}</strong>
                        reserveren
                    </p>

                    <p>
                        Status:
                        {{ ucfirst($reservation->status) }}
                    </p>

                </div>

            @endforeach

        @endif
    @endif

@if($tab === 'my-reservations')

    @if($reservations->isEmpty())

        <h4>Geen verzoeken</h4>
        <p class="body-sm">
            Je hebt momenteel geen verzoeken ontvangen.
        </p>
    @else

        @foreach($reservations as $reservation)

            <div class="reserve-message">

                <h5>
                    {{ $reservation->product->title }}
                </h5>

                <p>
                    Verkoper:
                    {{ $reservation->seller->firstname }}
                    {{ $reservation->seller->lastname }}
                </p>

                <p>
                    Status:
                    {{ ucfirst($reservation->status) }}
                </p>

            </div>

        @endforeach
    
    @endif

@endif



@include('partials.footer')
