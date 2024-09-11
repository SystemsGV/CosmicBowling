<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class TestView extends Controller
{
    public function index()
    {
        $title = 'Test';
        return view('frontend/test', compact('title'));
    }
}
