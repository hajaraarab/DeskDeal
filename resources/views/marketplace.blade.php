<style>
    body {
        background-color: #f5f7fa;
    }
</style>

@include('partials.header')

<div class="hero-banner-container">
    <div class="hero-banner">
        <h1>Marketplace</h1>
    </div>
</div>

<div class="content marketplace">

    <div class="section-header">
        <p class="subtitle">new subtitle</p>
        <div class="marplace-description">
            <h2>Vind je volgende kantoorvonst</h2>
            <p>6 items beschikbaar - bekijk per categorie</p>
        </div>
    </div>

    <div class="search-container">
        <input type="text" placeholder="Search for products...">
        <button class="button-with-icon body-sm" type="submit">
            <img src="{{ asset('images/icons/filter-icon.png') }}" alt="Filter Icon">
            Filter
        </button>
    </div>

    <div class="marketplace-container">
        <div class="sidebar">

            @auth
                <a class="round-btn darkblue body-lg" href="{{ route('products.create') }}" >+ Voeg product toe</a>
            @endauth

            <div class="categories">
                <p class="subtitle">Categorieën</p>

                <a href="#" class="">Alle categorieën</a>

                @foreach($categories as $category)
                    <p>{{ $category->name }}</p>
                @endforeach
            </div>

        </div>
        
        <div class="product-listing">
            @foreach($products as $product)
                <div class="product-card">
                    @if($product->images->isNotEmpty())
                        <img
                            src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                            alt="{{ $product->title }}"
                        >
                    @endif
                    <h3>{{ $product->title }}</h3>
                    <p>{{ $product->description }}</p>
                    <p>{{ $product->location }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>

@include('partials.footer')