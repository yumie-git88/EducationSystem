<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class TopController extends Controller
{
    public function showTop()
    {
        return view('user.top');
    }
}
