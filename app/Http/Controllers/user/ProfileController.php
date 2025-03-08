<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * プロフィール編集画面の表示
     */
    public function edit()
    {
        $user = Auth::guard('user')->user();
        return view('user.profile_edit', compact('user'));
    }

    /**
     * プロフィール情報の更新処理
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'          => 'nullable|string|max:255',
            'name_kana'     => 'nullable|string|max:255',
            'email'         => 'nullable|email|unique:users,email,' . Auth::id(),
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        /** @var User $user */
        $user = Auth::guard('user')->user();

        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'ユーザーが見つかりません']);
        }

        // プロフィール画像の処理
        if ($request->hasFile('profile_image')) {
            // 新しい画像アップロード前に、既存の画像があれば削除
            if ($user->profile_image) {
                Storage::delete('public/' . $user->profile_image);
            }

            // storage/app/public/images/profile に画像を保存
            $path = $request->file('profile_image')->store('images/profile', 'public');
            $user->profile_image = $path;
        }

        // 入力がある場合のみ更新
        if ($request->filled('name')) {
            $user->name = $request->name;
        }

        if ($request->filled('name_kana')) {
            $user->name_kana = $request->name_kana;
        }

        if ($request->filled('email')) {
            $user->email = $request->email;
        }

        $user->save();

        return redirect()->back()->with('success', 'プロフィールが更新されました！');
    }

    /**
     * パスワード変更フォームの表示
     */
    public function showChangePasswordForm()
    {
        return view('user.password_edit');
    }

    /**
     * パスワードの更新処理
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        /** @var \App\Models\User|null $user */
        $user = Auth::guard('user')->user();

        if (!$user) {
            return back()->withErrors(['error' => 'ユーザーが見つかりません']);
        }

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => '現在のパスワードが一致しません']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('user.password.change')->with('success', 'パスワードが変更されました');
    }
}
