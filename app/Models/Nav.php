<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nav extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category_slug',
        'position',
        'main_child',
        'parent_id',
        'header_footer'
    ];

    public function category()
    {
        return $this->belongsTo(MenuCategory::class, 'category_slug', 'slug');
    }

    protected $casts = [
        'name' => 'json',
    ];
}
