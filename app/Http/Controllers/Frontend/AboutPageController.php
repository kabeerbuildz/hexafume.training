<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\Brand\app\Models\Brand;
use Modules\Faq\app\Models\Faq;
use Modules\Frontend\app\Models\Section;
use Modules\Testimonial\app\Models\Testimonial;

class AboutPageController extends Controller {
    function index(): View {
        $theme_name = Session::has('demo_theme') ? Session::get('demo_theme') : DEFAULT_HOMEPAGE;

        // Cache sections for 1 hour (same as homepage)
        $sections = Cache::remember("homepage_sections_{$theme_name}", 3600, function () use ($theme_name) {
            return Section::whereHas("home", function ($q) use ($theme_name) {
                $q->where('slug', $theme_name);
            })->get();
        });

        $hero = $sections->where('name', 'hero_section')->first();
        $aboutSection = $sections->where('name', 'about_section')->first();
        $ourFeatures = $sections->where('name', 'our_features_section')->first();
        $newsletterSection = $sections->where('name', 'newsletter_section')->first();
        $faqSection = $sections->where('name', 'faq_section')->first();

        // Cache brands for 1 hour (shared with homepage and partners page)
        $brands = Cache::remember('active_brands', 3600, function () {
            return Brand::where('status', 1)
                ->select('id', 'name', 'image', 'url', 'created_at')
                ->get()
                ->filter(function ($brand) {
                    if (empty($brand->image)) {
                        return false;
                    }
                    return File::exists(public_path($brand->image));
                })
                ->values();
        });

        // Cache testimonials for 1 hour (limited to active ones)
        $reviews = Cache::remember('about_page_testimonials', 3600, function () {
            return Testimonial::select('id', 'image', 'rating', 'status', 'created_at')
                ->with('translation')
                ->where('status', 1)
                ->orderBy('created_at', 'desc')
                ->limit(20)
                ->get();
        });

        // Cache FAQs for 1 hour (shared with homepage)
        $faqs = Cache::remember('homepage_faqs', 3600, function () {
            return Faq::with('translation')->where('status', 1)->get();
        });

        return view('frontend.pages.about-us', compact('aboutSection',  'ourFeatures', 'newsletterSection', 'hero', 'brands', 'reviews', 'faqSection', 'faqs'));
    }
}
