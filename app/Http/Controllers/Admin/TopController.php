<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TopController extends Controller
{
    public function showTop(){
        $admin = Auth::guard('admin')->user();

        return view('admin.layouts.top', compact('admin'));
  }
}
