<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/admin/top';

    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function showRegisterForm()
    {
        return view('admin.auth.register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_image' => 'default.jpg', // ✅ 追加
        ]);

        Auth::guard('admin')->login($admin);

        return redirect('/admin/top'); // 強制的に /admin/top にリダイレクト
    }
}
