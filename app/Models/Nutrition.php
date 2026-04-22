<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nutrition extends Model
{
    protected $fillable = [
        'menu_id',
        'calories',
        'protein',
        'carbs',
        'fats',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
