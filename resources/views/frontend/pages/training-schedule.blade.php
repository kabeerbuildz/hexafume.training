@extends('frontend.layouts.master')
@section('meta_title', __('Training Schedule') . ' || ' . $setting->app_name)
@section('contents')
    <!-- Hero Section -->
    <section class="training-hero-section">
        <div class="training-hero-background-pattern"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <div class="training-hero-content">
                        <span class="training-hero-badge">{{ __('Plan Your Learning') }}</span>
                        <h1 class="training-hero-title">{{ __('Training Schedule') }}</h1>
                        <p class="training-hero-description">
                            {{ __('View our comprehensive training schedule to plan your learning journey. All sessions are designed to fit your busy schedule while ensuring maximum learning outcomes.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Schedule Section -->
    <section class="schedule-section section-py-120">
        <div class="container">
            <div class="schedule-header text-center mb-60">
                <h2 class="schedule-section-title">{{ __('Upcoming Training Sessions') }}</h2>
                <p class="schedule-section-subtitle">{{ __('Browse through our scheduled training programs and find the perfect time slot for you') }}</p>
            </div>

            <div class="schedule-filters mb-4">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="filter-tabs">
                            <button class="filter-tab active" data-filter="all">{{ __('All Sessions') }}</button>
                            <button class="filter-tab" data-filter="upcoming">{{ __('Upcoming') }}</button>
                            <button class="filter-tab" data-filter="ongoing">{{ __('Ongoing') }}</button>
                            <button class="filter-tab" data-filter="completed">{{ __('Completed') }}</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="schedule-timeline">
                @for($i = 1; $i <= 6; $i++)
                <div class="schedule-item" data-status="{{ $i <= 2 ? 'upcoming' : ($i <= 4 ? 'ongoing' : 'completed') }}">
                    <div class="schedule-item-card">
                        <div class="schedule-date-badge">
                            <div class="date-day">{{ date('d', strtotime("+$i days")) }}</div>
                            <div class="date-month">{{ date('M', strtotime("+$i days")) }}</div>
                        </div>
                        <div class="schedule-content">
                            <div class="schedule-header-info">
                                <span class="schedule-status status-{{ $i <= 2 ? 'upcoming' : ($i <= 4 ? 'ongoing' : 'completed') }}">
                                    {{ $i <= 2 ? __('Upcoming') : ($i <= 4 ? __('Ongoing') : __('Completed')) }}
                                </span>
                                <span class="schedule-time">
                                    <i class="fas fa-clock"></i>
                                    {{ date('h:i A', strtotime("+$i hours")) }} - {{ date('h:i A', strtotime("+$i hours +2 hours")) }}
                                </span>
                            </div>
                            <h3 class="schedule-title">{{ __('Advanced Web Development') }} - {{ __('Session') }} {{ $i }}</h3>
                            <p class="schedule-description">
                                {{ __('Comprehensive training on modern web development technologies including React, Node.js, and database management.') }}
                            </p>
                            <div class="schedule-meta">
                                <div class="meta-item">
                                    <i class="fas fa-user"></i>
                                    <span>{{ __('Instructor') }}: {{ __('John Doe') }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-users"></i>
                                    <span>{{ __('Enrolled') }}: {{ 15 + $i * 2 }}/30</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ __('Online') }} / {{ __('Classroom') }}</span>
                                </div>
                            </div>
                            <div class="schedule-actions">
                                <a href="javascript:;" class="btn btn-primary btn-sm">{{ __('View Details') }}</a>
                                @if($i <= 2)
                                <a href="javascript:;" class="btn btn-outline-primary btn-sm">{{ __('Enroll Now') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </section>
    <!-- Schedule Section End -->

    <!-- Calendar View Section -->
    <section class="calendar-section section-py-120 bg-light">
        <div class="container">
            <div class="calendar-header text-center mb-60">
                <h2 class="calendar-section-title">{{ __('Monthly Calendar View') }}</h2>
                <p class="calendar-section-subtitle">{{ __('Get a quick overview of all training sessions in a calendar format') }}</p>
            </div>

            <div class="calendar-wrapper">
                <div class="calendar-month-header">
                    <button class="calendar-nav-btn prev-month">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <h3 class="calendar-month-title">{{ date('F Y') }}</h3>
                    <button class="calendar-nav-btn next-month">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
                <div class="calendar-grid">
                    <div class="calendar-weekdays">
                        <div class="weekday">{{ __('Sun') }}</div>
                        <div class="weekday">{{ __('Mon') }}</div>
                        <div class="weekday">{{ __('Tue') }}</div>
                        <div class="weekday">{{ __('Wed') }}</div>
                        <div class="weekday">{{ __('Thu') }}</div>
                        <div class="weekday">{{ __('Fri') }}</div>
                        <div class="weekday">{{ __('Sat') }}</div>
                    </div>
                    <div class="calendar-days">
                        @php
                            $firstDay = date('w', strtotime(date('Y-m-01')));
                            $daysInMonth = date('t');
                            $currentDay = 1;
                        @endphp
                        @for($i = 0; $i < 42; $i++)
                            @if($i < $firstDay || $currentDay > $daysInMonth)
                                <div class="calendar-day empty"></div>
                            @else
                                <div class="calendar-day {{ $currentDay == date('d') ? 'today' : '' }} {{ in_array($currentDay, [5, 12, 19, 26]) ? 'has-session' : '' }}">
                                    <span class="day-number">{{ $currentDay }}</span>
                                    @if(in_array($currentDay, [5, 12, 19, 26]))
                                        <span class="session-indicator"></span>
                                    @endif
                                </div>
                                @php $currentDay++; @endphp
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Calendar View Section End -->
@endsection

@push('styles')
<style>
    /* Hero Section */
    .training-hero-section {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        position: relative;
        overflow: hidden;
        padding: 100px 0 80px;
        margin-top: 0;
    }

    .training-hero-background-pattern {
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

    .training-hero-section > .container {
        position: relative;
        z-index: 1;
    }

    .training-hero-content {
        padding: 0 20px;
    }

    .training-hero-badge {
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

    .training-hero-title {
        font-size: 52px;
        font-weight: 800;
        line-height: 1.2;
        color: #1a1f3a;
        margin-bottom: 28px;
        letter-spacing: -0.5px;
    }

    .training-hero-description {
        font-size: 18px;
        line-height: 1.75;
        color: #5a6c7d;
        max-width: 750px;
        margin: 0 auto;
        font-weight: 400;
    }

    /* Schedule Section */
    .schedule-section {
        background: #ffffff;
    }

    .schedule-section-title {
        font-size: 42px;
        font-weight: 700;
        color: #1a1f3a;
        margin-bottom: 16px;
    }

    .schedule-section-subtitle {
        font-size: 18px;
        color: #6c757d;
        max-width: 600px;
        margin: 0 auto;
    }

    .filter-tabs {
        display: flex;
        gap: 12px;
        justify-content: center;
        flex-wrap: wrap;
        background: #f8f9fa;
        padding: 8px;
        border-radius: 50px;
    }

    .filter-tab {
        padding: 12px 24px;
        border: none;
        background: transparent;
        color: #6c757d;
        font-weight: 600;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 14px;
    }

    .filter-tab:hover,
    .filter-tab.active {
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        color: #ffffff;
        box-shadow: 0 4px 15px rgba(87, 81, 225, 0.3);
    }

    .schedule-timeline {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .schedule-item-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e9ecef;
        display: flex;
        gap: 24px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .schedule-item-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
    }

    .schedule-item-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(87, 81, 225, 0.15);
        border-color: #5751e1;
    }

    .schedule-date-badge {
        flex-shrink: 0;
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        border-radius: 16px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        text-align: center;
    }

    .date-day {
        font-size: 32px;
        font-weight: 700;
        line-height: 1;
    }

    .date-month {
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        margin-top: 4px;
    }

    .schedule-content {
        flex: 1;
    }

    .schedule-header-info {
        display: flex;
        gap: 16px;
        align-items: center;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }

    .schedule-status {
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-upcoming {
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
    }

    .status-ongoing {
        background: rgba(255, 193, 7, 0.1);
        color: #ffc107;
    }

    .status-completed {
        background: rgba(108, 117, 125, 0.1);
        color: #6c757d;
    }

    .schedule-time {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #6c757d;
        font-size: 14px;
        font-weight: 500;
    }

    .schedule-time i {
        color: #5751e1;
    }

    .schedule-title {
        font-size: 24px;
        font-weight: 700;
        color: #1a1f3a;
        margin-bottom: 12px;
    }

    .schedule-description {
        font-size: 15px;
        line-height: 1.7;
        color: #6c757d;
        margin-bottom: 20px;
    }

    .schedule-meta {
        display: flex;
        gap: 24px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #6c757d;
        font-size: 14px;
    }

    .meta-item i {
        color: #5751e1;
        font-size: 16px;
    }

    .schedule-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    /* Calendar Section */
    .calendar-section {
        background: #f8f9fa;
    }

    .calendar-section-title {
        font-size: 42px;
        font-weight: 700;
        color: #1a1f3a;
        margin-bottom: 16px;
    }

    .calendar-section-subtitle {
        font-size: 18px;
        color: #6c757d;
        max-width: 600px;
        margin: 0 auto;
    }

    .calendar-wrapper {
        background: #ffffff;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    }

    .calendar-month-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #e9ecef;
    }

    .calendar-nav-btn {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        border: 2px solid #e9ecef;
        background: #ffffff;
        color: #5751e1;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .calendar-nav-btn:hover {
        background: #5751e1;
        color: #ffffff;
        border-color: #5751e1;
        transform: scale(1.1);
    }

    .calendar-month-title {
        font-size: 28px;
        font-weight: 700;
        color: #1a1f3a;
        margin: 0;
    }

    .calendar-weekdays {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 8px;
        margin-bottom: 12px;
    }

    .weekday {
        text-align: center;
        font-weight: 600;
        color: #5751e1;
        font-size: 14px;
        padding: 12px;
    }

    .calendar-days {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 8px;
    }

    .calendar-day {
        aspect-ratio: 1;
        background: #f8f9fa;
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        padding: 8px;
    }

    .calendar-day.empty {
        background: transparent;
        cursor: default;
    }

    .calendar-day.today {
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        color: #ffffff;
        font-weight: 700;
    }

    .calendar-day.has-session {
        border: 2px solid #5751e1;
        background: rgba(87, 81, 225, 0.05);
    }

    .calendar-day:hover:not(.empty) {
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(87, 81, 225, 0.2);
    }

    .day-number {
        font-size: 16px;
        font-weight: 600;
    }

    .session-indicator {
        width: 6px;
        height: 6px;
        background: #5751e1;
        border-radius: 50%;
        margin-top: 4px;
    }

    .calendar-day.today .session-indicator {
        background: #ffffff;
    }

    /* Responsive Design */
    @media (max-width: 991.98px) {
        .training-hero-title {
            font-size: 38px;
        }

        .schedule-item-card {
            flex-direction: column;
        }

        .schedule-date-badge {
            width: 80px;
            height: 80px;
        }

        .calendar-wrapper {
            padding: 30px 20px;
        }
    }

    @media (max-width: 767.98px) {
        .training-hero-title {
            font-size: 32px;
        }

        .schedule-section-title,
        .calendar-section-title {
            font-size: 28px;
        }

        .schedule-meta {
            flex-direction: column;
            gap: 12px;
        }

        .calendar-wrapper {
            padding: 20px 15px;
        }

        .weekday,
        .day-number {
            font-size: 12px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter functionality
        const filterTabs = document.querySelectorAll('.filter-tab');
        const scheduleItems = document.querySelectorAll('.schedule-item');

        filterTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs
                filterTabs.forEach(t => t.classList.remove('active'));
                // Add active class to clicked tab
                this.classList.add('active');

                const filter = this.getAttribute('data-filter');

                scheduleItems.forEach(item => {
                    if (filter === 'all' || item.getAttribute('data-status') === filter) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
@endpush













