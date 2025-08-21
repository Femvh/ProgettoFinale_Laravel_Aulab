
<x-layout>
    <div class="container d-flex justify-content-center align-items-top min-vh-100">
        <div class="col-12 col-md-8 col-lg-6 ">
            <div class="card shadow rounded-4 border-0 p-4 h-100 bg-color-primary-dark text-white">
                <h1 class="text-center fw-bold text-color-light-purple mb-4">
                    🤖 Conversazione con l'AI
                </h1>
                <form method="POST" action="/chat" id="chatForm">
                    @csrf
                    <div class="mb-3">
                        <h2 class="fs-6 p-2 text-center"> Il tuo messaggio</h2>
                        <textarea name="message" id="message" rows="8" required
                        class="form-control @error('message') is-invalid @enderror"
                        placeholder="Scrivi qui...">{{ old('message') }}</textarea>
                        @error('message')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="welcome-btn text-white w-100 fw-bold" onclick="sendMessage(event)">
                        <i class="bi bi-send me-2 "></i> Invia messaggio
                    </button>
                </form>
                
                @if(isset($botMessage))
                <div class="alert alert-info mt-4" id="bot-response">
                    <strong>Risposta dell'AI:</strong><br>
                    {!! nl2br(e($botMessage)) !!}
                </div>
                @endif
            </div>
        </div>
    </div>
    <script>
        function sendMessage(event) {
            const btn = event.target;
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span> Invio...';
            document.getElementById('chatForm').submit();
        }
    </script>
</x-layout>