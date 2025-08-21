<x-layout>

    <div class="row mt-0">
        <div class="col-12 mt-0 align-self-center">
            <section class="col-12 d-flex">
                <div class="d-flex col-12 h-25 d-none d-md-block order-md-0 m-0 p-0">
                    <div class="d-none d-md-block position-relative w-100">
                        <img src="{{ asset('sfondo/index-category.jpg')}}" 
                        class="img-fluid w-100 custom-img-index" 
                        alt="immagine di un portatile con lo schermo colorato"
                        style="object-fit: cover; height: 300px;">
                        <h1 class="position-title-index position-absolute">
                            <span class="text-white">{{ __('ui.Public_Article3')}} <span class=" fw-bold text-color-light-purple">{{$category->name}}</span>
                        </h1>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- 🏷️ Categories Section -->
    <section class="w-100 p-3 mt-0 border-top-purple bg-custom-login bg-color-primary-dark ">
        
        <!-- Title -->
        <h3 class="fs-5 text-color-acc-purple mb-3 text-center">
            Tutte Le Categorie <i class="fa-solid fa-layer-group"></i>
        </h3>
        
        <!-- Tags Container -->
        <div class="d-flex flex-wrap justify-content-center gap-2">
            @foreach($categories as $category)
            <a href="{{ route('byCategory', ['category' => $category]) }}"
                class="badge text-decoration-none px-3 py-2 rounded-pill text-color-light-color text-capitalize"
                style="background-color: var(--primary-dark); border: 1px solid var(--light-color-purple); transition: 0.3s ease;">
                {{ $category->name }}
            </a>
            @endforeach
        </div>
        
    </section>
        
        </div>
        <div class="row height-custom justify-content-evenly align-items-center py-5 text-white m-4 ">
        @forelse ($articles as $article)
            <div class="col-12 col-md-4 col-lg-3 col-xl-2 gap-3 m-2">
                <x-card :article="$article" />
            </div>
        @empty
            <div class="col-12 text-center fs-3 text-dark">
                <h3 class="mt-4">{{ __('ui.Public_Article2')}} 😢...</h3>
                <h3 class="m-3">{{ __('ui.Public_Article1')}}</h3>
                @auth
                    <a class="btn login-btn-custom fw-semibold rounded-pill mt-4 mb-3 " href="{{route('article.create')}}"> {{ __('ui.Public_Article')}}</a>
                @endauth
            </div>
        @endforelse
        </div>
    
    </div>

</x-layout>