<style>
    body {
        background-color: #f5f7fa;
    }
</style>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@include('partials.header')

<div class="content create-product">

    <a href="{{ route('marketplace') }}" class="back-link body-md"><- Terug naar Marketplace</a>

    <div class="section-header">
        <p class="subtitle">new subtitle</p>
        <h2>Vind je volgende kantoorvonst</h2>
        <p class="body-sm">Vul de gegevens hieronder in. Hoe completer je advertentie, hoe sneller je item een nieuwe eigenaar vindt.</p>
    </div>

    <form enctype="multipart/form-data" class="create-product-form" action="{{ route('products.store') }}" method="POST">
        @csrf
        <!-- MAX 2MB PER FOTO -->
        <div class="form-field">
            <label for="product-images">Foto's</label>

            <div class="image-upload-wrapper">
                <img class="icon" src="{{ asset('images/icons/upload.png') }}" alt="Filter Icon">
                <p class="body-md">Sleep foto's hierheen of klik om te uploaden</p>
                <p class="body-sm">PNG, JPG of JPEG, max 2 MB per foto</p>
                <input
                    type="file"
                    name="images[]"
                    class="image-upload"
                    accept="image/*"
                    multiple
                >
            </div>
        </div>

        <div class="form-group">
            <div class="form-field">
                <label for="title">Titel:</label>
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
                    required
                >

            <label class="checkbox-label">
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
                <label class="checkbox-label">
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

        <div class="form-actions">
            <a href="" class="back-link body-lg">Annuleren</a>
            <button class="round-btn darkblue body-lg"type="submit">Create Product</button>
        </div>
        
    </form>
</div>

@include('partials.footer')