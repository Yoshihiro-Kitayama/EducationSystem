<?php

namespace App\Http\Controllers\User; // ✅ ここを確認！

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('user.password_edit'); // Bladeファイルを正しく指定
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => '現在のパスワードが一致しません']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('user.password.change')->with('success', 'パスワードが変更されました');
    }
}
