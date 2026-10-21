{{--
    Partial Form — dipakai oleh create.blade.php & edit.blade.php
    Variable yang dibutuhkan:
    - $product (optional, untuk edit)
    - $action  (URL action)
    - $method  (POST / PUT)
    - $button  (label tombol submit)
--}}

<form action="{{ $action }}" method="POST" id="formProduk" enctype="multipart/form-data">
    @csrf
    @if(($method ?? 'POST') !== 'POST')
        @method($method)
    @endif

    {{-- Info Dasar --}}
    <div class="section-label">Informasi Dasar</div>

    <div class="form-group">
        <label class="form-label">Nama Produk <span class="required">*</span></label>
        <input type="text"
               name="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $product->name ?? '') }}"
               placeholder="Mis: Beras Premium 5kg"
               required />
        @error('name')
            <span class="form-error">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-row">
        <div class="form-group">
            <label class="form-label">SKU / Kode Produk</label>
            <input type="text"
                   class="form-control"
                   value="{{ $product->id ?? 'auto-generate' }}"
                   placeholder="Auto-generate"
                   disabled />
            <span class="form-hint">Kode unik produk</span>
        </div>

        <div class="form-group">
            <label class="form-label">Kategori</label>
            <input type="text"
                   name="category"
                   class="form-control @error('category') is-invalid @enderror"
                   value="{{ old('category', $product->category ?? '') }}"
                   placeholder="Mis: Makanan" />
            @error('category')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>
    </div>

    {{-- Harga & Stok --}}
    <div class="section-label">Harga & Stok</div>

    <div class="form-row">
        <div class="form-group">
            <label class="form-label">Harga <span class="required">*</span></label>
            <input type="number"
                   name="price"
                   class="form-control @error('price') is-invalid @enderror"
                   value="{{ old('price', $product->price ?? '') }}"
                   placeholder="0"
                   min="0"
                   step="0.01"
                   required />
            @error('price')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Stok <span class="required">*</span></label>
            <input type="number"
                   name="stock"
                   class="form-control @error('stock') is-invalid @enderror"
                   value="{{ old('stock', $product->stock ?? '') }}"
                   placeholder="0"
                   min="0"
                   required />
            @error('stock')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>
    </div>

    {{-- Tambahan --}}
    <div class="section-label">Tambahan</div>

    <div class="form-group">
        <label class="form-label">Deskripsi Produk</label>
        <textarea name="description"
                  class="form-control @error('description') is-invalid @enderror"
                  placeholder="Deskripsi singkat produk...">{{ old('description', $product->description ?? '') }}</textarea>
        @error('description')
            <span class="form-error">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label">Gambar Produk</label>
        @if(isset($product) && $product->image)
            <div style="margin-bottom: 10px;">
                <img src="{{ asset('storage/' . $product->image) }}" alt="Preview" style="max-height: 100px; border-radius: 8px;">
            </div>
        @endif
        <input type="file" name="image" class="form-control" accept="image/*">
        <span class="form-hint">Format: JPG, PNG. Max: 2MB</span>
    </div>

    <div class="form-group" style="margin-bottom: 0;">
        <label class="form-label">Status</label>
        <div style="display: flex; align-items: center; gap: 8px; margin-top: 8px;">
            <input type="checkbox"
                   name="is_active"
                   id="is_active"
                   value="1"
                   @checked(old('is_active', $product->is_active ?? true))
                   style="width: 18px; height: 18px; accent-color: var(--primary);" />
            <label for="is_active" style="font-size: 13.5px; color: var(--text-2); cursor: pointer;">
                Produk aktif & bisa dijual
            </label>
        </div>
    </div>

</form>

<style>
    .section-label {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--text-3);
        letter-spacing: 0.05em;
        margin: 20px 0 12px;
    }
    .section-label:first-child { margin-top: 0; }

    .form-error {
        display: block;
        font-size: 12px;
        color: var(--red);
        margin-top: 4px;
    }

    .form-control.is-invalid {
        border-color: var(--red);
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
    }
</style>
