@php
$nav_menu = menu_get_by_slug('nav-menu');
// Cache categories query for better performance
$categories = \Illuminate\Support\Facades\Cache::remember('header_categories', 3600, function () {
    return \Modules\Course\app\Models\CourseCategory::with('translation')
->where('status', 1)
->whereNull('parent_id')
->get();
});
@endphp
<!-- header-area -->
<header>
    @if ($setting?->header_topbar_status == 'active')
    <div class="tg-header__top">
        <div class="container custom-container xl_container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <ul class="tg-header__top-info list-wrap mb-0" style="display: flex; flex-wrap: wrap; gap: 20px; align-items: center;">
                        @if ($setting?->site_address)
                        <li style="display: flex; align-items: center; gap: 8px;">
                            <img src="{{ asset('frontend/img/icons/map_marker.svg') }}" alt="Icon" style="width: 16px; height: 16px; flex-shrink: 0;">
                            <span style="font-size: 14px; color: #666;">{{ $setting?->site_address }}</span>
                        </li>
                        @endif
                        @if ($setting?->site_email)
                        <li style="display: flex; align-items: center; gap: 8px;">
                            <img src="{{ asset('frontend/img/icons/envelope.svg') }}" alt="Icon" style="width: 16px; height: 16px; flex-shrink: 0;">
                            <a href="mailto:{{ $setting?->site_email }}" style="font-size: 14px; color: #666; text-decoration: none; transition: color 0.3s ease;" onmouseover="this.style.color='#5751e1'" onmouseout="this.style.color='#666'">{{ $setting?->site_email }}</a>
                        </li>
                        @endif
                    </ul>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="tg-header__top-right" style="display: flex; align-items: center; justify-content: flex-end; gap: 20px; flex-wrap: wrap;">
                        @if ($setting?->header_social_status == 'active')
                        <ul class="tg-header__top-social list-wrap mb-0" style="display: flex; align-items: center; gap: 12px; margin: 0; padding: 0; list-style: none;">
                            <li style="font-size: 14px; color: #666; font-weight: 500; margin-right: 4px;">{{ __('Follow Us On') }}:</li>
                            @foreach (getSocialLinks() as $socialLink)
                            <li class="header-social" style="margin: 0;">
                                <a href="{{ $socialLink->link }}" target="_blank" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 50%; background: #f5f5f5; transition: all 0.3s ease; text-decoration: none;" onmouseover="this.style.background='#5751e1'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#f5f5f5'; this.style.transform='translateY(0)'">
                                    <img src="{{ asset($socialLink->icon) }}" alt="{{ $socialLink->name ?? 'Social' }}" style="width: 18px; height: 18px; filter: brightness(0) saturate(100%) invert(40%);">
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                        <div class="header-auth-buttons">
                            @guest('web')
                                <a href="{{ route('login') }}" class="auth-btn auth-btn-login">
                                    <i class="fas fa-sign-in-alt"></i>
                                    <span>{{ __('Login') }}</span>
                                </a>
                                <a href="{{ route('register') }}" class="auth-btn auth-btn-register">
                                    <i class="fas fa-user-plus"></i>
                                    <span>{{ __('Register') }}</span>
                                </a>
                            @else
                                @if(userAuth()->role === 'instructor')
                                    <a href="{{ route('instructor.dashboard') }}" class="auth-btn auth-btn-enroll">
                                        <i class="fas fa-graduation-cap"></i>
                                        <span>{{ __('Go to Dashboard') }}</span>
                                    </a>
                                @else
                                    <a href="javascript:;" class="auth-btn auth-btn-enroll enroll-now-btn" data-bs-toggle="modal" data-bs-target="#enrollmentModal">
                                        <i class="fas fa-graduation-cap"></i>
                                        <span>{{ __('Enroll Now') }}</span>
                                    </a>
                                @endif
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div id="header-fixed-height"></div>
    <div id="sticky-header" class="tg-header__area">
        <div class="container custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="tgmenu__wrap">
                        <nav class="tgmenu__nav">
                            <div class="logo">
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset($setting?->logo) }}" alt="Logo" style="width: 200px;">
                                </a>
                            </div>
                            <div class="tgmenu__navbar-wrap tgmenu__main-menu d-none d-xl-flex">
                                @if ($nav_menu)
                                <ul class="navigation">
                                    @foreach ($nav_menu->menuItems as $menu)
                                    @php
                                    // Auto-detect and fix common menu links
                                    $menuLabel = strtolower(trim($menu?->label ?? ''));
                                    $menuLink = $menu?->link ?? '';

                                                // Check if it's "About Us" and ensure it links correctly
                                                if (in_array($menuLabel, ['about us', 'about-us', 'about_us', __('About Us')])) {
                                                    $menuLink = route('about-us');
                                                }
                                                // Check for other common pages
                                                elseif (in_array($menuLabel, ['our instructors', 'our-instructors', __('Our Instructors')])) {
                                                    $menuLink = route('all-instructors');
                                                }
                                                elseif (in_array($menuLabel, ['our programs', 'our-programs', 'our_programs', __('Our Programs')])) {
                                                    $menuLink = route('all-programs');
                                                }
                                                elseif (in_array($menuLabel, ['training schedule', 'training-schedule', 'training_schedule', __('Training Schedule')])) {
                                                    $menuLink = route('training-schedule');
                                                }
                                                elseif (in_array($menuLabel, ['fee structure', 'fee-structure', 'fee_structure', __('Fee Structure')])) {
                                                    $menuLink = route('fee-structure');
                                                }
                                                elseif (in_array($menuLabel, ['contact', __('Contact')])) {
                                                    $menuLink = route('contact.index');
                                                }
                                                elseif (in_array($menuLabel, ['courses', __('Courses')])) {
                                                    $menuLink = route('courses');
                                                }
                                                elseif (in_array($menuLabel, ['blog', __('Blog')])) {
                                                    $menuLink = route('blogs');
                                                }
                                                elseif (in_array($menuLabel, ['our partners', 'our-partners', 'our_partners', __('Our Partners')])) {
                                                    $menuLink = route('our-partners');
                                                }
                                    @endphp
                                    @if ($menu?->link == '/' && $setting?->show_all_homepage == 1)
                                    <li class="menu-item-has-children">
                                        <a href="{{ url('/') }}"
                                            title="">{{ __('Home') }}</a>
                                        <ul class="sub-menu">
                                            @foreach (App\Enums\ThemeList::cases() as $theme)
                                            <li class=""><a
                                                    href="{{ route('change-theme', $theme->value) }}"
                                                    title="">{{ __($theme->value) }}</a></li>
                                            @endforeach
                                        </ul><!-- /.sub-menu -->
                                    </li>
                                    @else
                                    <li
                                        class="{{ $menu->child && count($menu->child) ? 'menu-item-has-children' : '' }}">
                                        <a href="{{ $menu->child && count($menu->child) ? 'javascript:;' : url($menuLink) }}"
                                            title="">{{ $menu?->label }}</a>
                                        @if ($menu->child && count($menu->child))
                                        <ul class="sub-menu">
                                            @foreach ($menu?->child as $child)
                                            @php
                                            $childLabel = strtolower(trim($child?->label ?? ''));
                                            $childLink = $child?->link ?? '';

                                                                    if (in_array($childLabel, ['about us', 'about-us', 'about_us', __('About Us')])) {
                                                                        $childLink = route('about-us');
                                                                    }
                                                                    elseif (in_array($childLabel, ['our instructors', 'our-instructors', __('Our Instructors')])) {
                                                                        $childLink = route('all-instructors');
                                                                    }
                                                                    elseif (in_array($childLabel, ['our programs', 'our-programs', 'our_programs', __('Our Programs')])) {
                                                                        $childLink = route('all-programs');
                                                                    }
                                                                    elseif (in_array($childLabel, ['training schedule', 'training-schedule', 'training_schedule', __('Training Schedule')])) {
                                                                        $childLink = route('training-schedule');
                                                                    }
                                                                    elseif (in_array($childLabel, ['fee structure', 'fee-structure', 'fee_structure', __('Fee Structure')])) {
                                                                        $childLink = route('fee-structure');
                                                                    }
                                                                    elseif (in_array($childLabel, ['contact', __('Contact')])) {
                                                                        $childLink = route('contact.index');
                                                                    }
                                                                    elseif (in_array($childLabel, ['our partners', 'our-partners', 'our_partners', __('Our Partners')])) {
                                                                        $childLink = route('our-partners');
                                                                    }
                                            @endphp
                                            <li class=""><a href="{{ url($childLink) }}"
                                                    title="">{{ $child?->label }}</a></li>
                                            @endforeach
                                        </ul><!-- /.sub-menu -->
                                        @endif
                                    </li>
                                    @endif
                                    @endforeach
                                </ul><!-- /.menu -->
                                @endif

                            </div>
                            <div class="tgmenu__search d-none d-md-block">
                                <form action="{{ route('courses') }}" class="tgmenu__search-form">
                                    <div class="select-grp">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                                            <path
                                                d="M10.992 13.25C10.5778 13.25 10.242 13.5858 10.242 14C10.242 14.4142 10.5778 14.75 10.992 14.75V13.25ZM16.992 14.75C17.4062 14.75 17.742 14.4142 17.742 14C17.742 13.5858 17.4062 13.25 16.992 13.25V14.75ZM14.742 11C14.742 10.5858 14.4062 10.25 13.992 10.25C13.5778 10.25 13.242 10.5858 13.242 11H14.742ZM13.242 17C13.242 17.4142 13.5778 17.75 13.992 17.75C14.4062 17.75 14.742 17.4142 14.742 17H13.242ZM1 6.4H1.75H1ZM1 1.6H1.75H1ZM6.4 1V1.75V1ZM7 1.6H6.25H7ZM6.4 7V6.25V7ZM1 16.4H1.75H1ZM1 11.6H1.75H1ZM6.4 11V11.75V11ZM7 11.6H6.25H7ZM6.4 17V17.75V17ZM1.6 17V17.75V17ZM11 6.4H11.75H11ZM11 1.6H11.75H11ZM11.6 1V0.25V1ZM16.4 1V1.75V1ZM17 1.6H17.75H17ZM17 6.4H17.75H17ZM16.4 7V6.25V7ZM10.992 14.75H13.992V13.25H10.992V14.75ZM16.992 13.25H13.992V14.75H16.992V13.25ZM14.742 14V11H13.242V14H14.742ZM13.242 14V17H14.742V14H13.242ZM1.75 6.4V1.6H0.25V6.4H1.75ZM1.75 1.6C1.75 1.63978 1.7342 1.67794 1.70607 1.70607L0.645406 0.645406C0.392232 0.89858 0.25 1.24196 0.25 1.6H1.75ZM1.70607 1.70607C1.67794 1.7342 1.63978 1.75 1.6 1.75V0.25C1.24196 0.25 0.89858 0.392232 0.645406 0.645406L1.70607 1.70607ZM1.6 1.75H6.4V0.25H1.6V1.75ZM6.4 1.75C6.36022 1.75 6.32207 1.7342 6.29393 1.70607L7.35459 0.645406C7.10142 0.392231 6.75804 0.25 6.4 0.25V1.75ZM6.29393 1.70607C6.2658 1.67793 6.25 1.63978 6.25 1.6H7.75C7.75 1.24196 7.60777 0.898581 7.35459 0.645406L6.29393 1.70607ZM6.25 1.6V6.4H7.75V1.6H6.25ZM6.25 6.4C6.25 6.36022 6.2658 6.32207 6.29393 6.29393L7.35459 7.35459C7.60777 7.10142 7.75 6.75804 7.75 6.4H6.25ZM6.29393 6.29393C6.32207 6.2658 6.36022 6.25 6.4 6.25V7.75C6.75804 7.75 7.10142 7.60777 7.35459 7.35459L6.29393 6.29393ZM6.4 6.25H1.6V7.75H6.4V6.25ZM1.6 6.25C1.63978 6.25 1.67793 6.2658 1.70607 6.29393L0.645406 7.35459C0.898581 7.60777 1.24196 7.75 1.6 7.75V6.25ZM1.70607 6.29393C1.7342 6.32207 1.75 6.36022 1.75 6.4H0.25C0.25 6.75804 0.392231 7.10142 0.645406 7.35459L1.70607 6.29393ZM1.75 16.4V11.6H0.25V16.4H1.75ZM1.75 11.6C1.75 11.6398 1.7342 11.6779 1.70607 11.7061L0.645406 10.6454C0.392231 10.8986 0.25 11.242 0.25 11.6H1.75ZM1.70607 11.7061C1.67793 11.7342 1.63978 11.75 1.6 11.75V10.25C1.24196 10.25 0.898581 10.3922 0.645406 10.6454L1.70607 11.7061ZM1.6 11.75H6.4V10.25H1.6V11.75ZM6.4 11.75C6.36022 11.75 6.32207 11.7342 6.29393 11.7061L7.35459 10.6454C7.10142 10.3922 6.75804 10.25 6.4 10.25V11.75ZM6.29393 11.7061C6.2658 11.6779 6.25 11.6398 6.25 11.6H7.75C7.75 11.242 7.60777 10.8986 7.35459 10.6454L6.29393 11.7061ZM6.25 11.6V16.4H7.75V11.6H6.25ZM6.25 16.4C6.25 16.3602 6.2658 16.3221 6.29393 16.2939L7.35459 17.3546C7.60777 17.1014 7.75 16.758 7.75 16.4H6.25ZM6.29393 16.2939C6.32207 16.2658 6.36022 16.25 6.4 16.25V17.75C6.75804 17.75 7.10142 17.6078 7.35459 17.3546L6.29393 16.2939ZM6.4 16.25H1.6V17.75H6.4V16.25ZM1.6 16.25C1.63978 16.25 1.67793 16.2658 1.70607 16.2939L0.645406 17.3546C0.898581 17.6078 1.24196 17.75 1.6 17.75V16.25ZM1.70607 16.2939C1.7342 16.3221 1.75 16.3602 1.75 16.4H0.25C0.25 16.758 0.392231 17.1014 0.645406 17.3546L1.70607 16.2939ZM11.75 6.4V1.6H10.25V6.4H11.75ZM11.75 1.6C11.75 1.63978 11.7342 1.67793 11.7061 1.70607L10.6454 0.645406C10.3922 0.898581 10.25 1.24196 10.25 1.6H11.75ZM11.7061 1.70607C11.6779 1.7342 11.6398 1.75 11.6 1.75V0.25C11.242 0.25 10.8986 0.392231 10.6454 0.645406L11.7061 1.70607ZM11.6 1.75H16.4V0.25H11.6V1.75ZM16.4 1.75C16.3602 1.75 16.3221 1.7342 16.2939 1.70607L17.3546 0.645406C17.1014 0.392231 16.758 0.25 16.4 0.25V1.75ZM16.2939 1.70607C16.2658 1.67793 16.25 1.63978 16.25 1.6H17.75C17.75 1.24196 17.6078 0.898581 17.3546 0.645406L16.2939 1.70607ZM16.25 1.6V6.4H17.75V1.6H16.25ZM16.25 6.4C16.25 6.36022 16.2658 6.32207 16.2939 6.29393L17.3546 7.35459C17.6078 7.10142 17.75 6.75804 17.75 6.4H16.25ZM16.2939 6.29393C16.3221 6.2658 16.3602 6.25 16.4 6.25V7.75C16.758 7.75 17.1014 7.60777 17.3546 7.35459L16.2939 6.29393ZM16.4 6.25H11.6V7.75H16.4V6.25ZM11.6 6.25C11.6398 6.25 11.6779 6.2658 11.7061 6.29393L10.6454 7.35459C10.8986 7.60777 11.242 7.75 11.6 7.75V6.25ZM11.7061 6.29393C11.7342 6.32207 11.75 6.36022 11.75 6.4H10.25C10.25 6.75804 10.3922 7.10142 10.6454 7.35459L11.7061 6.29393Z"
                                                fill="currentcolor" />
                                        </svg>

                                        <select class="form-select select_js w_150px"
                                            aria-label="Default select example" name="main_category">
                                            <option selected disabled>{{ __('Categories') }}</option>
                                            @foreach ($categories as $category)
                                            <option @selected(request('main_category')==$category->slug) value="{{ $category->slug }}">
                                                {{ $category?->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-grp">
                                        <input type="text" placeholder="{{ __('Search For Course') }} . . ."
                                            name="search" value="{{ request('search') }}">
                                        <button type="submit" aria-label="Search"><i
                                                class="flaticon-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="tgmenu__action">
                                <ul class="list-wrap">
                                    @auth('web')
                                        @if(userAuth()->role !== 'instructor')
                                            <li class="mini-cart-icon">
                                                <a href="{{ route('cart') }}" class="cart-count">
                                                    <img src="{{ asset('frontend/img/icons/cart.svg') }}" class="injectable"
                                                        alt="img">
                                                    <span class="mini-cart-count">
                                                        {{userAuth()->cart_count}}
                                                    </span>
                                                </a>
                                            </li>
                                        @endif
                                    @else
                                        <li class="mini-cart-icon">
                                            <a href="{{ route('cart') }}" class="cart-count">
                                                <img src="{{ asset('frontend/img/icons/cart.svg') }}" class="injectable"
                                                    alt="img">
                                                <span class="mini-cart-count">
                                                    {{ Cart::content()->count() }}
                                                </span>
                                            </a>
                                        </li>
                                    @endauth
                                    <li class="mini-cart-icon user-dropdown-wrapper">
                                        <a href="javascript:;" class="cart-count user-dropdown-trigger">
                                            <img src="{{ asset('frontend/img/icons/menu_user.svg') }}" alt="img">
                                            @auth('web')
                                                @if(userAuth()->image)
                                                    <span class="user-avatar-mini">
                                                        <img src="{{ asset(userAuth()->image) }}" alt="{{ userAuth()->name }}">
                                                    </span>
                                                @endif
                                            @endauth
                                        </a>
                                        <div class="user-dropdown-menu">
                                            @auth('admin')
                                            <div class="dropdown-header">
                                                <i class="fas fa-user-shield"></i>
                                                <span>{{ __('Admin') }}</span>
                                            </div>
                                            <div class="dropdown-divider"></div>
                                            <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                                                <i class="fas fa-tachometer-alt"></i>
                                                <span>{{ __('Admin Dashboard') }}</span>
                                                <i class="fas fa-chevron-right"></i>
                                            </a>
                                            @endauth
                                            @guest
                                            <div class="dropdown-header">
                                                <i class="fas fa-user-circle"></i>
                                                <span>{{ __('Account') }}</span>
                                            </div>
                                            <div class="dropdown-divider"></div>
                                            <a href="{{ route('login') }}" class="dropdown-item">
                                                <i class="fas fa-sign-in-alt"></i>
                                                <span>{{ __('Sign in') }}</span>
                                                <i class="fas fa-chevron-right"></i>
                                            </a>
                                            <a href="{{ route('register') }}" class="dropdown-item dropdown-item-primary">
                                                <i class="fas fa-user-plus"></i>
                                                <span>{{ __('Sign Up') }}</span>
                                                <i class="fas fa-chevron-right"></i>
                                            </a>
                                            @else
                                            <div class="dropdown-profile">
                                                <div class="profile-avatar">
                                                    <img src="{{ asset(userAuth()->image ?? Cache::get('setting')->default_avatar) }}" alt="{{ userAuth()->name }}">
                                                </div>
                                                <div class="profile-info">
                                                    <h4 class="profile-name">{{ userAuth()->name }}</h4>
                                                    <span class="profile-role">
                                                        @if(userAuth()->role == 'instructor')
                                                            <i class="fas fa-chalkboard-teacher"></i> {{ __('Instructor') }}
                                                        @else
                                                            <i class="fas fa-user-graduate"></i> {{ __('Student') }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="dropdown-divider"></div>
                                            <a href="{{ userAuth()->role == 'instructor' ? route('instructor.setting.index') : route('student.setting.index') }}" class="dropdown-item">
                                                <i class="fas fa-user-cog"></i>
                                                <span>{{ __('Profile') }}</span>
                                                <i class="fas fa-chevron-right"></i>
                                            </a>
                                            <a href="{{ userAuth()->role == 'instructor' ? route('instructor.courses.index') : route('student.enrolled-courses') }}" class="dropdown-item">
                                                <i class="fas fa-book-open"></i>
                                                <span>{{ __('Courses') }}</span>
                                                <i class="fas fa-chevron-right"></i>
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="" class="dropdown-item dropdown-item-danger logout-btn">
                                                <i class="fas fa-sign-out-alt"></i>
                                                <span>{{ __('Logout') }}</span>
                                                <i class="fas fa-chevron-right"></i>
                                            </a>
                                            @endguest
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="mobile-nav-toggler"><i class="tg-flaticon-menu-1"></i></div>
                        </nav>
                    </div>

                    <!-- Mobile Menu  -->
                    <div class="tgmobile__menu">
                        <nav class="tgmobile__menu-box">
                            <div class="close-btn"><i class="tg-flaticon-close-1"></i></div>
                            <div class="nav-logo">
                                <a href="{{ route('home') }}"><img src="{{ asset(Cache::get('setting')->logo) }}"
                                        alt="Logo"></a>
                            </div>

                            <div class="header_language_area d-flex flex-wrap">

                                <ul>
                                    <li>
                                        @if (count(allLanguages()?->where('status', 1)) > 1)
                                        <form action="{{ route('set-language') }}"
                                            class="change-language-header-mobile" method="GET">
                                            <select name="code" class="select_js set-language-header-mobile">
                                                @forelse (allLanguages()?->where('status', 1) as $language)
                                                <option value="{{ $language->code }}"
                                                    {{ getSessionLanguage() == $language->code ? 'selected' : '' }}>
                                                    {{ $language->name }}
                                                </option>
                                                @empty
                                                <option value="en"
                                                    {{ getSessionLanguage() == 'en' ? 'selected' : '' }}>
                                                    {{ __('English') }}
                                                </option>
                                                @endforelse
                                            </select>
                                        </form>
                                        @endif
                                    </li>
                                    <li>
                                        @if (count(allCurrencies()?->where('status', 'active')) > 1)
                                        <form action="{{ route('set-currency') }}"
                                            class="change-currency-header-mobile" method="GET">
                                            <select name="currency" class="set-currency-header-mobile select_js">
                                                @forelse (allCurrencies()?->where('status', 'active') as $currency)
                                                <option value="{{ $currency->currency_code }}"
                                                    {{ getSessionCurrency() == $currency->currency_code ? 'selected' : '' }}>
                                                    {{ $currency->currency_name }}
                                                </option>
                                                @empty
                                                <option value="USD"
                                                    {{ getSessionCurrency() == 'USD' ? 'selected' : '' }}>
                                                    {{ __('USD') }}
                                                </option>
                                                @endforelse
                                            </select>
                                        </form>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <ul class="mobile_menu_login d-flex flex-wrap">
                                @auth('admin')
                                <li><a href="{{ route('admin.dashboard') }}">{{ __('Admin Dashboard') }}</a></li>
                                @endauth
                                @guest
                                <li><a href="{{ route('login') }}">{{ __('login') }}</a></li>
                                <li><a href="{{ route('register') }}">{{ __('register') }}</a></li>
                                @endguest

                                @auth('web')
                                @php
                                $user = Auth::guard('web')->user();
                                $dashboardRoute =
                                $user->role == 'instructor' ? 'instructor.dashboard' : 'student.dashboard';
                                $coursesRoute =
                                $user->role == 'instructor'
                                ? 'instructor.courses.index'
                                : 'student.enrolled-courses';
                                @endphp
                                <li><a href="{{ route($dashboardRoute) }}">{{ __('Dashboard') }}</a></li>
                                <li><a href="{{ route($coursesRoute) }}">{{ __('Courses') }}</a></li>
                                @endauth
                            </ul>

                            <div class="tgmobile__search">
                                <form action="{{ route('courses') }}">
                                    <select class="form-select w_150px" aria-label="Default select example"
                                        name="main_category">
                                        <option selected disabled>{{ __('Categories') }}</option>
                                        @foreach ($categories as $category)
                                        <option @selected(request('main_category')==$category->slug) value="{{ $category->slug }}">
                                            {{ $category?->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <input type="text" placeholder="{{ __('Search here') }}..." name="search">
                                    <button aria-label="Search"><i class="fas fa-search"></i></button>
                                </form>
                            </div>
                            <div class="tgmobile__menu-outer">
                                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                            </div>
                            <div class="social-links">
                                @if (count(getSocialLinks()) > 0)
                                <ul class="list-wrap">
                                    @foreach (getSocialLinks() as $socialLink)
                                    <li>
                                        <a href="{{ $socialLink->link }}" target="_blank">
                                            <img src="{{ asset($socialLink->icon) }}" alt="img">
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                        </nav>
                    </div>
                    <div class="tgmobile__menu-backdrop"></div>
                    <!-- End Mobile Menu -->

                    {{-- start admin logout form --}}
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    {{-- end admin logout form --}}
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header-area-end -->
<style>
    /* Ensure all header elements are aligned on the same line */
    .tgmenu__nav {
        display: flex !important;
        align-items: center !important;
        gap: 20px;
        flex-wrap: nowrap;
        width: 100%;
    }

    .tgmenu__nav .logo {
        flex-shrink: 0;
        display: flex;
        align-items: center;
        height: 100%;
    }

    .tgmenu__nav .logo img {
        max-height: 80px;
        width: auto;
        object-fit: contain;
    }

    .tgmenu__navbar-wrap {
        flex: 1 1 auto;
        min-width: 0;
        display: flex;
        align-items: center;
    }

    .tgmenu__navbar-wrap ul {
        display: flex;
        align-items: center;
        margin: 0;
        padding: 0;
        list-style: none;
        flex-wrap: nowrap !important;
        gap: 8px;
        overflow: hidden;
    }

    .tgmenu__navbar-wrap ul li {
        display: flex;
        align-items: center;
        flex-shrink: 0;
        white-space: nowrap;
    }

    .tgmenu__navbar-wrap ul li a {
        display: flex;
        align-items: center;
        white-space: nowrap;
        font-size: 14px;
        padding: 8px 10px;
        transition: all 0.3s ease;
    }

    .tgmenu__navbar-wrap ul li a:hover {
        color: var(--tg-theme-primary, #5751e1);
    }

    .tgmenu__search {
        flex-shrink: 1;
        display: flex;
        align-items: center;
        min-width: 0;
        margin-left: 15px;
    }

    .tgmenu__search-form {
        display: flex;
        align-items: center;
        margin: 0;
        width: 100%;
        max-width: 500px;
        min-width: 300px;
    }

    .tgmenu__search-form .select-grp {
        display: flex;
        align-items: center;
        flex-shrink: 0;
        min-width: 140px;
    }

    .tgmenu__search-form .input-grp {
        display: flex;
        align-items: center;
        flex: 1;
        min-width: 0;
    }

    .tgmenu__search-form .input-grp input {
        flex: 1;
        min-width: 0;
        font-size: 14px;
    }

    .tgmenu__search-form .input-grp button {
        flex-shrink: 0;
    }

    .tgmenu__action {
        flex-shrink: 0;
        display: flex;
        align-items: center;
        margin-left: 15px;
    }

    .tgmenu__action ul {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .tgmenu__action ul li {
        display: flex;
        align-items: center;
        flex-shrink: 0;
    }

    .tgmenu__action ul li a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .tgmenu__action ul li a:hover {
        background-color: rgba(87, 81, 225, 0.1);
    }

    .tgmenu__action ul li a img {
        width: 20px;
        height: 20px;
        object-fit: contain;
    }

    .mobile-nav-toggler {
        flex-shrink: 0;
        display: flex;
        align-items: center;
    }

    /* Responsive adjustments */
    @media (max-width: 1599.98px) {
        .tgmenu__navbar-wrap ul li a {
            font-size: 13px;
            padding: 8px 8px;
        }

        .tgmenu__search-form {
            max-width: 450px;
            min-width: 280px;
        }
    }

    @media (max-width: 1399.98px) {
        .tgmenu__nav {
            gap: 15px;
        }

        .tgmenu__nav .logo img {
            max-height: 70px;
        }

        .tgmenu__navbar-wrap ul {
            gap: 6px;
        }

        .tgmenu__navbar-wrap ul li a {
            font-size: 13px;
            padding: 8px 6px;
        }

        .tgmenu__search-form {
            max-width: 400px;
            min-width: 260px;
        }

        .tgmenu__search-form .select-grp {
            min-width: 120px;
        }
    }

    @media (max-width: 1199.98px) {
        .tgmenu__nav {
            gap: 10px;
        }

        .tgmenu__nav .logo img {
            max-height: 60px;
        }

        .tgmenu__navbar-wrap {
            display: none !important;
        }

        .tgmenu__search {
            margin-left: auto;
        }

        .tgmenu__search-form {
            max-width: 380px;
            min-width: 250px;
        }
    }

    @media (max-width: 991.98px) {
        .tgmenu__nav {
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .tgmenu__search {
            order: 3;
            width: 100%;
            margin-top: 10px;
        }

        .tgmenu__search-form {
            width: 100%;
        }
    }

    @media (max-width: 767.98px) {
        .tgmenu__nav .logo img {
            max-height: 50px;
            width: 150px;
        }
    }
</style>

<!-- Enrollment Modal -->
<div class="modal fade enrollment-modal-3d" id="enrollmentModal" tabindex="-1" aria-labelledby="enrollmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered enrollment-modal-dialog">
        <div class="modal-content enrollment-modal-content">
            <div class="enrollment-modal-header">
                <div class="enrollment-modal-title-wrapper">
                    <h5 class="modal-title" id="enrollmentModalLabel">
                        <span class="enrollment-icon">🎓</span>
                        {{ __('Enroll Now') }}
                    </h5>
                    <p class="enrollment-subtitle">{{ __('Start your learning journey today') }}</p>
                </div>
                <button type="button" class="btn-close enrollment-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body enrollment-modal-body">
                <form id="enrollmentForm">
                    @csrf
                    <div class="enrollment-form-group">
                        <label for="enroll_name" class="enrollment-label">
                            <span class="label-icon">👤</span>
                            {{ __('Name') }} <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control enrollment-input" id="enroll_name" name="name" required placeholder="{{ __('Enter your full name') }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="enrollment-form-group">
                        <label for="enroll_email" class="enrollment-label">
                            <span class="label-icon">📧</span>
                            {{ __('Email') }} <span class="text-danger">*</span>
                        </label>
                        <input type="email" class="form-control enrollment-input" id="enroll_email" name="email" required placeholder="{{ __('Enter your email address') }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="enrollment-form-group">
                        <label for="enroll_contact" class="enrollment-label">
                            <span class="label-icon">📱</span>
                            {{ __('Contact') }} <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control enrollment-input" id="enroll_contact" name="contact" required placeholder="{{ __('Enter your contact number') }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="enrollment-form-group">
                        <label for="enroll_course" class="enrollment-label">
                            <span class="label-icon">📚</span>
                            {{ __('Select Course') }} <span class="text-danger">*</span>
                        </label>
                        <select class="form-select enrollment-input enrollment-select" id="enroll_course" name="course_id" required>
                            <option value="">{{ __('Loading courses...') }}</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="enrollment-form-group">
                        <label for="enroll_comment" class="enrollment-label">
                            <span class="label-icon">💬</span>
                            {{ __('Comment') }}
                        </label>
                        <textarea class="form-control enrollment-input enrollment-textarea" id="enroll_comment" name="comment" rows="4" placeholder="{{ __('Any additional comments or questions...') }}"></textarea>
                    </div>
                    <div class="enrollment-modal-footer">
                        <button type="button" class="btn enrollment-btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn enrollment-btn-primary">
                            <span class="btn-text">{{ __('Submit Enrollment') }}</span>
                            <span class="btn-loader d-none">
                                <span class="spinner-border spinner-border-sm" role="status"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Enrollment Modal 3D Effects & Blur Background */
    .enrollment-modal-3d .modal-backdrop {
        background: rgba(0, 0, 0, 0.6) !important;
        backdrop-filter: blur(10px) !important;
        -webkit-backdrop-filter: blur(10px) !important;
    }

    .enrollment-modal-3d.show .modal-backdrop {
        animation: backdropFadeIn 0.3s ease-out;
    }

    @keyframes backdropFadeIn {
        from {
            opacity: 0;
            backdrop-filter: blur(0px);
        }

        to {
            opacity: 1;
            backdrop-filter: blur(10px);
        }
    }

    .enrollment-modal-dialog {
        perspective: 1000px;
        transform-style: preserve-3d;
        max-width: 700px;
        width: 90%;
        margin: 1.75rem auto;
    }

    .enrollment-modal-content {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(87, 81, 225, 0.1);
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        transform: translateZ(0);
        overflow: hidden;
        position: relative;
    }

    .enrollment-modal-3d.show .enrollment-modal-content {
        animation: modalSlideIn 0.3s ease-out;
    }

    @keyframes modalSlideIn {
        0% {
            opacity: 0;
            transform: translateY(-20px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .enrollment-modal-header {
        background: transparent;
        border-bottom: 1px solid rgba(87, 81, 225, 0.1);
        padding: 20px 24px;
        border-radius: 16px 16px 0 0;
        position: relative;
    }

    .enrollment-modal-title-wrapper {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .enrollment-modal-title-wrapper .modal-title {
        font-size: 22px;
        font-weight: 600;
        color: #1a1a2e;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .enrollment-icon {
        font-size: 20px;
        display: inline-block;
    }

    .enrollment-subtitle {
        font-size: 13px;
        color: #888;
        margin: 0;
        font-weight: 400;
        display: none;
    }

    .enrollment-close-btn {
        background: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0.7;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .enrollment-close-btn:hover {
        opacity: 1;
        transform: rotate(90deg) scale(1.1);
        background: rgba(255, 255, 255, 1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .enrollment-modal-body {
        padding: 24px;
        background: transparent;
    }

    .enrollment-form-group {
        margin-bottom: 18px;
        position: relative;
    }

    .enrollment-label {
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 500;
        color: #333;
        margin-bottom: 8px;
        font-size: 13px;
    }

    .label-icon {
        font-size: 16px;
        display: none;
    }

    .enrollment-input,
    .enrollment-select,
    .enrollment-textarea {
        background: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 14px;
        transition: all 0.2s ease;
        box-shadow: none;
    }

    .enrollment-input:focus,
    .enrollment-select:focus,
    .enrollment-textarea:focus {
        background: #fff;
        border-color: #5751e1;
        box-shadow: 0 0 0 3px rgba(87, 81, 225, 0.1);
        outline: none;
    }

    .enrollment-input:hover,
    .enrollment-select:hover,
    .enrollment-textarea:hover {
        border-color: #5751e1;
    }

    .enrollment-textarea {
        resize: vertical;
        min-height: 100px;
    }

    .enrollment-modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding: 20px 24px;
        background: #f8f9fa;
        border-top: 1px solid #e0e0e0;
        border-radius: 0 0 16px 16px;
        margin-top: 0;
    }

    .enrollment-btn-secondary,
    .enrollment-btn-primary {
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 500;
        font-size: 14px;
        transition: all 0.2s ease;
        position: relative;
        overflow: hidden;
        border: none;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .enrollment-btn-secondary {
        background: #f0f0f0;
        color: #666;
    }

    .enrollment-btn-secondary:hover {
        background: #e0e0e0;
        color: #333;
    }

    .enrollment-btn-primary {
        background: #5751e1;
        color: white;
        box-shadow: 0 2px 8px rgba(87, 81, 225, 0.3);
    }

    .enrollment-btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    .enrollment-btn-primary:hover::before {
        left: 100%;
    }

    .enrollment-btn-primary:hover {
        background: #4a44d1;
        box-shadow: 0 4px 12px rgba(87, 81, 225, 0.4);
    }

    .enrollment-btn-primary:active {
        transform: translateY(-1px) scale(0.98);
    }

    .enrollment-btn-primary:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }

    .btn-loader {
        display: inline-flex;
        align-items: center;
    }


    /* Responsive Design */
    @media (max-width: 576px) {
        .enrollment-modal-content {
            border-radius: 20px;
            margin: 10px;
        }

        .enrollment-modal-header,
        .enrollment-modal-body,
        .enrollment-modal-footer {
            padding: 20px;
        }

        .enrollment-modal-title-wrapper .modal-title {
            font-size: 24px;
        }
    }

    /* Loading Animation */
    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    .enrollment-input:disabled,
    .enrollment-select:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        animation: pulse 2s infinite;
    }

    /* ===== HEADER AUTH BUTTONS - Built from Scratch ===== */
    .header-auth-buttons {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .auth-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 600;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        white-space: nowrap;
    }

    .auth-btn i {
        font-size: 14px;
    }

    .auth-btn-login {
        background: transparent;
        color: #5751e1;
        border: 2px solid #5751e1;
    }

    .auth-btn-login:hover {
        background: #5751e1;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(87, 81, 225, 0.3);
    }

    .auth-btn-register,
    .auth-btn-enroll {
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        color: #ffffff;
        box-shadow: 0 2px 8px rgba(87, 81, 225, 0.2);
    }

    .auth-btn-register:hover,
    .auth-btn-enroll:hover {
        background: linear-gradient(135deg, #4a44d1 0%, #6b65ff 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(87, 81, 225, 0.4);
    }

    .auth-btn:active {
        transform: translateY(0);
    }

    @media (max-width: 991.98px) {
        .header-auth-buttons {
            gap: 8px;
        }

        .auth-btn {
            padding: 8px 16px;
            font-size: 13px;
        }

        .auth-btn i {
            font-size: 13px;
        }
    }

    @media (max-width: 767.98px) {
        .header-auth-buttons {
            gap: 6px;
        }

        .auth-btn {
            padding: 8px 14px;
            font-size: 12px;
        }

        .auth-btn span {
            display: none;
        }

        .auth-btn i {
            margin: 0;
        }
    }

    /* Enhanced User Menu Styles */
    .user-menu-trigger {
        position: relative;
    }

    .user-avatar-mini {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 24px;
        height: 24px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid #ffffff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .user-avatar-mini img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* ===== NEW USER DROPDOWN - Built from Scratch ===== */
    .user-dropdown-wrapper {
        position: relative;
    }

    .user-dropdown-menu {
        position: absolute;
        top: calc(100% + 15px);
        right: 0;
        min-width: 280px;
        width: 280px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        z-index: 999;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .user-dropdown-wrapper:hover .user-dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .user-dropdown-menu .dropdown-header {
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        padding: 16px 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #ffffff;
        font-weight: 600;
        font-size: 14px;
    }

    .user-dropdown-menu .dropdown-header i {
        font-size: 16px;
    }

    .user-dropdown-menu .dropdown-profile {
        padding: 20px;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        border-bottom: 1px solid #e9ecef;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-dropdown-menu .profile-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid #5751e1;
        flex-shrink: 0;
        box-shadow: 0 4px 15px rgba(87, 81, 225, 0.3);
    }

    .user-dropdown-menu .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .user-dropdown-menu .profile-info {
        flex: 1;
        min-width: 0;
    }

    .user-dropdown-menu .profile-name {
        font-size: 16px;
        font-weight: 700;
        color: #1a1f3a;
        margin: 0 0 4px 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .user-dropdown-menu .profile-role {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: #6c757d;
        font-weight: 500;
    }

    .user-dropdown-menu .profile-role i {
        color: #5751e1;
        font-size: 12px;
    }

    .user-dropdown-menu .dropdown-divider {
        height: 1px;
        background: #e9ecef;
        margin: 8px 0;
    }

    .user-dropdown-menu .dropdown-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 20px;
        color: #1a1f3a;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
    }

    .user-dropdown-menu .dropdown-item i:first-child {
        width: 20px;
        text-align: center;
        color: #6c757d;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .user-dropdown-menu .dropdown-item span {
        flex: 1;
    }

    .user-dropdown-menu .dropdown-item i:last-child {
        font-size: 12px;
        color: #cbd5e0;
        transition: all 0.3s ease;
        margin-left: auto;
    }

    .user-dropdown-menu .dropdown-item:hover {
        background: linear-gradient(90deg, rgba(87, 81, 225, 0.08) 0%, transparent 100%);
        color: #5751e1;
        border-left-color: #5751e1;
        padding-left: 22px;
    }

    .user-dropdown-menu .dropdown-item:hover i:first-child {
        color: #5751e1;
        transform: scale(1.1);
    }

    .user-dropdown-menu .dropdown-item:hover i:last-child {
        color: #5751e1;
        transform: translateX(3px);
    }

    .user-dropdown-menu .dropdown-item-primary {
        background: linear-gradient(135deg, rgba(87, 81, 225, 0.1) 0%, rgba(124, 118, 255, 0.05) 100%);
        border-left-color: #5751e1;
    }

    .user-dropdown-menu .dropdown-item-primary:hover {
        background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
        color: #ffffff;
    }

    .user-dropdown-menu .dropdown-item-primary:hover i {
        color: #ffffff;
    }

    .user-dropdown-menu .dropdown-item-danger {
        color: #dc3545;
    }

    .user-dropdown-menu .dropdown-item-danger i:first-child {
        color: #dc3545;
    }

    .user-dropdown-menu .dropdown-item-danger:hover {
        background: linear-gradient(90deg, rgba(220, 53, 69, 0.1) 0%, transparent 100%);
        color: #dc3545;
        border-left-color: #dc3545;
    }

    .user-dropdown-menu .dropdown-item-danger:hover i {
        color: #dc3545;
    }

    .user-dropdown-menu::before {
        content: "";
        position: absolute;
        top: -15px;
        right: 10px;
        width: 0;
        height: 0;
        border-left: 12px solid transparent;
        border-right: 12px solid transparent;
        border-bottom: 15px solid #5751e1;
    }

    @media (max-width: 991.98px) {
        .user-dropdown-menu {
            min-width: 260px;
            width: 260px;
        }

        .user-dropdown-menu .profile-name {
            font-size: 15px;
        }

        .user-dropdown-menu .dropdown-item {
            padding: 11px 18px;
            font-size: 13px;
        }
    }

    @media (max-width: 767.98px) {
        .user-dropdown-menu {
            min-width: 240px;
            width: 240px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('=== Enrollment Modal Script Loaded ===');
        
        const enrollmentModal = document.getElementById('enrollmentModal');
        const enrollmentForm = document.getElementById('enrollmentForm');
        const courseSelect = document.getElementById('enroll_course');

        console.log('Elements check:', {
            'enrollmentModal': !!enrollmentModal,
            'enrollmentForm': !!enrollmentForm,
            'courseSelect': !!courseSelect
        });

        if (!enrollmentModal) {
            console.error('ERROR: enrollmentModal element not found!');
            return;
        }
        if (!courseSelect) {
            console.error('ERROR: courseSelect element not found!');
            return;
        }

        // Load courses when modal is shown
        enrollmentModal.addEventListener('show.bs.modal', function() {
            console.log('Modal show event triggered - calling loadCourses()');
            loadCourses();
        });

        // Load courses from database
        function loadCourses() {
            console.log('=== loadCourses() function called ===');
            
            // Check if courseSelect exists
            if (!courseSelect) {
                console.error('ERROR: courseSelect element is null or undefined!');
                return;
            }
            
            console.log('Step 1: Setting loading state');
            courseSelect.innerHTML = '<option value="">{{ __("Loading courses...") }}</option>';

            const url = '{{ route("enrollment.courses") }}';
            console.log('Step 2: Fetch URL:', url);

            console.log('Step 3: Starting fetch request...');
            
            fetch(url)
                .then(response => {
                    console.log('Step 4: Response received', {
                        'status': response.status,
                        'statusText': response.statusText,
                        'ok': response.ok,
                        'headers': Object.fromEntries(response.headers.entries())
                    });

                    // Check if response is OK
                    if (!response.ok) {
                        console.error('Step 4.1: Response not OK', {
                            'status': response.status,
                            'statusText': response.statusText
                        });
                        throw new Error('Network response was not ok: ' + response.status + ' - ' + response.statusText);
                    }

                    console.log('Step 5: Parsing JSON response...');
                    return response.json();
                })
                .then(data => {
                    console.log('Step 6: JSON data parsed successfully', {
                        'data': data,
                        'hasSuccess': 'success' in data,
                        'successValue': data.success,
                        'hasCourses': 'courses' in data,
                        'coursesType': Array.isArray(data.courses) ? 'array' : typeof data.courses,
                        'coursesLength': Array.isArray(data.courses) ? data.courses.length : 'N/A'
                    });

                    console.log('Step 7: Clearing dropdown and setting default option');
                    courseSelect.innerHTML = '<option value="">{{ __("Select a course") }}</option>';

                    if (data.success && data.courses && data.courses.length > 0) {
                        console.log('Step 8: Courses found - adding to dropdown', {
                            'coursesCount': data.courses.length,
                            'courses': data.courses
                        });

                        data.courses.forEach((course, index) => {
                            console.log(`Step 8.${index + 1}: Adding course option`, {
                                'index': index,
                                'course': course,
                                'courseId': course.id,
                                'courseTitle': course.title
                            });

                            const option = document.createElement('option');
                            option.value = course.id;
                            option.textContent = course.title;
                            courseSelect.appendChild(option);
                        });
                        
                        console.log('Step 9: All courses added successfully', {
                            'totalOptions': courseSelect.options.length
                        });
                    } else {
                        console.warn('Step 8: No courses available or invalid data', {
                            'dataSuccess': data.success,
                            'hasCourses': !!data.courses,
                            'coursesLength': data.courses ? data.courses.length : 0,
                            'fullData': data
                        });
                        courseSelect.innerHTML = '<option value="">{{ __("No courses available") }}</option>';
                    }
                })
                .catch(error => {
                    console.error('=== ERROR in loadCourses() ===', {
                        'errorName': error.name,
                        'errorMessage': error.message,
                        'errorStack': error.stack,
                        'fullError': error
                    });
                    
                    courseSelect.innerHTML = '<option value="">{{ __("Error loading courses") }}</option>';
                    
                    // Show user-friendly error message
                    if (typeof toastr !== 'undefined') {
                        toastr.error('{{ __("Failed to load courses. Please try again.") }}');
                    }
                });

        }

        // Handle form submission
        enrollmentForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const submitBtn = this.querySelector('button[type="submit"]');
            const btnText = submitBtn.querySelector('.btn-text');
            const btnLoader = submitBtn.querySelector('.btn-loader');
            const originalText = btnText.textContent;

            // Show loading state
            submitBtn.disabled = true;
            btnText.textContent = '{{ __("Submitting...") }}';
            btnLoader.classList.remove('d-none');

            // Clear previous errors
            this.querySelectorAll('.is-invalid').forEach(el => {
                el.classList.remove('is-invalid');
            });
            this.querySelectorAll('.invalid-feedback').forEach(el => {
                el.textContent = '';
            });

            const formData = new FormData(this);

            fetch('{{ route("enrollment.submit") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message
                        if (typeof toastr !== 'undefined') {
                            toastr.success(data.message || '{{ __("Enrollment submitted successfully!") }}');
                        } else {
                            alert(data.message || '{{ __("Enrollment submitted successfully!") }}');
                        }

                        // Reset form
                        enrollmentForm.reset();

                        // Close modal with animation
                        setTimeout(() => {
                            const modal = bootstrap.Modal.getInstance(enrollmentModal);
                            if (modal) {
                                modal.hide();
                            }
                        }, 500);
                    } else {
                        // Show error message
                        if (data.errors) {
                            // Handle validation errors
                            Object.keys(data.errors).forEach(field => {
                                const input = document.getElementById('enroll_' + field);
                                if (input) {
                                    input.classList.add('is-invalid');
                                    const feedback = input.nextElementSibling;
                                    if (feedback && feedback.classList.contains('invalid-feedback')) {
                                        feedback.textContent = data.errors[field][0];
                                    }
                                }
                            });
                        }

                        if (typeof toastr !== 'undefined') {
                            toastr.error(data.message || '{{ __("An error occurred. Please try again.") }}');
                        } else {
                            alert(data.message || '{{ __("An error occurred. Please try again.") }}');
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    if (typeof toastr !== 'undefined') {
                        toastr.error('{{ __("An error occurred. Please try again.") }}');
                    } else {
                        alert('{{ __("An error occurred. Please try again.") }}');
                    }
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    btnText.textContent = originalText;
                    btnLoader.classList.add('d-none');
                });
        });

        // Add 3D effect on modal show
        enrollmentModal.addEventListener('shown.bs.modal', function() {
            const modalContent = this.querySelector('.enrollment-modal-content');
            if (modalContent) {
                modalContent.style.transform = 'translateZ(0) rotateX(0deg)';
            }
        });

        // Reset form when modal is hidden
        enrollmentModal.addEventListener('hidden.bs.modal', function() {
            enrollmentForm.reset();
            enrollmentForm.querySelectorAll('.is-invalid').forEach(el => {
                el.classList.remove('is-invalid');
            });
        });
    });
</script>