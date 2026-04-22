<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    protected $fillable = [
        'name',
        'type',
        'address',
        'phone',
        'portion',
        'kitchen_id',
    ];

    public function kitchen()
    {
        return $this->belongsTo(Kitchen::class);
    }
    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class);
    }
}
