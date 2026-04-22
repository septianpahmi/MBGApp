<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    protected $fillable = [
        'receiver_id',
        'name',
        'phone',
        'address',
        'acceptance_count',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function receiver()
    {
        return $this->belongsTo(Receiver::class, 'receiver_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
