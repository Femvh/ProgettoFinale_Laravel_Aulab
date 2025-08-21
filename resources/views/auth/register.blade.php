<x-layout>

    <div class="d-flex justify-content-center align-items-center  min-vh-100 text-white  ">
        
        <div class="row justify-content-center m-0 p-0 w-75 login-container-custom" style="height: 75vh;">
            <!-- image -->
            <div class=" col-md-6 col-lg-3  d-none d-md-block order-md-0 m-0 p-0">
                <img src="{{ asset('register-login/register.jpg') }}"  class="custom-img" alt="Image">
            </div>
            
            <!-- Content Column -->
            <div class="col-12 col-md-12 col-lg-4 order-md-2 d-flex flex-column justify-content-center align-items-center text-center text-container-login px-3 bg-login-custom">
                <h3 class="my-2 p-3 ">Hai già un account?
                    Sblocca la tua prossima grande scoperta: accedi per esplorare, vendere e connetterti. Effettua il login ora cliccando sul bottone sotto.</h3>
                <button class="btn rounded-pill text-white register-btn-custom mx-5 mb-3 my-5"><a href="{{route('login')}}" class="text-decoration-none text-white px-3">login</a></button>
            </div>
        

            <div class="col-12 col-md-6 col-lg-4 d-flex order-md-1 column justify-content-center align-items-center p-4 bg-login-custom text-white">
                <form action="{{route('register.store')}}" method="post" class="text-container-login login-form w-75">
                    @csrf
                    <div>
                        <h2 class="mb-4 text-center"> Registrati ora</h2>
                    </div>
                    <form action="{{ route('register.store') }}" method="post" class="login-form">
                        @csrf
                    
                        <div class="mb-3">
                            <label for="name" class="form-label text-start">Nome</label>
                            <input type="text" class="form-control rounded-pill" id="name" name="name">
                            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    
                        <div class="mb-3">
                            <label for="email" class="form-label text-start">Indirizzo mail</label>
                            <input type="email" class="form-control rounded-pill" id="email" name="email">
                            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    
                        <div class="mb-3">
                            <label for="password" class="form-label text-white">Password</label>
                            <input type="password" class="form-control rounded-pill" id="password" name="password">
                            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label text-white">Conferma Password</label>
                            <input type="password" class="form-control rounded-pill" id="password_confirmation" name="password_confirmation">
                            @error('password_confirmation') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    
                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn login-btn-custom fw-semibold rounded-pill w-50">
                                Registrati
                            </button>
                        </div>
                    </form>
                </form>
            </div>
        </div>
    </div>
    </x-layout>