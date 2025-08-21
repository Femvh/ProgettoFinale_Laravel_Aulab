<div class="article-card"
data-title="{{ strtolower($article->title) }}"
    data-price="{{ $article->price }}"
    data-date="{{ $article->created_at }}">

    <div class="product-card-custom">
        <div class="card-image-custom">
            <img src="{{$article->images->isNotEmpty() ? $article->images->first()->getUrl(300,500): 'https://picsum.photos/250/400'}}" alt="Immagine dell'articolo {{ $article->title }}" width="300" height="200">
            
            <div class="info-card-custom">
                <div class="position-info-card-custom">
                    <h3 class="fs-5">{{ $article->title }}</h3>
                    <p class="fs-6"> <i class="fa-solid fa-circle-user me-2"></i> {{ $article->user->name }}</p>
                    <span class="">€{{ $article->price }}</span>
                </div>
            </div>
        </div>
        <div class="card-content-custom">
            <button class="card-cta-modal-button">
                <div class="card-modal-trigger-container">
                    <span class="card-cta-modal-button-text"><i class="fa-regular fa-plus"></i></span>
                    
                    
                    <!-- Default + icon -->
                    
                    <a href="{{route('article.show', compact('article'))}}"><span class="card-cta-modal-button-text-hover text-dark">Dettagli</span></a> <!-- Hover text -->
                </div>
    
            </button>
    
        </div>
    </div>
</div>