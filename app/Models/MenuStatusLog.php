<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuStatusLog extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'menu_id',
        'status',
        'created_at',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
