<form class="rounded shadow text-start px-4 py-5 my-0 text-white form-create-article" wire:submit="save">
    <h1 class="text-center fs-4 ">Inserisci il tuo annuncio</h1>
    
    <div class="mb-4">
        <label for="title" class="form-label">Titolo dell'articolo</label>
        <input type="text" class="form-control rounded border @error('title') is-invalid @enderror" id="title" wire:model='title'>
        @error('title') <div class="text-danger mt-1 fw-semibold">{{ $message }}</div> @enderror
    </div>
    
    <div class="mb-4">
        <label for="description" class="form-label">Descrizione</label>
        <textarea class="form-control rounded border @error('description') is-invalid @enderror" id="description" cols="30" rows="5" wire:model='description'></textarea>
        @error('description') <div class="text-danger mt-1 fw-semibold">{{ $message }}</div> @enderror
    </div>
    
    <div class="mb-4">
        <label for="price" class="form-label">Prezzo in EURO</label>
        <input type="text" class="form-control rounded border @error('price') is-invalid @enderror" id="price" wire:model='price'>
        @error('price') <div class="text-danger mt-1 fw-semibold">{{ $message }}</div> @enderror
    </div>
    
    <div class="mb-4">
        <label for="category" class="form-label">Categoria</label>
        <select id="category" wire:model='category' class="form-select rounded border @error('category') is-invalid @enderror">
            <option value="" selected>Seleziona una categoria</option>
            @foreach (collect($categories)->sortBy('name') as $category)
            <option class="text-capitalize" value="{{ $category->id }}">
                {{ __('categories.' . $category->name) }}
            </option>
        @endforeach
        
        </select>
        @error('category') <div class="text-danger mt-1 fw-semibold">{{ $message }}</div> @enderror
    </div>
    
    <div class="mb-3" 
    x-data="{ loading: false }"
    x-on:livewire-upload-start="loading = true"
    x-on:livewire-upload-finish="loading = false"
    x-on:livewire-upload-error="loading = false"
    x-on:livewire-upload-success="loading = false"
    >
    <input type="file" wire:model.live="temporary_images" multiple class="form-control shadow @error('temporary_images.*') is-invalid @enderror">
    
    <div x-show="loading" class="text-center mt-2">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Caricamento...</span>
        </div>
        <p class="mt-2">Caricamento immagini in corso...</p>
    </div>
    
    @error('temporary_images.*') <p class="fst-italic text-danger">{{ $message }}</p> @enderror
    @error('temporary_images') <p class="fst-italic text-danger">{{ $message }}</p> @enderror
</div>


@if (!empty($images))
<div class="row">
    <div class="col-12">
        <p>Anteprima:</p>
        <div class="row border border-3 border-dark rounded shadow py-4">
            @foreach ($images as $key => $image)
            <div class="col d-flex flex-column align-items-center my-3">
                <div class="img-preview mx-auto shadow rounded" style="background-image: url({{ $image->temporaryUrl() }}); width: 150px; height: 150px; background-size: cover; background-position: center;"></div>
                <button type="button" class="btn mt-2 btn-danger btn-sm" onclick="confermaRimozione({{ $key }})">Elimina</button>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<div class="d-flex justify-content-center mt-4">
    <button type="submit" class="btn welcome-btn fw-bold px-4 py-2"><i class="bi bi-save2-fill me-3"></i> Crea </button>
</div>
</form>

<script>
    function confermaRimozione(key) {
        Swal.fire({
            title: 'Eliminare immagine?',
            text: 'Questa operazione non è reversibile.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sì, elimina!',
            cancelButtonText: 'Annulla'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch('removeImageFromForm', { key: key });
            }
        });
    }
    
    @if(session()->has('success'))
    Swal.fire({
        icon: 'success',
        title: 'Articolo creato!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false
    });
    @endif
</script>
<script>
    window.addEventListener('articleCreated', () => {
        Swal.fire({
            icon: 'success',
            title: 'Articolo creato!',
            text: 'Il tuo annuncio è stato pubblicato correttamente!, Aguarda l\'approvazione.',
            showConfirmButton: false,
            timer: 3500
        });
    });
</script>


