<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Application extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();
        static::created(function ($item) {
            $item->verificationCode = Str::random(20);
            $item->save();
        });
    }

    public function verifyCareer()
    {
        $this->verificationCode = null;
        $this->verified = true;
        $this->save();
    }

    public function career()
    {
        return $this->belongsTo(Career::class, 'careerId', 'id');
    }
}
