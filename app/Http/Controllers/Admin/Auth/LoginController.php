<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests\AdminLoginRequest;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    use AuthenticatesUsers {
        logout as performLogout;
    }

    public function login(AdminLoginRequest $request)
    {
        //バリデーション処理
        $validated = $request->validated();
        //認証
        if(Auth::guard('admin')->attempt($request->only('email','password'))){
            return redirect()->intended('/admin/top');
        }
        //エラー時の処理
        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません。',])->withInput();
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/top';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');    
    }

    public function guard()
    {
        return Auth::guard('admin');
    }

    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect('admin/login');
    }
}
