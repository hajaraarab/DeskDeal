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
        <p class="subtitle">Slim kiezen begint hier</p>
        <div class="marketplace-description">
            <h2>Vind je volgende kantoorvonst</h2>
            <p class="info-message">{{ $products->total() }} items beschikbaar - bekijk per categorie</p>
        </div>
    </div>

    <div class="search-container">
        <input id="search-input" type="text" placeholder="🔍   Search for products...">
        <button id="filter-button" class="button-with-icon border body-sm" type="button">
            <img src="{{ asset('images/icons/filter-icon.png') }}" alt="Filter Icon">
            Filter
        </button>

        <div class="filter-popup" id="province-filter-popup" aria-hidden="true">
            <label for="province-select" class="filter-popup-label body-sm">Selecteer provincie</label>
            <select id="province-select" class="filter-popup-select body-sm">
                <option value="">Alle provincies</option>
                <option value="Antwerpen">Antwerpen</option>
                <option value="Limburg">Limburg</option>
                <option value="Oost-Vlaanderen">Oost-Vlaanderen</option>
                <option value="Vlaams-Brabant">Vlaams-Brabant</option>
                <option value="West-Vlaanderen">West-Vlaanderen</option>
                <option value="Brussel">Brussel</option>
                <option value="Waals-Brabant">Waals-Brabant</option>
                <option value="Henegouwen">Henegouwen</option>
                <option value="Luik">Luik</option>
                <option value="Namen">Namen</option>
                <option value="Luxemburg">Luxemburg</option>
            </select>
            <div class="filter-popup-actions">
                <button id="apply-province-filter" type="button" class="button-with-icon border body-sm">
                    Toepassen
                </button>
            </div>
        </div>
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

            @if(method_exists($products, 'links'))
                <div class="pagination-wrapper">
                    {{ $products->links() }}
                </div>
            @endif
</div>

@include('partials.footer')