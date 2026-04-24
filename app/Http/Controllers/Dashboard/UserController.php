<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $title = "Data Users";
        $data = User::all();
        return view('dashboard.components.users.index', compact('title', 'data'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/users')->with('success', 'User deleted successfully.');
    }

    public function create()
    {
        $title = "Create User";
        return view('dashboard.components.users.create', compact('title'));
    }

    public function edit($id)
    {
        $title = "Edit User";
        $data = User::findOrFail($id);
        return view('dashboard.components.users.update', compact('title', 'data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
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

        User::create([
            'name' => $request->name,
            'email' => $email,
            'idnumber' => $idnumber,
            'password' => bcrypt($request->password),
        ])->assignRole(['admin']);

        return redirect('/users')->with('success', 'User created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
        ]);

        $user = User::findOrFail($id);

        $email = null;
        $idnumber = null;

        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            $email = $request->username;

            if (User::where('email', $email)->where('id', '!=', $id)->exists()) {
                return back()->withErrors(['username' => 'Email sudah digunakan']);
            }
        } else {
            $idnumber = $request->username;

            if (User::where('idnumber', $idnumber)->where('id', '!=', $id)->exists()) {
                return back()->withErrors(['username' => 'NIK/NIS sudah digunakan']);
            }
        }

        $user->update([
            'name' => $request->name,
            'email' => $email,
            'idnumber' => $idnumber,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        return redirect('/users')->with('success', 'User updated successfully.');
    }
}
