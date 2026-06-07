<style>
    body {
        background-color: #f5f7fa;
    }
</style>

@include('partials.header')

<div class="content make-delivery-confirmation">

    <div class="message">
        <div class="icon-container">
            <img src="{{ asset('images/icons/check-mark.png') }} " alt="Checkmark icon">
        </div>

        <div class="message-header">
            <h2>Bestelling bevestigd</h2>
            <p class="body-lg grey">
                Je krijgt zo dadelijk een mail met alle details. Veel plezier met je nieuwe aankoop !
            </p>
        </div>

        <div class="product-information">
            <div class="delivery-confirmation-info">
                <p class="body-md">Product</p>
                <p class="body-lg">{{ $product->title }}</p>
            </div>

            <div class="delivery-confirmation-info">
                <p class="body-md">Verkoper</p>
                <p class="body-lg">
                    {{ $product->user->firstname }}
                    {{ $product->user->lastname }}
                </p>
            </div>

            <div class="delivery-confirmation-info">
                <p class="body-md">Afspraak</p>

                <p class="body-lg">

                    {{ \Carbon\Carbon::parse($reservation->pickup_date)->format('d/m/Y') }}
                    om
                    {{ \Carbon\Carbon::parse($reservation->pickup_time)->format('H:i') }}
                </p>
            </div>

            <div class="delivery-confirmation-info">
                <p class="body-md">Levering</p>

                <p class="body-lg">
                    @if($reservation->delivery_method === 'delivery')

                        {{ $reservation->delivery_address }}

                    @else

                        Zelf afhalen

                    @endif
                </p>
            </div>
        </div>
    </div>
</div>