<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kitchen extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'address',
        'phone',
        'user_id'
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->name);
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function receivers()
    {
        return $this->hasMany(Receiver::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
