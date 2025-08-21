<x-layout>
    <div class="container py-5">
        <div class="col-12 py-4 mb-4 text-center title-box-custom">
            <h2 class="text-center align-self-center text-color-acc-purple">{{ __('ui.my_page') }}</h2>
        </div>
        @if($articles->count())
        <div class="row">
            @foreach($articles as $article)
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card shadow h-100">
                    
                    @if ($article->images->count() > 1)
                    <div id="carouselArticle{{ $article->id }}" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($article->images as $key => $image)
                            <div class="carousel-item @if($loop->first) active @endif">
                                <img src="{{ Storage::url($image->path) }}" class="d-block w-100 card-img-top" alt="Immagine {{ $key + 1 }}">
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselArticle{{ $article->id }}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Precedente</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselArticle{{ $article->id }}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Successiva</span>
                        </button>
                    </div>
                    @elseif ($article->images->count() === 1)
                    <img src="{{ Storage::url($article->images->first()->path) }}" class="card-img-top" alt="{{ $article->title }}">
                    @else
                    <img src="https://picsum.photos/300/?blur=5" class="card-img-top" alt="placeholder">
                    @endif
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text text-muted">€ {{ number_format($article->price, 2, ',', '.') }}</p>
                            <p class="small text-secondary">{{ Str::limit($article->description, 60) }}</p>
                            @php
                            $status = $article->is_accepted;
                            @endphp
                            
                            @if (is_null($status))
                            <span class="badge bg-warning text-dark">{{ __('ui.status_pending') }}</span>
                            @elseif ($status === 1)
                            <span class="badge bg-warning text-dark">{{ __('ui.status_accepted') }}</span>
                            @elseif ($status === 0)
                            <span class="badge bg-warning text-dark">{{ __('ui.status_rejected') }}</span>
                            @endif
                            
                        </div>
                        
                        <div class="mt-3 d-flex justify-content-between gap-2">
                            <a href="{{ route('article.edit', $article) }}" class="btn btn-sm btn-outline-primary w-50">
                                <i class="bi bi-pencil-square me-2"></i>{{ __('ui.my_page1') }}
                            </a>
                            <form id="delete-form-{{ $article->id }}" action="{{ route('article.destroy', $article) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button 
                            onclick="confermaEliminazione({{ $article->id }})" 
                            class="btn btn-sm btn-outline-danger w-100">
                            <i class="bi bi-trash3"></i>{{ __('ui.my_page2') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="mt-4">
        {{ $articles->links() }}
    </div>
    @else 
    <div class="alert alert-info text-center">
        {{ __('ui.my_page3') }}
    </div>
    @endif
</div>

<script>
    function confermaEliminazione(articleId) {
        Swal.fire({
            title: 'Sei sicuro?',
            text: "Questa azione non può essere annullata!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sì, elimina!',
            cancelButtonText: 'Annulla'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + articleId).submit();
            }
        });
    }
</script>

</x-layout>
