<x-layout>

    <div class="d-flex justify-content-center align-items-center min-vh-100 text-white ">
        
        <div class="row justify-content-center m-0 w-75 login-container-custom" style="height: 75vh;">
            <!-- image -->
            <div class=" col-md-6 col-lg-3  d-none d-md-block order-md-0 m-0 p-0">
                <img src="{{ asset('register-login/login-image.png') }}"  class="custom-img" alt="Image">
            </div>
            
            <!-- Content Column -->
            <div class="col-12 col-md-12 col-lg-4 order-md-2 d-flex flex-column justify-content-center align-items-center text-center text-container-login px-3 bg-login-custom">
                <h3 class="my-2 p-3 ">Non sei ancora registrata? Compila il form e scopri la nostra comunità tech!</h3>
                <button class="btn rounded-pill text-white register-btn-custom mx-5 mb-3"><a href="{{route('register')}}" class="text-decoration-none text-white">Registrati</a></button>
            </div>
        

            <div class="col-12 col-md-6 col-lg-4 d-flex order-md-1 column justify-content-center align-items-center p-4 bg-login-custom">
                
                <form action="{{route('login.store')}}" method="post" class="text-container-login login-form w-75">
                    @csrf
                    <div>
                        <h2 class="mb-4 text-center"> Effetua il login</h2>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label text-start">Inserisci il tuo email</label>
                        <input type="email" class="form-control rounded-pill" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control rounded-pill" id="password" name="password">
                    </div>
                    <button  class="btn login-btn-custom fw-semibold rounded-pill mb-3 w-100">Accedi</button>

                    <a href="{{ route('google.login') }}" class="btn login-btn-custom fw-semibold rounded-pill w-100 text-center">
                        Accedi con Google <i class="bi bi-google"></i>
                    </a>
                    <div class="mt-3 ">
                        <a href="{{ route('password.request') }}" class="text-color-light-purple fw--semibold text-decoration-none">{{ __('Forgot your password?') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if (session('password_reset_success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Password aggiornata!',
            text: '{{ session('password_reset_success') }}',
            timer: 3500,
            showConfirmButton: false,
        });
    </script>
@endif
</x-layout>