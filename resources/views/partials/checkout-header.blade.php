@php
    $appointment = session('checkout_appointment');
@endphp

    <div class="product-reserved">
        <div class="product-reserved-top">
            
            <div class="icon-container">
                <img src="{{ asset('images/icons/check-mark.png') }} " alt="Checkmark icon">
            </div>

            <div class="product-reserved-header">
                <p class="subtitle">Reservering geaccepteerd</p>
                <h3>Goed nieuws - je mag {{ $product->title }} je kopen</h3>
                <p class="body-sm grey">{{ $product->user->firstname }} heeft je reservering goedgekeurd. Plan hieronder een afspraak en kies hoe je het product wil ontvangen.</p>
            </div>
        </div>

        <div class="reservation-product-bottom">
            <div class="reservation-product-info">
                <div class="attributes">
                    <img src="{{ asset('images/icons/box-green.png') }}" alt="Product">
                    <p class="subtitle">product</p>
                </div>
                <p class="body-lg">{{ $product->title }} </p>
            </div>

            <div class="reservation-product-info">
                <div class="attributes">
                    <img src="{{ asset('images/icons/box-green.png') }}" alt="Product">
                    <p class="subtitle">verkoper</p>
                </div>
                <p class="body-lg">{{ $product->user->firstname }} {{ $product->user->lastname }} </p>
            </div>

            <div class="reservation-product-info">
                <div class="attributes">
                    <img src="{{ asset('images/icons/box-green.png') }}" alt="Product">
                    <p class="subtitle">locatie</p>
                </div>
                <p class="body-lg">{{ $product->location }} </p>
            </div>
        </div>
    </div>

