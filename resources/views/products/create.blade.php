<style>
    body {
        background-color: #f5f7fa;
    }
</style>

@include('partials.header')

<div class="content create-product">

    <a href="{{ route('marketplace') }}" class="back-link body-md"><- Terug naar Marketplace</a>

    <div class="section-header">
        <p class="subtitle">new subtitle</p>
        <h2>Vind je volgende kantoorvonst</h2>
        <p class="body-sm">Vul de gegevens hieronder in. Hoe completer je advertentie, hoe sneller je item een nieuwe eigenaar vindt.</p>
    </div>

    <form class="create-product-form" action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <div class="form-field">
                <label for="title">Title:</label>
                <input 
                    type="text" 
                    name="title" 
                    value="{{ old('title') }}"
                    placeholder="Bv. Ergonomische bureaustoel"
                    required
                >
            </div>

            <div class="form-field">
                <label for="category">Category:</label>
                <select 
                    name="category_id" 
                    placeholder="Selecteer een categorie"
                    required
                >

                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}
                        >
                        {{ $category->name }}
                    </option>
                @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="form-field">
                <label for="price">Prijs:</label>
                <input 
                type="number" 
                name="price" 
                placeholder="€ 22"
                step="0.01" 
                required>
            <label>
                <input 
                    type="checkbox"
                    name="free_product"
                    value="1"
                >
                Gratis aanbieden
            </label>
            </div>

            <div class="form-field">
                <label for="location">Stad:</label>
                <input 
                    type="text" 
                    name="location" 
                    placeholder="Bv. Antwerpen"
                    value="{{ old('location') }}"
                    required
                >
                <label>
                <input 
                    type="checkbox"
                    name="use_company_location"
                    value="1"
                >
                Gebruik bedrijfslocatie
                </label>
            </div>
        </div>

        <div class="form-field">
            <label for="description">Beschrijving:</label>
            <textarea 
                name="description" 
                placeholder="Beschrijf je item: afmetingen, staat, ..."
                required
            >
                {{ old('description') }}
            </textarea>
        </div>

        <div class="create-product-buttons">
            <a href="" class="back-link body-lg">Annuleren</a>
            <button class="round-btn darkblue body-lg"type="submit">Create Product</button>
        </div>
        
    </form>
</div>

@include('partials.footer')