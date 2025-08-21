<x-layout>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
    
                <div class="card shadow-lg border-0 rounded-4 bg-login-custom">
                    <div class="card-body p-5">
                        <h2 class="mb-4 text-center">Profilo Utente</h2>
    
                        <div class="mb-3">
                            <label class="form-label fw-bold text-light">Nome</label>
                            <div class="form-control bg-light">{{ $user->name }}</div>
                        </div>
    
                        <div class="mb-3">
                            <label class="form-label fw-bold text-light">Email</label>
                            <div class="form-control bg-light">{{ $user->email }}</div>
                        </div>
    
                        <div class="mb-3">
                            <label class="form-label fw-bold text-light">Data di Registrazione</label>
                            <div class="form-control bg-light">{{ $user->created_at->format('d/m/Y') }}</div>
                        </div>
    
                        
                        <div class="text-center mt-4">
                            <a href="{{ route('profile.edit') }}" class="btn login-btn-custom">Modifica Profilo</a>
                        </div> 
                    </div>
                </div>
    
            </div>
        </div>
    </div>

</x-layout>