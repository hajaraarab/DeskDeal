@foreach($reservations->take(4) as $reservation)

    @if($reservation->seller_id === auth()->id() && $reservation->status === 'pending')

        <div class="reserve-message">

            <div class="reservation-info">

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

            </div>

            <div class="reservation-action">

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

            </div>

        </div>

    @elseif($reservation->buyer_id === auth()->id() && $reservation->status === 'accepted')

        <div class="reserve-message">

            <div class="reservation-content">

                <div class="profile-picture">
                    <img src="{{ asset('images/icons/box-darkblue.png') }} " alt="">
                </div>

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

                <h5>Reservatie geweigerd</h5>

                <p class="body-sm">
                    Jouw reservatie voor
                    <strong>{{ $reservation->product->title }}</strong>
                    werd geweigerd.
                </p>

            </div>

            <div class="reservation-action">
                <p class="notification-btn border">Geweigerd</p>
            </div>

        </div>

    @endif

@endforeach

