<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::guard('user')->user();
        return view('user.profile_edit', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        /** @var User $user */
        $user = Auth::guard('user')->user();

        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'ユーザーが見つかりません']);
        }

        try {
            $user->updateProfile($request->all());
            return redirect()->back()->with('success', 'プロフィールが更新されました！');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'プロフィールの更新に失敗しました: ' . $e->getMessage()]);
        }
    }

    public function showChangePasswordForm()
    {
        return view('user.password_edit');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        /** @var User $user */
        $user = Auth::guard('user')->user();

        if (!$user) {
            return back()->withErrors(['error' => 'ユーザーが見つかりません']);
        }

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => '現在のパスワードが一致しません']);
        }

        try {
            $user->changePassword($request->new_password);
            return redirect()->route('user.password.change')->with('success', 'パスワードが変更されました');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'パスワード変更に失敗しました: ' . $e->getMessage()]);
        }
    }
}
