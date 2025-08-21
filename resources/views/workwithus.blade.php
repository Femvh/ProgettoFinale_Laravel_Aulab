<x-layout>
    
    
    <section class="hero bg-dark text-white position-relative" style="height: 60vh; overflow: hidden;">
        <img src="{{ asset('about/work-with-us.jpg') }}" alt="Internet vintage" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" style="opacity: 0.5;">
        <div class="container h-100 d-flex flex-column justify-content-center align-items-start position-relative" style="z-index: 2;">
            <h1 class=" fs-1 text-uppercase py-5 fst-italic">{{ __('ui.working_contact') }}</h1>
            <h3 class="text-uppercase fst-italic">{{ __('ui.working_contact1') }}</h3>
        </div>
    </section>
    
    
    <div class="container py-5">
        <div class="white-box"> 
            <div class="row align-items-center mt-5">
                <div class="col-md-6 text-center">
                    <img src="{{ asset('logo/logo.png') }}" alt="Logo BiteAndBuy" class="img-fluid" style="max-width: 500px;">
                </div>
                <div class="col-md-5 offset-md-1 mb-3 text-center">
                        <p class="fs-3 fst-italic ">{{ __('ui.working_contact2') }}</p>
                        <p class=" fs-3 fst-italic">{{ __('ui.working_contact3') }}</p>
                        @guest
                            <h1>{{ __('ui.working_contact4') }}</h1>
                            <p>{{ __('ui.working_contact5') }} <a href="{{route('login')}}">{{ __('ui.working_contact9') }}</a></p>
                        @endguest
                    @auth
                    @if (!Auth::user()->is_revisor)
                    <h5>{{ __('ui.working_contact6') }}</h5>
                    <p>{{ __('ui.working_contact7') }}</p>
                    <a href="{{route('become.revisor')}}" class="welcome-btn fs-3 text-dark" >{{ __('ui.working_contact8') }}</a>
                    @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
    
    
    
    @if (session()->has('errorMessage'))
            <div class="alert alert-danger text-center shadow rounded w-50">
                {{session('errorMessage')}}
            </div>
    @endif


    @if (session()->has('message'))
        <div class="alert alert-success text-center shadow rounded w-50">
            {{session('message')}}
        </div>
    @endif





</x-layout>
