@include ('partials.header')

<div class="content checkout">
    @include ('partials.checkout-header')

        <div class="transport">
            <div class="product-reserved-header">
                <div class="icon-and-title">
                    <img src="{{ asset('images/icons/truck-green.png') }}" alt="Bezorgservice">
                    <h4>Hoe wil je het ontvangen ?</h4>
                </div>
                <p class="body-sm grey">Kies de optie die voor jou het beste werkt. </p> 
            </div>

            <div class="transport-options">

                <label class="transport-option deliveryservice">
                    <div class="transport-option-text">
                        <div class="icon-wrapper">
                            <img src="{{ asset('images/icons/truck.png') }}" alt="Bezorgoptie">
                        </div>

                        <div class="transport-option-info">
                            <h5>Deskdeal bezorgservice</h5>
                            <p class="body-sm">Wij brengen het bij je thuis. Vanaf € 4,99</p>
                        </div>
                    </div>

                    <input 
                        type="radio" 
                        name="delivery_method" 
                        value="delivery"
                        {{ ($appointment['delivery_method'] ?? '') === 'delivery' ? 'checked' : '' }}
                    >
    
                </label>

                <label class="transport-option selfpickup">
                    <div class="transport-option-text">
                        <div class="icon-wrapper">
                            <img src="{{ asset('images/icons/location-darkblue.png') }}" alt="Zelf ophalen">
                        </div>

                        <div class="transport-option-info">
                            <h5>Zelf afhalen</h5>
                            <p class="body-sm">Pik het op bij de verkoper in Antwerpen. Gratis</p>
                        </div>
                    </div>

                    <input 
                        type="radio" 
                        name="delivery_method" 
                        value="pickup"
                        {{ ($appointment['delivery_method'] ?? '') === 'pickup' ? 'checked' : '' }}

                    >
    
                </label>
            </div>

            <div class="transport-output deliveryservice">
                <form 
                    id="delivery-form" 
                    method="POST"
                    action="{{ route('reservation.appointment.preview', $reservation) }}"
                >
                    @csrf

                    <input
                        type="hidden"
                        name="delivery_method"
                        value="delivery"
                    >
                    <div class="form-field required">
                        <label for="deliveryadres">Leveringsadres</label>
                        <input 
                            type="text" 
                            name="deliveryadres" 
                            placeholder="Straat, nummer, postcode, stad" 
                            value="{{ old('deliveryadres', $appointment['delivery_address'] ?? '') }}"
                        >
                        <p class="error-message"></p>
                    </div>

                    <div class="deliveryservice-info">
                        <div class="icon-and-title">
                            <img src="{{ asset('images/icons/calender.png') }}" alt="Beschikbare datum">
                        </div>
                        <div class="transport-info">
                            <h5>Eerstvolgende beschikbare leverdatum</h5>
                            <p class="body-md">maandag 17 juni - tussen 14:00 en 16:00</p>
                            <p class="body-sm">Automatisch ingepland door bezorgservice</p>
                        </div>
                    </div>

                    <button type="submit" class="round-btn darkblue body-lg">Volgende</button>
                </form>
            </div>

            <div class="transport-output selfpickup">
                <div class="delivery-selfpickup">

                    <div class="icon-and-title">
                            <img src="{{ asset('images/icons/clock.png') }}" alt="Kies tijd">
                    </div>

                    <p class="body-sm grey">Spreek af op een moment dat voor jou past. </p> 

                    <div class="selfpickup-info">

                        <form 
                            id="pickup-form" 
                            method="POST"
                            action="{{ route('reservation.appointment.preview', $reservation) }}"
                        >
                        @csrf

                            <input
                                type="hidden"
                                name="delivery_method"
                                value="pickup"
                            >

                            <div class="selfpickup-inputs">
                                <div class="form-field required">
                                    <label for="pickup-date">Pick up datum: </label>
                                    <input 
                                        type="date" 
                                        name="pickup-date" 
                                        placeholder="19/06/2026" 
                                        value="{{ old('pickup-date', $appointment['pickup_date'] ?? '') }}"
                                    >
                                    <p class="error-message"></p>
                                </div>

                                <div class="form-field required">
                                    <label for="pickup-time">Tijd</label>
                                    <input
                                        type="time"
                                        id="pickup-time"
                                        name="pickup_time"
                                        value="{{ old('pickup_time', $appointment['pickup_time'] ?? '') }}"
                                    >
                                    <p class="error-message"></p>
                                </div>
                            </div>

                            <button type="submit" class="round-btn darkblue body-lg">Volgende</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>

@include ('partials.footer')