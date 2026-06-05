@include('partials.header')

<div class="content reservations-index">

    <a href="{{ route('profile.show') }}" class="back-link body-md">
        <img src="{{ asset('images/icons/back.png') }} " alt="">
         Terug naar mijn profiel
    </a>

    <div class="section-header">
        <p class="subtitle">Overzicht</p>
        <h2>Alle reservaties</h2>
        <p class="body-sm">Bekijk producten die jij hebt gereserveerd en aanvragen op jouw artikelen.</p>

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
            <div class="profile-picture">
                <img src="{{ asset('/images/icons/box-darkblue.png') }}" alt="">
            </div>

            <div class="empty-state-text">
                <h5>Je hebt momenteel geen verzoeken</h5>
                <p class="body-sm">
                    Zodra iemand een product van jou wil reserveren, verschijnt het verzoek hier.
                    Je vindt hier een overzicht van alle reservatieverzoeken, zowel lopende als afgehandelde aanvragen.
                </p>
            </div>
        </div>
        @else

            <div class="reserve-messages">
            @foreach($reservations as $reservation)

                <div class="reserve-message">

                @if($reservation->seller_id === auth()->id() && $reservation->status === 'pending')

                    <div class="reserve-info">
                        <p class="body-sm time">{{ $reservation->created_at->diffForHumans() }}</p>

                        <div class="reservation-content">
                            @if($reservation->product->images->isNotEmpty())
                                <img
                                    src="{{ asset('storage/' . $reservation->product->images->first()->image_path) }}"
                                    alt="{{ $reservation->product->title }}"
                                    class="product-reserved-image"
                                >
                            @endif

                            <div class="reserve-message-info">
                                <h5>{{ $reservation->buyer->firstname }} {{ $reservation->buyer->lastname }}</h5>

                                <p class="body-sm">
                                    Heeft een reservatieaanvraag ingediend voor {{ $reservation->product->title }}.
                                </p>
                            </div>
                        </div>

                    </div>
                
                    <div class="reservation-action">

                        <form action="{{ route('reservations.accept', $reservation) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <button class="button-with-icon success body-lg" type="submit">
                                <img src="{{ asset('images/icons/check-mark-white.png') }}" alt="">
                                Accepteren
                            </button>
                        </form>

                        <form action="{{ route('reservations.reject', $reservation) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <button class="button-with-icon border body-lg" type="submit">
                                <img src="{{ asset('/images/icons/close.png') }}" alt="">
                                Weigeren
                            </button>
                        </form>
                
                    </div>
                    <!--
                    <p>
                        Status:
                        {{ ucfirst($reservation->status) }}
                    </p>
                    -->

                @elseif($reservation->seller_id === auth()->id() && $reservation->status === 'accepted')

                    <div class="reserve-info accepted-reservation">
                        <p class="body-sm time">{{ $reservation->created_at->diffForHumans() }}</p>

                        <div class="reservation-content">
                            @if($reservation->product->images->isNotEmpty())
                                <img
                                    src="{{ asset('storage/' . $reservation->product->images->first()->image_path) }}"
                                    alt=""
                                    class="product-reserved-image"
                                >
                            @endif

                            <div class="reserve-message-info">
                                <div class="icon-and-title">
                                    <img src="{{ asset('/images/icons/clock.png') }}" alt="">
                                    <h5>Wachten op de aankoper...</h5>
                                </div>

                                <p class="body-sm">
                                    Jij hebt deze reservatie aanvaard. 
                                    De aankoper moet de transport en levering ingeven. Vanaf dat dit gebeurd is, kan het product worden opgehaald en is de transactie voltooid
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="reservation-action">
                        <p class="notification-btn success">Geaccepteerd</p>
                    </div>
                    

                @elseif($reservation->seller_id === auth()->id() && $reservation->status === 'rejected')
                    <div class="reserve-info rejected-reservation">
                        <p class="body-sm time">{{ $reservation->created_at->diffForHumans() }}</p>

                        <div class="reservation-content">
                            @if($reservation->product->images->isNotEmpty())
                                <img
                                    src="{{ asset('storage/' . $reservation->product->images->first()->image_path) }}"
                                    alt=""
                                    class="product-reserved-image"
                                >
                            @endif

                            <div class="reserve-message-info">
                                <h5>Je hebt deze aankoop geweigerd.</h5>

                                <p class="body-sm">
                                    {{ $reservation->buyer->firstname }} {{ $reservation->buyer->lastname }} wou {{ $reservation->product->title }} aankopen maar jij hebt dit geweigerd.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="reservation-action">
                        <p class="notification-btn rejected">Geweigerd</p>
                    </div>
                @endif
                </div>
            
            @endforeach
            </div>

        @endif
    @endif

