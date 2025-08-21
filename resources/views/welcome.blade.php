<x-layout>
    <div class="row">
        <!-- Image Section -->
        <div class="col-12 homepage-custom-img align-self-center">
            <img src="{{ asset('sfondo/homepage-bg-biteandbuy.jpg') }}" 
            alt="Immagine con una maschera di realtà virtuale">
            
            <!-- Centered Text & Button -->
            <div class="homepage-text">
                <h1>{{ __('ui.start')}}<span class="highlight-home">{{ __('ui.highlighted')}}</span> {{ __('ui.and')}} <span class="highlight-home">{{ __('ui.sell')}}</span>{{ __('ui.save')}}</h1>
                
                <a href="{{ auth()->check() ? route('article.create') : route('login') }}" class="welcome-btn">
                    {{ __('ui.start_sell') }}
                </a>
                <a href="{{ route('article.index') }}" class="welcome-btn">{{ __('ui.find_stuff')}}<i class="fa-regular fa-gem"></i> </a>
            </div>
        </div>
        <!--carousel-->

        <x-carousel :$news ></x-carousel>
        
        <!-- 6 most recent Articles Section -->
        <div class="col-12 bg-gradient-article-detail">
                    
            <!-- Section Title -->
            <div class="text-center pt-5  text-white">
                <h2 class="fs-3 fw-semibold">{{ __('ui.Articles')}}</h2>
            </div>  
            {{-- section cards --}}
            <div class="container-fluid d-flex justify-content-center mb-5 ">
                <div class="row justify-content-center align-items-center py-4">
                    @forelse ($articles as $article)
                        <div class="col-xs-12 col-sm-6 col-lg-4 col-xl-3 d-flex justify-content-center mb-4 me-2">
                            <x-card :article="$article"/>
                        </div>
                    @empty
                            <div class="col-12 text-center fs-3 text-dark">
                                <h3 class="mt-4">Non abbiamo trovato annunci 😢...</h3>
                                <h3 class="m-3">Pubblica per primo un annuncio!</h3>
                                @auth
                                    <a class="btn login-btn-custom fw-semibold rounded-pill mt-4 mb-3 " href="{{route('article.create')}}"> Pubblica un articolo</a>
                                @endauth
                            </div>
                            <h3 class="text-center fs-6">{{ __('ui.no_Articles')}}</h3>
                        </div>
                    @endforelse
                </div>
            </div>
    </div>
</div>
    </div>
</x-layout>
