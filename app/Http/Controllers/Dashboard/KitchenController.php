<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Kitchen;
use App\Models\User;
use Illuminate\Http\Request;

class KitchenController extends Controller
{
    public function index()
    {
        $title = 'Dapur';
        $data = Kitchen::all();
        return view('dashboard.components.kitchen.index', compact('title', 'data'));
    }

    public function create()
    {
        $title = 'Tambah Dapur';
        return view('dashboard.components.kitchen.create', compact('title'));
    }

    public function edit($slug)
    {
        $title = 'Edit Dapur';
        $kitchen = Kitchen::where('slug', $slug)->first();
        return view('dashboard.components.kitchen.update', compact('title', 'kitchen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'phone' => 'required',
            'address' => 'required',
        ]);
        $email = null;
        $idnumber = null;

        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            $email = $request->username;

            if (User::where('email', $email)->exists()) {
                return back()->withErrors(['username' => 'Email sudah digunakan']);
            }
        } else {
            $idnumber = $request->username;

            if (User::where('idnumber', $idnumber)->exists()) {
                return back()->withErrors(['username' => 'NIK/NIS sudah digunakan']);
            }
        }
        $user = User::create([
            'name' => $request->name,
            'idnumber' => $idnumber,
            'email' => $email,
            'password' => bcrypt($request->password),
        ])->assignRole('kitchen');

        $kitchen = new Kitchen();
        $kitchen->name = $request->name;
        $kitchen->phone = $request->phone;
        $kitchen->address = $request->address;
        $kitchen->user_id = $user->id;
        $kitchen->save();

        return redirect('/kitchen')->with('success', 'Dapur berhasil ditambahkan.');
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $kitchen = Kitchen::where('slug', $slug)->first();
        $kitchen->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect('/kitchen')->with('success', 'Dapur berhasil diperbarui.');
    }

    public function destroy($slug)
    {
        $kitchen = Kitchen::where('slug', $slug)->first();
        $kitchen->delete();

        return redirect('/kitchen')->with('success', 'Dapur berhasil dihapus.');
    }
}
