<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Team extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'job_title',
        'email',
        'phone_number',
        'address',
        'description',
        'image',
        'facebook',
        'whatsapp',
        'twitter',
        'youtube',
        'linkedin',
        'publish_status',
        'display_home',
        'created_by',
        'updated_by',
        'meta_title',
        'meta_keyphrase',
        'meta_description',
        'meta_keyword',
    ];
    protected $dates  = ['deleted_at'];


}
