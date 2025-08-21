<x-layout>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-12 col-md-6 col-lg-5">
            <div class="card shadow rounded-4 border-0">
                <div class="card-body p-5">
                    
                    <h2 class="text-center mb-4 fw-bold text-primary">
                        <i class="bi bi-lock-fill"></i> {{ __('Password dimenticata ?') }}
                    </h2>
                    <p class="text-muted text-center mb-4">
                        Inserisci la tua email per ricevere il link di reset.
                    </p>
                    
                    <form method="POST" action="{{ route('password.email') }}" id="resetForm">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">{{ __('Email') }}</label>
                            <input type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            autofocus>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 fw-bold mt-3">
                            <i class="bi bi-envelope-arrow-up"></i> {{ __('Invia link di reset') }}
                        </button>
                    </form>
                    
                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="text-decoration-none">
                            <i class="bi bi-arrow-left"></i> Torna al login
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
    {{-- SweetAlert2 --}}
    @if (session('status'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Email inviata!',
            text: '{{ session('status') }}',
            showConfirmButton: false,
            timer: 3500
        });
    </script>
    @endif
</x-layout>
