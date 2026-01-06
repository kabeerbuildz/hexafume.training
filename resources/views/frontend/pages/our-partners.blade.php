@extends('frontend.layouts.master')

@section('meta_title', __('Our Partners') . ' || ' . $setting->app_name)
@section('meta_description', __('Discover our trusted partners who collaborate with us to deliver exceptional educational experiences and innovative learning solutions.'))

@section('contents')
    <!-- breadcrumb-area -->
    <x-frontend.breadcrumb :title="__('Our Partners')" :links="[['url' => route('home'), 'text' => __('Home')], ['url' => '', 'text' => __('Our Partners')]]" />
    <!-- breadcrumb-area-end -->

    <!-- Partners Hero Section -->
    <section class="partners-hero-section section-py-120">
        <div class="partners-hero-background-pattern"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <div class="partners-hero-content">
                        <span class="partners-hero-badge">{{ __('Trusted Collaborations') }}</span>
                        <h1 class="partners-hero-title">{{ __('Our Partners') }}</h1>
                        <p class="partners-hero-description">
                            {{ __('We are proud to collaborate with industry leaders, educational institutions, and innovative organizations that share our commitment to excellence in education and learning.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Partners Hero Section End -->

    <!-- Partners Grid Section -->
    @if($partners && $partners->count() > 0)
    <section class="partners-grid-section section-py-120">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <div class="section__title">
                        <span class="sub-title">{{ __('Our Network') }}</span>
                        <h2 class="title">{{ __('Trusted by Leading Organizations') }}</h2>
                        <p>{{ __('We work with prestigious partners who help us deliver world-class educational experiences.') }}</p>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                @foreach ($partners as $partner)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="partner-card">
                        <div class="partner-card-inner">
                            <a href="{{ $partner->url ?? '#' }}" target="_blank" rel="noopener noreferrer" class="partner-link">
                                <div class="partner-logo-wrapper">
                                    <img src="{{ asset($partner->image) }}" alt="{{ $partner->name ?? 'Partner' }}" class="partner-logo" loading="lazy" onerror="this.src='{{ asset('frontend/img/placeholder-logo.png') }}'">
                                </div>
                                @if($partner->name)
                                <div class="partner-info">
                                    <h4 class="partner-name">{{ $partner->name }}</h4>
                                </div>
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @else
    <!-- Empty State -->
    <section class="partners-empty-section section-py-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h3 class="empty-state-title">{{ __('No Partners Available') }}</h3>
                        <p class="empty-state-description">{{ __('We are currently building our partner network. Check back soon for updates!') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- Partners Grid Section End -->

    <!-- Partnership Benefits Section -->
    <section class="partnership-benefits-section section-py-120 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <div class="section__title">
                        <span class="sub-title">{{ __('Why Partner With Us') }}</span>
                        <h2 class="title">{{ __('Building Strong Partnerships') }}</h2>
                        <p>{{ __('Our partnerships are built on trust, innovation, and a shared vision for transforming education.') }}</p>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h4 class="benefit-title">{{ __('Innovation') }}</h4>
                        <p class="benefit-description">{{ __('We collaborate with forward-thinking organizations to bring cutting-edge solutions to education.') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="fas fa-globe"></i>
                        </div>
                        <h4 class="benefit-title">{{ __('Global Reach') }}</h4>
                        <p class="benefit-description">{{ __('Our partnerships extend our educational impact to learners worldwide.') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <h4 class="benefit-title">{{ __('Quality Assurance') }}</h4>
                        <p class="benefit-description">{{ __('We partner only with organizations that meet our high standards for excellence.') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="benefit-title">{{ __('Student Success') }}</h4>
                        <p class="benefit-description">{{ __('Our partnerships are designed to enhance student learning outcomes and career success.') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4 class="benefit-title">{{ __('Growth') }}</h4>
                        <p class="benefit-description">{{ __('Together with our partners, we continuously expand and improve our educational offerings.') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h4 class="benefit-title">{{ __('Commitment') }}</h4>
                        <p class="benefit-description">{{ __('We are committed to long-term partnerships that create lasting value for all stakeholders.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Partnership Benefits Section End -->

    <!-- CTA Section -->
    <section class="partners-cta-section section-py-120">
        <div class="container">
            <div class="partners-cta-card">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <div class="cta-content">
                            <h3 class="cta-title">{{ __('Interested in Becoming a Partner?') }}</h3>
                            <p class="cta-description">{{ __('Join our network of trusted partners and help us transform education together.') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="{{ route('contact.index') }}" class="btn btn-primary btn-lg cta-button">
                            {{ __('Contact Us') }}
                            <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CTA Section End -->

    <!-- Custom Styles -->
    <style>
        /* Partners Hero Section */
        .partners-hero-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            position: relative;
            overflow: hidden;
        }

        .partners-hero-background-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 20% 30%, rgba(87, 81, 225, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(124, 118, 255, 0.06) 0%, transparent 50%);
            z-index: 0;
        }

        .partners-hero-section > .container {
            position: relative;
            z-index: 1;
        }

        .partners-hero-badge {
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

        .partners-hero-title {
            font-size: 48px;
            font-weight: 700;
            line-height: 1.2;
            color: #1a1f3a;
            margin-bottom: 24px;
        }

        .partners-hero-description {
            font-size: 18px;
            line-height: 1.8;
            color: #6c757d;
            margin: 0;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Partners Grid Section */
        .partners-grid-section {
            background: #ffffff;
            position: relative;
        }

        .partner-card {
            height: 100%;
            transition: all 0.3s ease;
        }

        .partner-card-inner {
            background: #ffffff;
            border: 2px solid #e9ecef;
            border-radius: 16px;
            padding: 30px 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            transition: all 0.3s ease;
            min-height: 200px;
        }

        .partner-card:hover .partner-card-inner {
            border-color: #5751e1;
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(87, 81, 225, 0.15);
        }

        .partner-link {
            text-decoration: none;
            color: inherit;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
        }

        .partner-logo-wrapper {
            width: 100%;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .partner-card:hover .partner-logo-wrapper {
            background: rgba(87, 81, 225, 0.05);
        }

        .partner-logo {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            filter: grayscale(100%);
            opacity: 0.7;
            transition: all 0.3s ease;
        }

        .partner-card:hover .partner-logo {
            filter: grayscale(0%);
            opacity: 1;
            transform: scale(1.05);
        }

        .partner-info {
            margin-top: auto;
        }

        .partner-name {
            font-size: 16px;
            font-weight: 600;
            color: #1a1f3a;
            margin: 0;
            transition: color 0.3s ease;
        }

        .partner-card:hover .partner-name {
            color: #5751e1;
        }

        /* Empty State */
        .partners-empty-section {
            background: #ffffff;
        }

        .empty-state {
            padding: 60px 20px;
        }

        .empty-state-icon {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, rgba(87, 81, 225, 0.1) 0%, rgba(124, 118, 255, 0.1) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            font-size: 48px;
            color: #5751e1;
        }

        .empty-state-title {
            font-size: 28px;
            font-weight: 700;
            color: #1a1f3a;
            margin-bottom: 16px;
        }

        .empty-state-description {
            font-size: 16px;
            color: #6c757d;
            margin: 0;
        }

        /* Partnership Benefits Section */
        .partnership-benefits-section {
            position: relative;
            overflow: hidden;
        }

        .partnership-benefits-section::before {
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

        .partnership-benefits-section > .container {
            position: relative;
            z-index: 1;
        }

        .benefit-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid #e9ecef;
        }

        .benefit-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            border-color: #5751e1;
        }

        .benefit-icon {
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

        .benefit-card:hover .benefit-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .benefit-title {
            font-size: 22px;
            font-weight: 700;
            color: #1a1f3a;
            margin-bottom: 12px;
        }

        .benefit-description {
            font-size: 15px;
            line-height: 1.7;
            color: #6c757d;
            margin: 0;
        }

        /* CTA Section */
        .partners-cta-section {
            background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
            position: relative;
            overflow: hidden;
        }

        .partners-cta-section::before {
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

        .partners-cta-section > .container {
            position: relative;
            z-index: 1;
        }

        .partners-cta-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 50px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .cta-title {
            font-size: 32px;
            font-weight: 700;
            color: #1a1f3a;
            margin-bottom: 12px;
        }

        .cta-description {
            font-size: 16px;
            color: #6c757d;
            margin: 0;
        }

        .cta-button {
            padding: 14px 32px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(87, 81, 225, 0.3);
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(87, 81, 225, 0.4);
        }

        /* Responsive Design */
        @media (max-width: 991.98px) {
            .partners-hero-title {
                font-size: 36px;
            }

            .partners-hero-description {
                font-size: 16px;
            }

            .partners-cta-card {
                padding: 40px 30px;
            }

            .cta-title {
                font-size: 28px;
            }
        }

        @media (max-width: 767.98px) {
            .partners-hero-title {
                font-size: 28px;
            }

            .partners-hero-description {
                font-size: 15px;
            }

            .partner-card-inner {
                min-height: 180px;
                padding: 24px 16px;
            }

            .partner-logo-wrapper {
                height: 100px;
            }

            .partners-cta-card {
                padding: 30px 20px;
            }

            .cta-title {
                font-size: 24px;
            }

            .cta-button {
                width: 100%;
                margin-top: 20px;
            }

            .benefit-card {
                padding: 30px 20px;
            }
        }
    </style>
@endsection



