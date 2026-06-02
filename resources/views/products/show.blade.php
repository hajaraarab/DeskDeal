@include('partials.header')

    <h1>{{ $product->title }}</h1>

    @if($product->images->isNotEmpty())
        <img
            src="{{ asset('storage/' . $product->images->first()->image_path) }}"
            alt="{{ $product->title }}"
            width="400"
        >
    @endif

    <p>Categorie: {{ $product->category?->name }}</p>
    <p>Locatie: {{ $product->location }}</p>
    <p>{{ $product->description }}</p>

@include('partials.footer')