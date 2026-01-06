<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FeeStructureLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'order',
        'status',
    ];

    /**
     * Get the course fee structures for this location.
     */
    public function courseFeeStructures(): HasMany
    {
        return $this->hasMany(CourseFeeStructure::class, 'location_id');
    }

    /**
     * Get the courses for this location.
     */
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'location_id');
    }
}
