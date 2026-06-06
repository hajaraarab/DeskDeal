@include('partials.header')

<div class="content checkout">

    <div class="product-reserved">
        <div class="product-reserved-top">
            
            <div class="icon-container">
                <img src="{{ asset('images/icons/check-mark.png') }} " alt="Checkmark icon">
            </div>

            <div class="product-reserved-header">
                <p class="subtitle">Reservering geaccepteerd</p>
                <h3>Goed nieuws - je mag {{ $product->title }} je kopen</h3>
                <p class="body-sm">{{ $product->user->firstname }} heeft je reservering goedgekeurd. Plan hieronder een afspraak en kies hoe je het product wil ontvangen.</p>
            </div>
        </div>

        <div class="reservation-product-bottom">
            <div class="reservation-product-info">
                <div class="attributes">
                    <img src="{{ asset('images/icons/box-green.png') }}" alt="">
                    <p class="subtitle">product</p>
                </div>
                <p class="body-lg">{{ $product->title }} </p>
            </div>

            <div class="reservation-product-info">
                <div class="attributes">
                    <img src="{{ asset('images/icons/box-green.png') }}" alt="">
                    <p class="subtitle">verkoper</p>
                </div>
                <p class="body-lg">{{ $product->user->firstname }} {{ $product->user->lastname }} </p>
            </div>

            <div class="reservation-product-info">
                <div class="attributes">
                    <img src="{{ asset('images/icons/box-green.png') }}" alt="">
                    <p class="subtitle">locatie</p>
                </div>
                <p class="body-lg">{{ $product->location }} </p>
            </div>
        </div>
    </div>

    <div class="transport">
            <div class="product-reserved-header">
                <div class="icon-and-title">
                    <img src="{{ asset('images/icons/truck-green.png') }}" alt="">
                    <h4>Hoe wil je het ontvangen ?</h4>
                </div>
                <p class="body-sm">Kies de optie die voor jou het beste werkt. </p> 

                <div class="transport-options">

                    <label class="transport-option deliveryservice">
                        <div class="icon-wrapper">
                            <img src="{{ asset('images/icons/truck.png') }}" alt="">
                        </div>

                        <div class="transport-option-info">
                            <h5>Deskdeal bezorgservice</h5>
                            <p class="body-sm">Wij brengen het bij je thuis. Vanaf € 4,99</p>
                        </div>

                        <input type="radio" name="delivery_method" value="delivery">
        
                    </label>

                    <label class="transport-option selfpickup">
                        <div class="icon-wrapper">
                            <img src="{{ asset('images/icons/location-darkblue.png') }}" alt="">
                        </div>

                        <div class="transport-option-info">
                            <h5>Zelf afhalen</h5>
                            <p class="body-sm">Pik het op bij de verkoper in Antwerpen. Gratis</p>
                        </div>

                        <input type="radio" name="delivery_method" value="delivery">
        
                    </label>
                </div>

                <div class="transport-output deliveryservice">
                    <div class="form-field required">
                        <label for="deliveryadres">Leveringsadres</label>
                        <input type="text" name="deliveryadres" placeholder="Straat, nummer, postcode, stad" >
                    </div>

                    <div class="deliveryservice-info">
                        <div class="icon-and-title">
                            <img src="{{ asset('images/icons/check-mark.png') }}" alt="">
                            <h5>Eerstvolgende beschikbare leverdatum</h5>
                        </div>
        
                        <p class="body-md">maandag 17 juni - tussen 14:00 en 16:00</p>
                        <p class="body-sm">Automatisch ingepland door bezorgservice</p>
                    </div>
                </div>

                <div class="transport-output selfpickup">
                    <div class="delivery-withservice">
                        <h5>Selfpickup</h5>
                    </div>
                </div>

            </div>
    </div>

</div>

@include('partials.footer')