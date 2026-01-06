@php
    $footerSetting = \Modules\FooterSetting\app\Models\FooterSetting::first();
    $footer_menu_one = menu_get_by_slug('footer-col-one');
    $footer_menu_two = menu_get_by_slug('footer-col-two-1PiTN');
    $footer_menu_three = menu_get_by_slug('footer-col-three');
    $setting = Cache::get('setting');
@endphp

<footer class="skillgro-footer">
    <!-- Main Footer Content -->
    <div class="footer-main-wrapper">
        <div class="container">
            <div class="row g-4">
                <!-- Column 1: SkillGro Brand -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="footer-brand-column">
                        <a href="{{ route('home') }}" class="footer-logo-link">
                            <div class="footer-logo-wrapper">
                                <img src="{{ asset($setting?->logo) }}" alt="Logo" style="width: 200px;">
                            </div>
                           
                        </a>
                        @if($footerSetting?->footer_text)
                            <p class="footer-description">{{ $footerSetting->footer_text }}</p>
                        @else
                            <p class="footer-description">{{ __('We offer a wide range of courses in various subjects, from business and technology to art and personal development') }}</p>
                        @endif
                        
                        <div class="footer-contact-info-wrapper">
                            <div class="footer-contact-item">
                                <div class="footer-contact-icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22C12 22 19 14.25 19 9C19 5.13 15.87 2 12 2ZM12 11.5C10.62 11.5 9.5 10.38 9.5 9C9.5 7.62 10.62 6.5 12 6.5C13.38 6.5 14.5 7.62 14.5 9C14.5 10.38 13.38 11.5 12 11.5Z" fill="currentColor"/>
                                    </svg>
                                </div>
                                <p class="footer-address">DHA phase 1 islamabad inovista plaza</p>
                            </div>
                            
                            <div class="footer-contact-item">
                                <div class="footer-contact-icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20 4H4C2.9 4 2.01 4.9 2.01 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM20 8L12 13L4 8V6L12 11L20 6V8Z" fill="currentColor"/>
                                    </svg>
                                </div>
                                <a href="mailto:Courses@hexafume.com" class="footer-email">Courses@hexafume.com</a>
                            </div>
                            
                            @if($footerSetting?->phone)
                            <div class="footer-contact-item">
                                <div class="footer-contact-icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.62 10.79C8.06 13.62 10.38 15.94 13.21 17.38L15.41 15.18C15.69 14.9 16.08 14.82 16.43 14.93C17.55 15.3 18.75 15.5 20 15.5C20.55 15.5 21 15.95 21 16.5V20C21 20.55 20.55 21 20 21C10.61 21 3 13.39 3 4C3 3.45 3.45 3 4 3H7.5C8.05 3 8.5 3.45 8.5 4C8.5 5.25 8.7 6.45 9.07 7.57C9.18 7.92 9.1 8.31 8.82 8.59L6.62 10.79Z" fill="currentColor"/>
                                    </svg>
                                </div>
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $footerSetting->phone) }}" class="footer-phone">{{ $footerSetting->phone }}</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Column 2: Useful Links -->
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="footer-links-column">
                        <h4 class="footer-column-title">{{ __('Useful Links') }}</h4>
                        <ul class="footer-links-list">
                            <li><a href="{{ route('home') }}" class="footer-link">{{ __('Home') }}</a></li>
                            <li><a href="{{ route('courses') }}" class="footer-link">{{ __('Courses') }}</a></li>
                            <li><a href="{{ route('blogs') }}" class="footer-link">{{ __('Blog') }}</a></li>
                            <li><a href="{{ route('about-us') }}" class="footer-link">{{ __('About Us') }}</a></li>
                            <li><a href="{{ route('contact.index') }}" class="footer-link">{{ __('Contact') }}</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Column 3: Our Company -->
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="footer-links-column">
                        <h4 class="footer-column-title">{{ __('Our Company') }}</h4>
                        <ul class="footer-links-list">
                            <li><a href="{{ route('contact.index') }}" class="footer-link">{{ __('Contact Us') }}</a></li>
                            <li><a href="{{ route('custom-page', 'privacy-policy') }}" class="footer-link">{{ __('Privacy Policy') }}</a></li>
                            <li><a href="{{ route('custom-page', 'terms-and-conditions') }}" class="footer-link">{{ __('Terms and Conditions') }}</a></li>
                            <li><a href="{{ route('become-instructor') }}" class="footer-link">{{ __('Become Teacher') }}</a></li>
                            <li><a href="{{ route('all-instructors') }}" class="footer-link">{{ __('All Instructors') }}</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Column 4: Get In Touch -->
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <div class="footer-contact-column">
                        <h4 class="footer-column-title">{{ __('Get In Touch') }}</h4>
                        @if($footerSetting?->get_in_touch_text)
                            <p class="footer-contact-text">{{ $footerSetting->get_in_touch_text }}</p>
                        @else
                            <p class="footer-contact-text">{{ __('If you need any kind of help you can know us on socials or mail us') }}</p>
                        @endif
                        
                        <!-- Social Media Icons -->
                        @if(count(getSocialLinks()) > 0)
                        <div class="footer-social-icons">
                            @foreach (getSocialLinks() as $socialLink)
                                @php
                                    $socialName = strtolower($socialLink->name ?? '');
                                    $isFacebook = str_contains($socialName, 'facebook');
                                    $isLinkedIn = str_contains($socialName, 'linkedin');
                                    $isWhatsApp = str_contains($socialName, 'whatsapp');
                                    $isYouTube = str_contains($socialName, 'youtube');
                                @endphp
                                <a href="{{ $socialLink->link }}" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="footer-social-icon"
                                   aria-label="{{ $socialLink->name ?? 'Social Media' }}">
                                    @if($isFacebook)
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                        </svg>
                                    @elseif($isLinkedIn)
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                        </svg>
                                    @elseif($isWhatsApp)
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                        </svg>
                                    @elseif($isYouTube)
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                        </svg>
                                    @else
                                        <img src="{{ asset($socialLink->icon) }}" alt="{{ $socialLink->name ?? 'Social' }}" class="footer-social-icon-img">
                                    @endif
                                </a>
                            @endforeach
                        </div>
                        @endif

                    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom Bar -->
    <div class="footer-bottom-bar">
        <div class="container">
            <div class="footer-bottom-content">
                <div class="footer-copyright">
                    @if($setting && $setting->copyright_text)
                        <p class="copyright-text">© {{ date('Y') }} {{ $setting->copyright_text }}. {{ __('All rights reserved.') }}</p>
                    @else
                        <p class="copyright-text">© {{ date('Y') }} skillgro.com. {{ __('All rights reserved.') }}</p>
                    @endif
                </div>
                @if($footer_menu_three && count($footer_menu_three->menuItems) > 0)
                <div class="footer-legal-links">
                    @foreach ($footer_menu_three->menuItems as $index => $footerMenuThree)
                        @if($index > 0)
                            <span class="legal-separator">|</span>
                        @endif
                        <a href="{{ url($footerMenuThree?->link) }}" class="legal-link">
                            {{ $footerMenuThree?->label }}
                        </a>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</footer>

