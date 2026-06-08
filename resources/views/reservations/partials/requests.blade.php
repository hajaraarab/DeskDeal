
@if($reservations->isEmpty())

<div class="empty-state">
    <div class="profile-picture">
            <img src="{{ asset('/images/icons/box-darkblue.png') }}" alt="Geen verzoeken">
    <div class="empty-state-text">
        <h5>Je hebt momenteel geen verzoeken</h5>

        <p class="body-sm">
            Zodra iemand een product van jou wil reserveren,
            verschijnt het verzoek hier.
            Je vindt hier een overzicht van alle reservatieverzoeken,
            zowel lopende als afgehandelde aanvragen.
        </p>
    </div>
</div>

@else

<div class="reserve-messages">

    @foreach($reservations as $reservation)

        <div class="reserve-message">
            <a
                href="{{ route('products.show', $reservation->product) }}"
                class="reserve-message-link"
            >

        {{-- NIEUWE RESERVATIE --}}
        @if(
            $reservation->seller_id === auth()->id()
            && $reservation->status === 'pending'
        )

            <div class="reserve-info">

                <p class="body-sm time">
                    {{ $reservation->created_at->diffForHumans() }}
                </p>

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
                            {{ $reservation->buyer->firstname }}
                            {{ $reservation->buyer->lastname }}
                        </h5>

                        <p class="body-sm">
                            Heeft een reservatieaanvraag ingediend voor
                            {{ $reservation->product->title }}.
                        </p>

                    </div>

                </div>

            </div>

        </a>

            <div class="reservation-action">

                <form
                    action="{{ route('reservations.accept', $reservation) }}"
                    method="POST"
                >
                    @csrf
                    @method('PATCH')

                    <button
                        class="button-with-icon success body-lg"
                        type="submit"
                    >
                        <img src="{{ asset('images/icons/check-mark-white.png') }}" alt="Accepteren">
                        Accepteren
                    </button>

                </form>

                <form
                    action="{{ route('reservations.reject', $reservation) }}"
                    method="POST"
                >
                    @csrf
                    @method('PATCH')

                    <button
                        class="button-with-icon border body-lg"
                        type="submit"
                    >
                        <img src="{{ asset('/images/icons/close.png') }}" alt="Weigeren">
                        Weigeren
                    </button>

                </form>

            </div>

        {{-- WACHTEN OP AANKOPER --}}
        @elseif(
            $reservation->seller_id === auth()->id()
            && $reservation->status === 'accepted'
            && !$reservation->appointment_status
        )

            <div class="reserve-info accepted-reservation">

                <p class="body-sm time">
                    {{ $reservation->created_at->diffForHumans() }}
                </p>

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
                            <img src="{{ asset('/images/icons/clock.png') }}" alt="Wachten op aankoper">
                            <h5>Wachten op de aankoper...</h5>
                        </div>

                        <p class="body-sm">
                            Jij hebt deze reservatie aanvaard.
                            De aankoper moet de transport- en leveringsgegevens invullen.
                        </p>

                    </div>

                </div>

            </div>

        </a>

            <div class="reservation-action">
                <p class="notification-btn border">
                    In behandeling
                </p>
            </div>

        {{-- LEVERING DOORGESTUURD --}}
        @elseif(
            $reservation->seller_id === auth()->id()
            && $reservation->status === 'accepted'
            && $reservation->appointment_status === 'accepted'
        )

            <div class="reserve-info delivery-accepted-reservation">

                <p class="body-sm time">
                    {{ $reservation->created_at->diffForHumans() }}
                </p>

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

                            <img
                                src="{{ asset('/images/icons/location-green.png') }}"
                                alt="Locatie"
                            >

                            <h5>
                                Leveringsgegevens ontvangen
                            </h5>

                        </div>

                        <p class="body-sm">

                            @if($reservation->delivery_method === 'pickup')

                                De aankoper wil het product ophalen op

                                <strong>
                                    {{ \Carbon\Carbon::parse($reservation->pickup_date)->format('d/m/Y') }}
                                    om
                                    {{ \Carbon\Carbon::parse($reservation->pickup_time)->format('H:i') }}
                                </strong>.

                            @else

                                Onze bezorgservice haalt het product op

                                <strong>
                                    {{ \Carbon\Carbon::parse($reservation->pickup_date)->format('d/m/Y') }}
                                    om
                                    {{ \Carbon\Carbon::parse($reservation->pickup_time)->format('H:i') }}
                                </strong>.

                            @endif

                        </p>

                    </div>

                </div>

            </div>

        </a>

            <div class="reservation-action">

                <a
                    href="#"
                    class="round-btn darkblue body-lg"
                >
                    Ander moment voorstellen
                </a>

            </div>

        {{-- GEWEIGERD --}}
        @elseif(
            $reservation->seller_id === auth()->id()
            && $reservation->status === 'rejected'
        )

            <div class="reserve-info rejected-reservation">

                <p class="body-sm time">
                    {{ $reservation->created_at->diffForHumans() }}
                </p>

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
                            Je hebt deze aankoop geweigerd.
                        </h5>

                        <p class="body-sm">
                            {{ $reservation->buyer->firstname }}
                            {{ $reservation->buyer->lastname }}
                            wou
                            {{ $reservation->product->title }}
                            aankopen maar jij hebt dit geweigerd.
                        </p>

                    </div>

                </div>

            </div>

        </a>

            <div class="reservation-action">
                <p class="notification-btn rejected">
                    Geweigerd
                </p>
            </div>

        @endif

    </div>

    @endforeach

</div>

@endif