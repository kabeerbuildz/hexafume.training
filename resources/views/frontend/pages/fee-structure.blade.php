@extends('frontend.layouts.master')
@section('meta_title', __('Fee Structure') . ' || ' . $setting->app_name)
@section('contents')
    <!-- Hero Section -->
    <section class="fee-hero-section">
        <div class="fee-hero-background-pattern"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <div class="fee-hero-content">
                        <span class="fee-hero-badge">{{ __('Transparent Pricing') }}</span>
                        <h1 class="fee-hero-title">{{ __('Fee Structure') }}</h1>
                        <p class="fee-hero-description">
                            {{ __('Our transparent and competitive fee structure ensures you get the best value for your investment in education. Choose the plan that best fits your learning goals and budget.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Fee Structure Table Section -->
    <section class="fee-structure-section section-py-120">
        <div class="container-fluid">
            <div class="fee-structure-wrapper">
                <!-- Filter Section -->
                <div class="filter-section">
                    <!-- Location Tabs -->
                    <div class="filter-group">
                        <div class="filter-label">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ __('Select Location') }}</span>
                        </div>
                        <div class="filter-tabs location-tabs">
                            @foreach($locations as $index => $location)
                            <button class="filter-tab {{ $index === 0 ? 'active' : '' }}" data-location-id="{{ $location->id }}" data-location-name="{{ $location->name }}">
                                <i class="fas fa-city"></i>
                                <span>{{ $location->name }}</span>
                            </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Duration Tabs -->
                    <div class="filter-group">
                        <div class="filter-label">
                            <i class="fas fa-clock"></i>
                            <span>{{ __('Select Duration') }}</span>
                        </div>
                        <div class="filter-tabs duration-tabs">
                            @foreach($durations as $index => $duration)
                            <button class="filter-tab {{ $index === 0 ? 'active' : '' }}" data-duration-id="{{ $duration->id }}" data-duration-name="{{ $duration->name }}" data-duration-value="{{ $duration->value }}">
                                <span>{{ $duration->name }}</span>
                            </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Dynamic Heading -->
                <div class="fee-structure-heading text-center mb-40">
                    <div class="heading-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h2 class="fee-structure-title">
                        <span class="location-name">{{ $locations->first()->name ?? __('Location') }}</span> - 
                        <span class="duration-value">{{ $durations->first()->name ?? __('Duration') }}</span>
                    </h2>
                    <p class="fee-structure-subtitle">{{ __('Complete course listing with transparent pricing') }}</p>
                </div>

                <!-- Fee Table -->
                <div class="fee-table-wrapper">
                    <div class="table-header-bar">
                        <div class="table-header-left">
                            <span id="courseCount">0</span> {{ __('Courses Available') }}
                        </div>
                        <div class="table-header-center">
                            <div class="search-box-wrapper">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" id="courseSearchInput" class="course-search-input" placeholder="{{ __('Search courses...') }}" autocomplete="off">
                                <button type="button" class="search-clear-btn" id="searchClearBtn" style="display: none;">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="table-header-right">
                            <button class="table-action-btn" title="{{ __('Download') }}">
                                <i class="fas fa-download"></i>
                            </button>
                            <button class="table-action-btn" title="{{ __('Print') }}">
                                <i class="fas fa-print"></i>
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="fee-table">
                            <thead>
                                <tr>
                                    <th>{{ __('SERIAL NO') }}</th>
                                    <th>{{ __('COURSE NAME') }}</th>
                                    <th>{{ __('COURSE FEE') }}</th>
                                    <th>{{ __('REGISTRATION FEE') }}</th>
                                </tr>
                            </thead>
                            <tbody id="feeTableBody">
                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 60px; color: #6c757d;">
                                        <div class="hexagonal-loader-wrapper">
                                            <div class="hexagonal-loader">
                                                <div class="hexagon hexagon-outer">
                                                    <div class="hexagon-inner"></div>
                                                </div>
                                                <div class="hexagon hexagon-middle">
                                                    <div class="hexagon-inner"></div>
                                                </div>
                                                <div class="hexagon hexagon-inner-core">
                                                    <div class="hexagon-inner"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="font-size: 16px; font-weight: 600; margin-top: 30px;">{{ __("Loading courses...") }}</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Fee Structure Table Section End -->

    <!-- Our Branches Section -->
    <section class="branches-section section-py-120 bg-light">
        <div class="container">
            <div class="branches-header text-center mb-60">
                <span class="branches-badge">{{ __('GLOBAL PRESENCE') }}</span>
                <h2 class="branches-title">{{ __('Our Branches') }}</h2>
                <p class="branches-subtitle">{{ __('Visit the nearest location or connect with us internationally. Each branch is designed to support your learning journey with expert mentors and modern facilities.') }}</p>
            </div>

            <div class="row g-4">
                @forelse($branches as $branch)
                <div class="col-lg-4 col-md-6">
                    <div class="branch-card">
                        <div class="branch-icon-wrapper" style="background-color: {{ $branch->icon_color ?? '#5751e1' }}20;">
                            <i class="{{ $branch->icon ?? 'fas fa-building' }}" style="color: {{ $branch->icon_color ?? '#5751e1' }};"></i>
                        </div>
                        <h3 class="branch-name">{{ $branch->name }}</h3>
                        @if($branch->tag)
                        <span class="branch-tag">{{ $branch->tag }}</span>
                        @endif
                        <p class="branch-address">{{ $branch->address }}</p>
                        @if($branch->link)
                        <a href="{{ $branch->link }}" class="branch-link">
                            <span>{{ __('Visit branch page') }}</span>
                            <i class="fas fa-arrow-up-right"></i>
                        </a>
                        @endif
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <p class="text-muted">{{ __('No branches available at the moment.') }}</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- Our Branches Section End -->

    <!-- Explore Courses by City Section -->
    <section class="city-courses-section section-py-120">
        <div class="container">
            <div class="city-courses-header text-center mb-60">
                <span class="city-courses-badge">
                    <i class="fas fa-map-marker-alt"></i>
                    {{ __('CITY LEARNING HUBS') }}
                </span>
                <h2 class="city-courses-title">{{ __('Explore Courses by City') }}</h2>
                <p class="city-courses-subtitle">{{ __('Choose your city to discover curated learning paths, expert-led sessions, and upcoming cohorts tailored to your local community.') }}</p>
            </div>

            <div class="row g-4">
                @forelse($locations as $location)
                <div class="col-lg-4 col-md-6">
                    <div class="city-card">
                        <div class="city-icon-wrapper">
                            <i class="fas fa-city"></i>
                        </div>
                        <h3 class="city-name">{{ strtoupper($location->name) }}</h3>
                        <p class="city-description">{{ __('View :city bootcamps, diplomas, and weekend workshops.', ['city' => $location->name]) }}</p>
                        <a href="{{ route('courses', ['location' => $location->slug ?? $location->id]) }}" class="city-link">
                            <span>{{ __('Explore Now') }}</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <p class="text-muted">{{ __('No cities available at the moment.') }}</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- Explore Courses by City Section End -->
@endsection

@push('styles')
<style>
    /* Hero Section */
    .fee-hero-section {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        position: relative;
        overflow: hidden;
        padding: 100px 0 80px;
        margin-top: 0;
    }

    .fee-hero-background-pattern {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: 
            radial-gradient(circle at 20% 30%, rgba(87, 81, 225, 0.05) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(124, 118, 255, 0.04) 0%, transparent 50%);
        z-index: 0;
    }

    .fee-hero-section > .container {
        position: relative;
        z-index: 1;
    }

    .fee-hero-content {
        padding: 0 20px;
    }

    .fee-hero-badge {
        display: inline-block;
        padding: 10px 24px;
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        color: #ffffff;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 24px;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 4px 15px rgba(87, 81, 225, 0.3);
    }

    .fee-hero-title {
        font-size: 52px;
        font-weight: 800;
        line-height: 1.2;
        color: #1a1f3a;
        margin-bottom: 28px;
        letter-spacing: -0.5px;
    }

    .fee-hero-description {
        font-size: 18px;
        line-height: 1.75;
        color: #5a6c7d;
        max-width: 750px;
        margin: 0 auto;
        font-weight: 400;
    }

    /* Pricing Plans Section */
    .pricing-plans-section {
        background: #ffffff;
    }

    .pricing-section-title {
        font-size: 42px;
        font-weight: 700;
        color: #1a1f3a;
        margin-bottom: 16px;
    }

    .pricing-section-subtitle {
        font-size: 18px;
        color: #6c757d;
        max-width: 600px;
        margin: 0 auto;
    }

    .pricing-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 40px 30px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .pricing-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(87, 81, 225, 0.15);
        border-color: #5751e1;
    }

    .pricing-card.featured {
        border-color: #5751e1;
        background: linear-gradient(135deg, #ffffff 0%, rgba(87, 81, 225, 0.02) 100%);
        transform: scale(1.05);
    }

    .popular-badge {
        position: absolute;
        top: -15px;
        left: 50%;
        transform: translateX(-50%);
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        color: #ffffff;
        padding: 8px 24px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 15px rgba(87, 81, 225, 0.3);
    }

    .pricing-header-card {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 30px;
        border-bottom: 2px solid #f0f0f0;
    }

    .pricing-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, rgba(87, 81, 225, 0.1) 0%, rgba(124, 118, 255, 0.1) 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 36px;
        color: #5751e1;
        transition: all 0.3s ease;
    }

    .pricing-card:hover .pricing-icon {
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        color: #ffffff;
        transform: scale(1.1);
    }

    .pricing-plan-name {
        font-size: 28px;
        font-weight: 700;
        color: #1a1f3a;
        margin-bottom: 20px;
    }

    .pricing-amount {
        display: flex;
        align-items: baseline;
        justify-content: center;
        gap: 4px;
        margin-bottom: 16px;
    }

    .currency {
        font-size: 24px;
        font-weight: 600;
        color: #5751e1;
    }

    .amount {
        font-size: 56px;
        font-weight: 800;
        color: #1a1f3a;
        line-height: 1;
    }

    .period {
        font-size: 16px;
        color: #6c757d;
        font-weight: 500;
    }

    .pricing-description {
        font-size: 15px;
        color: #6c757d;
        margin: 0;
        line-height: 1.6;
    }

    .pricing-features {
        flex: 1;
        margin-bottom: 30px;
    }

    .features-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 0;
        font-size: 15px;
        color: #1a1f3a;
    }

    .feature-item i {
        font-size: 18px;
        flex-shrink: 0;
    }

    .feature-item:not(.disabled) i {
        color: #28a745;
    }

    .feature-item.disabled {
        opacity: 0.5;
    }

    .feature-item.disabled i {
        color: #dc3545;
    }

    .pricing-footer {
        margin-top: auto;
    }

    /* Fee Structure Section */
    .fee-structure-section {
        background: #ffffff;
    }

    .fee-structure-section .container-fluid {
        max-width: 100%;
        padding-left: 40px;
        padding-right: 40px;
    }

    @media (min-width: 1400px) {
        .fee-structure-section .container-fluid {
            padding-left: 80px;
            padding-right: 80px;
        }
    }

    @media (max-width: 991.98px) {
        .fee-structure-section .container-fluid {
            padding-left: 30px;
            padding-right: 30px;
        }
    }

    @media (max-width: 767.98px) {
        .fee-structure-section .container-fluid {
            padding-left: 15px;
            padding-right: 15px;
        }
    }

    .fee-structure-wrapper {
        width: 100%;
        margin: 0 auto;
    }

    /* Filter Section */
    .filter-section {
        background: #ffffff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 40px;
    }

    .filter-group {
        margin-bottom: 30px;
    }

    .filter-group:last-child {
        margin-bottom: 0;
    }

    .filter-label {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 16px;
        font-weight: 600;
        color: #1a1f3a;
        margin-bottom: 16px;
    }

    .filter-label i {
        color: #5751e1;
    }

    .filter-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .filter-tab {
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 12px 24px;
        font-size: 14px;
        font-weight: 600;
        color: #6c757d;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .filter-tab:hover,
    .filter-tab.active {
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        color: #ffffff;
        border-color: #5751e1;
        box-shadow: 0 4px 15px rgba(87, 81, 225, 0.3);
    }

    .filter-tab i {
        font-size: 16px;
    }

    /* Fee Structure Heading */
    .fee-structure-heading {
        margin-bottom: 40px;
    }

    .heading-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, rgba(87, 81, 225, 0.1) 0%, rgba(124, 118, 255, 0.1) 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        font-size: 36px;
        color: #5751e1;
    }

    .fee-structure-title {
        font-size: 36px;
        font-weight: 700;
        color: #1a1f3a;
        margin-bottom: 12px;
    }

    .fee-structure-subtitle {
        font-size: 16px;
        color: #6c757d;
    }

    /* Table Header Bar */
    .table-header-bar {
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        color: #ffffff;
        padding: 16px 24px;
        border-radius: 12px 12px 0 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
    }

    .table-header-left {
        font-size: 16px;
        font-weight: 600;
        flex-shrink: 0;
    }

    .table-header-center {
        flex: 1;
        min-width: 250px;
        max-width: 400px;
        margin: 0 auto;
    }

    .search-box-wrapper {
        position: relative;
        width: 100%;
    }

    .search-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        font-size: 16px;
        pointer-events: none;
        z-index: 1;
    }

    .course-search-input {
        width: 100%;
        padding: 12px 45px 12px 45px;
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.95);
        color: #1a1f3a;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s ease;
        outline: none;
    }

    .course-search-input::placeholder {
        color: #6c757d;
    }

    .course-search-input:focus {
        border-color: rgba(255, 255, 255, 0.5);
        background: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .search-clear-btn {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border: none;
        color: #6c757d;
        cursor: pointer;
        padding: 4px 8px;
        border-radius: 4px;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
    }

    .search-clear-btn:hover {
        background: rgba(108, 117, 125, 0.1);
        color: #1a1f3a;
    }

    .table-header-right {
        display: flex;
        gap: 12px;
        flex-shrink: 0;
    }

    .table-action-btn {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: #ffffff;
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .table-action-btn:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    .fee-table-wrapper {
        background: #ffffff;
        border-radius: 0 0 20px 20px;
        padding: 0;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .fee-table-wrapper .table-responsive {
        padding: 0;
    }

    .fee-table {
        width: 100%;
        border-collapse: collapse;
    }

    .fee-table thead {
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        color: #ffffff;
    }

    .fee-table th {
        padding: 24px 32px;
        text-align: left;
        font-weight: 700;
        font-size: 16px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }

    .fee-table tbody tr {
        border-bottom: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .fee-table tbody tr:hover {
        background: rgba(87, 81, 225, 0.05);
    }

    .fee-table td {
        padding: 24px 32px;
        font-size: 16px;
        color: #1a1f3a;
        line-height: 1.6;
    }

    /* Hexagonal Loader */
    .hexagonal-loader-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px 0;
    }

    .hexagonal-loader {
        position: relative;
        width: 80px;
        height: 80px;
        transform-style: preserve-3d;
    }

    .hexagon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    /* Outer hexagon */
    .hexagon-outer {
        width: 80px;
        height: 80px;
        animation: hexagonRotate 2s linear infinite;
    }

    /* Middle hexagon */
    .hexagon-middle {
        width: 60px;
        height: 60px;
        animation: hexagonRotate 1.5s linear infinite reverse;
    }

    /* Inner hexagon */
    .hexagon-inner-core {
        width: 40px;
        height: 40px;
        animation: hexagonRotate 1s linear infinite;
    }

    .hexagon-inner {
        width: 100%;
        height: 100%;
        position: relative;
        clip-path: polygon(30% 0%, 70% 0%, 100% 50%, 70% 100%, 30% 100%, 0% 50%);
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        opacity: 0.9;
    }

    .hexagon-outer .hexagon-inner {
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        opacity: 0.3;
        box-shadow: 0 0 20px rgba(87, 81, 225, 0.3);
    }

    .hexagon-middle .hexagon-inner {
        background: linear-gradient(135deg, #7c76ff 0%, #5751e1 100%);
        opacity: 0.6;
        box-shadow: 0 0 15px rgba(124, 118, 255, 0.4);
    }

    .hexagon-inner-core .hexagon-inner {
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        opacity: 1;
        box-shadow: 0 0 25px rgba(87, 81, 225, 0.6), inset 0 0 20px rgba(255, 255, 255, 0.2);
        animation: hexagonPulse 1.5s ease-in-out infinite;
    }

    @keyframes hexagonRotate {
        0% {
            transform: translate(-50%, -50%) rotate(0deg);
        }
        100% {
            transform: translate(-50%, -50%) rotate(360deg);
        }
    }

    @keyframes hexagonPulse {
        0%, 100% {
            opacity: 1;
            transform: scale(1);
        }
        50% {
            opacity: 0.7;
            transform: scale(0.9);
        }
    }

    .category-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .category-info i {
        font-size: 20px;
        color: #5751e1;
    }

    .discount-badge {
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        margin-left: 8px;
    }

    /* Branches Section */
    .branches-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    }

    .branches-badge {
        display: inline-block;
        padding: 8px 20px;
        background: linear-gradient(135deg, rgba(87, 81, 225, 0.1) 0%, rgba(124, 118, 255, 0.1) 100%);
        color: #5751e1;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 20px;
    }

    .branches-title {
        font-size: 42px;
        font-weight: 700;
        color: #1a1f3a;
        margin-bottom: 16px;
    }

    .branches-subtitle {
        font-size: 18px;
        color: #6c757d;
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.7;
    }

    .branch-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .branch-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .branch-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(87, 81, 225, 0.15);
        border-color: #5751e1;
    }

    .branch-card:hover::before {
        transform: scaleX(1);
    }

    .branch-icon-wrapper {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        font-size: 28px;
        transition: all 0.3s ease;
    }

    .branch-card:hover .branch-icon-wrapper {
        transform: scale(1.1);
        box-shadow: 0 4px 15px rgba(87, 81, 225, 0.2);
    }

    .branch-name {
        font-size: 22px;
        font-weight: 700;
        color: #1a1f3a;
        margin-bottom: 12px;
    }

    .branch-tag {
        display: inline-block;
        padding: 4px 12px;
        background: linear-gradient(135deg, rgba(87, 81, 225, 0.1) 0%, rgba(124, 118, 255, 0.1) 100%);
        color: #5751e1;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 16px;
    }

    .branch-address {
        font-size: 15px;
        color: #6c757d;
        line-height: 1.6;
        margin-bottom: 20px;
        min-height: 48px;
    }

    .branch-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #5751e1;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .branch-link:hover {
        color: #7c76ff;
        gap: 12px;
    }

    .branch-link i {
        font-size: 12px;
        transition: transform 0.3s ease;
    }

    .branch-link:hover i {
        transform: translate(2px, -2px);
    }

    /* Explore Courses by City Section */
    .city-courses-section {
        background: linear-gradient(135deg, rgba(87, 81, 225, 0.02) 0%, rgba(124, 118, 255, 0.03) 50%, rgba(255, 193, 7, 0.02) 100%);
    }

    .city-courses-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 20px;
        background: linear-gradient(135deg, rgba(87, 81, 225, 0.1) 0%, rgba(124, 118, 255, 0.1) 100%);
        color: #5751e1;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 20px;
    }

    .city-courses-badge i {
        font-size: 14px;
    }

    .city-courses-title {
        font-size: 42px;
        font-weight: 700;
        color: #1a1f3a;
        margin-bottom: 16px;
    }

    .city-courses-subtitle {
        font-size: 18px;
        color: #6c757d;
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.7;
    }

    .city-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .city-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(87, 81, 225, 0.15);
        border-color: #5751e1;
    }

    .city-icon-wrapper {
        width: 80px;
        height: 80px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 24px;
        font-size: 36px;
        background: linear-gradient(135deg, rgba(87, 81, 225, 0.1) 0%, rgba(124, 118, 255, 0.1) 100%);
        transition: all 0.3s ease;
        color: #5751e1;
    }

    .city-card:hover .city-icon-wrapper {
        transform: scale(1.1) rotate(5deg);
        background: linear-gradient(135deg, rgba(87, 81, 225, 0.2) 0%, rgba(124, 118, 255, 0.2) 100%);
        box-shadow: 0 4px 15px rgba(87, 81, 225, 0.2);
    }

    .city-name {
        font-size: 24px;
        font-weight: 700;
        color: #1a1f3a;
        margin-bottom: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .city-description {
        font-size: 15px;
        color: #6c757d;
        line-height: 1.6;
        margin-bottom: 24px;
        flex-grow: 1;
    }

    .city-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #5751e1;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        padding: 8px 16px;
        border-radius: 8px;
    }

    .city-link:hover {
        color: #7c76ff;
        background: rgba(87, 81, 225, 0.1);
        gap: 12px;
    }

    .city-link i {
        font-size: 14px;
        transition: transform 0.3s ease;
    }

    .city-link:hover i {
        transform: translateX(4px);
    }

    /* Responsive Design */
    @media (max-width: 991.98px) {
        .fee-hero-title {
            font-size: 38px;
        }

        .pricing-card.featured {
            transform: scale(1);
        }

        .fee-table-wrapper {
            padding: 20px;
        }
    }

    @media (max-width: 767.98px) {
        .fee-hero-title {
            font-size: 32px;
        }

        .pricing-section-title,
        .fee-details-title {
            font-size: 28px;
        }

        .pricing-card {
            padding: 30px 20px;
        }

        .amount {
            font-size: 48px;
        }

        .fee-table {
            font-size: 14px;
        }

        .fee-table th,
        .fee-table td {
            padding: 14px 16px;
        }

        .fee-structure-section .container-fluid {
            padding-left: 15px;
            padding-right: 15px;
        }

        /* Responsive loader */
        .hexagonal-loader {
            width: 60px;
            height: 60px;
        }

        .hexagon-outer {
            width: 60px;
            height: 60px;
        }

        .hexagon-middle {
            width: 45px;
            height: 45px;
        }

        .hexagon-inner-core {
            width: 30px;
            height: 30px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        let currentLocationId = null;
        let currentDurationId = null;
        let allCoursesData = []; // Store all loaded courses for search
        let searchTimeout = null;

        // Get initial location and duration IDs
        const initialLocationTab = $('.location-tabs .filter-tab.active').first();
        const initialDurationTab = $('.duration-tabs .filter-tab.active').first();
        
        if (initialLocationTab.length && initialDurationTab.length) {
            currentLocationId = initialLocationTab.data('location-id');
            currentDurationId = initialDurationTab.data('duration-id');
            
            // Load data on page load
            loadFeeStructureData(currentLocationId, currentDurationId);
        }

        // Search functionality
        $('#courseSearchInput').on('input', function() {
            const searchTerm = $(this).val().toLowerCase().trim();
            
            // Show/hide clear button
            if (searchTerm.length > 0) {
                $('#searchClearBtn').show();
            } else {
                $('#searchClearBtn').hide();
            }

            // Debounce search
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                filterCoursesBySearch(searchTerm);
            }, 300);
        });

        // Clear search
        $('#searchClearBtn').on('click', function() {
            $('#courseSearchInput').val('');
            $(this).hide();
            filterCoursesBySearch('');
        });

        // Function to filter courses by search term
        function filterCoursesBySearch(searchTerm) {
            if (searchTerm === '') {
                // Show all courses
                displayCourses(allCoursesData);
                return;
            }

            // Filter courses
            const filteredCourses = allCoursesData.filter(function(course) {
                return course.name.toLowerCase().includes(searchTerm);
            });

            // Display filtered courses
            displayCourses(filteredCourses);
        }

        // Function to display courses in table
        function displayCourses(courses) {
            if (courses.length > 0) {
                // Update course count
                $('#courseCount').text(courses.length);

                // Build table rows
                let tableRows = '';
                courses.forEach(function(course) {
                    tableRows += `
                        <tr>
                            <td>${course.serial}</td>
                            <td>${course.name}</td>
                            <td>${formatCurrency(course.fee)}</td>
                            <td>${formatCurrency(course.regFee)}</td>
                        </tr>
                    `;
                });

                $('#feeTableBody').html(tableRows);
            } else {
                // No courses found
                $('#feeTableBody').html(`
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 60px; color: #6c757d;">
                            <i class="fas fa-search" style="font-size: 48px; margin-bottom: 20px; display: block; color: #dee2e6;"></i>
                            <div style="font-size: 16px; font-weight: 600;">{{ __("No courses found matching your search.") }}</div>
                        </td>
                    </tr>
                `);
                $('#courseCount').text('0');
            }
        }

        // Handle location tab clicks
        $('.location-tabs .filter-tab').on('click', function() {
            $('.location-tabs .filter-tab').removeClass('active');
            $(this).addClass('active');
            
            currentLocationId = $(this).data('location-id');
            const locationName = $(this).data('location-name');
            
            // Update heading
            $('.location-name').text(locationName);
            
            // Load data if duration is also selected
            if (currentDurationId) {
                loadFeeStructureData(currentLocationId, currentDurationId);
            }
        });

        // Handle duration tab clicks
        $('.duration-tabs .filter-tab').on('click', function() {
            $('.duration-tabs .filter-tab').removeClass('active');
            $(this).addClass('active');
            
            currentDurationId = $(this).data('duration-id');
            const durationName = $(this).data('duration-name');
            
            // Update heading
            $('.duration-value').text(durationName);
            
            // Load data if location is also selected
            if (currentLocationId) {
                loadFeeStructureData(currentLocationId, currentDurationId);
            }
        });

        // Function to load fee structure data
        function loadFeeStructureData(locationId, durationId) {
            if (!locationId || !durationId) {
                return;
            }

            // Show loading state
            $('#feeTableBody').html(`
                <tr>
                    <td colspan="4" style="text-align: center; padding: 60px; color: #6c757d;">
                        <div class="hexagonal-loader-wrapper">
                            <div class="hexagonal-loader">
                                <div class="hexagon hexagon-outer">
                                    <div class="hexagon-inner"></div>
                                </div>
                                <div class="hexagon hexagon-middle">
                                    <div class="hexagon-inner"></div>
                                </div>
                                <div class="hexagon hexagon-inner-core">
                                    <div class="hexagon-inner"></div>
                                </div>
                            </div>
                        </div>
                        <div style="font-size: 16px; font-weight: 600; margin-top: 30px;">{{ __("Loading courses...") }}</div>
                    </td>
                </tr>
            `);
            $('#courseCount').text('0');

            // Make AJAX request
            $.ajax({
                url: '{{ route("fee-structure.data") }}',
                method: 'GET',
                data: {
                    location_id: locationId,
                    duration_id: durationId
                },
                success: function(response) {
                    if (response.success && response.courses && response.courses.length > 0) {
                        // Store all courses for search functionality
                        allCoursesData = response.courses;
                        
                        // Clear search input when new data is loaded
                        $('#courseSearchInput').val('');
                        $('#searchClearBtn').hide();
                        
                        // Display all courses
                        displayCourses(allCoursesData);
                    } else {
                        // Clear stored courses
                        allCoursesData = [];
                        $('#courseSearchInput').val('');
                        $('#searchClearBtn').hide();
                        
                        // No courses found
                        $('#feeTableBody').html(`
                            <tr>
                                <td colspan="4" style="text-align: center; padding: 60px; color: #6c757d;">
                                    <i class="fas fa-inbox" style="font-size: 48px; margin-bottom: 20px; display: block; color: #dee2e6;"></i>
                                    <div style="font-size: 16px; font-weight: 600;">{{ __("No courses available for this selection.") }}</div>
                                </td>
                            </tr>
                        `);
                        $('#courseCount').text('0');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error loading fee structure data:', error);
                    $('#feeTableBody').html(`
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 60px; color: #dc3545;">
                                <i class="fas fa-exclamation-triangle" style="font-size: 48px; margin-bottom: 20px; display: block;"></i>
                                <div style="font-size: 16px; font-weight: 600;">{{ __("Error loading courses. Please try again.") }}</div>
                            </td>
                        </tr>
                    `);
                    $('#courseCount').text('0');
                }
            });
        }

        // Function to format currency
        function formatCurrency(amount) {
            if (amount == 0 || amount == null) {
                return '{{ __("Free") }}';
            }
            // Get currency from session or use default
            const currencyIcon = '{{ session("currency_icon", "Rs") }}';
            const currencyPosition = '{{ session("currency_position", "before") }}';
            
            const formattedAmount = parseFloat(amount).toLocaleString('en-US', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 2
            });

            if (currencyPosition === 'before') {
                return currencyIcon + ' ' + formattedAmount;
            } else {
                return formattedAmount + ' ' + currencyIcon;
            }
        }

        // Print functionality
        $('.table-action-btn[title="{{ __("Print") }}"]').on('click', function() {
            window.print();
        });

        // Download functionality - CSV Export
        $('.table-action-btn[title="{{ __("Download") }}"]').on('click', function() {
            if (!currentLocationId || !currentDurationId) {
                alert('{{ __("Please select location and duration first.") }}');
                return;
            }

            // Create download URL with current filters
            const downloadUrl = '{{ route("fee-structure.download") }}?location_id=' + currentLocationId + '&duration_id=' + currentDurationId;
            
            // Trigger download
            window.location.href = downloadUrl;
        });
    });
</script>
@endpush




