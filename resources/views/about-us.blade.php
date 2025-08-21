<x-layout>
    <section class="hero bg-dark text-white position-relative" style="height: 60vh; overflow: hidden;">
        <img src="{{ asset('about/hero-about-us.jpg') }}" alt="Internet vintage" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" style="opacity: 0.5;">
        <div class="container h-100 d-flex flex-column justify-content-center align-items-start position-relative" style="z-index: 2;">
            <h1 class="display-4 fw-bold">{{__('ui.story')}}</h1>
            <p class="lead">{{__('ui.dream')}}</p>
        </div>
    </section>
    <div class="container py-5" style="margin-bottom: 50px">
        <div class="white-box"> 
            <div class="row align-items-center mt-5">
                <div class="col-md-6 text-center">
                    <img src="{{ asset('logo/logo.png') }}" alt="Logo BiteAndBuy" class="img-fluid" style="max-width: 400px height-auto;">
                </div>
                <div class="col-md-6">
                    <h1 class="mb-4">{{__('ui.us')}}</h1>
                    <p style="font-size: 1.1rem;">
                        {{__('ui.part1')}}
                        <br><br>
                        {{__('ui.part2')}}
                        
                        <br><br>
                        {{__('ui.part3')}} <strong class="text-Color">Bite&Buy</strong> {{__('ui.part4')}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layout>