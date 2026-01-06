<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FeeStructureDuration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
        'order',
        'status',
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'status' => 'boolean',
    ];

    /**
     * Get the course fee structures for this duration.
     */
    public function courseFeeStructures(): HasMany
    {
        return $this->hasMany(CourseFeeStructure::class, 'duration_id');
    }
}
