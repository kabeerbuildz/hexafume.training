<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseFeeStructure extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'location_id',
        'duration_id',
        'course_fee',
        'registration_fee',
        'serial_number',
        'status',
    ];

    protected $casts = [
        'course_fee' => 'decimal:2',
        'registration_fee' => 'decimal:2',
        'status' => 'boolean',
    ];

    /**
     * Get the course that owns the fee structure.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the location for the fee structure.
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(FeeStructureLocation::class, 'location_id');
    }

    /**
     * Get the duration for the fee structure.
     */
    public function duration(): BelongsTo
    {
        return $this->belongsTo(FeeStructureDuration::class, 'duration_id');
    }
}
