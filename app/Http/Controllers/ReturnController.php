<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function good_return()
    {
        return view('admin.returns.good-return');
    }
}
