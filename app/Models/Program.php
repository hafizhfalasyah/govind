<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'img',
        'name',
        'slug',
        'category',
        'short_desc',
        'long_desc',
        'duration',
        'price',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price'     => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->img) {
            return asset('storage/programs/' . $this->img);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name ?: 'Program') .
            '&background=DCFCE7&color=166534&size=128';
    }
}
