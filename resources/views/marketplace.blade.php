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
        <div class="marketplace-description">
            <h2>Vind je volgende kantoorvonst</h2>
            <p>6 items beschikbaar - bekijk per categorie</p>
        </div>
    </div>

    <div class="search-container">
        <input type="text" placeholder="🔍   Search for products...">
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

                <a 
                    href="{{ route('marketplace.filter') }}" 
                    class="category-link active-category body-sm"
                >
                    Alle categorieën
                </a>

                @foreach($categories as $category)
                    <a 
                        href="{{ route('marketplace.filter', ['category' => $category->id]) }}"
                        class="category-link body-sm"
                    >
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>

        </div>
        <div class="product-listing" id="product-listing">
            @include('partials.product-list')
        </div>
    </div>
</div>

@include('partials.footer')