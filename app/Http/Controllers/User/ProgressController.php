<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Models\Grade;
use App\Http\Controllers\Controller;

class ProgressController extends Controller
{

    public function __construct()
{
    $this->middleware('auth')->except('showLogin');
}

    public function showProgress(Request $request){

        $curriculums = Curriculum::all();
        $grades = Grade::all();

        return view('user.layouts.curriculum_progress', compact('curriculums', 'grades'));
    }
}
