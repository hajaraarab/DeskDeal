@include('partials.header')

<div class="content view-product">
        <a href="{{ route('marketplace') }}" class="back-link body-md"><- Terug naar Marketplace</a>

        <div class="product-detail">
            <div class="product-detail-media">
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

                <h3>€ {{ $product->price }}</h3>

                <div class="attributes">
                    <div class="single-attribute">
                        <img src="{{ asset('images/icons/location-green.png') }}" alt="">
                        <p class="body-sm">Locatie: {{ $product->location }}</p>
                    </div>
                    <div class="single-attribute">
                        <img src="{{ asset('images/icons/clock.png') }}" alt="">
                        <p class="body-sm">Geplaatst {{ $product->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                <div class="user-details">
                    <p class="body-md">{{ $product->user->firstname }} {{ $product->user->lastname }}</p>
                    <p class="body-sm">Lid sinds {{ $product->user->created_at->format('Y') }}</p>
                </div>

                <a class="round-btn darkblue body-lg" href="">Reserveren</a>
            </div>
        </div>
</div>

@include('partials.footer')