<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shape extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'bg',
        'first_bg',
        'second_bg',
        'third_bg',
        'fourth_bg',
        'fifth_bg',
        'pattern',
        'first_pattern',
        'foooter',
        'shape',
        'firt_shape',
        'second_shape',
        'third_shape',
        'fourth_shape',
        'fifth_shape',
        'sixth_shape',
        'seventh_shape',
        'eighth_shape',
        'nineth_shape',
        'publish_status',
        'created_by',
        'updated_by',
    ];
    protected $dates  = ['deleted_at'];


}
