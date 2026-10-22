<form action="{{ $action }}" method="POST" id="formProduk" enctype="multipart/form-data">
    @csrf
    @if(($method ?? 'POST') !== 'POST')
        @method($method)
    @endif

    {{-- Info Dasar --}}
    <div class="section-label">Informasi Dasar</div>

    <div class="form-group">
        <label class="form-label">Nama Produk <span class="required">*</span></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $product->name ?? '') }}" placeholder="Mis: Beras Premium 5kg" required />
        @error('name') <span class="form-error">{{ $message }}</span> @enderror
    </div>

    <div class="form-row">
        <div class="form-group">
            <label class="form-label">SKU / Kode Produk</label>
            <input type="text" class="form-control" value="{{ $product->id ?? 'auto-generate' }}" disabled />
        </div>
        <div class="form-group">
            <label class="form-label">Kategori</label>
            <input type="text" name="category" class="form-control @error('category') is-invalid @enderror"
                   value="{{ old('category', $product->category ?? '') }}" placeholder="Mis: Makanan" />
            @error('category') <span class="form-error">{{ $message }}</span> @enderror
        </div>
    </div>

    {{-- Harga & Stok --}}
    <div class="section-label">Harga & Stok</div>

    <div class="form-row">
        <div class="form-group">
            <label class="form-label">Harga <span class="required">*</span></label>
            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                   value="{{ old('price', $product->price ?? '') }}" placeholder="0" min="0" required />
            @error('price') <span class="form-error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label class="form-label">Stok <span class="required">*</span></label>
            <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
                   value="{{ old('stock', $product->stock ?? '') }}" placeholder="0" min="0" required />
            @error('stock') <span class="form-error">{{ $message }}</span> @enderror
        </div>
    </div>

    {{-- Tambahan --}}
    <div class="section-label">Tambahan</div>

    <div class="form-group">
        <label class="form-label">Deskripsi Produk</label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                  placeholder="Deskripsi singkat produk...">{{ old('description', $product->description ?? '') }}</textarea>
        @error('description') <span class="form-error">{{ $message }}</span> @enderror
    </div>

    {{-- GAMBAR --}}
     <div class="form-group">
        <label class="form-label">Gambar Produk</label>

        @if(isset($product) && $product->image)
            <div id="preview-container" style="position: relative; display: inline-block; margin-bottom: 10px;">
                <img id="image-preview" src="{{ asset('storage/' . $product->image) }}" alt="Preview" style="max-height: 120px; border-radius: 8px; border: 1px solid var(--border);">

                {{-- Tombol Silang (X) --}}
                <button type="button" id="btn-remove-image" title="Hapus Gambar"
                        style="position: absolute; top: -8px; right: -8px; width: 24px; height: 24px; background: var(--red); color: white; border: none; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 14px; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                    <i class="ti ti-x"></i>
                </button>

                {{-- Input Hidden untuk kirim sinyal hapus ke Controller --}}
                <input type="hidden" name="remove_image" id="remove-image-flag" value="0">
            </div>
        @endif

        <input type="file" name="image" class="form-control" accept="image/*" id="input-image">
        <span class="form-hint">Format: JPG, PNG. Max: 2MB</span>
        @error('image') <span class="form-error">{{ $message }}</span> @enderror
    </div>


    {{-- TOMBOL SUBMIT --}}
    <div style="display: flex; justify-content: flex-end; gap: 8px; margin-top: 24px; padding-top: 20px; border-top: 1px solid var(--border-soft);">
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline">
            <i class="ti ti-x"></i> Batal
        </a>
        <button type="submit" class="btn btn-primary">
            <i class="ti ti-device-floppy"></i> {{ $button ?? 'Simpan Produk' }}
        </button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnRemove = document.getElementById('btn-remove-image');
        const previewContainer = document.getElementById('preview-container');
        const removeFlag = document.getElementById('remove-image-flag');

        if (btnRemove) {
            btnRemove.addEventListener('click', function () {
                // Sembunyikan gambar
                previewContainer.style.display = 'none';
                // Set nilai hidden input jadi 1 (berarti hapus)
                removeFlag.value = '1';
            });
        }
    });
</script>
