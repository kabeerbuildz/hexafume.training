<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('meta_title', $setting->app_name)</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', '')">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Custom Meta -->
    @stack('custom_meta')
    <!-- Preload LCP Image for Homepage -->
    @if(request()->routeIs('home'))
        @php
            $theme_name = session()->has('demo_theme') ? session()->get('demo_theme') : (defined('DEFAULT_HOMEPAGE') ? DEFAULT_HOMEPAGE : 'main');
            $sections = \Modules\Frontend\app\Models\Section::whereHas("home", function ($q) use ($theme_name) {
                $q->where('slug', $theme_name);
            })->get();
            $hero = $sections->where('name', 'hero_section')->first();
            $bannerImage = $hero?->global_content?->banner_image ?? null;
        @endphp
        @if($bannerImage)
            <link rel="preload" as="image" href="{{ asset($bannerImage) }}" fetchpriority="high">
        @endif
    @endif
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset($setting->favicon) }}">
    <!-- CSS here -->
    @include('frontend.layouts.styles')
    <!-- CustomCSS here -->
    @stack('styles')
    @if (customCode()?->css)
        <style>
            {!! customCode()->css !!}
        </style>
    @endif

    {{-- dynamic header scripts --}}
    @include('frontend.layouts.header-scripts')

    @php
        setEnrollmentIdsInSession();
        setInstructorCourseIdsInSession();
        $theme_name = session()->has('demo_theme') ? session()->get('demo_theme') : DEFAULT_HOMEPAGE;
    @endphp
</head>
<body class="{{ isRoute('home', "home_{$theme_name}") }}">
    <!-- @if ($setting->google_tagmanager_status == 'active') -->
        <!-- Google Tag Manager (noscript) -->
        <!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $setting->google_tagmanager_id }}"
                height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->
        <!-- End Google Tag Manager (noscript) -->
    <!-- @endif -->

   

    <!-- Scroll-top -->
    <button class="scroll__top scroll-to-target" data-target="html" aria-label="Scroll Top">
        <i class="tg-flaticon-arrowhead-up"></i>
    </button>
    <!-- Scroll-top-end-->

    <!-- header-area -->
    @include('frontend.layouts.header')
    <!-- header-area-end -->

    <!-- main-area -->
    <main class="main-area fix">
        @yield('contents')
    </main>
    <!-- main-area-end -->

    <!-- modal-area -->
    @include('frontend.partials.modal')
    @include('frontend.instructor-dashboard.course.partials.add-new-section-modal')
    <!-- modal-area -->

    <!-- footer-area -->
    @include('frontend.layouts.footer')
    <!-- footer-area-end -->


    <!-- JS here -->
    @include('frontend.layouts.scripts')

    <!-- Language Translation Variables -->
    @include('global.dynamic-js-variables')

    <!-- Page specific js -->
    @if (session('registerUser') && $setting->google_tagmanager_status == 'active' && $marketing_setting?->register)
        @php
            $registerUser = session('registerUser');
            session()->forget('registerUser');
        @endphp
        <script>
            $(function() {
                dataLayer.push({
                    'event': 'newStudent',
                    'student_info': @json($registerUser)
                });
            });
        </script>
    @endif
    @stack('scripts')
    @if (customCode()?->javascript)
        <script>
            "use strict";
            {!! customCode()->javascript !!}
        </script>
    @endif
</body>

</html>
