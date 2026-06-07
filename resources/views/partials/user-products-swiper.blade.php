@php
    $userProducts = $userProducts ?? auth()->user()?->products ?? collect();
@endphp

@if($userProducts->isNotEmpty())
    <div class="info-block user-products">

        <div class="product-detail-header">
            <p class="subtitle">Mijn producten</p>
            <h3>Producten die jij plaatste</h3>
        </div>

        <div class="swiper user-products-swiper">
            <div class="swiper-wrapper">

                @foreach($userProducts as $product)
                    <div class="swiper-slide">

                        <a href="{{ route('products.show', $product) }}" class="product-card-link">
                            <div class="product-card">

                                @if($product->images->isNotEmpty())
                                    <div class="reserved-status body-sm">
                                        <p>
                                            {{ $product->status === 'available' ? 'Beschikbaar' : 'Niet beschikbaar' }}
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
                                                alt=""
                                            >
                                            <p>{{ $product->category?->name }}</p>
                                        </div>

                                        <div class="meta-item">
                                            <img
                                                src="{{ asset('images/icons/location.png') }}"
                                                alt=""
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
