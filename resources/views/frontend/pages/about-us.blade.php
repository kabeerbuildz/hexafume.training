@extends('frontend.layouts.master')

@section('meta_title', $seo_setting['about_page']['seo_title'])
@section('meta_description', $seo_setting['about_page']['seo_description'])

@section('contents')
    <!-- breadcrumb-area -->
    <x-frontend.breadcrumb :title="__('About Us')" :links="[['url' => route('home'), 'text' => __('Home')], ['url' => '', 'text' => __('About Us')]]" />
    <!-- breadcrumb-area-end -->

    <!-- Hero About Section -->
    <section class="about-hero-section section-py-120">
        <div class="about-hero-background-pattern"></div>
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="about-hero-content">
                        <!-- Logo Display -->
                        <div class="about-logo-section mb-4">
                            @if(Cache::get('setting') && Cache::get('setting')->logo)
                                <div class="about-logo-wrapper">
                                    <img src="{{ asset(Cache::get('setting')->logo) }}" alt="{{ Cache::get('setting')->app_name ?? 'Logo' }}" class="about-logo-img">
                                </div>
                            @endif
                            @if(Cache::get('setting') && Cache::get('setting')->app_name)
                                <h2 class="about-company-name">{{ Cache::get('setting')->app_name }}</h2>
                            @endif
                        </div>
                        
                        <div class="section__title mb-4">
                            <span class="sub-title about-hero-badge">{{ __('Get More About Us') }}</span>
                            <h1 class="title about-hero-title">
                                {!! clean(processText($aboutSection?->content?->title ?? __('Empowering Minds, Transforming Futures'))) !!}
                            </h1>
                        </div>
                        <div class="about-hero-description">
                            {!! clean(processText($aboutSection?->content?->description ?? __('We are dedicated to providing world-class education and empowering individuals to achieve their dreams through innovative learning solutions.'))) !!}
                        </div>
                        
                        <!-- Quick Info Cards -->
                        <div class="about-quick-info mt-4 mb-4">
                            <div class="quick-info-item">
                                <div class="quick-info-icon">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <div class="quick-info-content">
                                    <span class="quick-info-label">{{ __('Established') }}</span>
                                    <span class="quick-info-value">{{ date('Y') - 5 }}+</span>
                                </div>
                            </div>
                            <div class="quick-info-item">
                                <div class="quick-info-icon">
                                    <i class="fas fa-globe"></i>
                                </div>
                                <div class="quick-info-content">
                                    <span class="quick-info-label">{{ __('Countries') }}</span>
                                    <span class="quick-info-value">50+</span>
                                </div>
                            </div>
                            <div class="quick-info-item">
                                <div class="quick-info-icon">
                                    <i class="fas fa-trophy"></i>
                                </div>
                                <div class="quick-info-content">
                                    <span class="quick-info-label">{{ __('Awards') }}</span>
                                    <span class="quick-info-value">25+</span>
                                </div>
                            </div>
                        </div>
                        
                        @if ($aboutSection?->global_content?->button_url != null)
                            <div class="about-hero-cta mt-4">
                                <a href="{{ $aboutSection?->global_content?->button_url }}" class="btn btn-primary btn-lg about-hero-btn">
                                    {{ $aboutSection?->content?->button_text ?? __('Explore Our Courses') }}
                                    <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                                <a href="{{ route('contact.index') }}" class="btn btn-outline-primary btn-lg about-hero-btn-outline ms-3">
                                    {{ __('Contact Us') }}
                                    <i class="fas fa-envelope ms-2"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-hero-image-wrapper">
                        <div class="about-hero-image">
                            @if($aboutSection?->global_content?->image)
                                <img src="{{ asset($aboutSection?->global_content?->image) }}" alt="About Us" class="main-image">
                            @else
                                <div class="placeholder-image">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                            @endif
                            @if($aboutSection?->global_content?->video_url)
                                <a href="{{ $aboutSection?->global_content?->video_url }}" class="video-play-btn popup-video" aria-label="Watch Video">
                                    <svg width="24" height="28" viewBox="0 0 24 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.19043 26.3132V1.69421C0.190288 1.40603 0.245303 1.12259 0.350273 0.870694C0.455242 0.6188 0.606687 0.406797 0.79027 0.254768C0.973854 0.10274 1.1835 0.0157243 1.39936 0.00193865C1.61521 -0.011847 1.83014 0.0480663 2.02378 0.176003L20.4856 12.3292C20.6973 12.4694 20.8754 12.6856 20.9999 12.9535C21.1245 13.2214 21.1904 13.5304 21.1904 13.8456C21.1904 14.1608 21.1245 14.4697 20.9999 14.7376C20.8754 15.0055 20.6973 15.2217 20.4856 15.3619L2.02378 27.824C1.83056 27.9517 1.61615 28.0116 1.40076 27.9981C1.18536 27.9847 0.97607 27.8983 0.792638 27.7472C0.609205 27.596 0.457661 27.385 0.352299 27.1342C0.246938 26.8833 0.191236 26.6008 0.19043 26.3132Z" fill="currentColor"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                        @use(App\Enums\ThemeList)
                        @php
                            $theme = session()->has('demo_theme') ? session()->get('demo_theme') : DEFAULT_HOMEPAGE;
                        @endphp
                        @if (!in_array($theme, [ThemeList::BUSINESS->value, ThemeList::KINDERGARTEN->value]) && $hero?->content?->total_student)
                            <div class="about-stats-card" data-aos="fade-up" data-aos-delay="200">
                                <div class="stats-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="stats-content">
                                    <h3 class="stats-number">{{ $hero->content->total_student }}+</h3>
                                    <p class="stats-label">{{ __('Enrolled Students') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero About Section End -->

    <!-- Company Info Section -->
    <section class="company-info-section section-py-120">
        <div class="container">
            <div class="company-info-card">
                <div class="row align-items-center g-5">
                    <div class="col-lg-4">
                        <div class="company-logo-display">
                            @if(Cache::get('setting') && Cache::get('setting')->logo)
                                <div class="company-logo-wrapper">
                                    <img src="{{ asset(Cache::get('setting')->logo) }}" alt="{{ Cache::get('setting')->app_name ?? 'Company Logo' }}" class="company-logo">
                                </div>
                            @endif
                            @if(Cache::get('setting') && Cache::get('setting')->app_name)
                                <h3 class="company-name-large">{{ Cache::get('setting')->app_name }}</h3>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="company-details">
                            <h3 class="company-details-title">{{ __('About Our Organization') }}</h3>
                            <p class="company-details-text">
                                {{ __('We are a leading educational platform committed to delivering excellence in online learning. Our mission is to make quality education accessible to everyone, everywhere. With a team of experienced educators and cutting-edge technology, we provide comprehensive learning solutions that empower students to achieve their academic and professional goals.') }}
                            </p>
                            <div class="company-highlights">
                                <div class="highlight-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>{{ __('Accredited Programs') }}</span>
                                </div>
                                <div class="highlight-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>{{ __('Expert Faculty') }}</span>
                                </div>
                                <div class="highlight-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>{{ __('Global Recognition') }}</span>
                                </div>
                                <div class="highlight-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>{{ __('24/7 Support') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Company Info Section End -->

    <!-- Statistics Section -->
    <section class="about-statistics-section section-py-80">
        <div class="statistics-pattern"></div>
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="statistics-title">{{ __('Our Achievements in Numbers') }}</h2>
                    <p class="statistics-subtitle">{{ __('These numbers reflect our commitment to excellence and our impact on the learning community.') }}</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number" data-count="{{ \App\Models\Course::where('status', 'active')->where('is_approved', 'approved')->count() }}">0</h3>
                            <p class="stat-label">{{ __('Active Courses') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number" data-count="{{ \App\Models\User::where('role', 'instructor')->where('status', 'active')->count() }}">0</h3>
                            <p class="stat-label">{{ __('Expert Instructors') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number" data-count="{{ $hero?->content?->total_student ?? '10000' }}">0</h3>
                            <p class="stat-label">{{ __('Happy Students') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number" data-count="98">0</h3>
                            <p class="stat-label">{{ __('Success Rate') }}%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Statistics Section End -->

    <!-- Mission & Vision Section -->
    <section class="mission-vision-section section-py-120">
        <div class="mission-vision-pattern"></div>
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <div class="section__title">
                        <span class="sub-title">{{ __('Our Foundation') }}</span>
                        <h2 class="title">{{ __('Mission & Vision') }}</h2>
                        <p>{{ __('The guiding principles that drive our commitment to educational excellence and student success.') }}</p>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="mission-vision-card mission-card">
                        <div class="card-icon">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h3 class="card-title">{{ __('Our Mission') }}</h3>
                        <p class="card-description">
                            {{ __('To provide accessible, high-quality education that empowers individuals to unlock their potential, achieve their goals, and make a positive impact in their communities and beyond.') }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mission-vision-card vision-card">
                        <div class="card-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h3 class="card-title">{{ __('Our Vision') }}</h3>
                        <p class="card-description">
                            {{ __('To become a globally recognized leader in online education, creating transformative learning experiences that inspire lifelong learning and drive innovation in education technology.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Mission & Vision Section End -->

    <!-- Values Section -->
    <section class="values-section section-py-120 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <div class="section__title">
                        <span class="sub-title">{{ __('Our Core Values') }}</span>
                        <h2 class="title">{{ __('What We Stand For') }}</h2>
                        <p>{{ __('These fundamental principles guide everything we do and shape our commitment to excellence in education.') }}</p>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h4 class="value-title">{{ __('Innovation') }}</h4>
                        <p class="value-description">{{ __('We continuously embrace new technologies and teaching methods to enhance the learning experience.') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h4 class="value-title">{{ __('Excellence') }}</h4>
                        <p class="value-description">{{ __('We maintain the highest standards in curriculum design, instruction, and student support services.') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h4 class="value-title">{{ __('Integrity') }}</h4>
                        <p class="value-description">{{ __('We conduct our operations with honesty, transparency, and ethical practices in all interactions.') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <h4 class="value-title">{{ __('Inclusivity') }}</h4>
                        <p class="value-description">{{ __('We believe education should be accessible to everyone, regardless of background or circumstances.') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h4 class="value-title">{{ __('Growth') }}</h4>
                        <p class="value-description">{{ __('We foster a culture of continuous learning and personal development for students and staff alike.') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h4 class="value-title">{{ __('Quality') }}</h4>
                        <p class="value-description">{{ __('We are committed to delivering exceptional educational content and outstanding student outcomes.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Values Section End -->

    <!-- Brand Area -->
    @if($brands && $brands->count() > 0)
    <section class="brand-area-modern section-py-80">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-8 text-center">
                    <h3 class="brand-section-title">{{ __('Trusted By Leading Organizations') }}</h3>
                </div>
            </div>
            <div class="brand-slider-wrapper">
                <div class="marquee_mode">
                    @foreach ($brands as $brand)
                        <div class="brand__item-modern">
                            <a href="{{ $brand?->url ?? '#' }}" target="_blank" rel="noopener noreferrer">
                                <img src="{{ asset($brand?->image) }}" alt="{{ $brand?->name ?? 'Brand' }}" loading="lazy">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- Brand Area End -->

    <!-- Features Section -->
    @if($ourFeatures)
    <section class="features__area-modern section-py-120">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-xl-8 text-center">
                    <div class="section__title">
                        <span class="sub-title">{{ __('How We Start Journey') }}</span>
                        <h2 class="title">{{ __('Start your Learning Journey Today!') }}</h2>
                        <p>{{ __('Discover a World of Knowledge and Skills at Your Fingertips – Unlock Your Potential and Achieve Your Dreams with Our Comprehensive Learning Resources!') }}</p>
                    </div>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="features__item-modern">
                        <div class="features__icon-modern">
                            @if($ourFeatures?->global_content?->image_one)
                                <img src="{{ asset($ourFeatures->global_content->image_one) }}" class="injectable" alt="img">
                            @else
                                <i class="fas fa-graduation-cap"></i>
                            @endif
                        </div>
                        <div class="features__content-modern">
                            <h4 class="title">{{ $ourFeatures?->content?->title_one ?? __('Expert Instructors') }}</h4>
                            <p>{{ $ourFeatures?->content?->sub_title_one ?? __('Learn from industry professionals with years of experience.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="features__item-modern">
                        <div class="features__icon-modern">
                            @if($ourFeatures?->global_content?->image_two)
                                <img src="{{ asset($ourFeatures->global_content->image_two) }}" class="injectable" alt="img">
                            @else
                                <i class="fas fa-book"></i>
                            @endif
                        </div>
                        <div class="features__content-modern">
                            <h4 class="title">{{ $ourFeatures?->content?->title_two ?? __('Quality Content') }}</h4>
                            <p>{{ $ourFeatures?->content?->sub_title_two ?? __('Comprehensive courses designed for real-world application.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="features__item-modern">
                        <div class="features__icon-modern">
                            @if($ourFeatures?->global_content?->image_three)
                                <img src="{{ asset($ourFeatures->global_content->image_three) }}" class="injectable" alt="img">
                            @else
                                <i class="fas fa-certificate"></i>
                            @endif
                        </div>
                        <div class="features__content-modern">
                            <h4 class="title">{{ $ourFeatures?->content?->title_three ?? __('Certification') }}</h4>
                            <p>{{ $ourFeatures?->content?->sub_title_three ?? __('Earn recognized certificates upon course completion.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="features__item-modern">
                        <div class="features__icon-modern">
                            @if($ourFeatures?->global_content?->image_four)
                                <img src="{{ asset($ourFeatures->global_content->image_four) }}" class="injectable" alt="img">
                            @else
                                <i class="fas fa-headset"></i>
                            @endif
                        </div>
                        <div class="features__content-modern">
                            <h4 class="title">{{ $ourFeatures?->content?->title_four ?? __('24/7 Support') }}</h4>
                            <p>{{ $ourFeatures?->content?->sub_title_four ?? __('Get help whenever you need it from our dedicated support team.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- Features Section End -->

    <!-- FAQ Section -->
    @if($faqs && $faqs->count() > 0)
    <section class="faq__area-modern section-py-120">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="faq__img-wrap-modern">
                        @if($faqSection?->global_content?->image)
                            <img src="{{ asset($faqSection->global_content->image) }}" alt="FAQ" class="faq-main-image">
                        @else
                            <div class="faq-placeholder-image">
                                <i class="fas fa-question-circle"></i>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="faq__content-modern">
                        <div class="section__title mb-4">
                            <span class="sub-title">{{ $faqSection?->content?->short_title ?? __('Frequently Asked Questions') }}</span>
                            <h2 class="title">{!! clean(processText($faqSection?->content?->title ?? __('Got Questions? We Have Answers'))) !!}</h2>
                        </div>
                        <p class="mb-4">{!! clean(processText($faqSection?->content?->description ?? __('Find answers to common questions about our courses, enrollment process, and more.'))) !!}</p>
                        <div class="faq__wrap-modern">
                            <div class="accordion" id="faqAccordion">
                                @foreach ($faqs as $faq)
                                    <div class="accordion-item-modern">
                                        <h2 class="accordion-header-modern">
                                            <button class="accordion-button-modern {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse{{ $faq->id }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="faqCollapse{{ $faq->id }}">
                                                <span>{{ $faq?->translation?->question ?? $faq->question }}</span>
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                        </h2>
                                        <div id="faqCollapse{{ $faq->id }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body-modern">
                                                <p>{{ $faq?->translation?->answer ?? $faq->answer }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- FAQ Section End -->

    <!-- Testimonials Section -->
    @if($reviews && $reviews->count() > 0)
    <section class="testimonial__area-modern section-py-120 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-xl-8 text-center">
                    <div class="section__title">
                        <span class="sub-title">{{ __('Our Testimonials') }}</span>
                        <h2 class="title">{{ __('What Students Think and Say About Us') }}</h2>
                        <p>{{ __('Genuine feedback from our students about their experiences with our teaching and learning platform.') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="testimonial__item-wrap-modern">
                        <div class="swiper-container testimonial-swiper-active">
                            <div class="swiper-wrapper">
                                @foreach ($reviews as $testimonial)
                                    <div class="swiper-slide">
                                        <div class="testimonial__item-modern">
                                            <div class="testimonial__quote-icon">
                                                <i class="fas fa-quote-left"></i>
                                            </div>
                                            <div class="testimonial__content-modern">
                                                <p>"{{ $testimonial?->translation?->comment ?? $testimonial->comment }}"</p>
                                            </div>
                                            <div class="testimonial__author-modern">
                                                <div class="testimonial__author-thumb-modern">
                                                    <img src="{{ asset($testimonial?->image ?? '/uploads/website-images/frontend-avatar.png') }}" alt="{{ $testimonial?->translation?->name ?? 'Student' }}" loading="lazy">
                                                </div>
                                                <div class="testimonial__author-content-modern">
                                                    <div class="rating-modern">
                                                        @for ($i = 0; $i < ($testimonial?->rating ?? 5); $i++)
                                                            <i class="fas fa-star"></i>
                                                        @endfor
                                                    </div>
                                                    <h4 class="title">{{ $testimonial?->translation?->name ?? __('Student') }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="testimonial__nav-modern">
                            <button class="testimonial-button-prev"><i class="fas fa-arrow-left"></i></button>
                            <button class="testimonial-button-next"><i class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- Testimonials Section End -->

    <!-- Newsletter Section -->
    @if($newsletterSection)
    <section class="newsletter__area-modern section-py-120">
        <div class="container">
            <div class="newsletter-card-modern">
                <div class="row align-items-center g-4">
                    <div class="col-lg-5">
                        <div class="newsletter__img-wrap-modern">
                            @if($newsletterSection?->global_content?->image)
                                <img src="{{ asset($newsletterSection->global_content->image) }}" alt="Newsletter" class="newsletter-image">
                            @else
                                <div class="newsletter-placeholder">
                                    <i class="fas fa-envelope-open-text"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="newsletter__content-modern">
                            <h2 class="title">{{ __('Want to stay informed about') }} <br><b>{{ __('new courses and study') }}?</b></h2>
                            <p class="newsletter-subtitle">{{ __('Subscribe to our newsletter and never miss an update on new courses, special offers, and educational insights.') }}</p>
                            <div class="newsletter__form-modern">
                                <form action="" method="post" class="newsletter-form-inline">
                                    @csrf
                                    <div class="input-group-modern">
                                        <input type="email" placeholder="{{ __('Type your email address') }}" name="email" class="form-control-modern" required>
                                        <button type="submit" class="btn btn-primary-modern">
                                            {{ __('Subscribe Now') }}
                                            <i class="fas fa-arrow-right ms-2"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- Newsletter Section End -->

    <!-- Custom Styles -->
    <style>
        /* About Hero Section */
        .about-hero-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            position: relative;
            overflow: hidden;
        }

        .about-hero-background-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 20% 30%, rgba(87, 81, 225, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(124, 118, 255, 0.06) 0%, transparent 50%),
                linear-gradient(135deg, transparent 0%, rgba(87, 81, 225, 0.03) 100%);
            z-index: 0;
        }

        .about-hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            background: linear-gradient(135deg, rgba(87, 81, 225, 0.05) 0%, rgba(124, 118, 255, 0.02) 100%);
            z-index: 0;
        }

        .about-hero-section > .container {
            position: relative;
            z-index: 1;
        }

        /* Logo Section */
        .about-logo-section {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 20px 0;
        }

        .about-logo-wrapper {
            width: 120px;
            height: 120px;
            background: #ffffff;
            border-radius: 20px;
            padding: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .about-logo-wrapper:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 15px 40px rgba(87, 81, 225, 0.2);
        }

        .about-logo-img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .about-company-name {
            font-size: 32px;
            font-weight: 700;
            color: #1a1f3a;
            margin: 0;
            background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Quick Info Cards */
        .about-quick-info {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .quick-info-item {
            display: flex;
            align-items: center;
            gap: 12px;
            background: #ffffff;
            padding: 16px 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            flex: 1;
            min-width: 150px;
        }

        .quick-info-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(87, 81, 225, 0.15);
        }

        .quick-info-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, rgba(87, 81, 225, 0.1) 0%, rgba(124, 118, 255, 0.1) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #5751e1;
            font-size: 20px;
        }

        .quick-info-content {
            display: flex;
            flex-direction: column;
        }

        .quick-info-label {
            font-size: 12px;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .quick-info-value {
            font-size: 20px;
            font-weight: 700;
            color: #1a1f3a;
        }

        .about-hero-btn-outline {
            border: 2px solid #5751e1;
            color: #5751e1;
            background: transparent;
            padding: 14px 32px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .about-hero-btn-outline:hover {
            background: #5751e1;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(87, 81, 225, 0.3);
        }

        /* Company Info Section */
        .company-info-section {
            background: #ffffff;
            position: relative;
        }

        .company-info-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border-radius: 30px;
            padding: 60px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
            border: 1px solid #e9ecef;
            position: relative;
            overflow: hidden;
        }

        .company-info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #5751e1 0%, #7c76ff 50%, #5751e1 100%);
        }

        .company-logo-display {
            text-align: center;
        }

        .company-logo-wrapper {
            width: 180px;
            height: 180px;
            background: #ffffff;
            border-radius: 24px;
            padding: 25px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
            margin: 0 auto 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            border: 3px solid #f0f0f0;
        }

        .company-logo-wrapper:hover {
            transform: scale(1.05) rotate(2deg);
            box-shadow: 0 20px 60px rgba(87, 81, 225, 0.2);
            border-color: #5751e1;
        }

        .company-logo {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .company-name-large {
            font-size: 36px;
            font-weight: 700;
            color: #1a1f3a;
            margin: 0;
            background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .company-details-title {
            font-size: 32px;
            font-weight: 700;
            color: #1a1f3a;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 16px;
        }

        .company-details-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #5751e1 0%, #7c76ff 100%);
            border-radius: 2px;
        }

        .company-details-text {
            font-size: 17px;
            line-height: 1.8;
            color: #6c757d;
            margin-bottom: 30px;
        }

        .company-highlights {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .highlight-item {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(87, 81, 225, 0.05);
            padding: 12px 20px;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 600;
            color: #5751e1;
            transition: all 0.3s ease;
        }

        .highlight-item:hover {
            background: rgba(87, 81, 225, 0.1);
            transform: translateX(5px);
        }

        .highlight-item i {
            font-size: 18px;
        }

        .about-hero-badge {
            display: inline-block;
            padding: 8px 20px;
            background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
            color: #ffffff;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .about-hero-title {
            font-size: 48px;
            font-weight: 700;
            line-height: 1.2;
            color: #1a1f3a;
            margin-bottom: 24px;
        }

        .about-hero-description {
            font-size: 18px;
            line-height: 1.8;
            color: #6c757d;
            margin-bottom: 30px;
        }

        .about-hero-btn {
            padding: 14px 32px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(87, 81, 225, 0.3);
        }

        .about-hero-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(87, 81, 225, 0.4);
        }

        .about-hero-image-wrapper {
            position: relative;
        }

        .about-hero-image {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        }

        .about-hero-image::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(87, 81, 225, 0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
            z-index: 0;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        .about-hero-image .main-image {
            position: relative;
            z-index: 1;
        }

        .about-hero-image .main-image {
            width: 100%;
            height: auto;
            display: block;
        }

        .placeholder-image {
            width: 100%;
            height: 400px;
            background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 80px;
            position: relative;
            overflow: hidden;
        }

        .placeholder-image::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                rgba(255, 255, 255, 0.1) 10px,
                rgba(255, 255, 255, 0.1) 20px
            );
            animation: slide 20s linear infinite;
        }

        @keyframes slide {
            from {
                transform: translate(0, 0);
            }
            to {
                transform: translate(50px, 50px);
            }
        }

        .placeholder-image i {
            position: relative;
            z-index: 1;
        }

        .video-play-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #5751e1;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            z-index: 2;
        }

        .video-play-btn:hover {
            background: #5751e1;
            color: #ffffff;
            transform: translate(-50%, -50%) scale(1.1);
        }

        .video-play-btn svg {
            width: 24px;
            height: 28px;
        }

        .about-stats-card {
            position: absolute;
            bottom: -30px;
            right: -30px;
            background: #ffffff;
            padding: 24px;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 16px;
            z-index: 3;
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 24px;
        }

        .stats-number {
            font-size: 32px;
            font-weight: 700;
            color: #1a1f3a;
            margin: 0;
            line-height: 1;
        }

        .stats-label {
            font-size: 14px;
            color: #6c757d;
            margin: 4px 0 0 0;
        }

        /* Statistics Section */
        .about-statistics-section {
            background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
            color: #ffffff;
            position: relative;
            overflow: hidden;
        }

        .statistics-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 90% 80%, rgba(255, 255, 255, 0.08) 0%, transparent 50%);
            z-index: 0;
        }

        .about-statistics-section > .container {
            position: relative;
            z-index: 1;
        }

        .statistics-title {
            font-size: 42px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 16px;
        }

        .statistics-subtitle {
            font-size: 18px;
            color: rgba(255, 255, 255, 0.9);
            margin: 0;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
        }

        .stat-card:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-5px);
        }

        .stat-icon {
            font-size: 48px;
            margin-bottom: 20px;
            opacity: 0.9;
        }

        .stat-number {
            font-size: 42px;
            font-weight: 700;
            margin: 0 0 10px 0;
        }

        .stat-label {
            font-size: 16px;
            opacity: 0.9;
            margin: 0;
        }

        /* Mission & Vision Section */
        .mission-vision-section {
            background: #ffffff;
            position: relative;
            overflow: hidden;
        }

        .mission-vision-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 15% 25%, rgba(87, 81, 225, 0.05) 0%, transparent 40%),
                radial-gradient(circle at 85% 75%, rgba(124, 118, 255, 0.04) 0%, transparent 40%);
            z-index: 0;
        }

        .mission-vision-section > .container {
            position: relative;
            z-index: 1;
        }

        .mission-vision-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 40px;
            height: 100%;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border: 1px solid #f0f0f0;
        }

        .mission-vision-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #5751e1 0%, #7c76ff 100%);
        }

        .mission-card::before {
            background: linear-gradient(90deg, #5751e1 0%, #7c76ff 100%);
        }

        .vision-card::before {
            background: linear-gradient(90deg, #7c76ff 0%, #5751e1 100%);
        }

        .mission-vision-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.12);
        }

        .card-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, rgba(87, 81, 225, 0.1) 0%, rgba(124, 118, 255, 0.1) 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: #5751e1;
            margin-bottom: 24px;
        }

        .card-title {
            font-size: 28px;
            font-weight: 700;
            color: #1a1f3a;
            margin-bottom: 16px;
        }

        .card-description {
            font-size: 16px;
            line-height: 1.8;
            color: #6c757d;
            margin: 0;
        }

        /* Values Section */
        .values-section {
            background: #f8f9fa;
            position: relative;
            overflow: hidden;
        }

        .values-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 25% 30%, rgba(87, 81, 225, 0.06) 0%, transparent 50%),
                radial-gradient(circle at 75% 70%, rgba(124, 118, 255, 0.05) 0%, transparent 50%);
            z-index: 0;
        }

        .values-section > .container {
            position: relative;
            z-index: 1;
        }

        .value-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 32px;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid #e9ecef;
        }

        .value-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            border-color: #5751e1;
        }

        .value-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            color: #ffffff;
            margin: 0 auto 24px;
            transition: all 0.3s ease;
        }

        .value-card:hover .value-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .value-title {
            font-size: 22px;
            font-weight: 700;
            color: #1a1f3a;
            margin-bottom: 12px;
        }

        .value-description {
            font-size: 15px;
            line-height: 1.7;
            color: #6c757d;
            margin: 0;
        }

        /* Brand Area Modern */
        .brand-area-modern {
            background: #ffffff;
            position: relative;
            padding: 60px 0;
        }

        .brand-area-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, #e9ecef 50%, transparent 100%);
        }

        .brand-section-title {
            font-size: 32px;
            font-weight: 700;
            color: #1a1f3a;
            margin-bottom: 40px;
        }

        .brand__item-modern {
            padding: 20px;
            background: #ffffff;
            border-radius: 12px;
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
        }

        .brand__item-modern:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-color: #5751e1;
        }

        .brand__item-modern img {
            max-height: 60px;
            width: auto;
            filter: grayscale(100%);
            opacity: 0.6;
            transition: all 0.3s ease;
        }

        .brand__item-modern:hover img {
            filter: grayscale(0%);
            opacity: 1;
        }

        /* Features Modern */
        .features__area-modern {
            background: #ffffff;
            position: relative;
        }

        .features__area-modern::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, #e9ecef 50%, transparent 100%);
        }

        .features__item-modern {
            background: #ffffff;
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid #e9ecef;
        }

        .features__item-modern:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 50px rgba(87, 81, 225, 0.15);
            border-color: #5751e1;
        }

        .features__icon-modern {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(87, 81, 225, 0.1) 0%, rgba(124, 118, 255, 0.1) 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            transition: all 0.3s ease;
        }

        .features__icon-modern img {
            max-width: 60px;
            max-height: 60px;
        }

        .features__icon-modern i {
            font-size: 48px;
            color: #5751e1;
        }

        .features__item-modern:hover .features__icon-modern {
            background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
            transform: scale(1.1);
        }

        .features__item-modern:hover .features__icon-modern i {
            color: #ffffff;
        }

        .features__content-modern h4 {
            font-size: 22px;
            font-weight: 700;
            color: #1a1f3a;
            margin-bottom: 12px;
        }

        .features__content-modern p {
            font-size: 15px;
            line-height: 1.7;
            color: #6c757d;
            margin: 0;
        }

        /* FAQ Modern */
        .faq__area-modern {
            background: #ffffff;
            position: relative;
        }

        .faq__area-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(87, 81, 225, 0.03) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(124, 118, 255, 0.03) 0%, transparent 40%);
            z-index: 0;
        }

        .faq__area-modern > .container {
            position: relative;
            z-index: 1;
        }

        .faq__img-wrap-modern {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
        }

        .faq-main-image {
            width: 100%;
            height: auto;
            display: block;
        }

        .faq-placeholder-image {
            width: 100%;
            height: 400px;
            background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 100px;
        }

        .accordion-item-modern {
            background: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            margin-bottom: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .accordion-item-modern:hover {
            border-color: #5751e1;
        }

        .accordion-button-modern {
            width: 100%;
            padding: 20px 24px;
            background: transparent;
            border: none;
            text-align: left;
            font-size: 18px;
            font-weight: 600;
            color: #1a1f3a;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .accordion-button-modern:not(.collapsed) {
            color: #5751e1;
        }

        .accordion-button-modern i {
            transition: transform 0.3s ease;
        }

        .accordion-button-modern:not(.collapsed) i {
            transform: rotate(180deg);
        }

        .accordion-body-modern {
            padding: 0 24px 24px;
            font-size: 16px;
            line-height: 1.7;
            color: #6c757d;
        }

        /* Testimonials Modern */
        .testimonial__area-modern {
            background: #f8f9fa;
        }

        .testimonial__item-modern {
            background: #ffffff;
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            height: 100%;
            position: relative;
        }

        .testimonial__quote-icon {
            font-size: 48px;
            color: #5751e1;
            opacity: 0.2;
            margin-bottom: 20px;
        }

        .testimonial__content-modern {
            font-size: 18px;
            line-height: 1.8;
            color: #1a1f3a;
            margin-bottom: 30px;
            font-style: italic;
        }

        .testimonial__author-modern {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .testimonial__author-thumb-modern {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid #5751e1;
        }

        .testimonial__author-thumb-modern img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .rating-modern {
            color: #ffc107;
            margin-bottom: 8px;
        }

        .testimonial__author-content-modern h4 {
            font-size: 18px;
            font-weight: 700;
            color: #1a1f3a;
            margin: 0;
        }

        .testimonial__nav-modern {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin-top: 40px;
        }

        .testimonial__nav-modern button {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 2px solid #5751e1;
            background: #ffffff;
            color: #5751e1;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .testimonial__nav-modern button:hover {
            background: #5751e1;
            color: #ffffff;
            transform: scale(1.1);
        }

        /* Newsletter Modern */
        .newsletter__area-modern {
            background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
            position: relative;
            overflow: hidden;
        }

        .newsletter__area-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.08) 0%, transparent 50%);
            z-index: 0;
        }

        .newsletter__area-modern > .container {
            position: relative;
            z-index: 1;
        }

        .newsletter-card-modern {
            background: #ffffff;
            border-radius: 24px;
            padding: 50px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .newsletter__img-wrap-modern {
            text-align: center;
        }

        .newsletter-image {
            max-width: 100%;
            height: auto;
            border-radius: 16px;
        }

        .newsletter-placeholder {
            width: 100%;
            height: 300px;
            background: linear-gradient(135deg, rgba(87, 81, 225, 0.1) 0%, rgba(124, 118, 255, 0.1) 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #5751e1;
            font-size: 80px;
        }

        .newsletter__content-modern h2 {
            font-size: 36px;
            font-weight: 700;
            color: #1a1f3a;
            margin-bottom: 16px;
        }

        .newsletter-subtitle {
            font-size: 16px;
            color: #6c757d;
            margin-bottom: 30px;
        }

        .input-group-modern {
            display: flex;
            gap: 12px;
            background: #f8f9fa;
            border-radius: 50px;
            padding: 4px;
        }

        .form-control-modern {
            flex: 1;
            border: none;
            background: transparent;
            padding: 14px 24px;
            font-size: 16px;
            outline: none;
        }

        .btn-primary-modern {
            padding: 14px 32px;
            background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
            color: #ffffff;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(87, 81, 225, 0.4);
        }

        /* Responsive Design */
        @media (max-width: 991.98px) {
            .about-hero-title {
                font-size: 36px;
            }

            .about-logo-section {
                flex-direction: column;
                text-align: center;
            }

            .about-logo-wrapper {
                margin: 0 auto;
            }

            .about-company-name {
                font-size: 28px;
            }

            .about-quick-info {
                justify-content: center;
            }

            .company-info-card {
                padding: 40px;
            }

            .company-logo-wrapper {
                width: 150px;
                height: 150px;
            }

            .company-name-large {
                font-size: 28px;
            }

            .about-stats-card {
                position: relative;
                bottom: auto;
                right: auto;
                margin-top: 30px;
            }

            .stat-number {
                font-size: 36px;
            }

            .statistics-title {
                font-size: 32px;
            }

            .card-title {
                font-size: 24px;
            }

            .newsletter-card-modern {
                padding: 30px;
            }

            .about-hero-btn-outline {
                margin-top: 12px;
                margin-left: 0 !important;
                width: 100%;
            }
        }

        @media (max-width: 767.98px) {
            .about-hero-title {
                font-size: 28px;
            }

            .about-hero-description {
                font-size: 16px;
            }

            .about-logo-wrapper {
                width: 100px;
                height: 100px;
            }

            .about-company-name {
                font-size: 24px;
            }

            .quick-info-item {
                min-width: 100%;
            }

            .company-info-card {
                padding: 30px 20px;
            }

            .company-logo-wrapper {
                width: 120px;
                height: 120px;
            }

            .company-name-large {
                font-size: 24px;
            }

            .company-details-title {
                font-size: 26px;
            }

            .statistics-title {
                font-size: 28px;
            }

            .statistics-subtitle {
                font-size: 16px;
            }

            .stat-card {
                padding: 24px;
            }

            .stat-number {
                font-size: 32px;
            }

            .mission-vision-card {
                padding: 30px;
            }

            .value-card {
                padding: 24px;
            }

            .highlight-item {
                font-size: 14px;
                padding: 10px 16px;
            }

            .input-group-modern {
                flex-direction: column;
                background: transparent;
                padding: 0;
            }

            .form-control-modern {
                background: #f8f9fa;
                border-radius: 12px;
                margin-bottom: 12px;
            }

            .btn-primary-modern {
                width: 100%;
                border-radius: 12px;
            }
        }
    </style>

    <!-- Counter Animation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.stat-number');
            const speed = 200;

            const animateCounter = (counter) => {
                const target = parseInt(counter.getAttribute('data-count'));
                const count = parseInt(counter.innerText);
                const increment = target / speed;

                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(() => animateCounter(counter), 1);
                } else {
                    counter.innerText = target + (counter.textContent.includes('+') ? '+' : '') + (counter.textContent.includes('%') ? '%' : '');
                }
            };

            const observerOptions = {
                threshold: 0.5
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        if (!counter.classList.contains('animated')) {
                            counter.classList.add('animated');
                            animateCounter(counter);
                        }
                    }
                });
            }, observerOptions);

            counters.forEach(counter => {
                counter.innerText = '0';
                observer.observe(counter);
            });
        });
    </script>
@endsection
