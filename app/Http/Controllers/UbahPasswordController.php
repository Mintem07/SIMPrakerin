<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UbahPasswordController extends Controller
{
    public function showSetting()
    {
        return view('siswa.setting');
    }

    public function ubahPassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with(['error' => 'Password lama tidak cocok.']);
        }

        $user->update([
            'password' => $request->new_password,
        ]);

        return redirect()->back()->with('success', 'Password berhasil diubah.');
    }
}
