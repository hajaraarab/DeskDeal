@include('partials.header')

<div class="content myproducts-page">

<a href="{{ route('profile.show') }}" class="back-link body-md">
    <img src="{{ asset('images/icons/back.png') }} " alt="Terug naar mijn profiel">
        Terug naar mijn profiel
</a>

<div class="section-header">
    <p class="subtitle">mijn aanbod</p>
    <h3>Jouw geplaatste producten</h3>
    <p class="body-lg grey">
        Hier vind je een overzicht van alle producten die je hebt aangeboden. Beheer je advertenties, bekijk de status van je producten en help materialen een tweede leven te geven.
    </p>
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