<style>
/* ============================================
   SKILLGRO FOOTER STYLES - MATCHING IMAGE DESIGN
   ============================================ */

.skillgro-footer {
    background: linear-gradient(135deg, #1a1f3a 0%, #2d3563 100%);
    position: relative;
    overflow: hidden;
}

.skillgro-footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 30%, rgba(87, 81, 225, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(124, 118, 255, 0.1) 0%, transparent 50%);
    pointer-events: none;
    z-index: 0;
}

.skillgro-footer > * {
    position: relative;
    z-index: 1;
}

/* Main Footer Wrapper */
.footer-main-wrapper {
    padding: 70px 0 50px;
}

/* Brand Column */
.footer-brand-column {
    display: flex;
    flex-direction: column;
    gap: 20px;
    position: relative;
}

.footer-brand-column::after {
    content: '';
    position: absolute;
    right: -30px;
    top: 0;
    bottom: 0;
    width: 1px;
    background: linear-gradient(180deg, transparent 0%, rgba(255, 255, 255, 0.1) 50%, transparent 100%);
}

@media (max-width: 991.98px) {
    .footer-brand-column::after {
        display: none;
    }
}

.footer-logo-link {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    transition: transform 0.3s ease;
}

.footer-logo-link:hover {
    transform: translateY(-2px);
}

.footer-logo-wrapper {
    position: relative;
}

.footer-logo-text {
    display: flex;
    flex-direction: column;
}

.footer-logo-title {
    font-size: 28px;
    font-weight: 700;
    color: #ffffff;
    margin: 0;
    line-height: 1.2;
}

