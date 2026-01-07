<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\ThemeList;
use App\Http\Controllers\Controller;
use App\Jobs\DefaultMailJob;
use App\Mail\DefaultMail;
use App\Models\Course;
use App\Models\User;
use App\Models\UserEducation;
use App\Models\UserExperience;
use App\Rules\CustomRecaptcha;
use App\Traits\MailSenderTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\Badges\app\Models\Badge;
use Modules\Blog\app\Models\Blog;
use Modules\Brand\app\Models\Brand;
use Modules\Course\app\Models\CourseCategory;
use Modules\Faq\app\Models\Faq;
use Modules\Frontend\app\Models\FeaturedCourseSection;
use Modules\Frontend\app\Models\FeaturedInstructor;
use Modules\Frontend\app\Models\Section;
use Modules\GlobalSetting\app\Models\EmailTemplate;
use Modules\Location\app\Models\City;
use Modules\Location\app\Models\Country;
use Modules\Location\app\Models\State;
use Modules\PageBuilder\app\Models\CustomPage;
use Modules\SiteAppearance\app\Models\SectionSetting;
use Modules\Testimonial\app\Models\Testimonial;

class HomePageController extends Controller {
    use MailSenderTrait;

    function index(): View {
        $theme_name = Session::has('demo_theme') ? Session::get('demo_theme') : DEFAULT_HOMEPAGE;
        
        // Sections query - Cache removed as requested
        $sections = Section::whereHas("home", function ($q) use ($theme_name) {
                $q->where('slug', $theme_name);
            })->get();
        // Only fetch sections needed for images (content is now static)
        $hero = $sections->where('name', 'hero_section')->first();
        $slider = $sections->where('name', 'slider_section')->first();
        $aboutSection = $sections->where('name', 'about_section')->first();
        $newsletterSection = $sections->where('name', 'newsletter_section')->first();
        $counter = $sections->where('name', 'counter_section')->first();
        $ourFeatures = $sections->where('name', 'our_features_section')->first();
        $bannerSection = $sections->where('name', 'banner_section')->first();
        $faqSection = $sections->where('name', 'faq_section')->first();

        // Cache FAQs for 2 hours
            $faqs =  Faq::select('id', 'status')
                ->with('translation:id,faq_id,question,answer')
                ->where('status', 1)
                ->limit(5)
                ->get();
    

        // Trending categories query - Cache removed as requested
        $trendingCategories = CourseCategory::select('id', 'parent_id', 'status', 'show_at_trending')
            ->with(['translation:id,name,course_category_id', 'subCategories' => function ($query) {
                $query->select('id', 'parent_id', 'status')
                    ->withCount(['courses' => function ($query) {
                        $query->where('status', 'active');
                    }]);
            }])->withCount(['subCategories as active_sub_categories_count' => function ($query) {
                $query->whereHas('courses', function ($query) {
                    $query->where('status', 'active');
                });
            }])->whereNull('parent_id')
            ->where('status', 1)
            ->where('show_at_trending', 1)
            ->limit(10)
            ->get();

            // dd($trendingCategories);

        // Brands query - Cache removed as requested
        $brands = Brand::where('status', 1)
            ->whereNotNull('image')
            ->where('image', '!=', '')
            ->select('id', 'name', 'image', 'url', 'created_at')
            ->get()
            ->filter(function ($brand) {
                return File::exists(public_path($brand->image));
            })
            ->values();

        // // Cache featured course section for 2 hours
        $featuredCourse = FeaturedCourseSection::first();
        

        // // Cache featured instructor section for 2 hours
        $featuredInstructorSection =  FeaturedInstructor::first();
       
        
        $instructorIds = $featuredInstructorSection ? json_decode($featuredInstructorSection->instructor_ids ?? '[]') : [];

        // // Cache selected instructors for 2 hours
        $selectedInstructors =  User::whereIn('id', $instructorIds)
                ->select('id', 'name', 'image', 'job_title', 'short_bio', 'facebook', 'twitter', 'linkedin', 'github')
                ->with(['courses' => function ($query) {
                    $query->select('id', 'instructor_id')
                        ->withCount(['reviews as avg_rating' => function ($query) {
                            $query->select(DB::raw('coalesce(avg(rating),0)'));
                        }])
                        ->limit(5);
                }])
                ->limit(10)
                ->get();
       

        // // Cache testimonials for 2 hours
        $testimonials =  Testimonial::select('id', 'image', 'rating', 'status', 'created_at')
                ->with('translation:id,testimonial_id,name,designation,comment')
                ->where('status', 1)
                ->orderBy('created_at', 'desc')
                ->limit(8)
                ->get();
        

        // // Cache featured blogs for 1 hour (more dynamic content)
        $featuredBlogs = Blog::with(['translation:id,blog_id,title,description', 'author:id,name'])
                ->select('id', 'admin_id', 'blog_category_id', 'slug', 'image', 'show_homepage', 'status', 'created_at')
                ->whereHas('category', function ($q) {
                    $q->where('status', 1);
                })
                ->where(['show_homepage' => 1, 'status' => 1])
                ->orderBy('created_at', 'desc')
                ->limit(4)
                ->get();
        
        
        // Section setting query - Cache removed as requested
        $sectionSetting = SectionSetting::first();
        
        // Course data query - Simple courses fetch
        $courseData = [];
        $allCoursesQuery = Course::active()
            ->select('id', 'title', 'slug', 'thumbnail', 'category_id', 'instructor_id', 'capacity', 'status', 'is_approved');
        
        // If logged-in user is an instructor, show only their assigned courses
        if (auth()->guard('web')->check() && userAuth()->role === 'instructor') {
            $instructorId = userAuth()->id;
            $allCoursesQuery->where(function($q) use ($instructorId) {
                $q->where('instructor_id', $instructorId)
                  ->orWhereHas('partnerInstructors', function($q) use ($instructorId) {
                      $q->where('instructor_id', $instructorId);
                  });
            });
        }
        
        $courseData['allCourses'] = $allCoursesQuery
            ->with([
                'favoriteBy' => function($q) {
                    if (auth()->guard('web')->check()) {
                        $q->where('user_id', userAuth()->id);
                    }
                },
                'category:id,parent_id',
                'category.translation:id,course_category_id,name',
                'instructor:id,name',
                'courseFeeStructures' => function($q) {
                    $q->where('status', 1)->select('course_id', 'course_fee');
                }
            ])
            ->withCount([
                'reviews as avg_rating' => function ($query) {
                    $query->select(DB::raw('coalesce(avg(rating), 0)'));
                },
            ])
            ->withCount('enrollments')
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();

       
        if (auth()->guard('web')->check()) {
            $userId = userAuth()->id;
            $allCourseIds = collect();
            
            // Collect all course IDs from courseData
            foreach ($courseData as $key => $value) {
                if (strpos($key, 'Courses') !== false && is_iterable($value) && $value instanceof \Illuminate\Support\Collection) {
                    $allCourseIds = $allCourseIds->merge($value->pluck('id'));
                }
            }
            
            if ($allCourseIds->isNotEmpty()) {
                // Single query to get all favorites
                $favorites = DB::table('favorite_course_user')
                    ->where('user_id', $userId)
                    ->whereIn('course_id', $allCourseIds->unique()->values()->all())
                    ->pluck('course_id')
                    ->toArray();
                
                // Add favoriteBy relationship to each course collection
                foreach ($courseData as $key => $value) {
                    if (strpos($key, 'Courses') !== false && is_iterable($value) && $value instanceof \Illuminate\Support\Collection) {
                        $value->each(function($course) use ($favorites, $userId) {
                            if (in_array($course->id, $favorites)) {
                                $course->setRelation('favoriteBy', collect([(object)['id' => $userId]]));
                            } else {
                                $course->setRelation('favoriteBy', collect([]));
                            }
                        });
                    }
                }
            }
        }

        $viewPath = 'frontend.home.' . $theme_name . '.index';

        return view($viewPath, compact(
            'hero',
            'trendingCategories',
            'slider',
            'brands',
            'aboutSection',
            'featuredCourse',   
            'newsletterSection',
            'featuredInstructorSection',
            'selectedInstructors',
            'counter',
            'faqSection',
            'faqs',
            'testimonials',
            'ourFeatures',
            'bannerSection',
            'featuredBlogs',
            'sectionSetting',
            'courseData'
        ));
    }
    

