
@forelse($products as $product)
    @php
        $blocked = false;
        try {
            $blocked = $product->reservations()->where('status', 'accepted')->where('appointment_status', 'accepted')->exists();
        } catch (\Throwable $e) {
            $blocked = false;
        }
    @endphp



    @if(!$blocked)
    <a href="{{ route('products.show', $product) }}" class="product-card-link swiper-slide">
        <div class="product-card">
            @if($product->images->isNotEmpty())
            
                <div class="reserved-status body-sm">
                    <p>{{ $product->status === 'available' ? 'Beschikbaar' : 'Niet beschikbaar' }}</p>
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
                        <img src="{{ asset('images/icons/pricetag.png') }}" alt="Filter Icon">
                        <p>{{ $product->category?->name }}</p>
                    </div>

                    <div class="meta-item">
                        <img src="{{ asset('images/icons/location.png') }}" alt="Filter Icon">
                        <p>{{ $product->location }}</p>
                    </div>
                </div>
            </div>
        </div>
   </a>
    @endif
@empty 
<div class="empty-state">
    <h3>Er zijn momenteel geen producten beschikbaar.</h3>
</div>
@endforelse