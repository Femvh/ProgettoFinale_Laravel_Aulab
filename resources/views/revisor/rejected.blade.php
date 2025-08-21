<x-layout>
    <div class="container py-5">
        <div class="col-12 py-4 mb-4 text-center title-box-custom">
            <h2 class="text-center text-color-acc-purple">Annunci Rifiutati</h2>
        </div>
        
        @if($rejectedArticles->count())
        <div class="row">
            @foreach($rejectedArticles as $article)
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card shadow h-100">
                    
                    @if ($article->images->count() > 1)
                    <div id="carouselRejected{{ $article->id }}" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($article->images as $key => $image)
                            <div class="carousel-item @if($loop->first) active @endif">
                                <img src="{{ Storage::url($image->path) }}" class="d-block w-100 card-img-top" alt="Immagine {{ $key + 1 }}">
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselRejected{{ $article->id }}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselRejected{{ $article->id }}" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                    @elseif ($article->images->count() === 1)
                    <img src="{{ Storage::url($article->images->first()->path) }}" class="card-img-top" alt="{{ $article->title }}">
                    @else
                    <img src="https://picsum.photos/300/?blur=5" class="card-img-top" alt="Placeholder">
                    @endif
                    
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text text-muted">€ {{ number_format($article->price, 2, ',', '.') }}</p>
                            <p class="small text-secondary">{{ Str::limit($article->description, 60) }}</p>
                            <span class="badge bg-danger">{{ __('ui.status_rejected') ?? 'Rifiutato' }}</span>
                        </div>
                        
                        <div class="mt-3 d-flex justify-content-between gap-2">
                            <form action="{{ route('revisor.goback', $article) }}" method="POST" class="w-50">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-warning">
                                    <i class="bi bi-arrow-repeat"></i> Torna in revisione
                                </button>
                            </form>
                            
                            <a href="{{ route('article.show', $article) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye-fill"></i> Visualizza
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="mt-4">
            {{ $rejectedArticles->links() }}
        </div>
        @else
        <div class="alert alert-info text-center">
            Nessun articolo rifiutato al momento.
        </div>
        @endif
    </div>
    
    @if(session('message'))
    <script>
        Swal.fire({
            icon: 'info',
            title: '{{ __("ui.alert_title") }}',
            text: '{{ __("ui.alert_message") }}',
            timer: 3000,
            showConfirmButton: false
        });
        Swal.fire({
            title: '{{ __("ui.confirm_title") }}',
            text: '{{ __("ui.confirm_text") }}',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '{{ __("ui.confirm_yes") }}',
            cancelButtonText: '{{ __("ui.confirm_cancel") }}',
        });
    </script>
    @endif
</x-layout>
