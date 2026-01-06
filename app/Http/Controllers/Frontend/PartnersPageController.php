<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use Modules\Brand\app\Models\Brand;

class PartnersPageController extends Controller
{
    function index(): View
    {
        // Cache partners for 1 hour to improve performance
        $partners = Cache::remember('active_partners', 3600, function () {
            return Brand::where('status', 1)
                ->select('id', 'name', 'image', 'url', 'created_at')
                ->orderBy('created_at', 'desc')
                ->get()
                ->filter(function ($partner) {
                    // Filter out partners with invalid/missing images
                    if (empty($partner->image)) {
                        return false;
                    }
                    $imagePath = public_path($partner->image);
                    return File::exists($imagePath);
                })
                ->values(); // Re-index the collection
        });
        
        return view('frontend.pages.our-partners', compact('partners'));
    }
}



