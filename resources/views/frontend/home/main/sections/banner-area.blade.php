<section class="banner-area banner-bg tg-motion-effects" style="background-image: url({{ asset($hero?->global_content?->hero_background) }});">
    <div class="container">
        <div class="row justify-content-between align-items-start">
            <div class="col-xl-5 col-lg-6">
                <div class="banner__content">
                    <h3 class="title tg-svg" data-aos="fade-right" data-aos-delay="400">
                        Never Stop <strong>Learning</strong> Life<br>Never Stop Teaching
                    </h3>
                    <p data-aos="fade-right" data-aos-delay="600">Every teaching and learning journey is unique Following<br>We'll help guide your way.</p>
                    <div class="banner__btn-two aos-init aos-animate mt-4" data-aos="fade-right" data-aos-delay="600">
                        <a href="#" class="btn arrow-btn">Ut Amet Nihil Et In <img src="{{ asset('frontend/img/icons/right_arrow.svg') }}" alt="img" class="injectable"></a>
                        <a href="#" class="play-btn popup-video" aria-label="Watch Our Class Demo"><i class="fas fa-play"></i> Watch Our Class Demo</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="banner__images">
                    <img src="{{ asset($hero?->global_content?->banner_image) }}" alt="img" class="main-img" fetchpriority="high" loading="eager">
                    <div class="shape big-shape" data-aos="fade-up-right" data-aos-delay="600">
                        <img src="{{  asset($hero?->global_content?->banner_background) }}" alt="shape" class="tg-motion-effects1">
                    </div>
                    <img src="{{ asset('frontend/img/banner/bg_dots.svg') }}" alt="shape"
                        class="shape bg-dots rotateme">
                    <img src="{{ asset('frontend/img/banner/banner_shape02.png') }}" alt="shape"
                        class="shape small-shape tg-motion-effects3">

                    <div class="about__enrolled students aos-init aos-animate" data-aos="fade-right"
                        data-aos-delay="200">
                        <p class="title"><span>10k</span>
                            {{ __('Enrolled Students') }}</p>
                        <img src="{{ asset($hero?->global_content?->enroll_students_image) }}" alt="img">
                    </div>
                    <div class="banner__student instructor aos-init aos-animate" data-aos="fade-left"
                        data-aos-delay="200">
                        <div class="icon">
                            <img src="{{ asset('frontend/img/banner/h2_banner_icon.svg') }}" alt="img"
                                class="injectable">
                        </div>
                        <div class="content">
                            <span>{{ __('Total Instructors') }}</span>
                            <h4 class="title">10k</h4>
                        </div>
                    </div>
                    <div class="banner__author">
                        <img src="{{ asset('frontend/img/banner/banner_shape02.svg') }}" alt="shape"
                            class="arrow-shape tg-motion-effects3">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <img src="{{ asset('frontend/img/banner/banner_shape01.svg') }}" alt="shape" class="line-shape"
        data-aos="fade-right" data-aos-delay="1600">
</section>