.footer-logo-tagline {
    font-size: 12px;
    font-weight: 500;
    color: rgba(255, 255, 255, 0.8);
    margin: 0;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.footer-description {
    color: rgba(255, 255, 255, 0.8);
    font-size: 14px;
    line-height: 1.7;
    margin: 0;
}

.footer-contact-info-wrapper {
    margin-top: 20px;
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.footer-contact-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.footer-contact-item:hover {
    background: rgba(255, 255, 255, 0.08);
    border-color: rgba(87, 81, 225, 0.3);
    transform: translateX(4px);
}

.footer-contact-icon {
    width: 40px;
    height: 40px;
    min-width: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, rgba(87, 81, 225, 0.2) 0%, rgba(124, 118, 255, 0.1) 100%);
    border-radius: 8px;
    color: #5751e1;
    transition: all 0.3s ease;
}

.footer-contact-item:hover .footer-contact-icon {
    background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
    color: #ffffff;
    transform: scale(1.1);
}

.footer-contact-icon svg {
    width: 18px;
    height: 18px;
}

.footer-address,
.footer-phone,
.footer-email {
    color: rgba(255, 255, 255, 0.9);
    font-size: 14px;
    text-decoration: none;
    display: block;
    line-height: 1.6;
    flex: 1;
    transition: color 0.3s ease;
    font-weight: 500;
}

.footer-phone:hover,
.footer-email:hover {
    color: #7c76ff;
}

.footer-address {
    margin: 0;
}

/* Links Columns */
.footer-links-column,
.footer-contact-column {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.footer-column-title {
    font-size: 18px;
    font-weight: 700;
    color: #ffffff;
    margin: 0;
    padding-bottom: 12px;
    position: relative;
    border-bottom: 2px solid rgba(87, 81, 225, 0.3);
}

.footer-column-title::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 50px;
    height: 2px;
    background: linear-gradient(90deg, #5751e1 0%, #7c76ff 100%);
}

.footer-links-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.footer-link {
    color: rgba(255, 255, 255, 0.8);
    font-size: 15px;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-block;
    position: relative;
    padding-left: 0;
}

.footer-link::before {
    content: '';
    position: absolute;
    left: -15px;
    top: 50%;
    transform: translateY(-50%);
    width: 0;
    height: 2px;
    background: #5751e1;
    transition: width 0.3s ease;
}

.footer-link:hover {
    color: #ffffff;
    padding-left: 15px;
}

.footer-link:hover::before {
    width: 8px;
}

/* Contact Column */
.footer-contact-text {
    color: rgba(255, 255, 255, 0.8);
    font-size: 14px;
    line-height: 1.7;
    margin: 0;
}

/* Social Icons */
.footer-social-icons {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin-top: 8px;
}

.footer-social-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    color: #ffffff;
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.footer-social-icon::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, #5751e1 0%, #7c76ff 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.footer-social-icon:hover {
    transform: translateY(-3px);
    border-color: #5751e1;
    box-shadow: 0 6px 20px rgba(87, 81, 225, 0.4);
}

.footer-social-icon:hover::before {
    opacity: 1;
}

.footer-social-icon svg,
.footer-social-icon-img {
    width: 20px;
    height: 20px;
    position: relative;
    z-index: 1;
    transition: filter 0.3s ease;
}

.footer-social-icon-img {
    filter: brightness(0) invert(1);
}

.footer-social-icon:hover svg,
.footer-social-icon:hover .footer-social-icon-img {
    filter: brightness(0) invert(1);
}

/* App Store Buttons */
.footer-app-buttons {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-top: 16px;
}

.app-store-btn {
    display: flex;
    align-items: center;
    padding: 12px 16px;
    background: rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    color: #ffffff;
    font-size: 12px;
}

.app-store-btn:hover {
    background: rgba(0, 0, 0, 0.5);
    border-color: rgba(87, 81, 225, 0.5);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(87, 81, 225, 0.3);
}

.app-store-btn svg {
    flex-shrink: 0;
}

.app-store-btn span {
    display: block;
    font-size: 10px;
    opacity: 0.8;
    line-height: 1.2;
}

.app-store-btn strong {
    display: block;
    font-size: 14px;
    font-weight: 600;
    line-height: 1.2;
}

/* Footer Bottom Bar */
.footer-bottom-bar {
    padding: 25px 0;
    background: rgba(0, 0, 0, 0.3);
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.footer-bottom-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
}

.copyright-text {
    color: rgba(255, 255, 255, 0.7);
    font-size: 14px;
    margin: 0;
}

.footer-legal-links {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

.legal-separator {
    color: rgba(255, 255, 255, 0.4);
    font-size: 14px;
}

.legal-link {
    color: rgba(255, 255, 255, 0.7);
    font-size: 14px;
    text-decoration: none;
    transition: color 0.3s ease;
    position: relative;
}

.legal-link::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 1px;
    background: #5751e1;
    transition: width 0.3s ease;
}

.legal-link:hover {
    color: #ffffff;
}

.legal-link:hover::after {
    width: 100%;
}

/* ============================================
   RESPONSIVE DESIGN
   ============================================ */

@media (max-width: 991.98px) {
    .footer-main-wrapper {
        padding: 50px 0 40px;
    }
    
    .footer-logo-title {
        font-size: 24px;
    }
    
    .footer-column-title {
        font-size: 16px;
    }
}

@media (max-width: 767.98px) {
    .footer-main-wrapper {
        padding: 40px 0 30px;
    }
    
    .footer-logo-link {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
    
    .footer-logo-title {
        font-size: 22px;
    }
    
    .footer-bottom-content {
        flex-direction: column;
        text-align: center;
    }
    
    .footer-legal-links {
        justify-content: center;
    }
    
    .footer-app-buttons {
        flex-direction: row;
    }
    
    .app-store-btn {
        flex: 1;
        justify-content: center;
    }
    
    .footer-contact-info-wrapper {
        margin-top: 16px;
        gap: 12px;
    }
    
    .footer-contact-item {
        padding: 10px;
    }
    
    .footer-contact-icon {
        width: 36px;
        height: 36px;
        min-width: 36px;
    }
    
    .footer-contact-icon svg {
        width: 16px;
        height: 16px;
    }
    
    .footer-address,
    .footer-phone,
    .footer-email {
        font-size: 13px;
    }
}

@media (max-width: 575.98px) {
    .footer-app-buttons {
        flex-direction: column;
    }
    
    .app-store-btn {
        width: 100%;
    }
}
</style>