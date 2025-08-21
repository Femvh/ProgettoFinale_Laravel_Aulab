<footer class="footer py-4 mt-auto fixed-bottom d-lg-block d-none">
    <div class="container d-flex flex-column flex-lg-row justify-content-between align-items-center text-center text-lg-start gap-2">
        <div class="footer-links d-flex flex-wrap gap-3 justify-content-center">
            @auth
            @if (!Auth::user()->is_revisor)
            <a href="{{route('work')}}" class="text-white text-decoration-none">Lavora con noi</a>
            @endif
            @endauth
            <a href="{{route('about')}}" class="text-white text-decoration-none">Chi siamo</a>
            <a href="{{route('contact')}}" class="text-white text-decoration-none">Contatti</a>
            <a href="{{route('privacy')}}" class="text-white text-decoration-none">Privacy</a>
        </div>
        <p class="mb-0 small">&copy; {{ date('Y') }} Bite&Buy - Tutti i diritti riservati</p>
    </div>
</footer>


