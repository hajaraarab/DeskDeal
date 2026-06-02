
    @forelse($products as $product)
        <div class="product-card">
            @if($product->images->isNotEmpty())
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
    @empty 
    <div class="empty-state">
        <h3>Er zijn momenteel geen producten beschikbaar.</h3>
    </div>
    @endforelse