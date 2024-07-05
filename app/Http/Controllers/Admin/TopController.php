<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class TopController extends Controller
{
    public function showTop()
    {
        return view('admin.top');
    }
}
