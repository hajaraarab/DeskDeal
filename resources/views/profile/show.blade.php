@php
    $user = auth()->user();
@endphp

@include('partials.header')

<div class="content profile-page">
    
    <div class="profile-info">
        <div class="profile-top">
            <div class="profile-header">
                <div class="profile-picture">
                    <h4>{{ strtoupper(substr($user->firstname, 0, 1)) }}{{ strtoupper(substr($user->lastname, 0, 1)) }}</h4>
                </div>

                <div class="profile-content">
                    <h3>{{ $user->firstname }} {{ $user->lastname }}</h3>

                    <div class="attributes">
                        <div class="single-attribute">
                            <img src="{{ asset('images/icons/location-green.png') }}" alt="">
                            <p class="body-sm">{{ $user->email }}</p>
                        </div>
                        <div class="single-attribute">
                            <img src="{{ asset('images/icons/clock.png') }}" alt="">
                            <p class="body-sm">Lid sinds {{ $user->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="profile-actions">
                <a class="round-btn darkblue body-lg" href="">Edit profile</a>
            </div>
        </div>

        <div class="stat-cards">
            <div class="stat-card">
                <img src="{{ asset('images/icons/check.png') }}" alt="">
                <h4>
                    {{ $userProducts->where('status', 'accepted')
                                    ->where('appointment_status', 'accepted')
                                    ->count() }}
                </h4>
                <p class="subtitle">aangekocht</p>
            </div>
            <div class="stat-card">
                <img src="{{ asset('images/icons/box-green.png') }}" alt="">
                <h4>{{ $userProducts->count() }}</h4>
                <p class="subtitle">actief</p>
            </div>
            <div class="stat-card">
                <img src="{{ asset('images/icons/pricetag-green.png') }}" alt="">
                <h4>
                    {{
                        \App\Models\Reservation::where('seller_id', auth()->id())
                            ->where('status', 'accepted')
                            ->where('appointment_status', 'accepted')
                            ->count()
                    }}
                </h4>
                <p class="subtitle">verkocht</p>
            </div>
        </div>
    </div>

    <div class="reserve-messages">

        <div class="section-header">
            <p class="subtitle">inbox</p>
            <div class="marketplace-description">
                <h3>Recente reserveringsaanvragen</h3>
                <a class="notification-btn darkblue body-md" href="{{ route('reservations.index') }}">Bekijk alle reservaties</a>
            </div>
        </div>

        @include('partials.inbox')

    </div>


    @include('partials.myproducts')

</div>

@include('partials.footer')