    function countries(): JsonResponse {
        $countries = Country::where('status', 1)->get();
        return response()->json($countries);
    }

    function states(string $id): JsonResponse {
        $states = State::where(['country_id' => $id, 'status' => 1])->get();
        return response()->json($states);
    }

    function cities(string $id): JsonResponse {
        $cities = City::where(['state_id' => $id, 'status' => 1])->get();
        return response()->json($cities);
    }

    public function setCurrency() {
        $currency = allCurrencies()->where('currency_code', request('currency'))->first();
        if (session()->has('currency_code')) {
            session()->forget('currency_code');
            session()->forget('currency_position');
            session()->forget('currency_icon');
            session()->forget('currency_rate');
        }
        if ($currency) {
            session()->put('currency_code', $currency->currency_code);
            session()->put('currency_position', $currency->currency_position);
            session()->put('currency_icon', $currency->currency_icon);
            session()->put('currency_rate', $currency->currency_rate);

            $notification = __('Currency Changed Successfully');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];

            return redirect()->back()->with($notification);
        }
        getSessionCurrency();
        $notification = __('Currency Changed Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    /**
     * Get courses for enrollment dropdown
     */
    public function getEnrollmentCourses(): JsonResponse
    {
        try {
            $courses = Course::active()
                ->select('id', 'title')
                ->orderBy('title', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'courses' => $courses
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching enrollment courses: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'courses' => []
            ], 500);
        }
    }

    /**
     * Submit enrollment form
     */
    public function submitEnrollment(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'contact' => ['required', 'string', 'max:50'],
                'course_id' => ['required', 'exists:courses,id'],
                'comment' => ['nullable', 'string', 'max:1000'],
            ], [
                'name.required' => __('Name is required'),
                'email.required' => __('Email is required'),
                'email.email' => __('Please enter a valid email address'),
                'contact.required' => __('Contact number is required'),
                'course_id.required' => __('Please select a course'),
                'course_id.exists' => __('Selected course does not exist'),
            ]);

            // Check if course exists and is active
            $course = Course::active()->where('id', $request->course_id)->first();
            
            if (!$course) {
                return response()->json([
                    'success' => false,
                    'message' => __('Selected course is not available')
                ], 422);
            }

            // Create enrollment record using ContactMessage model (or create a new Enrollment model)
            $enrollment = new \Modules\ContactMessage\app\Models\ContactMessage();
            $enrollment->name = $validated['name'];
            $enrollment->email = $validated['email'];
            $enrollment->phone = $validated['contact'];
            $enrollment->subject = __('Enrollment Request') . ' - ' . $course->title;
            $enrollment->message = __('Course Enrollment Request') . "\n\n" . 
                                  __('Course') . ': ' . $course->title . "\n" .
                                  __('Comment') . ': ' . ($validated['comment'] ?? __('No comment'));
            $enrollment->save();

            // Optionally send email notification
            try {
                $setting = Cache::get('setting');
                if ($setting && $setting->contact_message_receiver_mail) {
                    $emailSubject = __('New Enrollment Request') . ' - ' . $course->title;
                    $emailMessage = __('Name') . ': ' . $validated['name'] . "\n" .
                                   __('Email') . ': ' . $validated['email'] . "\n" .
                                   __('Contact') . ': ' . $validated['contact'] . "\n" .
                                   __('Course') . ': ' . $course->title . "\n" .
                                   __('Comment') . ': ' . ($validated['comment'] ?? __('No comment'));
                    
                    // Prepare mailData array as expected by DefaultMail
                    $mailData = [
                        'subject' => $emailSubject,
                        'email' => $setting->contact_message_receiver_mail,
                        'name' => $validated['name'],
                    ];
                    
                    Mail::to($setting->contact_message_receiver_mail)->send(new DefaultMail($mailData, $emailMessage));
                }
            } catch (\Exception $e) {
                Log::error('Error sending enrollment email: ' . $e->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => __('Your enrollment request has been submitted successfully. We will contact you soon.')
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => __('Validation failed'),
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error submitting enrollment: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => __('An error occurred. Please try again later.')
            ], 500);
        }
    }

    function instructorDetails(string $id) {
        User::where(['status' => 'active', 'is_banned' => 0, 'id' => $id])->first();
        $instructor = User::where(['status' => 'active', 'is_banned' => 0, 'id' => $id])->with(['courses' => function ($query) {
            $query->withCount(['reviews as avg_rating' => function ($query) {
                $query->select(DB::raw('coalesce(avg(rating),0)'));
            }]);
        }])
            ->firstOrFail();
        $experiences = UserExperience::where(['user_id' => $id])->get();
        $educations = UserEducation::where(['user_id' => $id])->get();
        $courses = Course::active()->where(['instructor_id' => $id])
            ->with(['courseFeeStructures' => function($q) {
                $q->where('status', 1);
            }])
            ->orderBy('id', 'desc')->get();
        $badges = Badge::where(['status' => 1])->get()->groupBy('key');
        return view('frontend.pages.instructor-details', compact('instructor', 'experiences', 'educations', 'courses', 'badges'));
    }

    function allInstructors() {
        $instructors = User::where(['status' => 'active', 'is_banned' => 0, 'role' => 'instructor'])
            ->withCount('courses as course_count')
            ->with(['courses' => function ($query) {
                $query->withCount(['reviews as avg_rating' => function ($query) {
                    $query->select(DB::raw('coalesce(avg(rating),0)'));
                }]);
            }])
            ->orderByDesc('course_count')
            ->paginate(18);

        return view('frontend.pages.all-instructors', compact('instructors'));
    }

    function allPrograms() {
        $query = Course::active()
            ->whereHas('category', function($q) {
                $q->where('status', 1);
            })
            ->with([
                'instructor', 
                'category.translation', 
                'reviews', 
                'enrollments',
                'courseFeeStructures' => function($q) {
                    $q->where('status', 1);
                }
            ]);
        
        // Load favoriteBy relationship if user is authenticated
        if (auth()->guard('web')->check()) {
            $query->with(['favoriteBy' => function($q) {
                $q->where('user_id', userAuth()->id);
            }]);
        }
        
        $programs = $query
            ->withCount(['reviews as avg_rating' => function ($query) {
                $query->select(DB::raw('coalesce(avg(rating),0)'));
            }])
            ->withCount('reviews as review_count')
            ->orderByDesc('created_at')
            ->paginate(12);

        return view('frontend.pages.all-programs', compact('programs'));
    }

    function trainingSchedule(): View {
        return view('frontend.pages.training-schedule');
    }

    function feeStructure(): View {
        $locations = \App\Models\FeeStructureLocation::where('status', 1)->orderBy('order')->orderBy('name')->get();
        $durations = \App\Models\FeeStructureDuration::where('status', 1)->orderBy('order')->orderBy('value')->get();
        $branches = \App\Models\FeeStructureBranch::where('status', 1)->orderBy('order')->orderBy('name')->get();
        
        // Dynamic stats for hero section
        $totalCourses = \App\Models\Course::active()->count();
        $totalLocations = $locations->count();
        
        return view('frontend.pages.fee-structure', compact('locations', 'durations', 'branches', 'totalCourses', 'totalLocations'));
    }

    function getFeeStructureData(Request $request) {
        try {
            $request->validate([
                'location_id' => 'required|exists:fee_structure_locations,id',
                'duration_id' => 'required|exists:fee_structure_durations,id',
            ]);

            // Get fee structures and ensure course exists in courses table
            $feeStructures = \App\Models\CourseFeeStructure::with(['course' => function($query) {
                $query->select('id', 'title', 'status', 'is_approved')
                      ->where('status', 'active')
                      ->where('is_approved', 'approved');
            }])
                ->where('location_id', $request->location_id)
                ->where('duration_id', $request->duration_id)
                ->where('status', 1)
                ->whereHas('course', function($query) {
                    // Ensure course exists in courses table and is active/approved
                    $query->where('status', 'active')
                          ->where('is_approved', 'approved');
                })
                ->whereNotNull('course_id') // Ensure course_id is not null
                ->orderBy('serial_number')
                ->orderBy('id')
                ->get();

            $courses = $feeStructures->filter(function($item) {
                return $item->course !== null; // Filter out any null courses
            })->map(function($item, $index) {
                return [
                    'serial' => $item->serial_number ?: ($index + 1),
                    'name' => $item->course->title ?? 'Unknown Course',
                    'fee' => (float)$item->course_fee,
                    'regFee' => (float)$item->registration_fee,
                ];
            })->values();

            return response()->json([
                'success' => true,
                'courses' => $courses,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in getFeeStructureData: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'courses' => [],
                'message' => 'Error loading fee structure data'
            ], 500);
        }
    }

    function downloadFeeStructure(Request $request)
    {
        try {
            $request->validate([
                'location_id' => 'required|exists:fee_structure_locations,id',
                'duration_id' => 'required|exists:fee_structure_durations,id',
            ]);

            // Get location and duration names for filename
            $location = \App\Models\FeeStructureLocation::find($request->location_id);
            $duration = \App\Models\FeeStructureDuration::find($request->duration_id);
            
            $locationName = $location ? str_replace(' ', '_', $location->name) : 'Location';
            $durationName = $duration ? str_replace(' ', '_', $duration->name) : 'Duration';

            // Get fee structures - same logic as getFeeStructureData
            $feeStructures = \App\Models\CourseFeeStructure::with(['course' => function($query) {
                $query->select('id', 'title', 'status', 'is_approved')
                      ->where('status', 'active')
                      ->where('is_approved', 'approved');
            }])
                ->where('location_id', $request->location_id)
                ->where('duration_id', $request->duration_id)
                ->where('status', 1)
                ->whereHas('course', function($query) {
                    $query->where('status', 'active')
                          ->where('is_approved', 'approved');
                })
                ->whereNotNull('course_id')
                ->orderBy('serial_number')
                ->orderBy('id')
                ->get();

            // Get currency settings
            $currencyIcon = session('currency_icon', 'Rs');
            $currencyPosition = session('currency_position', 'before');

            // Prepare CSV data
            $fileName = 'Fee_Structure_' . $locationName . '_' . $durationName . '_' . date('Y-m-d') . '.csv';
            
            $headers = [
                'Content-Type' => 'text/csv; charset=UTF-8',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Pragma' => 'no-cache',
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                'Expires' => '0'
            ];

            $callback = function() use ($feeStructures, $currencyIcon, $currencyPosition) {
                $file = fopen('php://output', 'w');
                
                // Add BOM for UTF-8
                fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
                
                // CSV Headers
                fputcsv($file, [
                    __('SERIAL NO'),
                    __('COURSE NAME'),
                    __('COURSE FEE'),
                    __('REGISTRATION FEE')
                ]);

                // Add data rows
                foreach ($feeStructures as $index => $item) {
                    if ($item->course === null) {
                        continue; // Skip null courses
                    }

                    $serial = $item->serial_number ?: ($index + 1);
                    $courseName = $item->course->title ?? 'Unknown Course';
                    
                    // Format fees with currency
                    $courseFee = (float)$item->course_fee;
                    $regFee = (float)$item->registration_fee;
                    
                    if ($courseFee == 0) {
                        $courseFeeFormatted = __('Free');
                    } else {
                        $formattedAmount = number_format($courseFee, 2);
                        $courseFeeFormatted = $currencyPosition === 'before' 
                            ? $currencyIcon . ' ' . $formattedAmount 
                            : $formattedAmount . ' ' . $currencyIcon;
                    }
                    
                    if ($regFee == 0) {
                        $regFeeFormatted = __('Free');
                    } else {
                        $formattedAmount = number_format($regFee, 2);
                        $regFeeFormatted = $currencyPosition === 'before' 
                            ? $currencyIcon . ' ' . $formattedAmount 
                            : $formattedAmount . ' ' . $currencyIcon;
                    }

                    fputcsv($file, [
                        $serial,
                        $courseName,
                        $courseFeeFormatted,
                        $regFeeFormatted
                    ]);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        } catch (\Exception $e) {
            \Log::error('Error in downloadFeeStructure: ' . $e->getMessage());
            return back()->with('error', __('Error generating download file. Please try again.'));
        }
    }

    function quickConnect(Request $request, string $id) {
        $validated = $request->validate([
            'name'                 => ['required', 'string', 'max:255'],
            'email'                => ['required', 'string', 'email', 'max:255'],
            'subject'              => ['required', 'string', 'max:255'],
            'message'              => ['required', 'string', 'max:1000'],
            'g-recaptcha-response' => Cache::get('setting')->recaptcha_status == 'active' ? ['required', new CustomRecaptcha()] : 'nullable',
        ]);

        $settings = cache()->get('setting');
        $marketingSettings = cache()->get('marketing_setting');
        if ($settings->google_tagmanager_status == 'active' && $marketingSettings->instructor_contact) {
            $instructor_contact = [
                'name'    => $request->name,
                'email'   => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
            ];
            session()->put('instructorQuickContact', $instructor_contact);
        }

        $this->handleMailSending($validated);
        return redirect()->back()->with(['messege' => __('Message sent successfully'), 'alert-type' => 'success']);
    }

    function handleMailSending(array $mailData) {
        self::setMailConfig();

        // Get email template
        $template = EmailTemplate::where('name', 'instructor_quick_contact')->firstOrFail();

        // Prepare email content
        $message = str_replace('{{name}}', $mailData['name'], $template->message);
        $message = str_replace('{{email}}', $mailData['email'], $message);
        $message = str_replace('{{subject}}', $mailData['subject'], $message);
        $message = str_replace('{{message}}', $mailData['message'], $message);

        if (self::isQueable()) {
            DefaultMailJob::dispatch($mailData['email'], $mailData, $message);
        } else {
            Mail::to($mailData['email'])->send(new DefaultMail($mailData, $message));
        }
    }

    function customPage(string $slug) {
        $page = CustomPage::where('slug', $slug)->firstOrFail();
        return view('frontend.pages.custom-page', compact('page'));
    }

    function changeTheme(string $theme) {
        if (Cache::get('setting')?->show_all_homepage != 1) {
            abort(404);
        }

        foreach (ThemeList::cases() as $enumTheme) {
            if ($theme == $enumTheme->value) {
                Session::put('demo_theme', $enumTheme->value);
                break;
            }
        }
        return redirect('/');
    }
}
