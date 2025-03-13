<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curriculum;

class DeliveryController extends Controller
{
    public function show(Curriculum $curriculum)
    {
        return view('user.delivery', compact('curriculum'));
    }
}
