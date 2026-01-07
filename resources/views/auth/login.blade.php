@extends('frontend.layouts.master')
@section('meta_title', 'Login'. ' || ' . $setting->app_name)
@section('contents')
    <style>
        .login-page-wrapper {
            min-height: 100vh;
            background: #ffffff;
            position: relative;
            padding: 80px 0;
        }
        
        .login-page-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(102, 126, 234, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(118, 75, 162, 0.03) 0%, transparent 50%);
            pointer-events: none;
        }
        
        .login-container {
            position: relative;
            z-index: 1;
        }
        
        .login-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(0, 0, 0, 0.04);
            padding: 50px 40px;
            position: relative;
            animation: slideUp 0.6s ease-out;
            border: 1px solid #f0f0f0;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
            z-index: 1;
        }
        
        .login-header .welcome-icon {
            width: 72px;
            height: 72px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            box-shadow: 0 4px 16px rgba(102, 126, 234, 0.25);
        }
        
        .login-header .welcome-icon i {
            font-size: 36px;
            color: white;
        }
        
        .login-header h2 {
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 12px;
            letter-spacing: -0.3px;
        }
        
        .login-header p {
            color: #6b7280;
            font-size: 15px;
            line-height: 1.6;
            margin: 0;
        }
        
        .account__social {
            margin-bottom: 30px;
        }
        
        .account__social-btn {
            width: 100%;
            padding: 14px 20px;
            background: #ffffff;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            font-weight: 600;
            color: #374151;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        
        .account__social-btn:hover {
            border-color: #667eea;
            background: #f8f9ff;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.1);
        }
        
        .account__divider {
            text-align: center;
            margin: 30px 0;
            position: relative;
        }
        
        .account__divider::before,
        .account__divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 45%;
            height: 1px;
            background: linear-gradient(to right, transparent, #e5e7eb, transparent);
        }
        
        .account__divider::before {
            left: 0;
        }
        
        .account__divider::after {
            right: 0;
        }
        
        .account__divider span {
            background: white;
            padding: 0 15px;
            color: #9ca3af;
            font-size: 14px;
            position: relative;
            z-index: 1;
        }
        
        .account__form {
            position: relative;
            z-index: 1;
        }
        
        .form-grp {
            margin-bottom: 24px;
        }
        
        .form-grp label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .form-grp label code {
            color: #ef4444;
            font-weight: 700;
        }
        
        .form-grp input {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.2s ease;
            background: #ffffff;
            color: #111827;
        }
        
        .form-grp input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.08);
        }
        
        .form-grp input::placeholder {
            color: #9ca3af;
        }
        
        .account__check {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .account__check-remember {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .account__check-remember input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #667eea;
            cursor: pointer;
        }
        
        .account__check-remember label {
            color: #6b7280;
            font-size: 14px;
            cursor: pointer;
            margin: 0;
        }
        
        .account__check-forgot a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .account__check-forgot a:hover {
            color: #764ba2;
            text-decoration: underline;
        }
        
        .login-submit-btn {
            width: 100%;
            padding: 14px 24px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.25);
        }
        
        .login-submit-btn:hover {
            box-shadow: 0 6px 16px rgba(102, 126, 234, 0.35);
        }
        
        .login-submit-btn:active {
            transform: translateY(1px);
        }
        
        .login-submit-btn i {
            font-size: 18px;
        }
        
        .account__switch {
            text-align: center;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 1px solid #e5e7eb;
        }
        
        .account__switch p {
            color: #6b7280;
            font-size: 14px;
            margin: 0;
        }
        
        .account__switch a {
            color: #667eea;
            text-decoration: none;
            font-weight: 700;
            margin-left: 5px;
            transition: all 0.3s ease;
        }
        
        .account__switch a:hover {
            color: #764ba2;
            text-decoration: underline;
        }
        
        @media (max-width: 768px) {
            .login-card {
                padding: 40px 30px;
                margin: 20px;
            }
            
            .login-header h2 {
                font-size: 28px;
            }
        }
    </style>

    <!-- login-area -->
    <section class="login-page-wrapper">
        <div class="container login-container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-6 col-md-8">
                    <div class="login-card">
                        <div class="login-header">
                            <div class="welcome-icon">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <h2>{{ __('Welcome back!') }}</h2>
                            <p>{{ __('Hey there! Ready to log in? Just enter your email and password below and you will be back in action in no time. Lets go!') }}</p>
                        </div>
                        
                        @if($setting->google_login_status == 'active')
                        <div class="account__social">
                            <a href="{{ route('auth.social', 'google') }}" class="account__social-btn">
                                <img src="{{ asset('frontend/img/icons/google.svg') }}" alt="Google" style="width: 20px; height: 20px;">
                                <span>{{ __('Continue with Google') }}</span>
                            </a>
                        </div>
                        <div class="account__divider">
                            <span>{{ __('or') }}</span>
                        </div>
                        @endif
                        
                        <form method="POST" action="{{ route('user-login') }}" class="account__form">
                            @csrf
                            <div class="form-grp">
                                <label for="email">
                                    <i class="fas fa-envelope" style="margin-right: 6px; color: #667eea;"></i>
                                    {{ __('Email') }} <code>*</code>
                                </label>
                                <input id="email" type="email" placeholder="{{ __('Enter your email address') }}" value="{{ old('email') }}" name="email" required autofocus>
                                <x-frontend.validation-error name="email" />
                            </div>
                            
                            <div class="form-grp">
                                <label for="password">
                                    <i class="fas fa-lock" style="margin-right: 6px; color: #667eea;"></i>
                                    {{ __('Password') }} <code>*</code>
                                </label>
                                <input id="password" type="password" placeholder="{{ __('Enter your password') }}" name="password" required>
                                <x-frontend.validation-error name="password" />
                            </div>
                            
                            <div class="account__check">
                                <div class="account__check-remember">
                                    <input type="checkbox" class="form-check-input" name="remember" value="1" id="terms-check">
                                    <label for="terms-check" class="form-check-label">{{ __('Remember me') }}</label>
                                </div>
                                <div class="account__check-forgot">
                                    <a href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
                                </div>
                            </div>
                            
                            @if (Cache::get('setting')->recaptcha_status === 'active')
                            <div class="form-grp mt-3">
                                <div class="g-recaptcha" data-sitekey="{{ Cache::get('setting')->recaptcha_site_key }}"></div>
                                <x-frontend.validation-error name="g-recaptcha-response" />
                            </div>
                            @endif
                            
                            <button type="submit" class="login-submit-btn">
                                <span>{{ __('Sign In') }}</span>
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </form>
                        
                        <div class="account__switch">
                            <p>{{ __('Don\'t have an account?') }}<a href="{{ route('register') }}">{{ __('Sign Up') }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login-area-end -->
@endsection