@if($tab === 'my-reservations')

    @if($reservations->isEmpty())
    <div class="empty-state">
        <div class="profile-picture">
            <img src="{{ asset('/images/icons/box-darkblue.png') }}" alt="">
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
        <div class="reserve-message">

            @if($reservation->status === 'pending')

                <div class="reserve-info">
                    <div class="reservation-content">
                    @if($reservation->product->images->isNotEmpty())
                        <img
                            src="{{ asset('storage/' . $reservation->product->images->first()->image_path) }}"
                            alt=""
                            class="product-reserved-image"
                        >
                    @endif

                    <div class="reserve-message-info">
                        <div class="icon-and-title">
                            <img src="{{ asset('/images/icons/hourglass.png') }}" alt="">
                            <h5>Reservatie in behandeling...</h5>
                        </div>

                        <p class="body-sm">
                            Je reservatie voor <strong>{{ $reservation->product->title }}</strong> werd verzonden naar de verkoper.
                            Zodra deze reageert, ontvang je hier een update.
                        </p>
                    </div>
                </div>
            </div>
            <div class="reservation-action">
                <p class="notification-btn border">In behandeling</p>
            </div>

            @elseif($reservation->status === 'accepted')

                <div class="reserve-info accepted-reservation">
                    <div class="reservation-content">
                    @if($reservation->product->images->isNotEmpty())
                        <img
                            src="{{ asset('storage/' . $reservation->product->images->first()->image_path) }}"
                            alt=""
                            class="product-reserved-image"
                        >
                    @endif

                    <div class="reserve-message-info">
                        <h5>Goed nieuws! jouw reservatie werd geaccepteerd</h5>

                        <p class="body-sm">
                            Jouw reservatie voor <strong>{{ $reservation->product->title }}</strong> werd geaccepteerd. 
                            Vul jouw leveringsopties of maak een afspraak in om de bestelling te krijgen.
                        </p>
                    </div>
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
            
            @elseif($reservation->status === 'rejected')

                <div class="reserve-info rejected-reservation">
                    <div class="reservation-content">
                    @if($reservation->product->images->isNotEmpty())
                        <img
                            src="{{ asset('storage/' . $reservation->product->images->first()->image_path) }}"
                            alt=""
                            class="product-reserved-image"
                        >
                    @endif

                    <div class="reserve-message-info">
                        <h5>Jouw reservatie werd niet geaccepteerd</h5>

                        <p class="body-sm">
                            Jouw reservatie voor <strong>{{ $reservation->product->title }}</strong> werd niet geaccepteerd. 
                            Helaas ga je dit product niet kunnen aankopen. Bekijk marketplace om iets gelijkaardigs te kunnen vinden. 
                        </p>
                    </div>
                </div>

            </div>

            <div class="reservation-action">
                <div class="reservation-action">
                    <p class="notification-btn rejected">Geweigerd</p>
                </div>
            </div>
            @endif
            

    </div>
    @endforeach
</div>
    
    @endif

@endif



@include('partials.footer')
