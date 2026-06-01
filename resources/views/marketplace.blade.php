@include('partials.header')

<div class="hero-banner">
    <h1>@yield('title')</h1>
</div>

<div class="content">
    <h1>Welcome to the marketplace Page</h1>
    <p>This is the content of the marketplaces page.</p>

    <div class="search-container">
        <input type="text" placeholder="Search for products...">
        <button class="" type="submit">Search</button>
    </div>

    <div class="marketplace-container">
        <div class="sidebar">

            <a href="{{ route('products.create') }}" >Voeg product toe</a>

            <p>Categorieën</p>

            <a href="#" class="">Alle categorieën</a>

            @foreach($categories as $category)
                <p>{{ $category->name }}</p>
            @endforeach
        </div>
        
        <div class="product-listing">
            @foreach($products as $product)
                <div class="product-card">
                    <img src="{{ asset('') }}" alt="Product Image">
                    <h3>{{ $product->name }}</h3>
                    <p>{{ $product->description }}</p>
                    <p class="price">€{{ number_format($product->price, 2) }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>

@include('partials.footer')