<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Models\Grade;
use App\Http\Controllers\Controller;


class ProfileController extends Controller
{

    public function __construct()
{
    $this->middleware('auth')->except('showLogin');
}

    public function showProfileForm(Request $request){

        $curriculums = Curriculum::all();
        $grades = Grade::all();

        return view('user.layouts.profile_edit', compact('curriculums', 'grades'));
    }
}
