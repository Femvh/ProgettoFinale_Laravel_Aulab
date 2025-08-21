<x-layout>
    <div class="container min-vh-100 min-vw-100 bg-gradient-article-detail d-flex justify-content-center align-items-center p-0 m-0">
        <div class="row min-vh-100 min-vw-100 p-0 m-0 flex-column justify-content-center align-items-center bg-article-detail-img">
            <div class=" d-flex w-75 h-auto flex-column flex-md-row rounded-4 shadow-lg overflow-hidden  p-4 custom-box-carousel-details-article">
                
                
                @if ($article->images->count()>0)
                <div class="col-12 col-md-6 carousel-section d-flex justify-content-center align-items-center w-100 h-100 p-0 m-0">
                    <div id="carouselExample" class="carousel slide w-100">
                        <div class="carousel-inner">
                            @foreach ($article->images as $key => $image)
                            <div class="carousel-item  @if ($loop->first) active @endif">
                                <img src="{{$image->getUrl(500 ,500)}}" class="d-block w-100 object-fit-cover" alt="Immagine {{$key +1}} dell articolo {{$article->title}}">
                            </div>
                            @endforeach
                        </div>
                        @if ($article->images->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Precedente</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Successiva</span>
                        </button>
                        @endif
                    </div>
                </div>
                @else
                <div class="col-12 col-md-6 carousel-section d-flex justify-content-center align-items-center w-100 h-100 p-0 m-0">
                    <div id="carouselExample" class="carousel slide w-100">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('/logo/logo.png') }}" class="d-block w-100 object-fit-cover" alt="Logo Bite and Buy">
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Article Details Section -->
                <div class=" col-12 col-md-6 details-section text-white p-4 py-5 d-flex flex-column justify-content-center">
                    <h2 class="fs-3 mb-4 fw-semibold text-color-light-purple mb-2">{{ $article->title }}</h2>
                    <h4 class="text-white fs-6 mb-3">Prezzo: €{{ $article->price }}     💰 </h4>
                    <div>
                        <h5 class="text-white fs-5 "> Descrizione:  📝 </h5>
                        <p class="text-white fs-6 mb-3">{{ $article->description }}</p>
                        @auth
                        
                        <div class="d-flex flex-wrap justify-content-start gap-3 mt-3">
                            <a   class="btn login-btn-custom text-white fw-bold px-4 py-2" href="{{route('article.edit',$article)}}"> modifica</a>
                            <form action="{{route('article.destroy' , $article)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn  register-btn-custom text-white fw-bold px-4 py-2">Elimina</button>
                            </form>
                            @endauth
                            
                        </div>
                        <div class="mt-3">
                        <!--pulsante carrello-->
                        <form action="{{ route('cart.add', $article->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success rounded-pill d-flex align-items-center gap-2 px-3 py-1">
                                <i class="bi bi-cart-plus-fill fs-6"></i>
                                <span class="small">Aggiungi</span>
                            </button>
                        </form>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layout>