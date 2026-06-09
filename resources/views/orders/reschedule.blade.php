@include('partials.header')

<div class="content create-product reschedule-page">

    <a href="{{ route('reservations.index') }}" class="back-link body-md">
        <img src="{{ asset('images/icons/back.png') }}" alt="Terug">
        Terug naar reservaties
    </a>

    <div class="section-header">
        <p class="subtitle">Leveringsmoment wijzigen</p>

        <h2>Stel een ander moment voor</h2>

        <p class="body-sm">
            Het voorgestelde moment past niet? Kies een nieuwe datum en tijd.
            De andere partij krijgt hiervan een melding en heeft 24 uur om het voorstel te accepteren.
        </p>
    </div>

    @if ($errors->any())
        <div class="form-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        class="create-product-form"
        action="{{ route('orders.reschedule.store', $order) }}"
        method="POST"
    >
        @csrf

        <p class="subtitle">Huidige leveringsgegevens</p>

         <div class="delivery-confirmation">

            <div class="delivery-confirmation-info">
                <p class="body-md title">Product</p>
                <p class="body-md">{{ $order->product->title }}</p>
            </div>

            <div class="delivery-confirmation-info">
                <p class="body-md title">Verkoper</p>
                <p class="body-md">
                    {{ $product->user->firstname }}
                    {{ $product->user->lastname }}
                </p>
            </div>

            <div class="delivery-confirmation-info">
                <p class="body-md title">Afspraak</p>

                <p class="body-md">

                        {{ \Carbon\Carbon::parse($order->pickup_date)->format('d/m/Y') }}
                        om
                        {{ \Carbon\Carbon::parse($order->pickup_time)->format('H:i') }}
                </p>
            </div>

            <div class="delivery-confirmation-info">
                <p class="body-md title">Levering</p>

                <p class="body-md">
                    @if($order->delivery_method === 'delivery')

                        {{ $order->delivery_address }}

                    @else

                        Zelf afhalen

                    @endif
                </p>
            </div>
        </div>

        @if($order->delivery_method === 'pickup')

            <div class="form-group">

                <div class="form-field">
                    <label for="pickup_date">
                        Nieuwe datum
                    </label>

                    <input
                        type="date"
                        name="pickup_date"
                        min="{{ now()->toDateString() }}"
                        value="{{ old('pickup_date', $order->pickup_date) }}"
                        required
                    >
                </div>

                <div class="form-field">
                    <label for="pickup_time">
                        Nieuw tijdstip
                    </label>

                    <input
                        type="time"
                        name="pickup_time"
                        value="{{ old('pickup_time', $order->pickup_time) }}"
                        required
                    >
                </div>

            </div>

        @else

            <div class="form-group">

                <div class="form-field">
                    <label for="pickup_date">
                        Nieuwe ophaaldatum
                    </label>

                    <input
                        type="date"
                        name="pickup_date"
                        min="{{ now()->toDateString() }}"
                        value="{{ old('pickup_date', $order->pickup_date) }}"
                        required
                    >
                </div>

                <div class="form-field">
                    <label for="pickup_time">
                        Nieuw ophaalmoment
                    </label>

                    <input
                        type="time"
                        name="pickup_time"
                        value="{{ old('pickup_time', $order->pickup_time) }}"
                        required
                    >
                </div>

            </div>

        @endif

        <div class="form-field">
            <label for="message">
                Reden van wijziging (optioneel)
            </label>

            <textarea
                name="message"
                rows="4"
                placeholder="Geef eventueel een korte toelichting..."
            >{{ old('message') }}</textarea>
        </div>

        <div class="form-actions">

            <a
                href="{{ route('reservations.index') }}"
                class="back-link body-lg"
            >
                Annuleren
            </a>

            <button
                class="round-btn darkblue body-lg"
                type="submit"
            >
                Nieuw voorstel versturen
            </button>

        </div>

    </form>

</div>

@include('partials.footer')