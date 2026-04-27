<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use App\Models\Kitchen;
use App\Models\Receiver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeneficiaryController extends Controller
{
    public function index()
    {
        $title = 'Penerima Manfaat';
        // $data = Beneficiary::all();
        $kitchen = Kitchen::where('user_id', Auth::id())->first();

        $data = Beneficiary::whereHas('receiver', function ($q) use ($kitchen) {
            $q->where('kitchen_id', $kitchen->id);
        })->get();
        return view('dashboard.components.beneficiary.index', compact('data', 'title'));
    }

    public function create()
    {
        $title = 'Tambah Penerima Manfaat';
        $receivers = Receiver::all();
        return view('dashboard.components.beneficiary.create', compact('receivers', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'nullable|numeric',
            'address' => 'nullable',
            'receiver_id' => 'nullable|exists:receivers,id',
            'acceptance_count' => 'nullable|integer',
            'password' => 'required|min:8',
            'username' => 'required|unique:users,idnumber',
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
        ])->assignRole('user');

        Beneficiary::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'receiver_id' => $request->receiver_id,
            'acceptance_count' => $request->acceptance_count ?? 0,
            'user_id' => $user->id,
        ]);
        $receiverCount = Receiver::find($request->receiver_id)->first();
        $receiverCount->update([
            'portion' => $receiverCount->portion + 1,
        ]);
        return redirect()->route('beneficiary')->with('success', 'Penerima manfaat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $beneficiary = Beneficiary::findOrFail($id);
        $receivers = Receiver::all();
        $title = 'Edit Penerima Manfaat';
        return view('dashboard.components.beneficiary.update', compact('beneficiary', 'receivers', 'title'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'nullable',
            'address' => 'nullable',
            'receiver_id' => 'nullable|exists:receivers,id',
            'acceptance_count' => 'nullable|integer',
        ]);

        $beneficiary = Beneficiary::findOrFail($id);
        $beneficiary->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'receiver_id' => $request->receiver_id,
            'acceptance_count' => $request->acceptance_count ?? 0,
        ]);

        return redirect()->route('beneficiary')->with('success', 'Penerima manfaat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $beneficiary = Beneficiary::findOrFail($id);
        $beneficiary->delete();

        return redirect()->route('beneficiary')->with('success', 'Penerima manfaat berhasil dihapus.');
    }
}
