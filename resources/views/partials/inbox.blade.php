@foreach($reservations->take(4) as $reservation)
<div class="reserve-message">

    <div class="reservation-info">

        @if($reservation->status === 'pending')

            <p class="body-sm grey">{{ $reservation->created_at->diffForHumans() }}</p>

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

        @elseif($reservation->status === 'accepted')

            <h5>Reservatie geaccepteerd</h5>

            <p class="body-sm">
                Je hebt de reservatie van
                <strong>{{ $reservation->buyer->firstname }}</strong>
                geaccepteerd voor
                <strong>{{ $reservation->product->title }}</strong>.
            </p>

        @elseif($reservation->status === 'rejected')

            <h5>Reservatie geweigerd</h5>

            <p class="body-sm">
                Je hebt de reservatie van
                <strong>{{ $reservation->buyer->firstname }}</strong>
                geweigerd voor
                <strong>{{ $reservation->product->title }}</strong>.
            </p>

        @endif

    </div>

    <div class="reservation-action">

        @if($reservation->status === 'pending')

            <form action="{{ route('reservations.accept', $reservation) }}" method="POST">
                @csrf
                @method('PATCH')

                <button class="round-btn accept body-lg" type="submit">
                    Accepteren
                </button>
            </form>

            <form action="{{ route('reservations.reject', $reservation) }}" method="POST">
                @csrf
                @method('PATCH')

                <button class="round-btn border body-lg" type="submit">
                    Weigeren
                </button>
            </form>

        @elseif($reservation->status === 'accepted')

            <span class="status accepted">
                Geaccepteerd
            </span>

        @elseif($reservation->status === 'rejected')

            <span class="status rejected">
                Geweigerd
            </span>

        @endif

    </div>

</div>

@if($reservation->buyer_id === auth()->id() && $reservation->status === 'accepted')

    <div class="reserve-message">

        <div class="reservation-info">
            <h5>Reservatie geaccepteerd 🎉</h5>

            <p class="body-sm">
                Jouw reservatie voor
                <strong>{{ $reservation->product->title }}</strong>
                werd geaccepteerd door de verkoper.
            </p>
        </div>

        <div class="reservation-action">
            <a
                href="{{ route('reservations.accept', $reservation->product) }}"
                class="round-btn darkblue body-lg"
            >
                Aankopen
            </a>
        </div>

    </div>

@endif
@endforeach

