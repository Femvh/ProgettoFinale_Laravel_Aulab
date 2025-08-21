@php
$user = Auth::user();
@endphp
<nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container-fluid">
        <a class="navbar-brand align-items-between text-white" href="/">
            <img src="{{ asset('logo/logo [Converted].png') }}" alt="Logo" height="40" class="me-3"> Bite & Buy
        </a>
        
        <!-- Bottone toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <!-- Menu collapsabile -->
    <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
        <!-- Link a sinistra -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('article.index') }}">{{__('ui.navbar1')}}</a>
            </li>
            
            <li class="nav-item dropdown position-relative dropdown-wrapper">
                {{-- DROPDOWN TOGGLE --}}
                <a class="nav-link dropdown-toggle text-white d-flex align-items-center gap-1 no-style" href="#" role="button" id="categoriesDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    {{__('ui.navbar2')}}
                </a>
            
                {{-- DROPDOWN MENU --}}
                <ul class="dropdown-menu glass-dropdown border mt-0" aria-labelledby="categoriesDropdown">
                    {{-- Category Links --}}
                    @foreach ($categories as $category)
                    <li>
                        <a class="dropdown-item border-none text-center text-capitalize px-4 py-2 w-100"
                        href="{{ route('byCategory', ['category' => $category]) }}">
                        {{ __('categories.' . $category->name) }}
                        </a>
                    </li>
                    @if (!$loop->last)
                    <hr class="dropdown-divider my-1">
                    @endif
                    @endforeach
                </ul>
            </li>
            
        </ul>

        <!-- Sezione destra: search + utente -->
        <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center gap-2 mt-3 mt-lg-0 custom-search">
            
            <!-- Chatbot -->
            <div class="d-flex align-items-center gap-2 my-3">
                <a href="{{ route('chatGpt') }}" class="btn btn-outline-light rounded-circle p-2"style="margin-right: 10px;">
                    <i class="fa-solid fa-comment-dots fs-4"></i> <!-- Icona del fumetto -->
                </a>
            </div>

            <!-- Search form -->
            <div class="d-flex align-items-center gap-2 ">
                <form class="d-flex search-form" role="search" action="{{ route('article.search') }}" method="GET">
                    <div class="input-group rounded-pill border overflow-hidden">
                        <input class="form-control me-0 search-bar rounded-pill" type="search" placeholder="Cerca" aria-label="Search" name="query" style="max-width:450px">
                        <button class="btn btn-outline-light rounded-circle search-button" id="basic-addon2" type="submit">
                            <i class="fa-duotone fa-solid fa-magnifying-glass custom-sec-acc-green"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Lingua -->
            @php
            $availableLocales = ['it', 'en', 'es', 'fr', 'de', 'pt']; 
            $currentLocale = app()->getLocale(); // oppure session('locale')
            @endphp
            
            <div class="dropdown text-white border-none">
                <button class="btn dropdown-toggle text-white p-1" type="button" id="dropdownLang" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('vendor/blade-flags/language-' . $currentLocale . '.svg') }}" width="25" height="25" alt="flag" style="margin-left: 30px">
                </button>
                
                <ul class="dropdown-menu glass-dropdown" aria-labelledby="dropdownLang" style="min-width: auto;">
                    @foreach($availableLocales as $lang)
                    @if($lang !== $currentLocale)
                    <li class="d-flex justify-content-center dropdown-item">
                        <form action="{{ route('setLocale', ['lang' => $lang]) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn p-1 border-0 bg-transparent">
                                <img src="{{ asset('vendor/blade-flags/language-' . $lang . '.svg') }}" width="25" height="25" alt="flag {{ $lang }}">
                            </button>
                        </form>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
            <li class="nav-item" style="list-style: none;">
                <a class="nav-link text-white" href="{{ route('cart.view') }}">
                    <i class="fa-solid fa-cart-shopping fs-4" style="margin-left: 20px;margin-right:20px;"></i> <!-- Icona del carrello -->
                </a>
            </li>

            <!-- Utente loggato -->
            @auth
            <div class="dropdown">
                <button class="btn btn-outline-light dropdown-toggle rounded-pill px-3 py-2 shadow-sm d-flex align-items-center gap-2"
                type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-circle-user fs-5"></i>
                <span>{{__('ui.navbar3')}}, {{ Auth::user()->name }}</span>
                </button>
                
                <ul class="dropdown-menu glass-dropdown" aria-labelledby="userDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('article.create') }}">
                            📤 {{__('ui.navbar4')}}
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    @if($user && $user->is_revisor)
                    <li>
                        <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{ route('revisor.index') }}">
                            🛠 {{__('ui.navbar5')}}
                            <span class="badge bg-danger rounded-pill">{{ \App\Models\Article::toBeRevisedCount() }}</span>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    @endif
                    <li>
                        <a class="dropdown-item" href="{{ route('profile') }}">
                            🗂 {{__('ui.navbar6')}}
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('article.my') }}">
                            👤 {{__('ui.navbar7')}}
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="/logout" method="POST" class="d-inline">
                            @csrf
                            <button class="dropdown-item" type="submit">🚪 {{__('ui.navbar8')}}</button>
                        </form>
                    </li>
                </ul>
            </div>
            @endauth

            <!-- Guest -->
            @guest
            <a href="{{ route('register') }}" class="welcome-btn fs-6 fw-medium border-1">{{__('ui.navbar9')}}</a>
            <a href="{{ route('login') }}" class="welcome-btn fs-6 fw-medium border-1">{{__('ui.navbar10')}}</a>
            @endguest
        </div>
    </div>
</nav>