<section class="courses-area section-pt-120 section-pb-90"
    data-background="{{ asset('frontend/img/bg/courses_bg.jpg') }}">
    <div class="container">
        <div class="section__title-wrap">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <div class="section__title text-center mb-40">
                        <span class="sub-title">{{ __('Top Class Courses') }}</span>
                        <h2 class="title">{{ __('Explore Our Worlds Featured Courses') }}</h2>
                        <p class="desc">{{ __('Check out the most demanding courses right now') }}</p>
                    </div>
                    <div class="courses__nav">
                        <ul class="nav nav-tabs" id="courseTab" role="tablist">
                            @php
                                // Use pre-loaded course data from controller (optimized)
                                $allCourses = $courseData['allCourses'] ?? collect([]);
                            @endphp
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="all-tab" data-bs-toggle="tab"
                                    data-bs-target="#all-tab-pane" type="button" role="tab"
                                    aria-controls="all-tab-pane" aria-selected="true">
                                    {{ __('All Courses') }}
                                </button>
                            </li>
                            <!-- @if ($featuredCourse?->category_one_status == 1)
                                <li class="nav-item" role="presentation">
                                    @php
                                        // Use pre-loaded course data from controller (optimized)
                                        $categoryOne = $courseData['categoryOne'] ?? null;
                                        $categoryOneCourses = $courseData['categoryOneCourses'] ?? collect([]);
                                    @endphp
                                    <button class="nav-link" id="design-tab" data-bs-toggle="tab"
                                        data-bs-target="#design-tab-pane" type="button" role="tab"
                                        aria-controls="design-tab-pane" aria-selected="false">
                                        {{ $categoryOne?->name }}
                                    </button>
                                </li>
                            @endif
                            @if ($featuredCourse?->category_two_status == 1)
                                <li class="nav-item" role="presentation">
                                    @php
                                        // Use pre-loaded course data from controller (optimized)
                                        $categoryTwo = $courseData['categoryTwo'] ?? null;
                                        $categoryTwoCourses = $courseData['categoryTwoCourses'] ?? collect([]);
                                    @endphp

                                    <button class="nav-link" id="business-tab" data-bs-toggle="tab"
                                        data-bs-target="#business-tab-pane" type="button" role="tab"
                                        aria-controls="business-tab-pane" aria-selected="false">
                                        {{ $categoryTwo?->name }}
                                    </button>
                                </li>
                            @endif

                            @if ($featuredCourse?->category_three_status == 1)
                                <li class="nav-item" role="presentation">
                                    @php
                                        // Use pre-loaded course data from controller (optimized)
                                        $categoryThree = $courseData['categoryThree'] ?? null;
                                        $categoryThreeCourses = $courseData['categoryThreeCourses'] ?? collect([]);
                                    @endphp
                                    <button class="nav-link" id="development-tab" data-bs-toggle="tab"
                                        data-bs-target="#development-tab-pane" type="button" role="tab"
                                        aria-controls="development-tab-pane" aria-selected="false">
                                        {{ $categoryThree?->name }}
                                    </button>
                                </li>
                            @endif

                            @if ($featuredCourse?->category_four_status == 1)
                                <li class="nav-item" role="presentation">
                                    @php
                                        // Use pre-loaded course data from controller (optimized)
                                        $categoryFour = $courseData['categoryFour'] ?? null;
                                        $categoryFourCourses = $courseData['categoryFourCourses'] ?? collect([]);
                                    @endphp
                                    <button class="nav-link" id="categoryFour-tab" data-bs-toggle="tab"
                                        data-bs-target="#categoryFour-tab-pane" type="button" role="tab"
                                        aria-controls="categoryFour-tab-pane" aria-selected="false">
                                        {{ $categoryFour?->name }}
                                    </button>
                                </li>
                            @endif

                            @if ($featuredCourse?->category_five_status == 1)
                                <li class="nav-item" role="presentation">
                                    @php
                                        // Use pre-loaded course data from controller (optimized)
                                        $categoryFive = $courseData['categoryFive'] ?? null;
                                        $categoryFiveCourses = $courseData['categoryFiveCourses'] ?? collect([]);
                                    @endphp
                                    <button class="nav-link" id="development-tab" data-bs-toggle="tab"
                                        data-bs-target="#categoryFive-tab-pane" type="button" role="tab"
                                        aria-controls="development-tab-pane" aria-selected="false">
                                        {{ $categoryFive?->name }}
                                    </button>
                                </li>
                            @endif -->

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-content" id="courseTabContent">
            <div class="tab-pane fade show active" id="all-tab-pane" role="tabpanel" aria-labelledby="all-tab"
                tabindex="0">
                <div class="swiper courses-swiper-active">
                    <div class="swiper-wrapper">
                        @if(isset($allCourses) && $allCourses->count() > 0)
                            @foreach ($allCourses as $course)
                            <div class="swiper-slide">
                                <div class="courses__item shine__animate-item">
                                    <div class="courses__item-thumb">
                                        <a href="{{ route('course.show', $course->slug) }}"
                                            class="shine__animate-link">
                                            <img src="{{ asset($course->thumbnail) }}" alt="img">
                                        </a>
                                        <a href="javascript:;" class="wsus-wishlist-btn common-white courses__wishlist-two"  aria-label="WishList"
                                            data-slug="{{ $course?->slug }}">
                                            <i class="{{ $course?->favorite_by_client ? 'fas' : 'far' }} fa-heart"></i>
                                        </a>
                                    </div>
                                    <div class="courses__item-content">
                                        <ul class="courses__item-meta list-wrap">
                                            <li class="courses__item-tag">
                                                <a
                                                    href="{{ route('courses', ['category' => $course->category?->id ?? 0]) }}">{{ $course->category?->translation?->name ?? __('Uncategorized') }}</a>
                                            </li>
                                            <li class="avg-rating"><i class="fas fa-star"></i>
                                                {{ number_format($course->avg_rating, 1) ?? 0 }}
                                            </li>
                                        </ul>
                                        <h3 class="title"><a
                                                href="{{ route('course.show', $course->slug) }}">{{ truncate($course->title, 50) }}</a>
                                        </h3>
                                        <p class="author">{{ __('By') }} 
                                            @if($course->instructor && $course->instructor->id)
                                                <a href="{{ route('instructor-details', ['id' => $course->instructor->id, 'slug' => Str::slug($course->instructor->name ?? 'instructor')]) }}">{{ $course->instructor->name ?? __('Unknown Instructor') }}</a>
                                            @else
                                                <span>{{ __('Unknown Instructor') }}</span>
                                            @endif
                                        </p>
                                        <div class="courses__item-bottom">
                                            @auth('web')
                                                @if(userAuth()->role === 'instructor')
                                                    <div class="button">
                                                        <a href="{{ route('instructor.dashboard') }}" class="">
                                                            <span class="text">{{ __('Go to Dashboard') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @elseif (in_array($course->id, session('enrollments') ?? []))
                                                    <div class="button">
                                                        <a href="{{ route('student.enrolled-courses') }}"
                                                            class="already-enrolled-btn" data-id="">
                                                            <span class="text">{{ __('Enrolled') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @elseif ($course->enrollments_count >= $course->capacity && $course->capacity != null)
                                                    <div class="button">
                                                        <a href="javascript:;" class=""
                                                            data-id="{{ $course->id }}">
                                                            <span class="text">{{ __('Booked') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="button">
                                                        <a href="javascript:;" class="add-to-cart"
                                                            data-id="{{ $course->id }}">
                                                            <span class="text">{{ __('Add To Cart') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            @else
                                                @if ($course->enrollments_count >= $course->capacity && $course->capacity != null)
                                                    <div class="button">
                                                        <a href="javascript:;" class=""
                                                            data-id="{{ $course->id }}">
                                                            <span class="text">{{ __('Booked') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="button">
                                                        <a href="javascript:;" class="add-to-cart"
                                                            data-id="{{ $course->id }}">
                                                            <span class="text">{{ __('Add To Cart') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            @endauth

                                            @php
                                                $feeStructures = $course->courseFeeStructures ?? collect([]);
                                                $minFee = $feeStructures->min('course_fee');
                                                $maxFee = $feeStructures->max('course_fee');
                                            @endphp
                                            @if($feeStructures->count() > 0 && $minFee !== null)
                                                @if($minFee == 0)
                                                    <h4 class="price">{{ __('Free') }}</h4>
                                                @elseif($minFee == $maxFee)
                                                    <h4 class="price">{{ currency($minFee) }}</h4>
                                                @else
                                                    <h4 class="price">{{ currency($minFee) }} - {{ currency($maxFee) }}</h4>
                                                @endif
                                            @else
                                                <h4 class="price">{{ __('Contact for Price') }}</h4>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="col-12 text-center py-5">
                                <p>{{ __('No courses available at the moment.') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="courses__nav">
                    <div class="courses-button-prev"><i class="flaticon-arrow-right"></i></div>
                    <div class="courses-button-next"><i class="flaticon-arrow-right"></i></div>
                </div>
            </div>

            <!-- <div class="tab-pane fade" id="design-tab-pane" role="tabpanel" aria-labelledby="design-tab-pane"
                tabindex="0">
                <div class="swiper courses-swiper-active">
                    <div class="swiper-wrapper">
                        @foreach ($categoryOneCourses ?? [] as $course)
                            <div class="swiper-slide">
                                <div class="courses__item shine__animate-item">
                                    <div class="courses__item-thumb">
                                        <a href="{{ route('course.show', $course->slug) }}"
                                            class="shine__animate-link">
                                            <img src="{{ asset($course->thumbnail) }}" alt="img">
                                        </a>
                                        <a href="javascript:;" class="wsus-wishlist-btn common-white courses__wishlist-two"  aria-label="WishList"
                                            data-slug="{{ $course?->slug }}">
                                            <i class="{{ $course?->favorite_by_client ? 'fas' : 'far' }} fa-heart"></i>
                                        </a>
                                    </div>
                                    <div class="courses__item-content">
                                        <ul class="courses__item-meta list-wrap">
                                            <li class="courses__item-tag">
                                                <a
                                                    href="{{ route('courses', ['category' => $course->category?->id ?? 0]) }}">{{ $course->category?->translation?->name ?? __('Uncategorized') }}</a>
                                            </li>
                                            <li class="avg-rating"><i class="fas fa-star"></i>
                                                {{ number_format($course->avg_rating, 1) ?? 0 }}
                                            </li>
                                        </ul>
                                        <h3 class="title"><a
                                                href="{{ route('course.show', $course->slug) }}">{{ truncate($course->title, 50) }}</a>
                                        </h3>
                                        <p class="author">{{ __('By') }} 
                                            @if($course->instructor && $course->instructor->id)
                                                <a href="{{ route('instructor-details', ['id' => $course->instructor->id, 'slug' => Str::slug($course->instructor->name ?? 'instructor')]) }}">{{ $course->instructor->name ?? __('Unknown Instructor') }}</a>
                                            @else
                                                <span>{{ __('Unknown Instructor') }}</span>
                                            @endif
                                        </p>
                                        <div class="courses__item-bottom">
                                            @auth('web')
                                                @if(userAuth()->role === 'instructor')
                                                    <div class="button">
                                                        <a href="{{ route('instructor.dashboard') }}" class="">
                                                            <span class="text">{{ __('Go to Dashboard') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @elseif (in_array($course->id, session('enrollments') ?? []))
                                                    <div class="button">
                                                        <a href="{{ route('student.enrolled-courses') }}"
                                                            class="already-enrolled-btn" data-id="">
                                                            <span class="text">{{ __('Enrolled') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @elseif ($course->enrollments_count >= $course->capacity && $course->capacity != null)
                                                    <div class="button">
                                                        <a href="javascript:;" class=""
                                                            data-id="{{ $course->id }}">
                                                            <span class="text">{{ __('Booked') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="button">
                                                        <a href="javascript:;" class="add-to-cart"
                                                            data-id="{{ $course->id }}">
                                                            <span class="text">{{ __('Add To Cart') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            @else
                                                @if ($course->enrollments_count >= $course->capacity && $course->capacity != null)
                                                    <div class="button">
                                                        <a href="javascript:;" class=""
                                                            data-id="{{ $course->id }}">
                                                            <span class="text">{{ __('Booked') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="button">
                                                        <a href="javascript:;" class="add-to-cart"
                                                            data-id="{{ $course->id }}">
                                                            <span class="text">{{ __('Add To Cart') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            @endauth
                                            @php
                                                $feeStructures = $course->courseFeeStructures ?? collect([]);
                                                $minFee = $feeStructures->min('course_fee');
                                                $maxFee = $feeStructures->max('course_fee');
                                            @endphp
                                            @if($feeStructures->count() > 0 && $minFee !== null)
                                                @if($minFee == 0)
                                                    <h4 class="price">{{ __('Free') }}</h4>
                                                @elseif($minFee == $maxFee)
                                                    <h4 class="price">{{ currency($minFee) }}</h4>
                                                @else
                                                    <h4 class="price">{{ currency($minFee) }} - {{ currency($maxFee) }}</h4>
                                                @endif
                                            @else
                                                <h4 class="price">{{ __('Contact for Price') }}</h4>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="courses__nav">
                    <div class="courses-button-prev"><i class="flaticon-arrow-right"></i></div>
                    <div class="courses-button-next"><i class="flaticon-arrow-right"></i></div>
                </div>
            </div> -->

            <!-- <div class="tab-pane fade" id="business-tab-pane" role="tabpanel" aria-labelledby="business-tab-pane"
                tabindex="0">
                <div class="swiper courses-swiper-active">
                    <div class="swiper-wrapper">
                        @foreach ($categoryTwoCourses ?? [] as $course)

                            <div class="swiper-slide">
                                <div class="courses__item shine__animate-item">
                                    <div class="courses__item-thumb">
                                        <a href="{{ route('course.show', $course->slug) }}"
                                            class="shine__animate-link">
                                            <img src="{{ asset($course->thumbnail) }}" alt="img">
                                        </a>
                                        <a href="javascript:;" class="wsus-wishlist-btn common-white courses__wishlist-two"  aria-label="WishList"
                                            data-slug="{{ $course?->slug }}">
                                            <i class="{{ $course?->favorite_by_client ? 'fas' : 'far' }} fa-heart"></i>
                                        </a>
                                    </div>
                                    <div class="courses__item-content">
                                        <ul class="courses__item-meta list-wrap">
                                            <li class="courses__item-tag">
                                                <a
                                                    href="{{ route('courses', ['category' => $course->category?->id ?? 0]) }}">{{ $course->category?->translation?->name ?? __('Uncategorized') }}</a>
                                            </li>
                                            <li class="avg-rating"><i class="fas fa-star"></i>
                                                {{ number_format($course->avg_rating, 1) ?? 0 }}
                                            </li>
                                        </ul>
                                        <h3 class="title"><a
                                                href="{{ route('course.show', $course->slug) }}">{{ truncate($course->title, 50) }}</a>
                                        </h3>
                                        <p class="author">{{ __('By') }} 
                                            @if($course->instructor && $course->instructor->id)
                                                <a href="{{ route('instructor-details', ['id' => $course->instructor->id, 'slug' => Str::slug($course->instructor->name ?? 'instructor')]) }}">{{ $course->instructor->name ?? __('Unknown Instructor') }}</a>
                                            @else
                                                <span>{{ __('Unknown Instructor') }}</span>
                                            @endif
                                        </p>
                                        <div class="courses__item-bottom">
                                            @auth('web')
                                                @if(userAuth()->role === 'instructor')
                                                    <div class="button">
                                                        <a href="{{ route('instructor.dashboard') }}" class="">
                                                            <span class="text">{{ __('Go to Dashboard') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @elseif (in_array($course->id, session('enrollments') ?? []))
                                                    <div class="button">
                                                        <a href="{{ route('student.enrolled-courses') }}"
                                                            class="already-enrolled-btn" data-id="">
                                                            <span class="text">{{ __('Enrolled') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @elseif ($course->enrollments_count >= $course->capacity && $course->capacity != null)
                                                    <div class="button">
                                                        <a href="javascript:;" class=""
                                                            data-id="{{ $course->id }}">
                                                            <span class="text">{{ __('Booked') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="button">
                                                        <a href="javascript:;" class="add-to-cart"
                                                            data-id="{{ $course->id }}">
                                                            <span class="text">{{ __('Add To Cart') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            @else
                                                @if ($course->enrollments_count >= $course->capacity && $course->capacity != null)
                                                    <div class="button">
                                                        <a href="javascript:;" class=""
                                                            data-id="{{ $course->id }}">
                                                            <span class="text">{{ __('Booked') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="button">
                                                        <a href="javascript:;" class="add-to-cart"
                                                            data-id="{{ $course->id }}">
                                                            <span class="text">{{ __('Add To Cart') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            @endauth
                                            @php
                                                $feeStructures = $course->courseFeeStructures ?? collect([]);
                                                $minFee = $feeStructures->min('course_fee');
                                                $maxFee = $feeStructures->max('course_fee');
                                            @endphp
                                            @if($feeStructures->count() > 0 && $minFee !== null)
                                                @if($minFee == 0)
                                                    <h4 class="price">{{ __('Free') }}</h4>
                                                @elseif($minFee == $maxFee)
                                                    <h4 class="price">{{ currency($minFee) }}</h4>
                                                @else
                                                    <h4 class="price">{{ currency($minFee) }} - {{ currency($maxFee) }}</h4>
                                                @endif
                                            @else
                                                <h4 class="price">{{ __('Contact for Price') }}</h4>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="courses__nav">
                    <div class="courses-button-prev"><i class="flaticon-arrow-right"></i></div>
                    <div class="courses-button-next"><i class="flaticon-arrow-right"></i></div>
                </div>
            </div> -->

            <!-- <div class="tab-pane fade" id="development-tab-pane" role="tabpanel"
                aria-labelledby="development-tab-pane" tabindex="0">
                <div class="swiper courses-swiper-active">
                    <div class="swiper-wrapper">
                        @foreach ($categoryThreeCourses ?? [] as $course)
                            <div class="swiper-slide">
                                <div class="courses__item shine__animate-item">
                                    <div class="courses__item-thumb">
                                        <a href="{{ route('course.show', $course->slug) }}"
                                            class="shine__animate-link">
                                            <img src="{{ asset($course->thumbnail) }}" alt="img">
                                        </a>
                                        <a href="javascript:;" class="wsus-wishlist-btn common-white courses__wishlist-two"  aria-label="WishList"
                                            data-slug="{{ $course?->slug }}">
                                            <i class="{{ $course?->favorite_by_client ? 'fas' : 'far' }} fa-heart"></i>
                                        </a>
                                    </div>
                                    <div class="courses__item-content">
                                        <ul class="courses__item-meta list-wrap">
                                            <li class="courses__item-tag">
                                                <a
                                                    href="{{ route('courses', ['category' => $course->category?->id ?? 0]) }}">{{ $course->category?->translation?->name ?? __('Uncategorized') }}</a>
                                            </li>
                                            <li class="avg-rating"><i class="fas fa-star"></i>
                                                {{ number_format($course->avg_rating, 1) ?? 0 }}
                                            </li>
                                        </ul>
                                        <h3 class="title"><a
                                                href="{{ route('course.show', $course->slug) }}">{{ truncate($course->title, 50) }}</a>
                                        </h3>
                                        <p class="author">{{ __('By') }} 
                                            @if($course->instructor && $course->instructor->id)
                                                <a href="{{ route('instructor-details', ['id' => $course->instructor->id, 'slug' => Str::slug($course->instructor->name ?? 'instructor')]) }}">{{ $course->instructor->name ?? __('Unknown Instructor') }}</a>
                                            @else
                                                <span>{{ __('Unknown Instructor') }}</span>
                                            @endif
                                        </p>
                                        <div class="courses__item-bottom">
                                            @auth('web')
                                                @if(userAuth()->role === 'instructor')
                                                    <div class="button">
                                                        <a href="{{ route('instructor.dashboard') }}" class="">
                                                            <span class="text">{{ __('Go to Dashboard') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @elseif (in_array($course->id, session('enrollments') ?? []))
                                                    <div class="button">
                                                        <a href="{{ route('student.enrolled-courses') }}"
                                                            class="already-enrolled-btn" data-id="">
                                                            <span class="text">{{ __('Enrolled') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @elseif ($course->enrollments_count >= $course->capacity && $course->capacity != null)
                                                    <div class="button">
                                                        <a href="javascript:;" class=""
                                                            data-id="{{ $course->id }}">
                                                            <span class="text">{{ __('Booked') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="button">
                                                        <a href="javascript:;" class="add-to-cart"
                                                            data-id="{{ $course->id }}">
                                                            <span class="text">{{ __('Add To Cart') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            @else
                                                @if ($course->enrollments_count >= $course->capacity && $course->capacity != null)
                                                    <div class="button">
                                                        <a href="javascript:;" class=""
                                                            data-id="{{ $course->id }}">
                                                            <span class="text">{{ __('Booked') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="button">
                                                        <a href="javascript:;" class="add-to-cart"
                                                            data-id="{{ $course->id }}">
                                                            <span class="text">{{ __('Add To Cart') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            @endauth
                                            @php
                                                $feeStructures = $course->courseFeeStructures ?? collect([]);
                                                $minFee = $feeStructures->min('course_fee');
                                                $maxFee = $feeStructures->max('course_fee');
                                            @endphp
                                            @if($feeStructures->count() > 0 && $minFee !== null)
                                                @if($minFee == 0)
                                                    <h4 class="price">{{ __('Free') }}</h4>
                                                @elseif($minFee == $maxFee)
                                                    <h4 class="price">{{ currency($minFee) }}</h4>
                                                @else
                                                    <h4 class="price">{{ currency($minFee) }} - {{ currency($maxFee) }}</h4>
                                                @endif
                                            @else
                                                <h4 class="price">{{ __('Contact for Price') }}</h4>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="courses__nav">
                    <div class="courses-button-prev"><i class="flaticon-arrow-right"></i></div>
                    <div class="courses-button-next"><i class="flaticon-arrow-right"></i></div>
                </div>
            </div>

            <div class="tab-pane fade" id="categoryFour-tab-pane" role="tabpanel"
                aria-labelledby="categoryFour-tab-pane" tabindex="0">
                <div class="swiper courses-swiper-active">
                    <div class="swiper-wrapper">
                        @foreach ($categoryFourCourses ?? [] as $course)
                            <div class="swiper-slide">
                                <div class="courses__item shine__animate-item">
                                    <div class="courses__item-thumb">
                                        <a href="{{ route('course.show', $course->slug) }}"
                                            class="shine__animate-link">
                                            <img src="{{ asset($course->thumbnail) }}" alt="img">
                                        </a>
                                        <a href="javascript:;" class="wsus-wishlist-btn common-white courses__wishlist-two"  aria-label="WishList"
                                            data-slug="{{ $course?->slug }}">
                                            <i class="{{ $course?->favorite_by_client ? 'fas' : 'far' }} fa-heart"></i>
                                        </a>
                                    </div>
                                    <div class="courses__item-content">
                                        <ul class="courses__item-meta list-wrap">
                                            <li class="courses__item-tag">
                                                <a
                                                    href="{{ route('courses', ['category' => $course->category?->id ?? 0]) }}">{{ $course->category?->translation?->name ?? __('Uncategorized') }}</a>
                                            </li>
                                            <li class="avg-rating"><i class="fas fa-star"></i>
                                                {{ number_format($course->avg_rating, 1) ?? 0 }}
                                            </li>
                                        </ul>
                                        <h3 class="title"><a
                                                href="{{ route('course.show', $course->slug) }}">{{ truncate($course->title, 50) }}</a>
                                        </h3>
                                        <p class="author">{{ __('By') }} 
                                            @if($course->instructor && $course->instructor->id)
                                                <a href="{{ route('instructor-details', ['id' => $course->instructor->id, 'slug' => Str::slug($course->instructor->name ?? 'instructor')]) }}">{{ $course->instructor->name ?? __('Unknown Instructor') }}</a>
                                            @else
                                                <span>{{ __('Unknown Instructor') }}</span>
                                            @endif
                                        </p>
                                        <div class="courses__item-bottom">
                                            @auth('web')
                                                @if(userAuth()->role === 'instructor')
                                                    <div class="button">
                                                        <a href="{{ route('instructor.dashboard') }}" class="">
                                                            <span class="text">{{ __('Go to Dashboard') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @elseif (in_array($course->id, session('enrollments') ?? []))
                                                    <div class="button">
                                                        <a href="{{ route('student.enrolled-courses') }}"
                                                            class="already-enrolled-btn" data-id="">
                                                            <span class="text">{{ __('Enrolled') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @elseif ($course->enrollments_count >= $course->capacity && $course->capacity != null)
                                                    <div class="button">
                                                        <a href="javascript:;" class=""
                                                            data-id="{{ $course->id }}">
                                                            <span class="text">{{ __('Booked') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="button">
                                                        <a href="javascript:;" class="add-to-cart"
                                                            data-id="{{ $course->id }}">
                                                            <span class="text">{{ __('Add To Cart') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            @else
                                                @if ($course->enrollments_count >= $course->capacity && $course->capacity != null)
                                                    <div class="button">
                                                        <a href="javascript:;" class=""
                                                            data-id="{{ $course->id }}">
                                                            <span class="text">{{ __('Booked') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="button">
                                                        <a href="javascript:;" class="add-to-cart"
                                                            data-id="{{ $course->id }}">
                                                            <span class="text">{{ __('Add To Cart') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            @endauth
                                            @php
                                                $feeStructures = $course->courseFeeStructures ?? collect([]);
                                                $minFee = $feeStructures->min('course_fee');
                                                $maxFee = $feeStructures->max('course_fee');
                                            @endphp
                                            @if($feeStructures->count() > 0 && $minFee !== null)
                                                @if($minFee == 0)
                                                    <h4 class="price">{{ __('Free') }}</h4>
                                                @elseif($minFee == $maxFee)
                                                    <h4 class="price">{{ currency($minFee) }}</h4>
                                                @else
                                                    <h4 class="price">{{ currency($minFee) }} - {{ currency($maxFee) }}</h4>
                                                @endif
                                            @else
                                                <h4 class="price">{{ __('Contact for Price') }}</h4>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="courses__nav">
                    <div class="courses-button-prev"><i class="flaticon-arrow-right"></i></div>
                    <div class="courses-button-next"><i class="flaticon-arrow-right"></i></div>
                </div>
            </div>

            <div class="tab-pane fade" id="categoryFive-tab-pane" role="tabpanel"
                aria-labelledby="categoryFive-tab-pane" tabindex="0">
                <div class="swiper courses-swiper-active">
                    <div class="swiper-wrapper">
                        @foreach ($categoryFiveCourses ?? [] as $course)
                            <div class="swiper-slide">
                                <div class="courses__item shine__animate-item">
                                    <div class="courses__item-thumb">
                                        <a href="{{ route('course.show', $course->slug) }}"
                                            class="shine__animate-link">
                                            <img src="{{ asset($course->thumbnail) }}" alt="img">
                                        </a>
                                        <a href="javascript:;" class="wsus-wishlist-btn common-white courses__wishlist-two"  aria-label="WishList"
                                            data-slug="{{ $course?->slug }}">
                                            <i class="{{ $course?->favorite_by_client ? 'fas' : 'far' }} fa-heart"></i>
                                        </a>
                                    </div>
                                    <div class="courses__item-content">
                                        <ul class="courses__item-meta list-wrap">
                                            <li class="courses__item-tag">
                                                <a
                                                    href="{{ route('courses', ['category' => $course->category?->id ?? 0]) }}">{{ $course->category?->translation?->name ?? __('Uncategorized') }}</a>
                                            </li>
                                            <li class="avg-rating"><i class="fas fa-star"></i>
                                                {{ number_format($course->avg_rating, 1) ?? 0 }}
                                            </li>
                                        </ul>
                                        <h3 class="title"><a
                                                href="{{ route('course.show', $course->slug) }}">{{ truncate($course->title, 50) }}</a>
                                        </h3>
                                        <p class="author">{{ __('By') }} 
                                            @if($course->instructor && $course->instructor->id)
                                                <a href="{{ route('instructor-details', ['id' => $course->instructor->id, 'slug' => Str::slug($course->instructor->name ?? 'instructor')]) }}">{{ $course->instructor->name ?? __('Unknown Instructor') }}</a>
                                            @else
                                                <span>{{ __('Unknown Instructor') }}</span>
                                            @endif
                                        </p>
                                        <div class="courses__item-bottom">
                                            @auth('web')
                                                @if(userAuth()->role === 'instructor')
                                                    <div class="button">
                                                        <a href="{{ route('instructor.dashboard') }}" class="">
                                                            <span class="text">{{ __('Go to Dashboard') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @elseif (in_array($course->id, session('enrollments') ?? []))
                                                    <div class="button">
                                                        <a href="{{ route('student.enrolled-courses') }}"
                                                            class="already-enrolled-btn" data-id="">
                                                            <span class="text">{{ __('Enrolled') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @elseif ($course->enrollments_count >= $course->capacity && $course->capacity != null)
                                                    <div class="button">
                                                        <a href="javascript:;" class=""
                                                            data-id="{{ $course->id }}">
                                                            <span class="text">{{ __('Booked') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="button">
                                                        <a href="javascript:;" class="add-to-cart"
                                                            data-id="{{ $course->id }}">
                                                            <span class="text">{{ __('Add To Cart') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            @else
                                                @if ($course->enrollments_count >= $course->capacity && $course->capacity != null)
                                                    <div class="button">
                                                        <a href="javascript:;" class=""
                                                            data-id="{{ $course->id }}">
                                                            <span class="text">{{ __('Booked') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="button">
                                                        <a href="javascript:;" class="add-to-cart"
                                                            data-id="{{ $course->id }}">
                                                            <span class="text">{{ __('Add To Cart') }}</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            @endauth
                                            @php
                                                $feeStructures = $course->courseFeeStructures ?? collect([]);
                                                $minFee = $feeStructures->min('course_fee');
                                                $maxFee = $feeStructures->max('course_fee');
                                            @endphp
                                            @if($feeStructures->count() > 0 && $minFee !== null)
                                                @if($minFee == 0)
                                                    <h4 class="price">{{ __('Free') }}</h4>
                                                @elseif($minFee == $maxFee)
                                                    <h4 class="price">{{ currency($minFee) }}</h4>
                                                @else
                                                    <h4 class="price">{{ currency($minFee) }} - {{ currency($maxFee) }}</h4>
                                                @endif
                                            @else
                                                <h4 class="price">{{ __('Contact for Price') }}</h4>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="courses__nav">
                    <div class="courses-button-prev"><i class="flaticon-arrow-right"></i></div>
                    <div class="courses-button-next"><i class="flaticon-arrow-right"></i></div>
                </div>
            </div> -->

        </div>
    </div>
</section>
