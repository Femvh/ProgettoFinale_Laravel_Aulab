<x-layout>
    <!-- HEADER IMAGE WITH TITLE -->
    <div class="row mt-0">
        <div class="col-12 mt-0 align-self-center">
            <section class="col-12 d-flex">
                <div class="d-flex col-12 h-25 d-none d-md-block order-md-0 m-0 p-0 border">
                    <div class="d-none d-md-block position-relative w-100">
                        <img src="{{ asset('sfondo/steve-johnson-hokONTrHIAQ-unsplash.jpg') }}" 
                        class="img-fluid w-100 custom-img-index" 
                        alt="immagine di un portatile con lo schermo colorato"
                        style="object-fit: cover; height: 300px;">
                        <h1 class="position-title-index position-absolute">
                            <span class="text-color-light-purple">{{ __('ui.Index_Article')}} </span><br>{{ __('ui.Index_Article1')}}
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
                Le Categorie <i class="fa-solid fa-layer-group"></i>
            </h3>
            
            <!-- Tags Container -->
            <div class="d-flex flex-wrap justify-content-center gap-2">
                @foreach($categories as $category)
                <a href="{{ route('byCategory', ['category' => $category]) }}"
                    class="badge text-decoration-none px-3 py-2 rounded-pill text-color-light-color text-capitalize"
                    style="background-color: var(--primary-dark); border: 1px solid var(--light-color-purple); transition: 0.3s ease;">
                    {{ __('categories.' . $category->name) }}
                </a>
                @endforeach
            </div>
            
        </section>

    <!-- SEARCHBAR / FILTERS -->
    <section class="col-12 fs-6 text-center py-3 mx-0 h-75 w-100">
        
        <!-- 🧭 Filter Row (Single Line, Same Height Boxes) -->
        <form class="row gy-3 gx-2 justify-content-center" id="filterForm" method="GET" action="{{ route('article.index') }}">
            @csrf
        
            <!-- Titolo -->
            <div class="col-12 col-md-2 d-flex align-items-end">
                <h3 class="fs-5 text-color-acc-purple m-0">
                    {{ __('ui.Index_Article2')}} <i class="fa-regular fa-gem"></i>
                </h3>
            </div>
        
            <!-- Barra di ricerca -->
            <div class="col-12 col-md-3">
                <div class="input-group rounded-pill border overflow-hidden w-100">
                    <input class="form-control search-bar rounded-pill py-1"
                        type="search"
                        placeholder="Search"
                        aria-label="Search"
                        name="query"
                        value="{{ request('query') }}">
                    <button class="btn btn-outline rounded-circle search-button" type="submit">
                        <i class="fa-duotone fa-solid fa-magnifying-glass text-color-acc-purple"></i>
                    </button>
                </div>
            </div>
        
            <!-- Prezzo Min -->
            <div class="col-6 col-md-2">
                <div class="form-floating">
                    <input type="number" min="0" class="form-control rounded border-light"
                        id="minPrice" name="minPrice" placeholder="Prezzo Min"
                        value="{{ request('minPrice') }}">
                    <label for="minPrice">{{ __('ui.Index_Article3')}}</label>
                </div>
            </div>
        
            <!-- Prezzo Max -->
            <div class="col-6 col-md-2">
                <div class="form-floating">
                    <input type="number" min="1" class="form-control rounded border-light"
                        id="maxPrice" name="maxPrice" placeholder="Prezzo Max"
                        value="{{ request('maxPrice') }}">
                    <label for="maxPrice">{{ __('ui.Index_Article4')}}</label>
                </div>
            </div>
        
            <!-- Ordinamento -->
            <div class="col-12 col-md-3">
                <div class="form-floating">
                    <select class="form-select" id="sortSelect" name="sort">
                        <option value="" {{ request('sort') == '' ? 'selected' : '' }}>Nessun ordine</option>
                        <option value="descByDate" {{ request('sort') == 'descByDate' ? 'selected' : '' }}>Dal più recente</option>
                        <option value="ascByDate" {{ request('sort') == 'ascByDate' ? 'selected' : '' }}>Dal più vecchio</option>
                        <option value="descByPrice" {{ request('sort') == 'descByPrice' ? 'selected' : '' }}>Dal più costoso</option>
                        <option value="ascByPrice" {{ request('sort') == 'ascByPrice' ? 'selected' : '' }}>Dal meno costoso</option>
                        <option value="ascByAlpha" {{ request('sort') == 'ascByAlpha' ? 'selected' : '' }}>Dalla A alla Z</option>
                        <option value="descByAlpha" {{ request('sort') == 'descByAlpha' ? 'selected' : '' }}>Dalla Z alla A</option>
                    </select>
                    <label for="sortSelect">{{ __('ui.Index_Article12')}}</label>
                </div>
            </div>
        
            <!-- Pulsante Submit -->
            <div class="col-12 col-md-2">
                <button type="submit" class="btn w-100 login-btn-custom rounded py-2">{{ __('ui.Index_Article13')}}</button>
            </div>
        </form>
        
            
        </section>
    </div>
    
    <!-- MAIN CONTENT -->
    <main class="col-12 mb-5">
        <div class="row AnnouncementsRow justify-content-center align-items-center mt-2">
            @forelse ($articles as $article)
            <div class="col-12 col-sm-6 col-md-4 col-lg-2 m-5">
                <x-card :article="$article" />
            </div>
            @empty
            <div class="col-12 text-center fs-3 text-dark">
                <h3 class="mt-4">{{ __('ui.Index_Article15')}}😢...</h3>
                <h3 class="m-3">{{ __('ui.Index_Article16')}}</h3>
                @auth
                <a class="btn login-btn-custom fw-semibold rounded-pill mt-4 mb-3" href="{{ route('article.create') }}">
                    {{ __('ui.Index_Article17')}}
                </a>
                @endauth
            </div>
            @endforelse
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4 mb-5 ">
                {{ $articles->links() }}
            </div>
        </div>
    </main>
    
</div>
</main>
</x-layout>
