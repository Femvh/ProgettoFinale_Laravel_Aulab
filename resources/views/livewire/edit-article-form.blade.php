<div>
    <div class="hero-image position-relative mb-4">
        <img src="{{ asset('sfondo/modify-article.jpg') }}"
        class="img-fluid w-100 object-fit-cover"
        style="height: 350px; object-position: center;"
        alt="Hero Image">
        
        <div class="position-absolute top-0 start-0 w-100 h-100"
        style="background: rgba(0,0,0,0.4);"></div>
        
        <div class="hero-text position-absolute top-50 start-50 translate-middle text-center text-white">
            <h1 class="display-5 fw-bold position-relative">
                <span class="shine-content shine-text">Modifica il tuo Articolo</span>
            </h1>
        </div>
    </div>
    
    <div class="container py-5">
        
        <script>
            function ConfirmSave() {
                Swal.fire({
                    title: 'Sei sicuro?',
                    text: "Vuoi davvero salvare le modifiche all'articolo?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#198754',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sì, salva!',
                    cancelButtonText: 'Annulla'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.save();
                    }
                });
            }
            
            window.addEventListener('EditeArticle', () => {
                Swal.fire({
                    icon: 'success',
                    title: 'Modifica salvata!',
                    text: 'Le modifiche sono state salvate correttamente.',
                    timer: 3000,
                    showConfirmButton: false
                });
                setTimeout(() => {
                    window.location.href = "{{ route('article.my') }}";
                }, 2100);
            });
        </script>
        @if(session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)"
            x-show="show" x-transition
            class="alert alert-success text-center" role="alert">
            {{ session('success') }}
        </div>
        @endif
        
        @if(session('imageDeleted'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)"
            x-show="show" x-transition
            class="alert alert-warning text-center" role="alert">
            <span>⚠️ {{ session('imageDeleted') }}</span>
        </div>
        @endif
        <form wire:submit.prevent="save" class="p-4 rounded shadow bg-login-custom rounded-3">
            <div class="mb-3">
                <label for="title" class="form-label fw-semibold edit-article-text-color">Titolo</label>
                <input wire:model.defer="title" type="text" id="title" class="form-control">
                @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label fw-semibold edit-article-text-color">Descrizione</label>
                <textarea wire:model.defer="description" id="description" class="form-control" rows="4"></textarea>
                @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label for="price" class="form-label fw-semibold edit-article-text-color">Prezzo (€)</label>
                <input wire:model.defer="price" type="number" step="0.01" id="price" class="form-control">
                @error('price') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label for="category" class="form-label fw-semibold edit-article-text-color">Categoria</label>
                <select wire:model.defer="category" id="category" class="form-select text-capitalize">
                    <option value="">-- Seleziona categoria --</option>
                    @foreach (\App\Models\Category::orderBy('name')->get() as $cat)
                    <option value="{{ $cat->id }}">{{ __('categories.' . $cat->name) }}</option>
                    @endforeach
                </select>
                @error('category') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4 d-flex flex-wrap gap-3">
                @foreach ($article->images as $image)
                <div class="position-relative">
                    <img src="{{ Storage::url($image->path) }}" width="150" height="150" class="rounded shadow">
                    <button wire:click="removeExistingImage({{ $image['id'] }})" type="button"
                    class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1">
                    ✖
                </button>
            </div>
            @endforeach
        </div>
        <div class="mb-4">
            <div x-data="{ loading: false }"
            x-on:livewire-upload-start="loading = true"
            x-on:livewire-upload-finish="loading = false"
            x-on:livewire-upload-error="loading = false"
            x-on:livewire-upload-success="loading = false">
            
            <label class="form-label fw-semibold edit-article-text-color">Carica nuove immagini</label>
            <input wire:model="temporary_images" type="file" multiple class="form-control">
            @error('temporary_images.*') <span class="text-danger small">{{ $message }}</span> @enderror
            
            <div x-show="loading" class="mt-2 text-center">
                <div class="spinner-border text-primary" role="status"></div>
                <p class="mt-2 text-light">Caricamento immagini in corso...</p>
            </div>
        </div>
    </div>
    <div class="mb-4 d-flex flex-wrap gap-3">
        @foreach ($newImages as $key => $image)
        <div class="position-relative">
            <img src="{{ $image->temporaryUrl() }}" width="150" height="150" class="rounded shadow">
            <button wire:click="removeNewImage({{ $key }})" type="button"
            class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1">
            ✖
        </button>
    </div>
    @endforeach
</div>
<button type="button" class="btn welcome-btn fw-bold px-4 py-2 w-100" onclick="ConfirmSave()">
    <i class="bi bi-floppy me-3"></i> Salva modifiche
</button>
</form>
<div class="row mt-4 g-2 mb-5">
    <div class="col-12 col-md-4">
        <a href="{{ route('article.show', $article) }}" class="btn btn-primary fw-bold w-100">
            <i class="bi bi-backspace me-2"></i> Visualizza articolo
        </a>
    </div>
    <div class="col-12 col-md-4">
        <a href="{{ route('article.my') }}" class="btn btn-secondary fw-bold w-100">
            <i class="bi bi-person-lines-fill me-2"></i> I miei annunci
        </a>
    </div>
    <div class="col-12 col-md-4">
        <a href="{{ route('byCategory', ['category' => $article->category->id]) }}"
            class="btn btn-primary fw-bold w-100 text-capitalize">
            <i class="bi bi-card-list me-2"></i>  Tutti annunci in {{ $article->category->name }}
        </a>
    </div>
</div>
</div>
</div>
