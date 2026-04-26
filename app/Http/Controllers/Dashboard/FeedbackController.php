<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $title = "Penilaian";
        $data = Review::all();
        return view('dashboard.components.feedback.index', compact('title', 'data'));
    }

    public function detail($id)
    {
        $title = "Detail Penilaian";
        $data = Review::where('id', $id)->first();
        $feedback = Review::where('id', $id)->get();
        return view('dashboard.components.feedback.detail', compact('title', 'data', 'feedback'));
    }
}
