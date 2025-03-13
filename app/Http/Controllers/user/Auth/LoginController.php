<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:user')->except('logout'); // ✅ 修正
    }
    
    
    protected $redirectTo = '/user/top'; // ユーザーのリダイレクト先を変更

    public function showLoginForm()
    {
        return view('user.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
    
        if (Auth::guard('user')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return redirect()->intended($this->redirectTo); // ✅ ここを統一
        }
    
        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが間違っています。',
        ]);
    }
    

    public function logout(Request $request)
    {
        Auth::guard('user')->logout(); // ✅ user ガードでログアウトする
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/user/login');
    }
    
}
