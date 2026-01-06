@extends('frontend.layouts.master')
@section('meta_title', __('All Instructors') . ' || ' . $setting->app_name)
@section('contents')
    <!-- breadcrumb-area -->
    <x-frontend.breadcrumb :title="__('All Instructors')" :links="[['url' => route('home'), 'text' => __('Home')], ['url' => '', 'text' => __('All Instructors')]]" />
    <!-- breadcrumb-area-end -->
    
    <!-- Hero Section -->
    <section class="instructors-hero-section section-py-80">
        <div class="instructors-hero-background-pattern"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <div class="section__title mb-4">
                        <span class="sub-title instructors-hero-badge">{{ __('Meet Our Experts') }}</span>
                        <h1 class="title instructors-hero-title">{{ __('Our Instructors') }}</h1>
                    </div>
                    <p class="instructors-hero-description">
                        {{ __('Discover our team of experienced and passionate instructors dedicated to helping you achieve your learning goals. Each instructor brings unique expertise and a commitment to excellence.') }}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Statistics Section -->
    <section class="instructors-statistics-section section-py-60">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="instructor-stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number">{{ $instructors->total() }}</h3>
                            <p class="stat-label">{{ __('Total Instructors') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="instructor-stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number">{{ \App\Models\Course::where('status', 'active')->where('is_approved', 'approved')->count() }}</h3>
                            <p class="stat-label">{{ __('Total Courses') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="instructor-stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number">4.8</h3>
                            <p class="stat-label">{{ __('Average Rating') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="instructor-stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number">10K+</h3>
                            <p class="stat-label">{{ __('Happy Students') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Statistics Section End -->

    <!-- instructor-area -->
    <section class="instructor__area-enhanced section-py-80">
        <div class="container">
            @if($instructors->count() > 0)
                <div class="row g-4">
                    @foreach ($instructors as $instructor)
                        @if ($instructor->courses()->where(['status' => 'active', 'is_approved' => 'approved'])->count() > 0)
                            <div class="col-xl-4 col-lg-4 col-md-6">
                                <div class="instructor__item-enhanced">
                                    <div class="instructor__thumb-enhanced">
                                        <a href="{{ route('instructor-details', ['id' => $instructor->id, 'slug' => Str::slug($instructor->name)]) }}">
                                            <img src="{{ asset($instructor->image) }}" alt="{{ $instructor->name }}">
                                            <div class="instructor__overlay">
                                                <span class="view-profile-btn">{{ __('View Profile') }}</span>
                                            </div>
                                        </a>
                                        <div class="instructor__badge">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </div>
                                    <div class="instructor__content-enhanced">
                                        <h2 class="title">
                                            <a href="{{ route('instructor-details', ['id' => $instructor->id, 'slug' => Str::slug($instructor->name)]) }}">
                                                {{ $instructor->name }}
                                            </a>
                                        </h2>
                                        <span class="designation">{{ $instructor->job_title ?? __('Expert Instructor') }}</span>
                                        
                                        <div class="instructor__stats">
                                            <div class="stat-item">
                                                <i class="fas fa-book"></i>
                                                <span>{{ $instructor->courses->count() }} {{ __('Courses') }}</span>
                                            </div>
                                            <div class="stat-item">
                                                <i class="fas fa-star"></i>
                                                <span>{{ number_format($instructor->courses->avg('avg_rating'), 1) }} {{ __('Rating') }}</span>
                                            </div>
                                        </div>
                                        
                                        @if($instructor->short_bio)
                                            <p class="instructor__bio">{{ Str::limit($instructor->short_bio, 100) }}</p>
                                        @endif
                                        
                                        <div class="instructor__social-enhanced">
                                            <ul class="list-wrap">
                                                @if ($instructor->facebook)
                                                    <li>
                                                        <a href="{{ $instructor->facebook }}" target="_blank" aria-label="Facebook" class="social-link facebook">
                                                            <i class="fab fa-facebook-f"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if ($instructor->twitter)
                                                    <li>
                                                        <a href="{{ $instructor->twitter }}" target="_blank" aria-label="Twitter" class="social-link twitter">
                                                            <i class="fab fa-twitter"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if ($instructor->linkedin)
                                                    <li>
                                                        <a href="{{ $instructor->linkedin }}" target="_blank" aria-label="Linkedin" class="social-link linkedin">
                                                            <i class="fab fa-linkedin"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if ($instructor->github)
                                                    <li>
                                                        <a href="{{ $instructor->github }}" target="_blank" aria-label="Github" class="social-link github">
                                                            <i class="fab fa-github"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        
                                        <div class="instructor__action">
                                            <a href="{{ route('instructor-details', ['id' => $instructor->id, 'slug' => Str::slug($instructor->name)]) }}" class="btn-instructor-profile">
                                                {{ __('View Profile') }}
                                                <i class="fas fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                
                @if($instructors->hasPages())
                    <nav class="pagination__wrap-enhanced mt-50">
                        {{ $instructors->links() }}
                    </nav>
                @endif
            @else
                <div class="row">
                    <div class="col-12">
                        <div class="no-instructors-found text-center py-5">
                            <div class="no-instructors-icon mb-4">
                                <i class="fas fa-user-slash"></i>
                            </div>
                            <h3>{{ __('No Instructors Found') }}</h3>
                            <p>{{ __('We are currently updating our instructor profiles. Please check back soon!') }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- instructor-area-end -->
@endsection

@push('styles')
<style>
    /* Hero Section */
    .instructors-hero-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        position: relative;
        overflow: hidden;
    }

    .instructors-hero-background-pattern {
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

    .instructors-hero-section > .container {
        position: relative;
        z-index: 1;
    }

    .instructors-hero-badge {
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

    .instructors-hero-title {
        font-size: 48px;
        font-weight: 700;
        line-height: 1.2;
        color: #1a1f3a;
        margin-bottom: 24px;
    }

    .instructors-hero-description {
        font-size: 18px;
        line-height: 1.8;
        color: #6c757d;
        max-width: 800px;
        margin: 0 auto;
    }

    /* Statistics Section */
    .instructors-statistics-section {
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        color: #ffffff;
        position: relative;
        overflow: hidden;
    }

    .instructors-statistics-section::before {
        content: '';
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

    .instructors-statistics-section > .container {
        position: relative;
        z-index: 1;
    }

    .instructor-stat-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 30px 20px;
        text-align: center;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-bottom: 0;
    }

    .instructor-stat-card:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-5px);
    }

    .instructor-stat-card .stat-icon {
        font-size: 42px;
        margin-bottom: 16px;
        opacity: 0.9;
    }

    .instructor-stat-card .stat-number {
        font-size: 38px;
        font-weight: 700;
        margin: 0 0 8px 0;
        color: #ffffff;
        line-height: 1.2;
    }

    .instructor-stat-card .stat-label {
        font-size: 15px;
        opacity: 0.9;
        margin: 0;
        color: #ffffff;
        font-weight: 500;
    }

    /* Enhanced Instructor Area */
    .instructor__area-enhanced {
        background: #ffffff;
        position: relative;
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .instructor__area-enhanced .row {
        margin-left: -15px;
        margin-right: -15px;
        margin-top: 0;
        margin-bottom: 0;
    }

    .instructor__area-enhanced .row > [class*='col-'] {
        padding-left: 15px;
        padding-right: 15px;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .instructor__item-enhanced {
        background: #ffffff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        border: 1px solid #e9ecef;
        margin: 0;
    }

    .instructor__item-enhanced:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 50px rgba(87, 81, 225, 0.2);
        border-color: #5751e1;
    }

    .instructor__thumb-enhanced {
        position: relative;
        overflow: visible;
        padding: 40px 20px 30px 20px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 200px;
    }

    .instructor__thumb-enhanced img {
        width: 140px;
        height: 140px;
        object-fit: cover;
        border-radius: 50%;
        transition: all 0.3s ease;
        border: 4px solid #ffffff;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        display: block;
        margin: 0 auto;
    }

    .instructor__item-enhanced:hover .instructor__thumb-enhanced img {
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(87, 81, 225, 0.3);
        border-color: #5751e1;
    }

    .instructor__overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(87, 81, 225, 0.9) 0%, rgba(124, 118, 255, 0.9) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
        border-radius: 20px 20px 0 0;
    }

    .instructor__item-enhanced:hover .instructor__overlay {
        opacity: 1;
    }

    .view-profile-btn {
        color: #ffffff;
        font-size: 16px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .instructor__badge {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 16px;
        box-shadow: 0 4px 15px rgba(87, 81, 225, 0.3);
        z-index: 2;
        border: 2px solid #ffffff;
    }

    .instructor__content-enhanced {
        padding: 24px 24px 24px 24px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .instructor__content-enhanced .title {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 6px;
        line-height: 1.3;
        text-align: center;
    }

    .instructor__content-enhanced .title a {
        color: #1a1f3a;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .instructor__content-enhanced .title a:hover {
        color: #5751e1;
    }

    .instructor__content-enhanced .designation {
        display: block;
        font-size: 14px;
        color: #6c757d;
        margin-bottom: 16px;
        font-weight: 500;
        text-align: center;
    }

    .instructor__stats {
        display: flex;
        gap: 20px;
        margin-bottom: 16px;
        padding-bottom: 16px;
        border-bottom: 1px solid #e9ecef;
        justify-content: center;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: #6c757d;
        font-weight: 500;
    }

    .stat-item i {
        color: #5751e1;
        font-size: 15px;
    }

    .instructor__bio {
        font-size: 13px;
        line-height: 1.6;
        color: #6c757d;
        margin-bottom: 18px;
        flex: 1;
        text-align: center;
        min-height: 40px;
    }

    .instructor__social-enhanced {
        margin-bottom: 20px;
        display: flex;
        justify-content: center;
    }

    .instructor__social-enhanced .list-wrap {
        display: flex;
        gap: 10px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .instructor__social-enhanced .social-link {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        color: #6c757d;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 16px;
    }

    .instructor__social-enhanced .social-link:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    .instructor__social-enhanced .social-link.facebook:hover {
        background: #1877f2;
        color: #ffffff;
    }

    .instructor__social-enhanced .social-link.twitter:hover {
        background: #1da1f2;
        color: #ffffff;
    }

    .instructor__social-enhanced .social-link.linkedin:hover {
        background: #0077b5;
        color: #ffffff;
    }

    .instructor__social-enhanced .social-link.github:hover {
        background: #333;
        color: #ffffff;
    }

    .instructor__action {
        margin-top: auto;
    }

    .btn-instructor-profile {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 22px;
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        color: #ffffff;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        width: 100%;
        justify-content: center;
        text-align: center;
    }

    .btn-instructor-profile:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(87, 81, 225, 0.4);
        color: #ffffff;
    }

    .btn-instructor-profile i {
        transition: transform 0.3s ease;
    }

    .btn-instructor-profile:hover i {
        transform: translateX(5px);
    }

    /* Pagination Enhanced */
    .pagination__wrap-enhanced {
        display: flex;
        justify-content: center;
        margin-top: 50px;
    }

    .pagination__wrap-enhanced .pagination {
        display: flex;
        gap: 10px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .pagination__wrap-enhanced .pagination li a,
    .pagination__wrap-enhanced .pagination li span {
        padding: 12px 20px;
        border-radius: 8px;
        background: #f8f9fa;
        color: #6c757d;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid #e9ecef;
    }

    .pagination__wrap-enhanced .pagination li.active span,
    .pagination__wrap-enhanced .pagination li a:hover {
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        color: #ffffff;
        border-color: #5751e1;
    }

    /* No Instructors Found */
    .no-instructors-found {
        padding: 80px 20px;
    }

    .no-instructors-icon {
        font-size: 80px;
        color: #6c757d;
        opacity: 0.5;
    }

    .no-instructors-found h3 {
        font-size: 28px;
        font-weight: 700;
        color: #1a1f3a;
        margin-bottom: 16px;
    }

    .no-instructors-found p {
        font-size: 16px;
        color: #6c757d;
        margin: 0;
    }

    /* Responsive Design */
    @media (max-width: 1199.98px) {
        .instructors-hero-title {
            font-size: 40px;
        }
    }

    @media (max-width: 991.98px) {
        .instructors-hero-title {
            font-size: 36px;
        }

        .instructors-hero-description {
            font-size: 16px;
        }

        .instructor-stat-card .stat-number {
            font-size: 36px;
        }
    }

    @media (max-width: 767.98px) {
        .instructors-hero-title {
            font-size: 28px;
        }

        .instructors-hero-description {
            font-size: 15px;
        }

        .instructor-stat-card {
            padding: 24px 15px;
        }

        .instructor-stat-card .stat-number {
            font-size: 32px;
        }

        .instructor__area-enhanced .row > [class*='col-'] {
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .instructor__thumb-enhanced {
            padding: 30px 15px 20px 15px;
            min-height: 160px;
        }

        .instructor__thumb-enhanced img {
            width: 120px;
            height: 120px;
        }

        .instructor__content-enhanced {
            padding: 20px;
        }

        .instructor__content-enhanced .title {
            font-size: 20px;
        }

        .instructor__stats {
            flex-direction: column;
            gap: 12px;
        }
    }
</style>
@endpush
