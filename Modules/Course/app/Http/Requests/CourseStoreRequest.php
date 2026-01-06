<?php

namespace Modules\Course\app\Http\Requests;

use App\Rules\ValidateDiscountRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class CourseStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // dd($this);
        $rules = [
            'title' => ['required', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:255'],
            'thumbnail' => ['required', 'max:255'],
            'demo_video_source' => ['nullable', 'string'],
            'path' => ['nullable', 'string'],
            'description' => ['required', 'string', 'max:5000'],
            'instructor' => ['required', 'numeric'],
        ];

        return $rules;
    }

    function messages(): array
    {
        return [
            'title.required' => __('Title is required'),
            'title.max' => __('Title must be less than 255 characters long'),
            'seo_description.string' => __('Seo description must be a string'),
            'seo_description.max' => __('Seo description must be less than 255 characters long'),
            'thumbnail.required' => __('Thumbnail is required'),
            'thumbnail.max' => __('Thumbnail must be less than 255 characters long'),
            'demo_video_source.string' => __('Demo video source must be a string'),
            'path.string' => __('Path must be a string'),
            'description.required' => __('Description is required'),
            'description.string' => __('Description must be a string'),
            'description.max' => __('Description must be less than 5000 characters long'),
            'instructor.required' => __('Instructor is required'),
            'instructor.numeric' => __('Instructor must be a number'),
        ];
    }
}
