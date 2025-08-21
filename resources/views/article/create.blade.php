<x-layout>
    <div class="hero-image position-relative">
        <div class="w-100" style="
    height: 350px;
    background-image: linear-gradient(to bottom, rgba(179, 207, 205, 0.544)100%), 
    url('{{ asset('sfondo/sellhero.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
">
</div>
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.4);"></div>
        <div class="hero-text position-absolute top-50 start-50 translate-middle text-center text-white">
            <h1 class="display-5 fw-bold position-relative">
                <span class="shine-content shine-text ">Vendi i tuoi oggetti in pochi clic!</span>
            </h1>
        </div>
    </div>
    <section class="bg-login-custom text-white py-5">
        <div class="container text-center">
            <h1 class="mb-5 fs-1">Come funziona? Vendere è semplicissimo!</h1>
            <div class="row justify-content-center g-5">
                <div class="col-12 col-md-6 d-flex flex-column align-items-center">
                    <div class="text-center px-4 mb-4">
                        <h5 class="fs-3 edit-article-text-color"><strong>1. Inserisci l’annuncio</strong></h5>
                        <p>Carica foto, descrizione e prezzo.</p>
                    </div>
                    <div class="text-center px-4">
                        <h5 class="fs-3 edit-article-text-color"><strong>2. Pubblica</strong></h5>
                        <p>Metti in vetrina in pochi secondi.</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 d-flex flex-column align-items-center">
                    <div class="text-center px-4 mb-4">
                        <h5 class="fs-3 edit-article-text-color"><strong>3. Ottieni l’approvazione</strong></h5>
                        <p>Verifica e approvazione rapide.</p>
                    </div>
                    <div class="text-center px-4">
                        <h5 class="fs-3 edit-article-text-color"><strong>4. Dai nuova vita ai tuoi oggetti!</strong></h5>
                        <p>Guadagna facilmente.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 bg-login-custom mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <livewire:create-article-form key="{{ now() }}" />
                </div>
            </div>
        </div>
    </section>
</x-layout>
