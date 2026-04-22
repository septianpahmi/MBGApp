<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Kitchen;
use App\Models\Menu;
use App\Models\MenuStatusLog;
use App\Models\Nutrition;
use App\Models\Receiver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index()
    {
        $title = 'Menu';
        $data = Menu::whereHas('kitchen', function ($query) {
            $query->where('user_id', Auth::id());
        })->with('receiver')->latest()->get();
        return view('dashboard.components.menu.index', compact('title', 'data'));
    }

    public function create()
    {
        $title = 'Tambah Menu';
        $receivers = Receiver::all();
        return view('dashboard.components.menu.create', compact('title', 'receivers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required',
            'title' => 'required',
            'date' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:5120',
            'description' => 'nullable',
            'calories' => 'nullable|numeric',
            'protein' => 'nullable|numeric',
            'carbs' => 'nullable|numeric',
            'fats' => 'nullable|numeric',
        ]);
        $user = Kitchen::where('user_id', Auth::id())->firstOrFail();
        $receiver = Receiver::with('beneficiaries')
            ->findOrFail($request->receiver_id);

        $total = $receiver->beneficiaries->count();
        $menu = new Menu();
        $menu->kitchen_id = $user->id;
        $menu->receiver_id = $request->receiver_id;
        $menu->title = $request->title;
        $menu->date = $request->date;
        $menu->portion = $total ?? 0;
        $menu->description = $request->description;
        $menu->status = "Draft";

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('menu', $imageName, 'public');
            $menu->image = $imageName;
        }
        $menu->save();
        Nutrition::create([
            'menu_id' => $menu->id,
            'calories' => $request->calories,
            'protein' => $request->protein,
            'carbs' => $request->carbs,
            'fats' => $request->fats,
        ]);

        MenuStatusLog::create([
            'menu_id' => $menu->id,
            'status' => $menu->status,
            'created_at' => now(),
        ]);

        return redirect()->route('menu')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit($slug)
    {
        $title = 'Edit Menu';
        $menu = Menu::where('slug', $slug)->firstOrFail();
        $receivers = Receiver::all();
        return view('dashboard.components.menu.update', compact('title', 'menu', 'receivers'));
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'receiver_id' => 'required',
            'title' => 'required',
            'date' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:5120',
            'description' => 'nullable',
            'calories' => 'nullable|numeric',
            'protein' => 'nullable|numeric',
            'carbs' => 'nullable|numeric',
            'fats' => 'nullable|numeric',
        ]);
        $user = Kitchen::where('user_id', Auth::id())->firstOrFail();
        $menu = Menu::where('slug', $slug)->firstOrFail();
        $menu->kitchen_id = $user->id;
        $menu->receiver_id = $request->receiver_id;
        $menu->title = $request->title;
        $menu->date = $request->date;
        $menu->portion = $menu->portion;
        $menu->status = $menu->status;
        $menu->description = $request->description;


        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('menu', $imageName, 'public');
            $menu->image = $imageName;
        }
        $menu->save();
        $nutrition = Nutrition::where('menu_id', $menu->id)->first();
        if ($nutrition) {
            $nutrition->calories = $request->calories;
            $nutrition->protein = $request->protein;
            $nutrition->carbs = $request->carbs;
            $nutrition->fats = $request->fats;
            $nutrition->save();
        } else {
            Nutrition::create([
                'menu_id' => $menu->id,
                'calories' => $request->calories,
                'protein' => $request->protein,
                'carbs' => $request->carbs,
                'fats' => $request->fats,
            ]);
        }
        MenuStatusLog::create([
            'menu_id' => $menu->id,
            'status' => $menu->status,
            'created_at' => now(),
        ]);

        return redirect()->route('menu')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy($slug)
    {
        $menu = Menu::where('slug', $slug)->firstOrFail();
        $menu->delete();

        return redirect()->route('menu')->with('success', 'Menu berhasil dihapus.');
    }

    public function status($slug, Request $request)
    {
        $menu = Menu::where('slug', $slug)->firstOrFail();
        $menu->status = $request->status;
        $menu->save();

        MenuStatusLog::create([
            'menu_id' => $menu->id,
            'status' => $menu->status,
            'created_at' => now(),
        ]);

        return redirect()->route('menu')->with('success', 'Status menu berhasil diperbarui.');
    }
}
