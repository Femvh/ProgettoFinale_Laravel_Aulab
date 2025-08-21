<x-layout>
    <div class="container py-5 ">
        <div class="mx-auto  rounded-4 shadow p-5 custom-box-dashboard" style="max-width: 800px;">
            <h1 class="mb-3 text-color-primary-dark">{{ __('ui.privacy_title') }}</h1>
            <p class="text-muted text-light fw-bold">{{ __('ui.privacy_updated') }}</p>

            <p class="text-light fw-bold">{{ __('ui.privacy_intro') }}</p>

            <hr>

            <h4 class="text-color-primary-dark fw-semi-bold">{{ __('ui.privacy_section1') }}</h4>
            <p class="text-light ">{{ __('ui.privacy_section1_text') }}</p>

            <h4 class="text-color-primary-dark fw-semi-bold">{{ __('ui.privacy_section2') }}</h4>
            <p class="text-light">{{ __('ui.privacy_section2_text') }}</p>

            <h4 class="text-color-primary-dark fw-semi-bold">{{ __('ui.privacy_section3') }}</h4>
            <p class="text-light ">{{ __('ui.privacy_section3_text') }}</p>

            <h4 class="text-color-primary-dark fw-semi-bold">{{ __('ui.privacy_section4') }}</h4>
            <p class="text-light ">{{ __('ui.privacy_section4_text') }}</p>

            <h4 class="text-color-primary-dark fw-semi-bold">{{ __('ui.privacy_section5') }}</h4>
            <p class="text-light ">{{ __('ui.privacy_section5_text') }}</p>

            <h4 class="text-color-primary-dark fw-semi-bold">{{ __('ui.privacy_section6') }}</h4>
            <p class="text-light ">{{ __('ui.privacy_section6_text') }}</p>

            <hr>

            <p class=" text-light fw-semi-bold">{{ __('ui.privacy_contact') }}  
                <a class=" fw-bold text-color-primary-dark" href="mailto:privacy@example.com">Privacy@BiteandBuy.com</a>
            </p>

            <div class="text-center mt-5 mb-3">
                <a href="{{ url('/') }}" class="register-btn-custom rounded-pill p-2 fw-bold text-white text-decoration-none text-dark">{{ __('ui.back_home') }}</a>
            </div>
        </div>
    </div>
</x-layout>
