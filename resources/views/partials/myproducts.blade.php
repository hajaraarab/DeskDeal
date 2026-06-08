
@if($userProducts->isNotEmpty())
    <div class="myproducts">

        <div class="section-header">
            <p class="subtitle">mijn producten</p>
            <div class="marketplace-description">
                <h3>Mijn geplaatste producten</h3>
                <a class="notification-btn darkblue body-md" href="">Bekijk al mijn producten</a>
            </div>
        </div>

        <div class="swiper user-products-swiper">
            <div class="swiper-wrapper">

                @foreach($userProducts as $product)

                    @php
                        if ($product->status === 'accepted' && $product->appointment_status === 'accepted') {
                            $filterStatus = 'sold';
                        } elseif ($product->status === 'reserved') {
                            $filterStatus = 'reserved';
                        } else {
                            $filterStatus = 'available';
                        }
                    @endphp

                    <div class="swiper-slide product-item" data-filter-status="{{ $filterStatus }}">

                        <a href="{{ route('products.show', $product) }}" class="product-card-link">
                            <div class="product-card">

                                @if($product->images->isNotEmpty())
                                    <div class="reserved-status body-sm">
                                        <p>
                                            @if($filterStatus === 'available')
                                                Beschikbaar
                                            @elseif($filterStatus === 'reserved')
                                                Gereserveerd
                                            @elseif($filterStatus === 'sold')
                                                Verkocht
                                            @endif
                                        </p>
                                    </div>

                                    <img
                                        src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                        alt="{{ $product->title }}"
                                    >
                                @endif

                                <div class="product-details">
                                    <h6>{{ $product->title }}</h6>

                                    <div class="product-meta">

                                        <div class="meta-item">
                                            <img
                                                src="{{ asset('images/icons/pricetag.png') }}"
                                                alt="Prijs"
                                            >
                                            <p>{{ $product->category?->name }}</p>
                                        </div>

                                        <div class="meta-item">
                                            <img
                                                src="{{ asset('images/icons/location.png') }}"
                                                alt="Locatie"
                                            >
                                            <p>{{ $product->location }}</p>
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
