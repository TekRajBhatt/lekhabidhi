<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Work extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'featured_image',
        'slug',
        'publish_status',
        'display_home',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'meta_keyphrase',
        'created_by',
        'updated_by',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
