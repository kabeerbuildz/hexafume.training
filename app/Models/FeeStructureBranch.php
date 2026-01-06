<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeStructureBranch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tag',
        'address',
        'icon_color',
        'icon',
        'link',
        'order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
