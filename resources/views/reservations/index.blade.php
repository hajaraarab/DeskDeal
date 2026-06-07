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

    <div class="reservation-status-filters">

        <a
            href="{{ route('reservations.index', [
                'tab' => $tab,
                'status' => 'all'
            ]) }}"
            class="body-md round-btn {{ $status === 'all' ? 'darkblue' : 'border' }}"
        >
            Alle
        </a>

        <a
            href="{{ route('reservations.index', [
                'tab' => $tab,
                'status' => 'pending'
            ]) }}"
            class="body-md round-btn {{ $status === 'pending' ? 'darkblue' : 'border' }}"
        >
            In behandeling
        </a>

        <a
            href="{{ route('reservations.index', [
                'tab' => $tab,
                'status' => 'accepted'
            ]) }}"
            class="body-md round-btn {{ $status === 'accepted' ? 'darkblue' : 'border' }}"
        >
            Geaccepteerd
        </a>

        <a
            href="{{ route('reservations.index', [
                'tab' => $tab,
                'status' => 'rejected'
            ]) }}"
            class="body-md round-btn {{ $status === 'rejected' ? 'darkblue' : 'border' }}"
        >
            Geweigerd
        </a>

    </div>

    @if($tab === 'requests')

        @include('reservations.partials.requests')

    @elseif($tab === 'my-reservations')

        @include('reservations.partials.my-reservations')

    @endif



@include('partials.footer')
