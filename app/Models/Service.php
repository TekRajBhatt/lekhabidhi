<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Service extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'created_by',
        'updated_by',

    ];

    protected $dates  = ['deleted_at'];

//     public function getRouteKeyName()
// {
//     return 'slug';
// }


}
