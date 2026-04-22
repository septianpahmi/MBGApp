<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MenuStatusLog;
use Illuminate\Http\Request;

class MenuLogsController extends Controller
{
    public function index()
    {
        $data = MenuStatusLog::latest()->get();
        return view('dashboard.components.menulogs.index', [
            'title' => 'Menu Logs',
            'data' => $data
        ]);
    }

    public function destroy($id)
    {
        $menu = MenuStatusLog::findOrFail($id);
        $menu->delete();
        return redirect()->route('menuLogs')->with('success', 'Menu log berhasil dihapus.');
    }
}
