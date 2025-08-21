<x-layout>
    <div class="container-fluid m-0 p-0 min-vw-100 min-vh-100 bg-gradient-article-detail">
        <div class="row m-0 p-0 min-vh-100 justify-content-center align-items-start bg-image-dashboard">
            <main class="col-12 col-lg-8 p-4 d-flex flex-column align-items-center bg-row-dashboard-revisor">
                
                <!-- Title box -->
                <div class="text-center custom-box-dashboard w-75 rounded mb-4 mt-4">
                    <h1>Bentornata {{ Auth::user()->name }}!</h1>
                </div>

                @if ($article_to_check)
                    @php $firstImage = $article_to_check->images->first(); @endphp

                    <!-- Article card -->
                    <div class="custom-box-dashboard p-4 rounded w-75 mb-4">
                        <div class="row g-4 align-items-center">
                            
                            <!-- Carousel Column -->
                            <div class="col-md-6">
                                @if ($article_to_check->images->count())
                                    <div id="articleImagesCarousel" class="carousel slide rounded shadow" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($article_to_check->images as $key => $image)
                                                <div class="carousel-item @if($key === 0) active @endif">
                                                    <img src="{{ $image->getUrl(600, 600) }}" class="d-block w-100 img-fluid rounded" alt="img {{ $key + 1 }}">
                                                </div>
                                            @endforeach
                                        </div>
                                        @if ($article_to_check->images->count() > 1)
                                            <button class="carousel-control-prev" type="button" data-bs-target="#articleImagesCarousel" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Precedente</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#articleImagesCarousel" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Successiva</span>
                                            </button>
                                        @endif
                                    </div>
                                @else
                                    <img src="{{ asset('logo/logo-con-bg.png') }}" alt="Logo Bite And Buy" class="img-fluid rounded shadow-sm">
                                @endif
                            </div>

                            <!-- Text Column -->
                            <div class="col-md-6 text-end d-flex flex-column justify-content-center">
                                <h2 class="fw-bold text-color-light-purple">{{ $article_to_check->title }}</h2>
                                <p class="mt-3">{{ $article_to_check->description }}</p>

                                <h5 class="mt-5 me-2">Labels</h5>
                                @if ($firstImage && $firstImage->labels)
                                    <div class="d-flex justify-content-end flex-wrap mb-2">
                                        @foreach ($firstImage->labels as $label)
                                            <span class="badge bg-primary me-1 mb-1">
                                                <i class="bi bi-tag"></i> {{ $label }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="fst-italic">Nessuna label disponibile</p>
                                @endif

                                <div class="text-end mt-4 pt-3 border-top">
                                    <p class="mb-0 text-white">Autore: <strong>{{ $article_to_check->user->name }}</strong></p>
                                    <p class="text-color-about-us fw-semibold">€ {{ $article_to_check->price }}</p>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="col-12 text-center mt-4">
                                <form action="{{ route('reject', ['article'=> $article_to_check]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-danger px-4 me-2">Rifiuta</button>
                                </form>
                                <form action="{{ route('accept', ['article'=> $article_to_check]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success px-4">Accetta</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Rating section -->
                    @if ($firstImage)
                        <div class="p-4 rounded mt-5  shadow text-center w-75 custom-box-dashboard">
                            <h5 class="text-color-light-purple">Rating immagine</h5>
                            <div class="row justify-content-center ">
                                @foreach (['adult', 'violence', 'spoof', 'racy', 'medical'] as $rating)
                                    <div class="col-auto text-center mb-2 text-light fw-bold">
                                        <i class="bi fs-4 {{ $firstImage->$rating }}"></i><br>
                                        <small class="text-capitalize">{{ $rating }}</small>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @else
                    <div class="row justify-content-center align-items-center min-vh-50 text-center w-100">
                        <div class="col-10 col-md-8">
                            <h1 class="fst-italic display-5"> Nessun articolo da revisionare </h1>
                        </div>
                    </div>
                @endif
                <a href="{{ route('revisor.rejected') }}" class="dropdown-item text-center mt-3 mb-5">
                    ❌ Articoli Rifiutati
                </a>
                
                @if (session()->has('message'))
                    <div class="row justify-content-center pt-3">
                        <div class="alert alert-success text-center col-md-6">
                            {{ session('message') }}
                        </div>
                    </div>
                @endif
            </main>
        </div>
    </div>

    <script>
        @if(session('accepted'))
            Swal.fire({
                icon: 'success',
                title: 'Accettato!',
                text: '{{ session('accepted') }}',
                timer: 3500,
                showConfirmButton: false,
            });
        @endif

        @if(session('rejected'))
            Swal.fire({
                icon: 'warning',
                title: 'Rifiutato!',
                text: '{{ session('rejected') }}',
                timer: 3500,
                showConfirmButton: false,
            });
        @endif
    </script>
</x-layout>
