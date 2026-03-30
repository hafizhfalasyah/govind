<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'occupation',
        'text',
        'img',
        'is_visible'
    ];

    protected $casts = [
        'is_visible' => 'boolean',
    ];

    public function scopeVisible($query) {
        return $query->where('is_visible', true);
    }
}
