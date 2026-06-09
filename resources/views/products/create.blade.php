<style>
    body {
        background-color: #f5f7fa;
    }
</style>

@include('partials.header')

<div class="content create-product">

    <a href="{{ route('marketplace') }}" class="back-link body-md">
        <img src="{{ asset('images/icons/back.png') }} " alt="Terug naar Marketplace">
         Terug naar Marketplace
    </a>

    <div class="section-header">
        <p class="subtitle">{{ isset($isEdit) ? 'Product bewerken' : 'Plaats je product' }}</p>
        <h2>Vind je volgende kantoorvonst</h2>
        <p class="body-sm">Vul de gegevens hieronder in. Hoe completer je advertentie, hoe sneller je item een nieuwe eigenaar vindt.</p>
    </div>

    <form
        enctype="multipart/form-data"
        class="create-product-form"
        action="{{ isset($isEdit)
            ? route('products.update', $product)
            : route('products.store') }}"
        method="POST"
    >

        @csrf

        @if(isset($isEdit))
            @method('PATCH')
        @endif

            <input
                type="hidden"
                name="delete_images"
                id="delete-images-input"
                value=""
            >

        <!-- MAX 2MB PER FOTO -->
        <div class="form-field">
            <label for="product-images">Foto's</label>

            <div class="image-upload-wrapper">
                <img class="icon" src="{{ asset('images/icons/upload.png') }}" alt="Upload foto">
                <p class="body-md">Sleep foto's hierheen of klik om te uploaden</p>
                <p class="body-sm">PNG, JPG of JPEG, max 2 MB per foto</p>
                <input
                    type="file"
                    name="images[]"
                    id="image-upload"
                    class="image-upload"
                    accept="image/*"
                    multiple
                >
            </div>

            <div id="image-preview" class="image-preview-container"></div>

            @if(isset($isEdit) && $product->images->isNotEmpty())

            <div class="current-images">
            @foreach($product->images as $image)

                <div
                    class="preview-image-wrapper existing-image"
                    data-image-id="{{ $image->id }}"
                >

                    <img
                        src="{{ asset('storage/' . $image->image_path) }}"
                        class="preview-image"
                        alt="{{ $product->title ?? 'Huidge productfoto' }}"
                    >
                </div>
            @endforeach
            </div>

    @endif
        </div>

        <div class="form-group">
            <div class="form-field">
                <label for="title">Titel:</label>
                <input 
                    type="text" 
                    name="title" 
                    value="{{ old('title', $product->title ?? '') }}"
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
                        {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}
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
                    id="price"
                    value="{{ old('price', $product->price ?? '') }}"
                    placeholder="€ 22"
                    step="0.01" 
                >

            <label class="checkbox-label">
                <input 
                    type="checkbox"
                    name="free_product"
                    id="free_product"
                    value="1"
                    {{ old('free_product', $product->is_free ?? false) ? 'checked' : '' }}
                >
                Gratis aanbieden
            </label>
            </div>

            <div class="form-field">
                <label for="location">Stad:</label>
                <input 
                    id="location"
                    type="text" 
                    name="location" 
                    placeholder="Bv. Antwerpen"
                    value="{{ old('location', $product->location ?? '') }}"
                    data-company-city="{{ auth()->user()->city }}"
                    required
                >
                <label class="checkbox-label">
                <input 
                    id="use_company_location"
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
                {{ old('description', $product->description ?? '') }}
            </textarea>
        </div>

        <div class="form-actions">
            <a href="" class="back-link body-lg">Annuleren</a>
            <button class="round-btn darkblue body-lg" type="submit">{{ isset($isEdit) ? 'Product bijwerken' : 'Product plaatsen' }}</button>
        </div>
        
    </form>
</div>

@include('partials.footer')

