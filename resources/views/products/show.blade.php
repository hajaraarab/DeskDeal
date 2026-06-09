@include('partials.header')

<div class="content view-product">
        <a href="{{ route('marketplace') }}" class="back-link body-md">
            <img src="{{ asset('images/icons/back.png') }} " alt="Terug naar Marketplace">
            Terug naar Marketplace
        </a>

        <div class="product-detail">
            <div class="product-detail-media">

                <div class="reserved-status body-sm">
                    <p>{{ $product->status === 'available' ? 'Beschikbaar' : 'Niet beschikbaar' }}</p>
                </div>

                @if($product->images->isNotEmpty())

                    {{-- Grote hoofdafbeelding --}}
                    <img
                        class="product-detail-main-image"
                        src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                        alt="{{ $product->title }}"
                    >

                    {{-- Overige afbeeldingen --}}
                    <div class="product-detail-images">
                        @foreach($product->images->skip(1) as $image)
                            <img
                                class="product-detail-image"
                                src="{{ asset('storage/' . $image->image_path) }}"
                                alt="{{ $product->title }}"
                            >
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="product-detail-content">
                <div class="product-detail-header">
                    <p class="subtitle">{{ $product->category?->name }}</p>
                    <h2>{{ $product->title }}</h2>
                    <p class="body-md">{{ $product->description }}</p>
                </div>

                <h3> {{ $product->is_free ? 'Gratis' : '€ ' . $product->price }}</h3>

                <div class="attributes">
                    <div class="single-attribute">
                        <img src="{{ asset('images/icons/location-green.png') }}" alt="Locatie">
                        <p class="body-sm">Locatie: {{ $product->location }}</p>
                    </div>
                    <div class="single-attribute">
                        <img src="{{ asset('images/icons/clock.png') }}" alt="Gepost op">
                        <p class="body-sm">Geplaatst {{ $product->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                <div class="user-details">
                    <p class="body-md">{{ $product->user->firstname }} {{ $product->user->lastname }}</p>
                    <p class="body-sm">Lid sinds {{ $product->user->created_at->format('Y') }}</p>
                </div>

                @if(auth()->id() === $product->user_id)
                    <a
                        class="round-btn darkblue body-lg"
                        href="{{ route('products.edit', $product) }}"
                    >
                        Product bewerken
                    </a>
                @elseif($product->status === 'available')
                    <div class="product-actions">
                        <a class="round-btn darkblue body-lg" href="{{ route('reservations.create', $product) }}">
                            Reserveren
                        </a>
                        <a
                            class="round-btn blue body-md"
                            href="mailto:{{ $product->user->email }}?subject=Vraag over {{ urlencode($product->title) }}"
                        >
                            Contacteer gebruiker
                        </a>
                    </div>

                @else 
                    <button
                        class="round-btn disabled body-lg"
                        disabled
                    >
                        Reeds gereserveerd
                    </button>
                @endif
            </div>
        </div>

    <div class="info-block">
        <div class="product-detail-header">
            <p class="subtitle">Locatie</p>
            <h3>Waar staat dit item? </h3>
            <p class="body-sm">{{ $product->location }} - open in Google Maps</p>
        </div>

        <iframe
            loading="lazy"
            allowfullscreen
            src="https://maps.google.com/maps?q={{ urlencode($product->location) }}&t=&z=13&ie=UTF8&iwloc=&output=embed">
        </iframe>
    </div>

    <div class="info-block">
        <div class="product-detail-header">
            <p class="subtitle">duurzaamheid</p>
            <h3>Duurzaamheidsmeter </h3>

            <div class="meter-bar">
                <div
                    class="meter-fill"
                    style="width: {{ $sustainability['score'] }}%"
                ></div>
            </div>

            <h4>{{ $sustainability['score'] }}/100</h4>

            <p class="body-md">
                {{ $sustainability['label'] }}
            </p>

            <p class="body-sm">
                🌱 Door dit meubel een tweede leven te geven wordt naar schatting
                {{ $sustainability['co2_savings'] }} kg CO₂-uitstoot vermeden.
            </p>
        </div>
    </div>

@if($relatedProducts->isNotEmpty())
    <div class="info-block related-products">

        <div class="product-detail-header">
            <p class="subtitle">Ontdek meer</p>
            <h3>Misschien ook interessant</h3>
        </div>

        <div class="swiper related-products-swiper">
            <div class="swiper-wrapper">

                @foreach($relatedProducts as $relatedProduct)
                    <div class="swiper-slide">

                        <a
                            href="{{ route('products.show', $relatedProduct) }}"
                            class="product-card-link"
                        >
                            <div class="product-card">

                                @if($relatedProduct->images->isNotEmpty())
                                    <div class="reserved-status body-sm">
                                        <p>
                                            {{ $relatedProduct->status === 'available'
                                                ? 'Beschikbaar'
                                                : 'Niet beschikbaar' }}
                                        </p>
                                    </div>

                                    <img
                                        src="{{ asset('storage/' . $relatedProduct->images->first()->image_path) }}"
                                        alt="{{ $relatedProduct->title }}"
                                    >
                                @endif

                                <div class="product-details">
                                    <h6>{{ $relatedProduct->title }}</h6>

                                    <div class="product-meta">

                                        <div class="meta-item">
                                            <img
                                                src="{{ asset('images/icons/pricetag.png') }}"
                                                alt="Prijs"
                                            >
                                            <p>{{ $relatedProduct->category?->name }}</p>
                                        </div>

                                        <div class="meta-item">
                                            <img
                                                src="{{ asset('images/icons/location.png') }}"
                                                alt="Locatie"
                                            >
                                            <p>{{ $relatedProduct->location }}</p>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </a>

                    </div>
                @endforeach

            </div>
        </div>

    </div>
@endif
</div>

@include('partials.footer')