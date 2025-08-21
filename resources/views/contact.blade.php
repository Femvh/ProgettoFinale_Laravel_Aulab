<x-layout>
    <section class="hero bg-dark text-white position-relative " style="height: 60vh; overflow: hidden;">
        <img src="{{ asset('sfondo/contact-page.jpg') }}" alt="Internet vintage"
            class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" style="opacity: 0.4;">
        <div class="container h-100 d-flex flex-column justify-content-end align-items-center position-relative z-2 pb-5">


            <h1 class="display-4 fw-bold text-color-light-purple ms-3 mb-3">{{ __('ui.contact_hero_title') }}</h1>
            <p class="lead fw-semi-bold ms-3 mb-4">{{ __('ui.contact_hero_subtitle') }}</p>
        </div>
    </section>

    <div class="container py-5 bg-light rounded-4" style="margin-top: 20px; margin-bottom: 120px;">
        <div class="text-center mb-5">
            <h2 class="text-color-light-purple fw-bold">{{ __('ui.contact_title') }}</h2>
            <p class="lead fw-bold">{{ __('ui.contact_intro') }}</p>
            <p class="fw-bold">{{ __('ui.contact_email') }}: supporto@BiteandBuy.com</p>
            <p class="fw-bold">{{ __('ui.contact_phone') }}: +39 123 456 7890</p>
        </div>

        <div class="row g-4">
            <div class="col-md-5 text-center ">
                <img src="{{ asset('logo/logo.png') }}" alt="Contattaci" class="img-fluid rounded" style="max-height: 400px;">
            </div>

            <div class="form-colon col-md-6 p-5 border=0 custom-box-dashboard mx-1">
                <form action="{{ route('sendemail') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="text-color-light-purple">{{ __('ui.contact_form_title') }}</label>
                        <input type="text" class="form-control" name="title" id="title">
                        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="text-color-light-purple">{{ __('ui.contact_form_email') }}</label>
                        <input type="email" class="form-control" name="email" id="email">
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="text-color-light-purple">{{ __('ui.contact_form_message') }}</label>
                        <textarea class="form-control" rows="4" name="description" id="description"></textarea>
                        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <button type="submit" class="btn text-white login-btn-custom w-100">{{ __('ui.contact_form_send') }}</button>
                </form>
            </div>
        </div>
    </div>

    @if(session('email_sent'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ __("ui.contact_alert_title") }}',
                text: '{{ __("ui.contact_alert_text") }}',
                timer: 3500,
                showConfirmButton: false
            });
        </script>
    @endif
</x-layout>
