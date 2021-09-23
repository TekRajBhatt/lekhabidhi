<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Website extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [

        'website_name',
        'email',
        'phone_number',
        'address',
        'logo',
        'footer_desc',
        'copyright',
        'display_home',
        'created_by',
        'updated_by',
        'meta_title',
        'meta_keyphrase',
        'meta_description',
        'meta_keyword',

    ];
    protected $dates  = ['deleted_at'];

    // protected $casts = [
    //     'features' => 'json'
    // ];
}
