<x-layout>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
    
                <div class="card shadow border-0 rounded-4 bg-login-custom">
                    <div class="card-body p-5">
                        <h2 class="mb-4 text-center fw-bold">Edit Profile</h2>
    
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
    
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
    
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold text-light">Nome</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            </div>
    
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold text-light">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            </div>
    
                            <div class="text-center mt-4">
                                <button type="submit" class="btn login-btn-custom">Save Changes</button>
                                <a href="{{ route('profile') }}" class="btn btn-secondary ms-2">Cancel</a>
                            </div>
                        </form>
    
                    </div>
                </div>
    
            </div>
        </div>
    </div>


</x-layout>