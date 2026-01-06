@extends('frontend.layouts.master')
@section('meta_title', __('All Programs') . ' || ' . $setting->app_name)
@section('contents')
    <!-- breadcrumb-area -->
    <x-frontend.breadcrumb :title="__('All Programs')" :links="[['url' => route('home'), 'text' => __('Home')], ['url' => '', 'text' => __('All Programs')]]" />
    <!-- breadcrumb-area-end -->
    
    <!-- Hero Section -->
    <section class="programs-hero-section section-py-80">
        <div class="programs-hero-background-pattern"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <div class="section__title mb-4">
                        <span class="sub-title programs-hero-badge">{{ __('Explore Our Programs') }}</span>
                        <h1 class="title programs-hero-title">{{ __('Our Programs') }}</h1>
                    </div>
                    <p class="programs-hero-description">
                        {{ __('Discover our comprehensive range of programs designed to help you achieve your learning goals. Each program is carefully crafted by expert instructors to provide you with the best learning experience.') }}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Statistics Section -->
    <section class="programs-statistics-section section-py-60">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="program-stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number">{{ $programs->total() }}</h3>
                            <p class="stat-label">{{ __('Total Programs') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="program-stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number">{{ \App\Models\User::where(['status' => 'active', 'is_banned' => 0, 'role' => 'instructor'])->count() }}</h3>
                            <p class="stat-label">{{ __('Expert Instructors') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="program-stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number">{{ number_format($programs->avg('avg_rating') ?? 0, 1) }}</h3>
                            <p class="stat-label">{{ __('Average Rating') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="program-stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number">{{ $programs->sum('review_count') }}</h3>
                            <p class="stat-label">{{ __('Total Reviews') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Statistics Section End -->

    <!-- programs-area -->
    <section class="programs__area-enhanced section-py-80">
        <div class="container">
            @if($programs->count() > 0)
                <div class="programs-header mb-5">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h2 class="programs-section-title">
                                <span class="title-accent"></span>
                                {{ __('Browse All Programs') }}
                            </h2>
                            <p class="programs-section-subtitle">{{ __('Find the perfect program to advance your skills') }}</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <div class="programs-count-badge">
                                <i class="fas fa-book-open me-2"></i>
                                <span>{{ $programs->total() }} {{ __('Programs Available') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4 programs-grid">
                    @foreach ($programs as $program)
                        <div class="col-xxl-4 col-lg-4 col-md-6 col-sm-12">
                            <div class="program-card-enhanced">
                                <div class="program-card-thumb">
                                    <a href="{{ route('course.show', $program->slug) }}" class="program-thumb-link">
                                        <img src="{{ asset($program->thumbnail) }}" alt="{{ $program->title }}" class="program-thumb-img">
                                        <div class="program-overlay">
                                            <span class="view-program-btn">
                                                <i class="fas fa-eye me-2"></i>
                                                {{ __('View Details') }}
                                            </span>
                                        </div>
                                    </a>
                                    <a href="javascript:;" class="program-wishlist-btn" data-slug="{{ $program->slug }}" aria-label="WishList">
                                        <i class="{{ $program->favorite_by_client ? 'fas' : 'far' }} fa-heart"></i>
                                    </a>
                                    @php
                                        $feeStructures = $program->courseFeeStructures ?? collect([]);
                                        $minFee = $feeStructures->min('course_fee');
                                        $maxFee = $feeStructures->max('course_fee');
                                    @endphp
                                    @if($feeStructures->count() > 0 && $minFee !== null && $minFee > 0 && $maxFee > $minFee)
                                        <span class="program-discount-badge">
                                            {{ __('Special Pricing') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="program-card-content">
                                    <div class="program-meta-top">
                                        <a href="{{ route('courses', ['category' => $program->category->id]) }}" class="program-category-badge">
                                            <i class="fas fa-tag me-1"></i>
                                            {{ $program->category->translation->name ?? '' }}
                                        </a>
                                        <div class="program-rating">
                                            <i class="fas fa-star"></i>
                                            <span class="rating-value">{{ number_format($program->avg_rating ?? 0, 1) }}</span>
                                            <span class="review-count">({{ $program->review_count ?? 0 }})</span>
                                        </div>
                                    </div>
                                    <h3 class="program-title">
                                        <a href="{{ route('course.show', $program->slug) }}">
                                            {{ truncate($program->title, 60) }}
                                        </a>
                                    </h3>
                                    <div class="program-instructor">
                                        <div class="instructor-info">
                                            <i class="fas fa-user-tie me-2"></i>
                                            <span>{{ __('By') }}</span>
                                            <a href="{{ route('instructor-details', ['id' => $program->instructor->id, 'slug' => Str::slug($program->instructor->name)]) }}">
                                                {{ $program->instructor->name }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="program-card-footer">
                                        <div class="program-price-section">
                                            @php
                                                $feeStructures = $program->courseFeeStructures ?? collect([]);
                                                $minFee = $feeStructures->min('course_fee');
                                                $maxFee = $feeStructures->max('course_fee');
                                            @endphp
                                            @if($feeStructures->count() > 0 && $minFee !== null)
                                                @if($minFee == 0)
                                                    <span class="program-price free">{{ __('Free') }}</span>
                                                @elseif($minFee == $maxFee)
                                                    <span class="program-price">{{ currency($minFee) }}</span>
                                                @else
                                                    <span class="program-price">{{ currency($minFee) }} - {{ currency($maxFee) }}</span>
                                                @endif
                                                @if($minFee != $maxFee)
                                                    <small class="text-muted d-block" style="font-size: 11px; margin-top: 4px;">{{ __('Starting from') }}</small>
                                                @endif
                                            @else
                                                <span class="program-price">{{ __('Contact for Price') }}</span>
                                            @endif
                                        </div>
                                        <div class="program-action">
                                            @if (in_array($program->id, session('enrollments') ?? []))
                                                <a href="{{ route('student.enrolled-courses') }}" class="program-btn enrolled-btn">
                                                    <i class="fas fa-check-circle me-2"></i>
                                                    {{ __('Enrolled') }}
                                                </a>
                                            @elseif ($program->enrollments->count() >= $program->capacity && $program->capacity != null)
                                                <a href="javascript:;" class="program-btn booked-btn">
                                                    <i class="fas fa-lock me-2"></i>
                                                    {{ __('Booked') }}
                                                </a>
                                            @else
                                                <a href="javascript:;" class="program-btn add-to-cart-btn add-to-cart" data-id="{{ $program->id }}">
                                                    <i class="fas fa-shopping-cart me-2"></i>
                                                    {{ __('Add To Cart') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                @if($programs->hasPages())
                    <nav class="pagination__wrap-enhanced mt-60">
                        {{ $programs->links() }}
                    </nav>
                @endif
            @else
                <div class="row">
                    <div class="col-12">
                        <div class="no-programs-found-enhanced text-center py-5">
                            <div class="no-programs-icon-wrapper">
                                <div class="no-programs-icon">
                                    <i class="fas fa-book-open"></i>
                                </div>
                            </div>
                            <h3 class="no-programs-title">{{ __('No Programs Found') }}</h3>
                            <p class="no-programs-text">{{ __('We are currently updating our program listings. Please check back soon!') }}</p>
                            <a href="{{ route('home') }}" class="back-home-btn">
                                <i class="fas fa-arrow-left me-2"></i>
                                {{ __('Back to Home') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- programs-area-end -->
@endsection

@push('styles')
<style>
    /* Hero Section */
    .programs-hero-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        position: relative;
        overflow: hidden;
        padding: 100px 0 80px;
    }

    .programs-hero-background-pattern {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: 
            radial-gradient(circle at 20% 30%, rgba(87, 81, 225, 0.08) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(124, 118, 255, 0.06) 0%, transparent 50%);
        z-index: 0;
        animation: float 20s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    .programs-hero-section > .container {
        position: relative;
        z-index: 1;
    }

    .programs-hero-badge {
        display: inline-block;
        padding: 10px 24px;
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        color: #ffffff;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 24px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 15px rgba(87, 81, 225, 0.3);
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .programs-hero-title {
        font-size: 52px;
        font-weight: 800;
        line-height: 1.2;
        color: #1a1f3a;
        margin-bottom: 24px;
        background: linear-gradient(135deg, #1a1f3a 0%, #5751e1 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .programs-hero-description {
        font-size: 18px;
        line-height: 1.8;
        color: #6c757d;
        max-width: 800px;
        margin: 0 auto;
    }

    /* Statistics Section */
    .programs-statistics-section {
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        color: #ffffff;
        position: relative;
        overflow: hidden;
        padding: 80px 0;
    }

    .programs-statistics-section::before {
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

    .programs-statistics-section > .container {
        position: relative;
        z-index: 1;
    }

    .program-stat-card {
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 24px;
        padding: 35px 25px;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .program-stat-card::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .program-stat-card:hover::before {
        opacity: 1;
    }

    .program-stat-card:hover {
        background: rgba(255, 255, 255, 0.18);
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        border-color: rgba(255, 255, 255, 0.4);
    }

    .program-stat-card .stat-icon {
        font-size: 48px;
        margin-bottom: 20px;
        opacity: 0.95;
        transition: transform 0.4s ease;
    }

    .program-stat-card:hover .stat-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .program-stat-card .stat-number {
        font-size: 42px;
        font-weight: 800;
        margin: 0 0 10px 0;
        color: #ffffff;
        line-height: 1.2;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .program-stat-card .stat-label {
        font-size: 16px;
        opacity: 0.95;
        margin: 0;
        color: #ffffff;
        font-weight: 500;
        letter-spacing: 0.3px;
    }

    /* Enhanced Programs Area */
    .programs__area-enhanced {
        background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);
        padding: 80px 0;
    }

    .programs-header {
        margin-bottom: 50px;
    }

    .programs-section-title {
        font-size: 36px;
        font-weight: 800;
        color: #1a1f3a;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .title-accent {
        width: 6px;
        height: 40px;
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        border-radius: 10px;
        display: inline-block;
    }

    .programs-section-subtitle {
        font-size: 16px;
        color: #6c757d;
        margin: 0;
    }

    .programs-count-badge {
        display: inline-flex;
        align-items: center;
        padding: 12px 24px;
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        color: #ffffff;
        border-radius: 50px;
        font-weight: 600;
        font-size: 15px;
        box-shadow: 0 4px 15px rgba(87, 81, 225, 0.3);
    }

    /* Enhanced Program Cards */
    .program-card-enhanced {
        background: #ffffff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid #e9ecef;
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .program-card-enhanced:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(87, 81, 225, 0.25);
        border-color: #5751e1;
    }

    .program-card-thumb {
        position: relative;
        overflow: hidden;
        height: 220px;
    }

    .program-thumb-link {
        display: block;
        width: 100%;
        height: 100%;
        position: relative;
    }

    .program-thumb-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .program-card-enhanced:hover .program-thumb-img {
        transform: scale(1.1);
    }

    .program-overlay {
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
        transition: opacity 0.4s ease;
    }

    .program-card-enhanced:hover .program-overlay {
        opacity: 1;
    }

    .view-program-btn {
        color: #ffffff;
        font-size: 16px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 12px 30px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50px;
        border: 2px solid rgba(255, 255, 255, 0.5);
        transition: all 0.3s ease;
    }

    .view-program-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: scale(1.05);
    }

    .program-wishlist-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 42px;
        height: 42px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #5751e1;
        font-size: 18px;
        transition: all 0.3s ease;
        z-index: 2;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .program-wishlist-btn:hover {
        background: #5751e1;
        color: #ffffff;
        transform: scale(1.1) rotate(10deg);
    }

    .program-wishlist-btn i.fas {
        color: #e74c3c;
    }

    .program-discount-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
        color: #ffffff;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        z-index: 2;
        box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
    }

    .program-card-content {
        padding: 24px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .program-meta-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .program-category-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 14px;
        background: linear-gradient(135deg, #f0f0ff 0%, #e8e8ff 100%);
        color: #5751e1;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .program-category-badge:hover {
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        color: #ffffff;
        transform: translateY(-2px);
    }

    .program-rating {
        display: flex;
        align-items: center;
        gap: 5px;
        color: #ffc224;
        font-size: 14px;
        font-weight: 600;
    }

    .program-rating i {
        color: #ffc224;
    }

    .rating-value {
        color: #1a1f3a;
    }

    .review-count {
        font-size: 12px;
        color: #6c757d;
    }

    .program-title {
        font-size: 20px;
        font-weight: 700;
        line-height: 1.4;
        margin: 0 0 12px 0;
    }

    .program-title a {
        color: #1a1f3a;
        text-decoration: none;
        transition: color 0.3s ease;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .program-title a:hover {
        color: #5751e1;
    }

    .program-instructor {
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 1px solid #e9ecef;
    }

    .instructor-info {
        display: flex;
        align-items: center;
        font-size: 14px;
        color: #6c757d;
    }

    .instructor-info a {
        color: #5751e1;
        text-decoration: none;
        font-weight: 600;
        margin-left: 5px;
        transition: color 0.3s ease;
    }

    .instructor-info a:hover {
        color: #7c76ff;
    }

    .program-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
        gap: 15px;
        flex-wrap: wrap;
    }

    .program-price-section {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .program-price {
        font-size: 24px;
        font-weight: 800;
        color: #5751e1;
    }

    .program-price.free {
        color: #28a745;
    }

    .program-price-old {
        font-size: 16px;
        color: #6c757d;
        text-decoration: line-through;
        font-weight: 500;
    }

    .program-action {
        flex-shrink: 0;
    }

    .program-btn {
        display: inline-flex;
        align-items: center;
        padding: 10px 20px;
        border-radius: 25px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .add-to-cart-btn {
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        color: #ffffff;
        box-shadow: 0 4px 15px rgba(87, 81, 225, 0.3);
    }

    .add-to-cart-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(87, 81, 225, 0.4);
        color: #ffffff;
    }

    .enrolled-btn {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: #ffffff;
    }

    .enrolled-btn:hover {
        transform: translateY(-2px);
        color: #ffffff;
    }

    .booked-btn {
        background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
        color: #ffffff;
        cursor: not-allowed;
    }

    /* Enhanced Pagination */
    .pagination__wrap-enhanced {
        display: flex;
        justify-content: center;
        margin-top: 60px;
    }

    .pagination__wrap-enhanced .pagination {
        display: flex;
        gap: 8px;
        list-style: none;
        padding: 0;
        margin: 0;
        flex-wrap: wrap;
        justify-content: center;
    }

    .pagination__wrap-enhanced .pagination li a,
    .pagination__wrap-enhanced .pagination li span {
        padding: 12px 20px;
        border-radius: 10px;
        background: #ffffff;
        color: #6c757d;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 2px solid #e9ecef;
        font-weight: 600;
        min-width: 44px;
        text-align: center;
    }

    .pagination__wrap-enhanced .pagination li.active span,
    .pagination__wrap-enhanced .pagination li a:hover {
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        color: #ffffff;
        border-color: #5751e1;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(87, 81, 225, 0.3);
    }

    /* Enhanced No Programs Found */
    .no-programs-found-enhanced {
        padding: 100px 20px;
    }

    .no-programs-icon-wrapper {
        margin-bottom: 30px;
    }

    .no-programs-icon {
        width: 120px;
        height: 120px;
        margin: 0 auto;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 60px;
        color: #6c757d;
        opacity: 0.6;
    }

    .no-programs-title {
        font-size: 32px;
        font-weight: 800;
        color: #1a1f3a;
        margin-bottom: 16px;
    }

    .no-programs-text {
        font-size: 18px;
        color: #6c757d;
        margin-bottom: 30px;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    .back-home-btn {
        display: inline-flex;
        align-items: center;
        padding: 12px 30px;
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        color: #ffffff;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(87, 81, 225, 0.3);
    }

    .back-home-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(87, 81, 225, 0.4);
        color: #ffffff;
    }

    /* Responsive Design */
    @media (max-width: 1199.98px) {
        .programs-hero-title {
            font-size: 42px;
        }
        .programs-section-title {
            font-size: 32px;
        }
    }

    @media (max-width: 991.98px) {
        .programs-hero-title {
            font-size: 36px;
        }
        .programs-hero-description {
            font-size: 16px;
        }
        .program-stat-card .stat-number {
            font-size: 36px;
        }
        .programs-section-title {
            font-size: 28px;
        }
        .program-card-thumb {
            height: 200px;
        }
    }

    @media (max-width: 767.98px) {
        .programs-hero-section {
            padding: 60px 0 50px;
        }
        .programs-hero-title {
            font-size: 28px;
        }
        .programs-hero-description {
            font-size: 15px;
        }
        .program-stat-card {
            padding: 25px 20px;
        }
        .program-stat-card .stat-number {
            font-size: 32px;
        }
        .programs-statistics-section {
            padding: 60px 0;
        }
        .programs__area-enhanced {
            padding: 60px 0;
        }
        .programs-section-title {
            font-size: 24px;
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
        .title-accent {
            height: 30px;
        }
        .program-card-thumb {
            height: 180px;
        }
        .program-card-content {
            padding: 20px;
        }
        .program-title {
            font-size: 18px;
        }
        .program-card-footer {
            flex-direction: column;
            align-items: stretch;
        }
        .program-btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush
