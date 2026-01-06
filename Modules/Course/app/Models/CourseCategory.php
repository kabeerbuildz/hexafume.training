<?php

namespace Modules\Course\app\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CourseCategory extends Model {
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'slug',
        'icon',
        'status',
        'order',
        'parent_id',
    ];

    function scopeActive() {
        return $this->where(['status' => 1]);
    }
    public function getNameAttribute(): ?string {
        // Try to get translation for current session language
        if ($this->relationLoaded('translation') && $this->translation) {
            return $this->translation->name ?? null;
        }
        
        // If translation relationship is not loaded, try to load it
        $translation = $this->translation()->first();
        if ($translation && $translation->name) {
            return $translation->name;
        }
        
        // Fallback to any available translation
        if ($this->relationLoaded('translations')) {
            $firstTranslation = $this->translations->first();
            if ($firstTranslation && $firstTranslation->name) {
                return $firstTranslation->name;
            }
        }
        
        // Try to get any translation from database
        $anyTranslation = $this->translations()->first();
        if ($anyTranslation && $anyTranslation->name) {
            return $anyTranslation->name;
        }
        
        return __('Untitled Category');
    }

    public function getTranslation($code): ?CourseCategoryTranslation {
        return $this->hasOne(CourseCategoryTranslation::class)->where('lang_code', $code)->first();
    }
    public function translation(): ?HasOne {
        return $this->hasOne(CourseCategoryTranslation::class)->where('lang_code', getSessionLanguage());
    }
    public function translations(): ?HasMany {
        return $this->hasMany(CourseCategoryTranslation::class, 'course_category_id');
    }

    public function subCategories() {
        return $this->hasMany(CourseCategory::class, 'parent_id');
    }

    public function parentCategory() {
        return $this->belongsTo(CourseCategory::class, 'parent_id');
    }

    function filters(): HasMany {
        return $this->hasMany(CourseFilter::class, 'course_category_id');
    }

    public function courses() {
        return $this->hasMany(Course::class, 'category_id');
    }

    public function allCourses() {
        $subCategories = $this->subCategories()->with('courses')->get();
        $courses = $this->courses()->get();

        foreach ($subCategories as $subCategory) {
            $courses = $courses->merge($subCategory->courses);
        }

        return $courses;
    }
}
