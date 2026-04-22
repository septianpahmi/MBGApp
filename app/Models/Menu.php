<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Menu extends Model
{
    protected $fillable = [
        'kitchen_id',
        'image',
        'title',
        'slug',
        'description',
        'date',
        'portion',
        'status',
        'receiver_id'
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->title);
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->title);
        });
    }

    public function receiver()
    {
        return $this->belongsTo(Receiver::class, 'receiver_id');
    }
    public function kitchen()
    {
        return $this->belongsTo(Kitchen::class, 'kitchen_id');
    }
    public function nutrition()
    {
        return $this->hasOne(Nutrition::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function logs()
    {
        return $this->hasMany(MenuStatusLog::class);
    }
}
