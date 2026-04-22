<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\Kitchen;
use App\Models\Menu;
use App\Models\Nutrition;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $beneficiaries = Beneficiary::where('user_id', auth()->id())->first();
        $menu = Menu::where('receiver_id', $beneficiaries->receiver_id)->first();
        $todayMenu = Menu::where('receiver_id', $beneficiaries->receiver_id)
            ->whereDate('created_at', now()->toDateString())
            ->first();

        $feedback = Review::where('menu_id', $todayMenu->id)->avg('rating');
        $menuCount = Review::where('menu_id', $todayMenu->id)->count();
        $nutrision = Nutrition::where('menu_id', $todayMenu->id)->first();
        return view('welcome', compact('menu', 'beneficiaries', 'todayMenu', 'feedback', 'menuCount', 'nutrision'));
    }
}
