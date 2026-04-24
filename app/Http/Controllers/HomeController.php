<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\Kitchen;
use App\Models\Menu;
use App\Models\Nutrition;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // dd(now());
        $beneficiaries = Beneficiary::where('user_id', Auth::id())->first();
        if (!$beneficiaries) {
            return view('welcome', [
                'menu' => null,
                'beneficiaries' => null,
                'todayMenu' => null,
                'feedback' => 0,
                'menuCount' => 0,
                'nutrision' => null
            ]);
        }
        $menu = Menu::where('receiver_id', $beneficiaries->receiver_id)->first();
        $todayMenu = Menu::where('receiver_id', $beneficiaries->receiver_id)
            ->whereDate('created_at', now()->toDateString())
            ->first();

        $feedback = Review::where('menu_id', optional($todayMenu)->id)->avg('rating');
        $menuCount = Review::where('menu_id', optional($todayMenu)->id)->count();
        $nutrision = Nutrition::where('menu_id', optional($todayMenu)->id)->first();
        $hasFeedback = false;

        if ($todayMenu && $beneficiaries) {
            $hasFeedback = Review::where('menu_id', $todayMenu->id)
                ->where('beneficiary_id', $beneficiaries->id)
                ->exists();
        }
        return view('welcome', compact('menu', 'beneficiaries', 'todayMenu', 'feedback', 'menuCount', 'nutrision', 'hasFeedback'));
    }
}
