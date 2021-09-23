<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'name',
        'designation',
        'first_description',
        'second_description',
        'publish_status',
        'created_by',
        'updated_by',
    ];
    protected $dates  = ['deleted_at'];

    protected $guarded = [];
}
